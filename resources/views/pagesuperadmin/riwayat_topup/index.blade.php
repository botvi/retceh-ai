@extends('template-admin.layout')

@section('style')
<style>
/* ── Filter Bar ─────────────────────────────── */
.filter-bar {
    background: #fff;
    border: 1px solid #e4e4e7;
    border-radius: 14px;
    padding: 1.25rem 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
}
.filter-bar label {
    font-size: 0.72rem !important;
    font-weight: 700 !important;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #71717a !important;
    margin-bottom: 5px !important;
}
.filter-bar .form-control,
.filter-bar .form-select {
    font-size: 0.83rem !important;
    padding: 8px 12px !important;
    border-radius: 10px !important;
}

/* ── Stat Summary Cards ─────────────────────── */
.mini-stat {
    border-radius: 14px !important;
    border: 1px solid #e4e4e7 !important;
    padding: 1.1rem 1.4rem;
    background: #fff;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
    display: flex;
    align-items: center;
    gap: 14px;
}
.mini-stat .ms-icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.mini-stat .ms-label { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: #71717a; }
.mini-stat .ms-value { font-size: 1.4rem; font-weight: 800; color: #09090b; line-height: 1.1; }

/* ── Table ──────────────────────────────────── */
.topup-table thead th { font-size: 0.72rem !important; }
.badge-paid    { background: rgba(34,197,94,0.12); color: #16a34a; border: 1px solid rgba(34,197,94,0.3); }
.badge-pending { background: rgba(245,158,11,0.12); color: #d97706; border: 1px solid rgba(245,158,11,0.3); }
.badge-expired { background: rgba(239,68,68,0.12); color: #dc2626; border: 1px solid rgba(239,68,68,0.3); }
.badge-cancelled { background: rgba(113,113,122,0.12); color: #52525b; border: 1px solid rgba(113,113,122,0.3); }
.badge-status  { padding: 4px 12px; border-radius: 999px; font-size: 0.72rem; font-weight: 700; display: inline-block; }

.user-cell .user-avatar {
    width: 34px; height: 34px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e4e4e7;
    flex-shrink: 0;
}
.user-cell .user-name { font-weight: 700; font-size: 0.82rem; color: #09090b; }
.user-cell .user-email { font-size: 0.72rem; color: #71717a; }

.amount-cell { font-weight: 800; color: #16a34a; font-size: 0.88rem; }
.order-id-cell { font-size: 0.72rem; color: #71717a; font-family: monospace; }
</style>
@endsection

@section('content')
<div class="pc-container">
    <div class="pc-content">

        {{-- ── Breadcrumb ── --}}
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Riwayat Topup</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Riwayat Topup</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Summary Stats ── --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="mini-stat">
                    <div class="ms-icon" style="background:rgba(34,197,94,0.1); color:#16a34a;">
                        <i class="ti ti-circle-check-filled"></i>
                    </div>
                    <div>
                        <div class="ms-label">Total Revenue</div>
                        <div class="ms-value">Rp{{ number_format($totalPaid / 1000, 1) }}k</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="mini-stat">
                    <div class="ms-icon" style="background:rgba(34,197,94,0.1); color:#16a34a;">
                        <i class="ti ti-check"></i>
                    </div>
                    <div>
                        <div class="ms-label">Transaksi Berhasil</div>
                        <div class="ms-value">{{ number_format($countPaid) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="mini-stat">
                    <div class="ms-icon" style="background:rgba(245,158,11,0.1); color:#d97706;">
                        <i class="ti ti-clock"></i>
                    </div>
                    <div>
                        <div class="ms-label">Pending</div>
                        <div class="ms-value">{{ number_format($totalPending) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="mini-stat">
                    <div class="ms-icon" style="background:rgba(239,68,68,0.1); color:#dc2626;">
                        <i class="ti ti-x"></i>
                    </div>
                    <div>
                        <div class="ms-label">Expired</div>
                        <div class="ms-value">{{ number_format($totalExpired) }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Filter Bar ── --}}
        <form method="GET" action="{{ route('riwayat-topup.index') }}" class="filter-bar">
            <div class="row g-2 align-items-end">
                <div class="col-12 col-md-4">
                    <label>Cari User</label>
                    <input type="text" name="search" class="form-control" placeholder="Nama atau email user..." value="{{ request('search') }}">
                </div>
                <div class="col-6 col-md-2">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua</option>
                        <option value="paid"    {{ request('status') == 'paid'    ? 'selected' : '' }}>Paid</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <label>Dari Tanggal</label>
                    <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
                </div>
                <div class="col-6 col-md-2">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
                </div>
                <div class="col-6 col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="ti ti-search me-1"></i> Filter
                    </button>
                    <a href="{{ route('riwayat-topup.index') }}" class="btn btn-secondary">
                        <i class="ti ti-refresh"></i>
                    </a>
                </div>
            </div>
        </form>

        {{-- ── Table ── --}}
        <div class="card" style="border-radius:16px !important;">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-0">Riwayat Transaksi Topup</h5>
                    <small class="text-muted">{{ $transactions->total() }} transaksi ditemukan</small>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table topup-table table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width:40px;">#</th>
                                <th>User</th>
                                <th>Paket</th>
                                <th>Order ID</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Tgl Transaksi</th>
                                <th>Tgl Dibayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $i => $trx)
                            <tr>
                                <td class="text-muted" style="font-size:0.8rem;">
                                    {{ ($transactions->currentPage() - 1) * $transactions->perPage() + $i + 1 }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2 user-cell">
                                        @php
                                            $fotoProfile = $trx->user->foto_profile ?? null;
                                            if ($fotoProfile) {
                                                $srcFoto = \Illuminate\Support\Str::startsWith($fotoProfile, ['http://', 'https://'])
                                                    ? $fotoProfile
                                                    : asset('uploads/foto_profile/' . $fotoProfile);
                                            } else {
                                                $srcFoto = asset('env/logo.jpg');
                                            }
                                        @endphp
                                        <img src="{{ $srcFoto }}" alt="foto" class="user-avatar">
                                        <div>
                                            <div class="user-name">{{ $trx->user->name ?? '—' }}</div>
                                            <div class="user-email">{{ $trx->user->email ?? '—' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-size:0.82rem; font-weight:600;">
                                    {{ $trx->package->name ?? '—' }}
                                    @if($trx->package)
                                        <div class="text-muted" style="font-size:0.72rem; font-weight:400;">
                                            {{ $trx->package->credits }} Gelas Kopi
                                        </div>
                                    @endif
                                </td>
                                <td class="order-id-cell">{{ $trx->order_id }}</td>
                                <td class="amount-cell">Rp{{ number_format($trx->amount, 0, ',', '.') }}</td>
                                <td>
                                    @php $st = strtolower($trx->status ?? ''); @endphp
                                    @if(in_array($st, ['paid', 'success']))
                                        <span class="badge-status badge-paid"><i class="ti ti-check me-1"></i> Paid</span>
                                    @elseif($st == 'pending')
                                        <span class="badge-status badge-pending"><i class="ti ti-clock me-1"></i> Pending</span>
                                    @elseif($st == 'expired')
                                        <span class="badge-status badge-expired"><i class="ti ti-x me-1"></i> Expired</span>
                                    @else
                                        <span class="badge-status badge-cancelled">{{ ucfirst($trx->status) }}</span>
                                    @endif
                                </td>
                                <td style="font-size:0.78rem; color:#71717a;">
                                    {{ $trx->created_at->format('d M Y, H:i') }}
                                </td>
                                <td style="font-size:0.78rem; color:#16a34a; font-weight:600;">
                                    {{ $trx->paid_at ? $trx->paid_at->format('d M Y, H:i') : '—' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="ti ti-receipt-off" style="font-size:2rem; display:block; margin-bottom:8px;"></i>
                                    Tidak ada transaksi ditemukan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($transactions->hasPages())
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $transactions->firstItem() }}–{{ $transactions->lastItem() }} dari {{ $transactions->total() }} transaksi
                </small>
                {{ $transactions->links() }}
            </div>
            @endif
        </div>

    </div>
</div>
@endsection
