@extends('template-admin.layout')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            {{-- Breadcrumb --}}
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="mb-0">Daftar Paket Top Up</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Paket Top Up</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Header Actions --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <p class="text-muted mb-0">Kelola paket top up kredit untuk pengguna</p>
                </div>
                <a href="{{ route('package.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Tambah Paket
                </a>
            </div>

            {{-- Main Content --}}
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 40px;">#</th>
                                    <th>Nama Paket</th>
                                    <th>Harga</th>
                                    <th>Kredit</th>
                                    <th>Status</th>
                                    <th>Fitur</th>
                                    <th class="text-center" style="width: 160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($packages as $idx => $pkg)
                                    <tr>
                                        <td class="text-muted">{{ $idx + 1 }}</td>
                                        <td class="fw-600">{{ $pkg->name }}</td>
                                        <td>Rp {{ number_format($pkg->price, 0, ',', '.') }}</td>
                                        <td><span class="badge bg-light-success">{{ $pkg->credits }} Gelas</span></td>
                                        <td>
                                            @if ($pkg->is_recommended)
                                                <span class="badge"
                                                    style="background: rgba(99,102,241,0.1); color: #6366f1; border: 1px solid rgba(99,102,241,0.2);">
                                                    <i class="ti ti-star-filled me-1"></i> Rekomendasi
                                                </span>
                                            @else
                                                <span class="badge bg-light-secondary">Standar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="mb-0 ps-3" style="font-size:0.813rem;">
                                                @if (is_array($pkg->features))
                                                    @foreach ($pkg->features as $feat)
                                                        <li>{{ $feat }}</li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('package.edit', $pkg->id) }}"
                                                    class="btn btn-sm btn-secondary">
                                                    <i class="ti ti-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('package.destroy', $pkg->id) }}" method="POST"
                                                    style="display:inline;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="ti ti-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">
                                            <i class="ti ti-credit-card-off"
                                                style="font-size:2rem; display:block; margin-bottom:8px;"></i>
                                            Belum ada paket top up terdaftar.
                                            <br>
                                            <a href="{{ route('package.create') }}" class="btn btn-primary mt-3">Tambah
                                                Paket Pertama</a>
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
@endsection
