<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Testimoni;
use App\Models\AiGeneration;
use App\Models\Transaction;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardSuperAdminController extends Controller
{
    public function index()
    {
        $paidStatuses = ['paid', 'PAID', 'success', 'SUCCESS'];

        // ── Basic Stats ──────────────────────────────────────────────
        $pelanggan          = User::where('role', 'user')->count();
        $generations        = AiGeneration::count();
        $testimonis         = Testimoni::count();
        $totalRevenue       = Transaction::whereIn('status', $paidStatuses)->sum('amount');
        $totalTopupBerhasil = Transaction::whereIn('status', $paidStatuses)->count();

        // ── Chart: Revenue per bulan (12 bulan terakhir) ─────────────
        $revenueMonthly = Transaction::whereIn('status', $paidStatuses)
            ->where(function($q) {
                $q->where('paid_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
                  ->orWhere(function($q2) {
                      $q2->whereNull('paid_at')->where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth());
                  });
            })
            ->select(
                DB::raw("DATE_FORMAT(COALESCE(paid_at, created_at), '%Y-%m') as bulan"),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $revenueLabels = [];
        $revenueData   = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('Y-m');
            $label = Carbon::now()->subMonths($i)->translatedFormat('M Y');
            $row   = $revenueMonthly->firstWhere('bulan', $month);
            $revenueLabels[] = $label;
            $revenueData[]   = $row ? (int) $row->total : 0;
        }

        // ── Chart: Generasi AI per bulan (12 bulan terakhir) ─────────
        $genMonthly = AiGeneration::where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $genLabels = [];
        $genData   = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('Y-m');
            $label = Carbon::now()->subMonths($i)->translatedFormat('M Y');
            $row   = $genMonthly->firstWhere('bulan', $month);
            $genLabels[] = $label;
            $genData[]   = $row ? (int) $row->total : 0;
        }

        // ── Chart: Pelanggan baru per bulan (12 bulan terakhir) ──────
        $userMonthly = User::where('role', 'user')
            ->where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $userLabels = [];
        $userData   = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('Y-m');
            $label = Carbon::now()->subMonths($i)->translatedFormat('M Y');
            $row   = $userMonthly->firstWhere('bulan', $month);
            $userLabels[] = $label;
            $userData[]   = $row ? (int) $row->total : 0;
        }

        // ── Topup Terbaru (10 transaksi terakhir yang paid) ───────────
        $latestTopup = Transaction::with(['user', 'package'])
            ->whereIn('status', $paidStatuses)
            ->latest(DB::raw('COALESCE(paid_at, created_at)'))
            ->take(10)
            ->get();

        return view('pagesuperadmin.dashboard.index', compact(
            'pelanggan',
            'generations',
            'testimonis',
            'totalRevenue',
            'totalTopupBerhasil',
            'revenueLabels',
            'revenueData',
            'genLabels',
            'genData',
            'userLabels',
            'userData',
            'latestTopup'
        ));
    }
}
