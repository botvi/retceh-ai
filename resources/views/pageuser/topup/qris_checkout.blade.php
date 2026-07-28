@extends('layouts.studio')

@section('title', 'Checkout QRIS | retcehStudio')

@section('content')
<main class="w-full flex-grow px-4 sm:px-6 py-5 flex items-center justify-center">

    <div id="view-qris-checkout" class="view-section w-full max-w-md mx-auto space-y-4">

        {{-- ======================================================= --}}
        {{-- HEADER                                                   --}}
        {{-- ======================================================= --}}
        <div class="text-center space-y-1">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-wise-green/10 text-forest text-[11px] font-bold shadow-sm border border-wise-green/20">
                <i class="bi bi-qr-code-scan"></i> PEMBAYARAN QRIS
            </div>
            <h2 class="text-xl font-bold tracking-tight text-forest mt-1.5 lowercase">checkout.</h2>
            <p class="text-xs text-zinc-500 leading-relaxed">Scan QR di bawah menggunakan aplikasi e-wallet atau mobile banking Anda.</p>
        </div>

        {{-- ======================================================= --}}
        {{-- TIMER COUNTDOWN                                          --}}
        {{-- ======================================================= --}}
        <div class="flex items-center justify-center gap-2 py-2">
            <div id="countdown-wrapper" class="flex items-center gap-2 px-4 py-2 bg-amber-50 border border-amber-200 rounded-2xl text-xs font-bold text-amber-700">
                <i class="bi bi-clock-history animate-pulse"></i>
                Berlaku: <span id="countdown-timer" class="font-black tabular-nums">-- Menit</span>
            </div>
            {{-- Status Badge (akan diupdate via JS) --}}
            <div id="status-badge" class="flex items-center gap-1.5 px-4 py-2 rounded-2xl text-xs font-bold border bg-zinc-50 border-zinc-200 text-zinc-500">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse inline-block"></span>
                <span id="status-text">Menunggu Pembayaran</span>
            </div>
        </div>

        {{-- ======================================================= --}}
        {{-- CARD UTAMA                                               --}}
        {{-- ======================================================= --}}
        <div class="rounded-3xl border border-zinc-200 bg-white shadow-xl overflow-hidden">

            {{-- QR Code Section --}}
            <div class="p-6 flex flex-col items-center gap-4 border-b border-zinc-100">
                <div id="qris-loading" class="flex flex-col items-center gap-2 text-zinc-400 py-4">
                    <div class="w-10 h-10 border-4 border-zinc-100 border-t-wise-green rounded-full animate-spin"></div>
                    <span class="text-xs">Memuat QR Code...</span>
                </div>

                <div id="qris-container" class="hidden flex flex-col items-center gap-3">
                    @if(!empty($data['qris_image']))
                        {{-- QR dari base64 image --}}
                        <div class="relative p-3 bg-white border-2 border-zinc-200 rounded-2xl shadow-inner">
                            <img src="{{ $data['qris_image'] }}"
                                 alt="QRIS QR Code"
                                 class="w-52 h-52 object-contain rounded-xl"
                                 id="qris-img"
                                 onerror="this.style.display='none'; document.getElementById('qris-img-fallback').style.display='block';">
                            <img src="{{ $data['qris_url'] ?? '' }}"
                                 alt="QRIS QR Code"
                                 class="w-52 h-52 object-contain rounded-xl hidden"
                                 id="qris-img-fallback">
                        </div>
                    @elseif(!empty($data['qris_url']))
                        {{-- QR dari URL --}}
                        <div class="relative p-3 bg-white border-2 border-zinc-200 rounded-2xl shadow-inner">
                            <img src="{{ $data['qris_url'] }}"
                                 alt="QRIS QR Code"
                                 class="w-52 h-52 object-contain rounded-xl"
                                 id="qris-img">
                        </div>
                    @endif
                    <p class="text-[10px] text-zinc-400 text-center">
                        Berlaku hingga <strong>{{ \Carbon\Carbon::parse($transaction->expired_at)->format('H:i') }} WIB</strong>
                    </p>
                </div>

                {{-- Success overlay (hidden by default) --}}
                <div id="success-overlay" class="hidden flex flex-col items-center gap-3 py-4">
                    <div class="w-20 h-20 rounded-full bg-emerald-50 border-2 border-emerald-200 flex items-center justify-center">
                        <i class="bi bi-check-circle-fill text-4xl text-emerald-500"></i>
                    </div>
                    <div class="text-center space-y-1">
                        <h3 class="text-base font-black text-emerald-600">Pembayaran Berhasil!</h3>
                        <p class="text-xs text-zinc-500">Kredit Anda telah ditambahkan secara otomatis.</p>
                    </div>
                </div>

                {{-- Expired overlay (hidden by default) --}}
                <div id="expired-overlay" class="hidden flex flex-col items-center gap-3 py-4">
                    <div class="w-20 h-20 rounded-full bg-red-50 border-2 border-red-200 flex items-center justify-center">
                        <i class="bi bi-x-circle-fill text-4xl text-red-400"></i>
                    </div>
                    <div class="text-center space-y-1">
                        <h3 class="text-base font-black text-red-500">QR Code Kadaluwarsa</h3>
                        <p class="text-xs text-zinc-500">Waktu pembayaran telah habis. Silakan buat transaksi baru.</p>
                    </div>
                </div>
            </div>

            {{-- Detail Transaksi --}}
            <div class="p-5 space-y-3">
                <div class="flex items-center justify-between border-b border-zinc-100 pb-2">
                    <span class="text-[11px] text-zinc-500 font-medium">Paket</span>
                    <span class="text-[11px] font-bold text-forest uppercase tracking-wide">{{ $package->name }}</span>
                </div>
                <div class="flex items-center justify-between border-b border-zinc-100 pb-2">
                    <span class="text-[11px] text-zinc-500 font-medium">Kredit Didapat</span>
                    <span class="text-[11px] font-extrabold text-forest flex items-center gap-1">
                        <i class="bi bi-cup-hot-fill text-amber-700 text-xs"></i>
                        {{ $package->credits }} Gelas Kopi
                    </span>
                </div>
                <div class="flex items-center justify-between border-b border-zinc-100 pb-2">
                    <span class="text-[11px] text-zinc-500 font-medium">Order ID</span>
                    <span class="text-[11px] font-mono text-zinc-600">{{ $transaction->order_id }}</span>
                </div>
                <div class="flex items-center justify-between pt-1">
                    <span class="text-xs text-zinc-600 font-semibold">Total Tagihan</span>
                    <span class="text-sm font-black text-forest" id="total-amount">
                        Rp {{ number_format($transaction->total_amount ?? $package->price, 0, ',', '.') }}
                    </span>
                </div>
                <p class="text-[9px] text-zinc-400 text-center leading-relaxed">
                    *Nominal mungkin berbeda dari harga paket karena kode unik QRIS otomatis.
                    Bayar sesuai nominal yang tertera di atas.
                </p>
            </div>

            {{-- Snap Payment & Check Status Buttons --}}
            <div class="px-5 pb-5 space-y-2.5" id="action-buttons">
                <button
                    id="btnPay"
                    data-signature="{{ $data['signature'] ?? '' }}"
                    class="w-full py-3.5 px-5 bg-wise-green text-forest hover:bg-wise-green-hover rounded-full font-extrabold text-xs uppercase tracking-wider transition-all duration-200 cursor-pointer shadow-md hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                    <i class="bi bi-qr-code-scan"></i> Buka Popup Pembayaran QRIS
                </button>

                <button
                    type="button"
                    id="btn-check-status"
                    class="w-full py-3 px-5 bg-white border-2 border-zinc-200 hover:bg-zinc-50 text-forest hover:border-zinc-300 rounded-full font-extrabold text-xs uppercase tracking-wider transition-all duration-200 cursor-pointer shadow-xs flex items-center justify-center gap-2">
                    <i class="bi bi-arrow-repeat text-wise-green text-sm" id="check-status-icon"></i>
                    <span>Cek Status Transaksi</span>
                </button>

                <div class="text-center pt-1">
                    <a href="{{ route('topup.index') }}" class="text-xs text-zinc-500 hover:text-zinc-900 transition underline font-semibold">
                        Batal & Kembali ke Pilih Paket
                    </a>
                </div>
            </div>

            {{-- Aksi setelah SUCCESS --}}
            <div class="px-5 pb-5 hidden" id="success-actions">
                <a href="{{ route('studio.index') }}"
                   class="w-full py-3 px-5 bg-wise-green text-forest hover:bg-wise-green-hover rounded-full font-extrabold text-xs uppercase tracking-wider transition-all duration-200 shadow-md hover:-translate-y-0.5 flex items-center justify-center gap-2 no-underline">
                    <i class="bi bi-magic"></i> Mulai Gunakan Gelas Kopi
                </a>
            </div>

            {{-- Aksi setelah EXPIRED --}}
            <div class="px-5 pb-5 hidden" id="expired-actions">
                <a href="{{ route('topup.checkout', $package->id) }}"
                   class="w-full py-3 px-5 bg-zinc-900 text-white hover:bg-zinc-800 rounded-full font-extrabold text-xs uppercase tracking-wider transition-all duration-200 shadow-md hover:-translate-y-0.5 flex items-center justify-center gap-2 no-underline">
                    <i class="bi bi-arrow-clockwise"></i> Buat Transaksi Baru
                </a>
            </div>
        </div>

        {{-- Info tambahan --}}
        <div class="bg-zinc-50 border border-zinc-200 rounded-2xl p-4 space-y-2">
            <h4 class="text-[11px] font-bold text-zinc-600 uppercase tracking-wider flex items-center gap-1.5">
                <i class="bi bi-shield-check text-wise-green"></i> Cara Pembayaran
            </h4>
            <ol class="text-[10px] text-zinc-500 space-y-1.5 list-decimal list-inside leading-relaxed">
                <li>Buka aplikasi e-wallet (GoPay, OVO, Dana, LinkAja, dll.) atau mobile banking.</li>
                <li>Pilih fitur <strong>Scan QR / QRIS</strong> di aplikasi.</li>
                <li>Scan kode QR di atas atau klik tombol <strong>Buka Popup Pembayaran</strong>.</li>
                <li>Konfirmasi nominal sesuai tagihan dan selesaikan pembayaran.</li>
                <li>Kredit akan otomatis ditambahkan setelah pembayaran berhasil.</li>
            </ol>
        </div>

    </div>
