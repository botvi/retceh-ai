<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Package;
use App\Models\User;
use App\Models\Setting;
use App\Models\Transaction;
use RealRashid\SweetAlert\Facades\Alert;

class TopupController extends Controller
{
    /**
     * Tampilkan halaman daftar paket.
     */
    public function index()
    {
        $packages = Package::all();
        return view('pageuser.landing.paket', compact('packages'));
    }

    /**
     * Buat transaksi QRIS baru dan tampilkan halaman checkout.
     * Jika QRIS belum dikonfigurasi, fallback ke mock checkout.
     */
    public function checkout($packageId)
    {
        if (!Auth::check()) {
            Alert::info('Silakan Login', 'Silakan masuk atau buat akun terlebih dahulu untuk melanjutkan pembelian paket.');
            return redirect()->route('login');
        }

        $package = Package::findOrFail($packageId);
        $user    = Auth::user();

        // Ambil konfigurasi QRIS dari settings
        $apiKey     = Setting::getValue('qris_api_key');
        $merchantId = Setting::getValue('qris_merchant_id');

        // Jika QRIS belum dikonfigurasi, gunakan mock checkout lama
        if (empty($apiKey) || empty($merchantId)) {
            return view('pageuser.topup.mock_checkout', compact('package'));
        }

        // Buat order_id unik
        $orderId = 'STD-' . time() . '-' . $user->id . '-' . $package->id;

        // Webhook URL dari settings (atau auto-generate)
        $webhookUrl = Setting::getValue('qris_webhook_url') ?: url('/topup/webhook/qris');

        // Panggil KlikQris API untuk buat transaksi
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'x-api-key'    => $apiKey,
                'id_merchant'  => $merchantId,
            ])->post('https://klikqris.com/api/qris/create', [
                'order_id'     => $orderId,
                'id_merchant'  => $merchantId,
                'amount'       => $package->price,
                'keterangan'   => 'Pembelian ' . $package->credits . ' Neurium - ' . $package->name,
                'callback_url' => $webhookUrl,
            ]);

            $result = $response->json();

            if (!$result || !($result['status'] ?? false)) {
                throw new \Exception($result['message'] ?? 'Gagal membuat transaksi QRIS.');
            }

            $data = $result['data'];

            // Parse expired_at robustly (seconds, timestamp, or date string)
            $expiredAtRaw = $data['expired_at'] ?? null;
            $expiredAt = null;
            if ($expiredAtRaw) {
                if (is_numeric($expiredAtRaw)) {
                    $expiredAt = ((int)$expiredAtRaw > 1000000000)
                        ? \Carbon\Carbon::createFromTimestamp((int)$expiredAtRaw)
                        : now()->addSeconds((int)$expiredAtRaw);
                } else {
                    try {
                        $expiredAt = \Carbon\Carbon::parse($expiredAtRaw);
                    } catch (\Exception $e) {
                        $expiredAt = now()->addMinutes(60);
                    }
                }
            } else {
                $expiredAt = now()->addMinutes(60);
            }

            // Simpan transaksi ke database
            $transaction = Transaction::create([
                'order_id'     => $orderId,
                'user_id'      => $user->id,
                'package_id'   => $package->id,
                'amount'       => $package->price,
                'total_amount' => (int) ($data['total_amount'] ?? $package->price),
                'status'       => 'PENDING',
                'signature'    => $data['signature'] ?? null,
                'qris_url'     => $data['qris_url'] ?? null,
                'qris_image'   => $data['qris_image'] ?? null,
                'expired_at'   => $expiredAt,
            ]);

            return view('pageuser.topup.qris_checkout', compact('package', 'transaction', 'data'));

        } catch (\Exception $e) {
            Log::error('QRIS Checkout Error: ' . $e->getMessage());
            Alert::error('Gagal', 'Terjadi kesalahan saat membuat transaksi QRIS. Silakan coba lagi.');
            return redirect()->route('topup.index');
        }
    }

    /**
     * Proses mock checkout (fallback jika QRIS belum dikonfigurasi).
     * Tambah kredit user langsung tanpa payment gateway.
     */
    public function process(Request $request, $packageId)
    {
        $package = Package::findOrFail($packageId);
        $user    = Auth::user();

        // Increment user credits
        $user->credits += $package->credits;
        User::where('id', $user->id)->update(['credits' => $user->credits]);

        Alert::success('Pembelian Berhasil!', "Selamat, saldo akun Anda berhasil ditambahkan {$package->credits} Neurium.");
        return redirect()->route('studio.index');
    }

    /**
     * AJAX: Polling status transaksi QRIS secara manual.
     */
    public function checkStatus(Request $request, $orderId)
    {
        $transaction = Transaction::where('order_id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Jika sudah SUCCESS/EXPIRED, langsung return dari DB
        if (in_array($transaction->status, ['SUCCESS', 'EXPIRED'])) {
            return response()->json([
                'success'       => true,
                'status'        => $transaction->status,
                'paid_at'       => $transaction->paid_at?->toDateTimeString(),
                'total_amount'  => $transaction->total_amount,
            ]);
        }

        // Cek status real-time ke KlikQris API
        $apiKey     = Setting::getValue('qris_api_key');
        $merchantId = Setting::getValue('qris_merchant_id');

        try {
            $response = Http::withHeaders([
                'x-api-key'   => $apiKey,
                'id_merchant' => $merchantId,
            ])->get("https://klikqris.com/api/qris/status/{$orderId}");

            $result = $response->json();

            if (!$result || !($result['status'] ?? false)) {
                throw new \Exception('Gagal cek status QRIS.');
            }

            $remoteStatus = strtoupper($result['data']['status'] ?? 'PENDING');

            // Update status lokal jika berubah
            if ($remoteStatus === 'SUCCESS' && $transaction->status !== 'SUCCESS') {
                $this->grantCredits($transaction, $remoteStatus, $result['data']['paid_at'] ?? null);
            } elseif ($remoteStatus === 'EXPIRED' && $transaction->status !== 'EXPIRED') {
                $transaction->update(['status' => 'EXPIRED']);
            }

            $transaction->refresh();

            return response()->json([
                'success'      => true,
                'status'       => $transaction->status,
                'paid_at'      => $transaction->paid_at?->toDateTimeString(),
                'total_amount' => $transaction->total_amount,
            ]);

        } catch (\Exception $e) {
            Log::error('QRIS Status Check Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memeriksa status transaksi.',
                'status'  => $transaction->status,
            ]);
        }
    }

    /**
     * Webhook handler: menerima callback dari KlikQris saat status berubah.
     * Route: POST /topup/webhook/qris (tanpa auth middleware)
     */
    public function webhookCallback(Request $request)
    {
        $payload = $request->json()->all();

        Log::info('QRIS Webhook received', $payload);

        $orderId   = $payload['order_id']  ?? null;
        $status    = strtoupper($payload['status'] ?? '');
        $signature = $payload['signature'] ?? null;

        if (!$orderId || !$status) {
            return response('Bad Request', 400);
        }

        // Cari transaksi di database
        $transaction = Transaction::where('order_id', $orderId)->first();

        if (!$transaction) {
            Log::warning('QRIS Webhook: Transaction not found', ['order_id' => $orderId]);
            return response('OK', 200); // Return 200 agar tidak di-retry
        }

        // Double Security: Validasi signature
        if ($signature && $transaction->signature && $signature !== $transaction->signature) {
            Log::warning('QRIS Webhook: Invalid signature', ['order_id' => $orderId]);
            return response('Unauthorized', 401);
        }

        // Hindari pemrosesan ganda
        if ($transaction->status === 'SUCCESS') {
            Log::info('QRIS Webhook: Already processed', ['order_id' => $orderId]);
            return response('OK', 200);
        }

        // Proses sesuai status
        if ($status === 'PAID' || $status === 'SUCCESS') {
            $paidAt = $payload['payment_date'] ?? now()->toDateTimeString();
            $this->grantCredits($transaction, 'SUCCESS', $paidAt);
            Log::info('QRIS Webhook: Credits granted', ['order_id' => $orderId, 'user_id' => $transaction->user_id]);
        } elseif ($status === 'EXPIRED') {
            $transaction->update(['status' => 'EXPIRED']);
        }

        return response('OK', 200);
    }

    /**
     * Helper: tambah kredit user dan update status transaksi ke SUCCESS.
     */
    private function grantCredits(Transaction $transaction, string $status, ?string $paidAt = null)
    {
        $transaction->update([
            'status'  => 'SUCCESS',
            'paid_at' => $paidAt ? \Carbon\Carbon::parse($paidAt) : now(),
        ]);

        // Tambah kredit ke user (idempotent check sudah di level caller)
        $user = User::find($transaction->user_id);
        if ($user) {
            User::where('id', $user->id)->update([
                'credits' => $user->credits + $transaction->package->credits,
            ]);
        }
    }
}