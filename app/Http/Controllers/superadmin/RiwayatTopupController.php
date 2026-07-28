<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class RiwayatTopupController extends Controller
{
    public function index(Request $request)
    {
        $paidStatuses    = ['paid', 'PAID', 'success', 'SUCCESS'];
        $pendingStatuses = ['pending', 'PENDING'];
        $expiredStatuses = ['expired', 'EXPIRED'];

        $query = Transaction::with(['user', 'package'])->latest();

        // Filter by status
        if ($request->filled('status')) {
            $st = strtolower($request->status);
            if ($st === 'paid' || $st === 'success') {
                $query->whereIn('status', $paidStatuses);
            } elseif ($st === 'pending') {
                $query->whereIn('status', $pendingStatuses);
            } elseif ($st === 'expired') {
                $query->whereIn('status', $expiredStatuses);
            } else {
                $query->where('status', $request->status);
            }
        }

        // Filter by search (user name / email)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by date range
        if ($request->filled('dari')) {
            $query->whereDate('created_at', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('created_at', '<=', $request->sampai);
        }

        $transactions = $query->paginate(20)->withQueryString();

        // Summary stats
        $totalPaid    = Transaction::whereIn('status', $paidStatuses)->sum('amount');
        $totalPending = Transaction::whereIn('status', $pendingStatuses)->count();
        $totalExpired = Transaction::whereIn('status', $expiredStatuses)->count();
        $countPaid    = Transaction::whereIn('status', $paidStatuses)->count();

        return view('pagesuperadmin.riwayat_topup.index', compact(
            'transactions',
            'totalPaid',
            'totalPending',
            'totalExpired',
            'countPaid'
        ));
    }
}