</main>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // ========================
    // Init State
    // ========================
    const orderId       = @json($transaction->order_id);
    const expiredAt     = new Date(@json(\Carbon\Carbon::parse($transaction->expired_at)->toIso8601String()));
    const statusUrl     = '{{ route("topup.check-status", $transaction->order_id) }}';
    const csrfToken     = '{{ csrf_token() }}';

    // UI Elements
    const qrisLoading    = document.getElementById('qris-loading');
    const qrisContainer  = document.getElementById('qris-container');
    const successOverlay = document.getElementById('success-overlay');
    const expiredOverlay = document.getElementById('expired-overlay');
    const actionButtons  = document.getElementById('action-buttons');
    const successActions = document.getElementById('success-actions');
    const expiredActions = document.getElementById('expired-actions');
    const statusBadge    = document.getElementById('status-badge');
    const statusText     = document.getElementById('status-text');
    const countdownEl    = document.getElementById('countdown-timer');
    const countdownWrap  = document.getElementById('countdown-wrapper');

    let pollInterval    = null;
    let countdownInt    = null;
    let isFinished      = false;

    // ========================
    // Show QR Code (after DOM ready)
    // ========================
    qrisLoading.classList.add('hidden');
    qrisContainer.classList.remove('hidden');

    // ========================
    // Countdown Timer (Jam / Menit / Detik)
    // ========================
    function updateCountdown() {
        const now  = new Date();
        const diff = Math.max(0, Math.floor((expiredAt - now) / 1000));
        
        const hours   = Math.floor(diff / 3600);
        const minutes = Math.floor((diff % 3600) / 60);
        const seconds = diff % 60;

        let formatted = '';
        if (hours > 0) {
            formatted = `${hours} Jam ${minutes} Menit`;
        } else if (minutes > 0) {
            formatted = `${minutes} Menit ${seconds} Detik`;
        } else {
            formatted = `${seconds} Detik`;
        }

        countdownEl.textContent = formatted;

        if (diff <= 0 && !isFinished) {
            clearInterval(countdownInt);
            clearInterval(pollInterval);
            onExpired();
        } else if (diff <= 300) {
            // Kurang 5 menit, ubah warna ke merah
            countdownWrap.className = countdownWrap.className
                .replace('bg-amber-50 border-amber-200 text-amber-700', 'bg-red-50 border-red-200 text-red-600');
        }
    }

    countdownInt = setInterval(updateCountdown, 1000);
    updateCountdown();

    // ========================
    // Polling Status (setiap 5 detik)
    // ========================
    function pollStatus() {
        if (isFinished) return;

        fetch(statusUrl, {
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(res => {
            if (!res.success) return;

            const status = (res.status || '').toUpperCase();

            if (status === 'SUCCESS') {
                clearInterval(pollInterval);
                clearInterval(countdownInt);
                onSuccess();
            } else if (status === 'EXPIRED') {
                clearInterval(pollInterval);
                clearInterval(countdownInt);
                onExpired();
            }
        })
        .catch(err => console.warn('Poll error:', err));
    }

    pollInterval = setInterval(pollStatus, 5000);

    // ========================
    // State: SUCCESS
    // ========================
    function onSuccess() {
        if (isFinished) return;
        isFinished = true;

        qrisContainer.classList.add('hidden');
        successOverlay.classList.remove('hidden');
        actionButtons.classList.add('hidden');
        successActions.classList.remove('hidden');
        countdownWrap.classList.add('hidden');

        statusBadge.className = 'flex items-center gap-1.5 px-4 py-2 rounded-2xl text-xs font-bold border bg-emerald-50 border-emerald-200 text-emerald-600';
        statusText.textContent = 'Pembayaran Berhasil!';

        showToast('Pembayaran berhasil! Gelas Kopi telah ditambahkan.', 'success');
    }

    // ========================
    // State: EXPIRED
    // ========================
    function onExpired() {
        if (isFinished) return;
        isFinished = true;

        qrisContainer.classList.add('hidden');
        expiredOverlay.classList.remove('hidden');
        actionButtons.classList.add('hidden');
        expiredActions.classList.remove('hidden');
        countdownWrap.classList.add('hidden');

        statusBadge.className = 'flex items-center gap-1.5 px-4 py-2 rounded-2xl text-xs font-bold border bg-red-50 border-red-200 text-red-500';
        statusText.textContent = 'QR Kadaluwarsa';

        showToast('QR Code telah kadaluwarsa. Silakan buat transaksi baru.', 'error');
    }

    // ========================
    // Manual Check Status Button
    // ========================
    const btnCheckStatus  = document.getElementById('btn-check-status');
    const checkStatusIcon = document.getElementById('check-status-icon');

    if (btnCheckStatus) {
        btnCheckStatus.addEventListener('click', () => {
            if (isFinished) return;

            btnCheckStatus.disabled = true;
            btnCheckStatus.classList.add('opacity-75', 'cursor-not-allowed');
            if (checkStatusIcon) checkStatusIcon.classList.add('animate-spin');

            fetch(statusUrl, {
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(res => {
                btnCheckStatus.disabled = false;
                btnCheckStatus.classList.remove('opacity-75', 'cursor-not-allowed');
                if (checkStatusIcon) checkStatusIcon.classList.remove('animate-spin');

                if (!res.success) {
                    showToast(res.message || 'Gagal memeriksa status.', 'error');
                    return;
                }

                const status = (res.status || '').toUpperCase();

                if (status === 'SUCCESS') {
                    clearInterval(pollInterval);
                    clearInterval(countdownInt);
                    onSuccess();
                } else if (status === 'EXPIRED') {
                    clearInterval(pollInterval);
                    clearInterval(countdownInt);
                    onExpired();
                } else {
                    showToast('Status: Menunggu Pembayaran. Belum ada pembayaran terdeteksi.', 'info');
                }
            })
            .catch(err => {
                btnCheckStatus.disabled = false;
                btnCheckStatus.classList.remove('opacity-75', 'cursor-not-allowed');
                if (checkStatusIcon) checkStatusIcon.classList.remove('animate-spin');
                showToast('Koneksi bermasalah saat mengecek status.', 'error');
            });
        });
    }

    // ========================
    // Snap Payment Popup Script
    // ========================
    var snapScript = document.createElement('script');
    snapScript.src = "https://klikqris.com/js/payment-snap.js?t=" + new Date().getTime();
    snapScript.onload = function () {
        console.log('Snap Payment script loaded.');
    };
    document.body.appendChild(snapScript);
});
</script>
@endsection
