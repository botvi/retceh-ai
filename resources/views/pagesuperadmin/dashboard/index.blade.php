@extends('template-admin.layout')

@section('style')
    <style>
        /* ══════════ DASHBOARD STATS CARDS ══════════ */
        .stat-card {
            border: 1px solid hsl(var(--border)) !important;
            border-radius: var(--radius) !important;
            overflow: hidden;
            position: relative;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            background: hsl(var(--card)) !important;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1) !important;
        }

        .stat-card .card-body {
            padding: 1.5rem !important;
        }

        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            background: hsl(var(--muted));
            color: hsl(var(--foreground));
        }

        .stat-card .stat-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: hsl(var(--muted-foreground));
            margin-bottom: 0.25rem;
        }

        .stat-card .stat-value {
            font-size: 1.875rem;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: -0.02em;
            color: hsl(var(--foreground));
        }

        .stat-card .stat-sub {
            font-size: 0.813rem;
            color: hsl(var(--muted-foreground));
            margin-top: 0.25rem;
            font-weight: 500;
        }

        /* ══════════ CHART CARDS ══════════ */
        .chart-card {
            border-radius: var(--radius) !important;
            border: 1px solid hsl(var(--border)) !important;
            box-shadow: none !important;
            transition: all 0.2s ease;
            background: hsl(var(--card)) !important;
        }

        .chart-card:hover {
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1) !important;
        }

        .chart-card .card-header {
            padding: 1rem 1.5rem !important;
            border-bottom: 1px solid hsl(var(--border)) !important;
            background: transparent !important;
        }

        .chart-card .chart-title {
            font-size: 1rem;
            font-weight: 600;
            color: hsl(var(--foreground));
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .chart-card .chart-subtitle {
            font-size: 0.813rem;
            color: hsl(var(--muted-foreground));
            margin-top: 0.25rem;
            font-weight: 500;
        }

        /* ══════════ BADGES ══════════ */
        .badge-paid {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .badge-pending {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .badge-expired {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .badge-status {
            padding: 0.25rem 0.625rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* ══════════ PAGE HEADER ══════════ */
        .dash-greeting {
            font-size: 1.5rem;
            font-weight: 700;
            color: hsl(var(--foreground));
            letter-spacing: -0.02em;
        }

        .dash-greeting span {
            color: hsl(var(--muted-foreground));
        }

        .dash-date {
            font-size: 0.875rem;
            color: hsl(var(--muted-foreground));
            font-weight: 500;
        }

        /* ══════════ RESPONSIVE ══════════ */
        @media (max-width: 768px) {
            .stat-card .card-body {
                padding: 1rem !important;
            }

            .stat-card .stat-icon {
                width: 40px;
                height: 40px;
                font-size: 1.25rem;
            }

            .stat-card .stat-value {
                font-size: 1.5rem;
            }

            .dash-greeting {
                font-size: 1.25rem;
            }

            .chart-card .card-header {
                padding: 1rem !important;
            }
        }

        @media (max-width: 640px) {
            .stat-card .card-body {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 0.75rem !important;
            }
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
                    <div class="dash-date">{{ now()->translatedFormat('l, d F Y') }} — Ringkasan performa platform secara
                        real-time</div>
                </div>
                <a href="{{ route('riwayat-topup.index') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                    <i class="ti ti-receipt"></i> Riwayat Topup
                </a>
            </div>

            {{-- ── Stats Cards Row ── --}}
            <div class="row g-3 mb-4">
                <div class="col-6 col-lg-3">
                    <div class="card stat-card">
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
                    <div class="card stat-card">
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
                    <div class="card stat-card">
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
                    <div class="card stat-card">
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
                                    <i class="ti ti-trending-up" style="font-size: 1.25rem;"></i> Revenue Bulanan
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
                            <a href="{{ route('riwayat-topup.index') }}"
                                class="btn btn-sm btn-secondary d-inline-flex align-items-center gap-1">
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
                                                    <div class="fw-600 text-dark" style="font-size:0.82rem;">
                                                        {{ $trx->user->name ?? '-' }}</div>
                                                    <div class="text-muted" style="font-size:0.72rem;">
                                                        {{ $trx->user->email ?? '' }}</div>
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
                                            <tr>
                                                <td colspan="4" class="text-center py-4 text-muted">Belum ada transaksi
                                                </td>
                                            </tr>
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
        // ══════════ Chart Revenue (Area) ══════════
        var revenueLabels = @json($revenueLabels);
        var revenueData = @json($revenueData);

        var optRevenue = {
            series: [{
                name: 'Revenue (Rp)',
                data: revenueData
            }],
            chart: {
                type: 'area',
                height: 290,
                toolbar: {
                    show: false
                },
                fontFamily: 'Inter, sans-serif',
            },
            colors: ['#0a0a0a'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.2,
                    opacityTo: 0.02,
                    stops: [0, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                categories: revenueLabels,
                labels: {
                    style: {
                        fontSize: '11px',
                        colors: '#737373'
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: v => 'Rp' + (v >= 1000 ? (v / 1000).toFixed(0) + 'k' : v),
                    style: {
                        fontSize: '11px',
                        colors: '#737373'
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: v => 'Rp ' + v.toLocaleString('id-ID')
                }
            },
            grid: {
                borderColor: '#e5e5e5',
                strokeDashArray: 4
            },
        };
        new ApexCharts(document.querySelector('#chartRevenue'), optRevenue).render();

        // ══════════ Chart Pelanggan Baru (Bar) ══════════
        var userLabels = @json($userLabels);
        var userData = @json($userData);

        var optUsers = {
            series: [{
                name: 'Pelanggan Baru',
                data: userData
            }],
            chart: {
                type: 'bar',
                height: 270,
                toolbar: {
                    show: false
                },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#171717'],
            dataLabels: {
                enabled: false
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    columnWidth: '55%'
                }
            },
            xaxis: {
                categories: userLabels,
                labels: {
                    style: {
                        fontSize: '10px',
                        colors: '#737373'
                    },
                    rotate: -45
                }
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: '11px',
                        colors: '#737373'
                    }
                }
            },
            grid: {
                borderColor: '#e5e5e5',
                strokeDashArray: 4
            },
        };
        new ApexCharts(document.querySelector('#chartUsers'), optUsers).render();

        // ══════════ Chart Generasi AI (Bar) ══════════
        var genLabels = @json($genLabels);
        var genData = @json($genData);

        var optGen = {
            series: [{
                name: 'Generasi AI',
                data: genData
            }],
            chart: {
                type: 'bar',
                height: 270,
                toolbar: {
                    show: false
                },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#262626'],
            dataLabels: {
                enabled: false
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    columnWidth: '55%'
                }
            },
            xaxis: {
                categories: genLabels,
                labels: {
                    style: {
                        fontSize: '10px',
                        colors: '#737373'
                    },
                    rotate: -45
                }
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: '11px',
                        colors: '#737373'
                    }
                }
            },
            grid: {
                borderColor: '#e5e5e5',
                strokeDashArray: 4
            },
        };
        new ApexCharts(document.querySelector('#chartGen'), optGen).render();
    </script>
@endsection
