@extends('template-admin.layout')

@section('style')
<style>
/* ── Stats Cards ───────────────────────────── */
.stat-card {
    border: none !important;
    border-radius: 18px !important;
    overflow: hidden;
    position: relative;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 36px rgba(0,0,0,0.15) !important;
}
.stat-card .card-body {
    padding: 1.5rem !important;
}
.stat-card .stat-icon {
    width: 54px; height: 54px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.6rem;
    flex-shrink: 0;
    backdrop-filter: blur(8px);
}
.stat-card .stat-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    opacity: 0.75;
    margin-bottom: 4px;
}
.stat-card .stat-value {
    font-size: 1.85rem;
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.02em;
}
.stat-card .stat-sub {
    font-size: 0.78rem;
    opacity: 0.7;
    margin-top: 4px;
    font-weight: 500;
}
/* Individual card themes */
.card-blue   { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; color: #fff !important; }
.card-green  { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important; color: #fff !important; }
.card-orange { background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%) !important; color: #fff !important; }
.card-pink   { background: linear-gradient(135deg, #f953c6 0%, #b91d73 100%) !important; color: #fff !important; }

.card-blue .stat-icon   { background: rgba(255,255,255,0.22); color:#fff; }
.card-green .stat-icon  { background: rgba(255,255,255,0.22); color:#fff; }
.card-orange .stat-icon { background: rgba(255,255,255,0.22); color:#fff; }
.card-pink .stat-icon   { background: rgba(255,255,255,0.22); color:#fff; }
.stat-card .stat-label, .stat-card .stat-sub { color: rgba(255,255,255,0.85) !important; }
.stat-card .stat-value { color: #fff !important; }

/* ── Chart Cards ───────────────────────────── */
.chart-card {
    border-radius: 18px !important;
    border: 1px solid #e4e4e7 !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03) !important;
    transition: all 0.25s ease;
}
.chart-card:hover {
    box-shadow: 0 8px 30px rgba(0,0,0,0.06) !important;
}
.chart-card .card-header {
    padding: 1.25rem 1.5rem !important;
    border-bottom: 1px solid #f0f0f4 !important;
    background: transparent !important;
}
.chart-card .chart-title {
    font-size: 0.95rem;
    font-weight: 800;
    color: #18181b;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.chart-card .chart-subtitle {
    font-size: 0.78rem;
    color: #71717a;
    margin-top: 3px;
    font-weight: 500;
}

/* ── Table Topup ───────────────────────────── */
.badge-paid    { background: rgba(34,197,94,0.12); color: #15803d; border: 1px solid rgba(34,197,94,0.25); }
.badge-pending { background: rgba(245,158,11,0.12); color: #b45309; border: 1px solid rgba(245,158,11,0.25); }
.badge-expired { background: rgba(239,68,68,0.12); color: #b91c1c; border: 1px solid rgba(239,68,68,0.25); }
.badge-status  { padding: 4px 10px; border-radius: 999px; font-size: 0.72rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; }

/* ── Page Header ───────────────────────────── */
.dash-greeting {
    font-size: 1.4rem;
    font-weight: 800;
    color: #18181b;
    letter-spacing: -0.01em;
}
.dash-greeting span { color: #667eea; }
.dash-date {
    font-size: 0.82rem;
    color: #71717a;
    font-weight: 500;
}
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
                            <h5 class="m-b-10">Dashboard</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Greeting ── --}}
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
            <div>
                <div class="dash-greeting d-flex align-items-center gap-2">
                    Halo, <span>{{ Auth::user()->name }}</span>
                    <i class="ti ti-award text-warning"></i>
                </div>
                <div class="dash-date">{{ now()->translatedFormat('l, d F Y') }} — Ringkasan performa platform secara real-time</div>
            </div>
            <a href="{{ route('riwayat-topup.index') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                <i class="ti ti-receipt"></i> Riwayat Topup
            </a>
        </div>

        {{-- ── Stats Cards Row ── --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="card stat-card card-blue">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon"><i class="ti ti-users"></i></div>
                        <div>
                            <div class="stat-label">Total Pelanggan</div>
                            <div class="stat-value">{{ number_format($pelanggan) }}</div>
                            <div class="stat-sub">Akun user aktif</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card stat-card card-green">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon"><i class="ti ti-photo-ai"></i></div>
                        <div>
                            <div class="stat-label">Generasi AI</div>
                            <div class="stat-value">{{ number_format($generations) }}</div>
                            <div class="stat-sub">Total desain dihasilkan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card stat-card card-orange">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon"><i class="ti ti-cash"></i></div>
                        <div>
                            <div class="stat-label">Total Revenue</div>
                            <div class="stat-value">Rp{{ number_format($totalRevenue / 1000, 1) }}k</div>
                            <div class="stat-sub">{{ $totalTopupBerhasil }} transaksi berhasil</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card stat-card card-pink">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon"><i class="ti ti-message-star"></i></div>
                        <div>
                            <div class="stat-label">Testimoni</div>
                            <div class="stat-value">{{ number_format($testimonis) }}</div>
                            <div class="stat-sub">Total ulasan pelanggan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Charts Row ── --}}
        <div class="row g-3 mb-4">
            {{-- Chart Revenue --}}
            <div class="col-lg-8">
                <div class="card chart-card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <div class="chart-title">
                                <i class="ti ti-trending-up text-primary fs-5"></i> Revenue Bulanan
                            </div>
                            <div class="chart-subtitle">Pendapatan 12 bulan terakhir (transaksi berhasil)</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chartRevenue"></div>
                    </div>
                </div>
            </div>
            {{-- Chart Pelanggan Baru --}}
            <div class="col-lg-4">
                <div class="card chart-card h-100">
                    <div class="card-header">
                        <div class="chart-title">
                            <i class="ti ti-user-plus text-primary fs-5"></i> Pelanggan Baru
                        </div>
                        <div class="chart-subtitle">Registrasi per bulan</div>
                    </div>
                    <div class="card-body">
                        <div id="chartUsers"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            {{-- Chart Generasi AI --}}
            <div class="col-lg-5">
                <div class="card chart-card h-100">
                    <div class="card-header">
                        <div class="chart-title">
                            <i class="ti ti-sparkles text-success fs-5"></i> Generasi AI per Bulan
                        </div>
                        <div class="chart-subtitle">Jumlah desain AI yang dibuat</div>
                    </div>
                    <div class="card-body">
                        <div id="chartGen"></div>
                    </div>
                </div>
            </div>
            {{-- Tabel Topup Terbaru --}}
            <div class="col-lg-7">
                <div class="card chart-card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <div class="chart-title">
                                <i class="ti ti-receipt text-warning fs-5"></i> Topup Terbaru
                            </div>
                            <div class="chart-subtitle">10 transaksi terakhir yang berhasil</div>
                        </div>
                        <a href="{{ route('riwayat-topup.index') }}" class="btn btn-sm btn-secondary d-inline-flex align-items-center gap-1">
                            Lihat Semua <i class="ti ti-chevron-right"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Paket</th>
                                        <th>Jumlah</th>
                                        <th>Tgl Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($latestTopup as $trx)
                                    <tr>
                                        <td>
                                            <div class="fw-600 text-dark" style="font-size:0.82rem;">{{ $trx->user->name ?? '-' }}</div>
                                            <div class="text-muted" style="font-size:0.72rem;">{{ $trx->user->email ?? '' }}</div>
                                        </td>
                                        <td style="font-size:0.82rem;">
                                            <span class="badge bg-light-primary text-primary font-semibold">
                                                {{ $trx->package->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td style="font-size:0.82rem; font-weight:700; color:#16a34a;">
                                            Rp{{ number_format($trx->amount, 0, ',', '.') }}
                                        </td>
                                        <td style="font-size:0.78rem; color:#71717a;">
                                            {{ $trx->paid_at ? $trx->paid_at->format('d M Y') : '-' }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada transaksi</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<script>
// ── Chart Revenue (Area) ────────────────────────────────────────────
var revenueLabels = @json($revenueLabels);
var revenueData   = @json($revenueData);

var optRevenue = {
    series: [{ name: 'Revenue (Rp)', data: revenueData }],
    chart: {
        type: 'area', height: 290, toolbar: { show: false },
        fontFamily: 'Public Sans, sans-serif',
    },
    colors: ['#667eea'],
    fill: {
        type: 'gradient',
        gradient: { shadeIntensity: 1, opacityFrom: 0.45, opacityTo: 0.02, stops: [0, 100] }
    },
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth', width: 3 },
    xaxis: { categories: revenueLabels, labels: { style: { fontSize: '11px', colors: '#71717a' } } },
    yaxis: {
        labels: {
            formatter: v => 'Rp' + (v >= 1000 ? (v/1000).toFixed(0)+'k' : v),
            style: { fontSize: '11px', colors: '#71717a' }
        }
    },
    tooltip: {
        y: { formatter: v => 'Rp ' + v.toLocaleString('id-ID') }
    },
    grid: { borderColor: '#f0f0f0', strokeDashArray: 4 },
};
new ApexCharts(document.querySelector('#chartRevenue'), optRevenue).render();

// ── Chart Pelanggan Baru (Bar) ──────────────────────────────────────
var userLabels = @json($userLabels);
var userData   = @json($userData);

var optUsers = {
    series: [{ name: 'Pelanggan Baru', data: userData }],
    chart: { type: 'bar', height: 270, toolbar: { show: false }, fontFamily: 'Public Sans, sans-serif' },
    colors: ['#764ba2'],
    dataLabels: { enabled: false },
    plotOptions: { bar: { borderRadius: 6, columnWidth: '55%' } },
    xaxis: { categories: userLabels, labels: { style: { fontSize: '10px', colors: '#71717a' }, rotate: -45 } },
    yaxis: { labels: { style: { fontSize: '11px', colors: '#71717a' } } },
    grid: { borderColor: '#f0f0f0', strokeDashArray: 4 },
};
new ApexCharts(document.querySelector('#chartUsers'), optUsers).render();

// ── Chart Generasi AI (Bar) ─────────────────────────────────────────
var genLabels = @json($genLabels);
var genData   = @json($genData);

var optGen = {
    series: [{ name: 'Generasi AI', data: genData }],
    chart: { type: 'bar', height: 270, toolbar: { show: false }, fontFamily: 'Public Sans, sans-serif' },
    colors: ['#11998e'],
    dataLabels: { enabled: false },
    plotOptions: { bar: { borderRadius: 6, columnWidth: '55%' } },
    xaxis: { categories: genLabels, labels: { style: { fontSize: '10px', colors: '#71717a' }, rotate: -45 } },
    yaxis: { labels: { style: { fontSize: '11px', colors: '#71717a' } } },
    grid: { borderColor: '#f0f0f0', strokeDashArray: 4 },
};
new ApexCharts(document.querySelector('#chartGen'), optGen).render();
</script>
@endsection
