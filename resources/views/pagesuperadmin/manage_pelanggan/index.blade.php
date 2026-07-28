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
                                <h5 class="mb-0">Manajemen Pelanggan</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Pelanggan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Search Bar --}}
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('manage-pelanggan.index') }}" method="GET">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 text-muted">
                                        <i class="ti ti-search"></i>
                                    </span>
                                    <input type="text" name="search" class="form-control border-start-0 ps-0"
                                        placeholder="Cari nama, email, username, atau no whatsapp..."
                                        value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-3 d-flex gap-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="ti ti-search me-1"></i> Cari
                                </button>
                                @if (request()->filled('search'))
                                    <a href="{{ route('manage-pelanggan.index') }}" class="btn btn-secondary">
                                        <i class="ti ti-refresh"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Daftar Pelanggan</h5>
                        <small class="text-muted">{{ $pelanggan->total() }} pelanggan terdaftar</small>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 40px;">#</th>
                                    <th>Pelanggan</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Username</th>
                                    <th>No. WhatsApp</th>
                                    <th>Kredit</th>
                                    <th class="text-end" style="padding-right: 1.5rem;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pelanggan as $e => $item)
                                    <tr>
                                        <td class="text-muted" style="font-size:0.8rem;">
                                            {{ ($pelanggan->currentPage() - 1) * $pelanggan->perPage() + $e + 1 }}
                                        </td>
                                        <td>
                                            @php
                                                $fotoProfile = $item->foto_profile ?? null;
                                                if ($fotoProfile) {
                                                    $srcFoto = \Illuminate\Support\Str::startsWith($fotoProfile, [
                                                        'http://',
                                                        'https://',
                                                    ])
                                                        ? $fotoProfile
                                                        : asset('uploads/foto_profile/' . $fotoProfile);
                                                } else {
                                                    $srcFoto = asset('env/logo.jpg');
                                                }
                                            @endphp
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ $srcFoto }}" alt="Foto" width="36" height="36"
                                                    style="object-fit:cover; border-radius:50%; border:2px solid hsl(var(--border));">
                                                <div>
                                                    <div class="fw-600" style="font-size:0.85rem;">{{ $item->name ?? '-' }}
                                                    </div>
                                                    <div class="text-muted" style="font-size:0.75rem;">
                                                        {{ $item->email ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="font-size:0.8rem; color:hsl(var(--muted-foreground));">
                                            {{ $item->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td style="font-size:0.83rem;">{{ $item->username ?? '-' }}</td>
                                        <td style="font-size:0.83rem;">{{ $item->no_wa ?? '-' }}</td>
                                        <td>
                                            <form action="{{ route('manage-pelanggan.update-credit', $item->id) }}"
                                                method="POST" class="d-flex align-items-center gap-1">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="credits" class="form-control form-control-sm"
                                                    value="{{ $item->credits }}" style="width: 75px;" min="0"
                                                    required>
                                                <button type="submit" class="btn btn-sm btn-primary p-1 px-2"
                                                    title="Perbarui Kredit">
                                                    <i class="ti ti-check"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-end" style="padding-right: 1.5rem;">
                                            <form action="{{ route('manage-pelanggan.destroy', $item->id) }}"
                                                method="POST" style="display:inline;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1">
                                                    <i class="ti ti-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">
                                            <i class="ti ti-users-minus"
                                                style="font-size:2rem; display:block; margin-bottom:8px;"></i>
                                            Tidak ada pelanggan ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($pelanggan->hasPages())
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <small class="text-muted">
                            Menampilkan {{ $pelanggan->firstItem() }}–{{ $pelanggan->lastItem() }} dari
                            {{ $pelanggan->total() }} pelanggan
                        </small>
                        <div>{{ $pelanggan->links() }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (form.dataset.confirmed === 'true') return;
                    e.preventDefault();

                    window.showCustomConfirm({
                        title: 'Apakah Anda yakin?',
                        text: 'Data pelanggan akan dihapus secara permanen!',
                        icon: 'danger',
                        confirmText: 'Ya, hapus!',
                        cancelText: 'Batal',
                        onConfirm: () => {
                            form.dataset.confirmed = 'true';
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
