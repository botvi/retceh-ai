@extends('template-admin.layout')

@section('style')
    <style>
        /* ── Responsive Stat Cards ── */
        .stat-icon-box {
            width: 44px;
            height: 44px;
            border-radius: var(--radius);
            background: hsl(var(--muted));
        }

        .stat-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        .stat-value {
            font-size: 1.75rem;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }

        .stat-sub {
            font-size: 0.813rem;
        }

        /* ── Mobile: smaller stat cards ── */
        @media (max-width: 575.98px) {
            .stat-icon-box {
                width: 36px;
                height: 36px;
            }

            .stat-icon-box i {
                font-size: 1rem !important;
            }

            .stat-value {
                font-size: 1.35rem;
            }

            .stat-label {
                font-size: 0.65rem;
            }

            .stat-sub {
                font-size: 0.7rem;
            }

            .greeting-name {
                font-size: 1.1rem !important;
            }

            .greeting-date {
                font-size: 0.75rem !important;
            }
        }

        @media (max-width: 767.98px) {
            .stat-value {
                font-size: 1.5rem;
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
                                <h5 class="mb-0">Dashboard</h5>
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
            <div
                class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between mb-4 gap-3">
                <div>
                    <h1 class="h3 fw-700 mb-1 greeting-name" style="letter-spacing:-0.02em;">
                        Halo, <span class="text-muted">{{ Auth::user()->name }}</span>
                        <i class="ti ti-award text-warning"></i>
                    </h1>
                    <p class="text-muted mb-0 greeting-date" style="font-size:0.875rem;">
                        {{ now()->translatedFormat('l, d F Y') }} — Ringkasan performa platform secara real-time
                    </p>
                </div>
                <a href="{{ route('riwayat-topup.index') }}" class="btn btn-primary w-100 w-sm-auto">
                    <i class="ti ti-receipt me-1"></i> Riwayat Topup
                </a>
            </div>

            {{-- ── Stat Cards (responsive: 1 col mobile, 2 col tablet, 4 col desktop) ── --}}
            <div class="row g-2 g-sm-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card p-3 p-lg-4 h-100">
                        <div class="d-flex align-items-center gap-2 gap-sm-3">
                            <div class="d-flex align-items-center justify-content-center flex-shrink-0 stat-icon-box">
                                <i class="ti ti-users" style="font-size:1.25rem;"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-muted text-uppercase mb-0 stat-label">Total Pelanggan</p>
                                <p class="fw-700 mb-0 stat-value">{{ number_format($pelanggan) }}</p>
                                <p class="text-muted mb-0 stat-sub">Akun user aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card p-3 p-lg-4 h-100">
                        <div class="d-flex align-items-center gap-2 gap-sm-3">
                            <div class="d-flex align-items-center justify-content-center flex-shrink-0 stat-icon-box">
                                <i class="ti ti-photo-ai" style="font-size:1.25rem;"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-muted text-uppercase mb-0 stat-label">Generasi AI</p>
                                <p class="fw-700 mb-0 stat-value">{{ number_format($generations) }}</p>
                                <p class="text-muted mb-0 stat-sub">Total desain dihasilkan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card p-3 p-lg-4 h-100">
                        <div class="d-flex align-items-center gap-2 gap-sm-3">
                            <div class="d-flex align-items-center justify-content-center flex-shrink-0 stat-icon-box">
                                <i class="ti ti-cash" style="font-size:1.25rem;"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-muted text-uppercase mb-0 stat-label">Total Revenue</p>
                                <p class="fw-700 mb-0 stat-value">Rp{{ number_format($totalRevenue / 1000, 1) }}k</p>
                                <p class="text-muted mb-0 stat-sub">{{ $totalTopupBerhasil }} transaksi berhasil</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card p-3 p-lg-4 h-100">
                        <div class="d-flex align-items-center gap-2 gap-sm-3">
                            <div class="d-flex align-items-center justify-content-center flex-shrink-0 stat-icon-box">
                                <i class="ti ti-message-star" style="font-size:1.25rem;"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-muted text-uppercase mb-0 stat-label">Testimoni</p>
                                <p class="fw-700 mb-0 stat-value">{{ number_format($testimonis) }}</p>
                                <p class="text-muted mb-0 stat-sub">Total ulasan pelanggan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Charts Row ── --}}
            <div class="row g-3 mb-4">
                {{-- Revenue Chart (full width on mobile) --}}
                <div class="col-12 col-lg-8">
                    <div class="card h-100">
                        <div
                            class="card-header d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-2">
                            <div>
                                <h5 class="mb-0 d-flex align-items-center gap-2">
                                    <i class="ti ti-trending-up"></i> Revenue Bulanan
                                </h5>
                                <p class="text-muted mb-0 mt-1" style="font-size:0.813rem;">Pendapatan 12 bulan terakhir
                                    (transaksi berhasil)</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="chartRevenue" class="w-100"></div>
                        </div>
                    </div>
                </div>
                {{-- User Chart --}}
                <div class="col-12 col-lg-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="mb-0 d-flex align-items-center gap-2">
                                <i class="ti ti-user-plus"></i> Pelanggan Baru
                            </h5>
                            <p class="text-muted mb-0 mt-1" style="font-size:0.813rem;">Registrasi per bulan</p>
                        </div>
                        <div class="card-body">
                            <div id="chartUsers" class="w-100"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Second Row: AI Gen + Topup Table ── --}}
            <div class="row g-3 mb-4">
                {{-- AI Generation Chart --}}
                <div class="col-12 col-lg-5">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="mb-0 d-flex align-items-center gap-2">
                                <i class="ti ti-sparkles"></i> Generasi AI per Bulan
                            </h5>
                            <p class="text-muted mb-0 mt-1" style="font-size:0.813rem;">Jumlah desain AI yang dibuat</p>
                        </div>
                        <div class="card-body">
                            <div id="chartGen" class="w-100"></div>
                        </div>
                    </div>
                </div>
                {{-- Recent Topups Table --}}
                <div class="col-12 col-lg-7">
                    <div class="card h-100">
                        <div
                            class="card-header d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-2">
                            <div>
                                <h5 class="mb-0 d-flex align-items-center gap-2">
                                    <i class="ti ti-receipt"></i> Topup Terbaru
                                </h5>
                                <p class="text-muted mb-0 mt-1" style="font-size:0.813rem;">10 transaksi terakhir yang
                                    berhasil</p>
                            </div>
                            <a href="{{ route('riwayat-topup.index') }}" class="btn btn-sm btn-secondary">
                                Lihat Semua <i class="ti ti-chevron-right ms-1"></i>
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
                                            <th class="text-nowrap">Tgl Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($latestTopup as $trx)
                                            <tr>
                                                <td>
                                                    <div class="fw-600" style="font-size:0.85rem;">
                                                        {{ $trx->user->name ?? '-' }}
                                                    </div>
                                                    <div class="text-muted" style="font-size:0.75rem;">
                                                        {{ $trx->user->email ?? '' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light-primary">
                                                        {{ $trx->package->name ?? '-' }}
                                                    </span>
                                                </td>
                                                <td class="fw-700" style="color:#16a34a;font-size:0.85rem;">
                                                    Rp{{ number_format($trx->amount, 0, ',', '.') }}
                                                </td>
                                                <td class="text-muted text-nowrap" style="font-size:0.8rem;">
                                                    {{ $trx->paid_at ? $trx->paid_at->format('d M Y') : '-' }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-5 text-muted">
                                                    <i class="ti ti-receipt-off"
                                                        style="font-size:1.5rem;display:block;margin-bottom:0.5rem;"></i>
                                                    Belum ada transaksi
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
        // ═══════════════════════════════════════════════════════════════════
        //  shadcn/ui-inspired ApexCharts — Responsive + Dark/Light ready
        // ═══════════════════════════════════════════════════════════════════

        // Helper: responsive chart height
        function rspH(lg, sm) {
            return window.innerWidth < 576 ? sm : (window.innerWidth < 992 ? Math.round((lg + sm) / 2) : lg);
        }

        const chartBase = {
            fontFamily: 'Inter, system-ui, sans-serif',
            toolbar: {
                show: false
            },
            foreColor: 'hsl(240, 3.8%, 46.1%)',
        };

        const gridBase = {
            borderColor: 'hsl(240, 5.9%, 90%)',
            strokeDashArray: 4,
        };

        const labelStyle = {
            style: {
                fontSize: '11px',
                colors: ['hsl(240, 3.8%, 46.1%)']
            }
        };

        // Responsive x-axis labels: don't rotate on mobile
        function xLabelStyle(rotate) {
            return window.innerWidth < 576 ? {
                style: {
                    fontSize: '9px',
                    colors: ['hsl(240, 3.8%, 46.1%)']
                }
            } : {
                ...labelStyle,
                rotate: rotate
            };
        }

        // ── 1. Revenue (Area) ──
        var revenueLabels = @json($revenueLabels);
        var revenueData = @json($revenueData);

        new ApexCharts(document.querySelector('#chartRevenue'), {
            series: [{
                name: 'Revenue (Rp)',
                data: revenueData
            }],
            chart: {
                ...chartBase,
                type: 'area',
                height: rspH(290, 200)
            },
            colors: ['hsl(240, 5.9%, 10%)'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.15,
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
                labels: xLabelStyle(false)
            },
            yaxis: {
                labels: {
                    ...labelStyle,
                    formatter: v => 'Rp' + (v >= 1000 ? (v / 1000).toFixed(0) + 'k' : v)
                }
            },
            tooltip: {
                y: {
                    formatter: v => 'Rp ' + v.toLocaleString('id-ID')
                }
            },
            grid: gridBase,
            responsive: [{
                breakpoint: 576,
                options: {
                    chart: {
                        height: 200
                    },
                    xaxis: {
                        labels: {
                            style: {
                                fontSize: '9px',
                                colors: ['hsl(240, 3.8%, 46.1%)']
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                fontSize: '9px',
                                colors: ['hsl(240, 3.8%, 46.1%)']
                            }
                        }
                    }
                }
            }]
        }).render();

        // ── 2. Pelanggan Baru (Bar) ──
        var userLabels = @json($userLabels);
        var userData = @json($userData);

        new ApexCharts(document.querySelector('#chartUsers'), {
            series: [{
                name: 'Pelanggan Baru',
                data: userData
            }],
            chart: {
                ...chartBase,
                type: 'bar',
                height: rspH(270, 200)
            },
            colors: ['hsl(240, 5.9%, 10%)'],
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
                labels: xLabelStyle(-45)
            },
            yaxis: {
                labels: labelStyle
            },
            grid: gridBase,
            responsive: [{
                breakpoint: 576,
                options: {
                    chart: {
                        height: 200
                    },
                    xaxis: {
                        labels: {
                            style: {
                                fontSize: '8px',
                                colors: ['hsl(240, 3.8%, 46.1%)']
                            },
                            rotate: -45
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                fontSize: '9px',
                                colors: ['hsl(240, 3.8%, 46.1%)']
                            }
                        }
                    }
                }
            }]
        }).render();

        // ── 3. Generasi AI (Bar) ──
        var genLabels = @json($genLabels);
        var genData = @json($genData);

        new ApexCharts(document.querySelector('#chartGen'), {
            series: [{
                name: 'Generasi AI',
                data: genData
            }],
            chart: {
                ...chartBase,
                type: 'bar',
                height: rspH(270, 200)
            },
            colors: ['hsl(240, 5.9%, 10%)'],
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
                labels: xLabelStyle(-45)
            },
            yaxis: {
                labels: labelStyle
            },
            grid: gridBase,
            responsive: [{
                breakpoint: 576,
                options: {
                    chart: {
                        height: 200
                    },
                    xaxis: {
                        labels: {
                            style: {
                                fontSize: '8px',
                                colors: ['hsl(240, 3.8%, 46.1%)']
                            },
                            rotate: -45
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                fontSize: '9px',
                                colors: ['hsl(240, 3.8%, 46.1%)']
                            }
                        }
                    }
                }
            }]
        }).render();
    </script>
@endsection
