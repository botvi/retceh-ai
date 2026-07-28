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
                                <h5 class="mb-0">Daftar Galeri Perbandingan</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Showcase</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Header Actions --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <p class="text-muted mb-0">Kelola galeri perbandingan Sebelum & Sesudah hasil AI</p>
                </div>
                <a href="{{ route('showcase.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Tambah Kartu
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
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
                                    <th>Foto Sebelum</th>
                                    <th>Foto Sesudah</th>
                                    <th class="text-center" style="width: 140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $idx => $item)
                                    <tr>
                                        <td class="text-muted">{{ $idx + 1 }}</td>
                                        <td class="fw-600">{{ $item->title }}</td>
                                        <td style="max-width: 200px;">
                                            <span class="text-muted">{{ Str::limit($item->description, 60) }}</span>
                                        </td>
                                        <td><span class="badge bg-light-secondary">{{ $item->category_label }}</span></td>
                                        <td>
                                            <img src="{{ asset($item->image_before) }}" alt="Before" width="56"
                                                height="56"
                                                style="object-fit:cover; border-radius:calc(var(--radius) - 2px); border:1px solid hsl(var(--border));">
                                        </td>
                                        <td>
                                            <img src="{{ asset($item->image_after) }}" alt="After" width="56"
                                                height="56"
                                                style="object-fit:cover; border-radius:calc(var(--radius) - 2px); border:1px solid hsl(var(--border));">
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('showcase.edit', $item->id) }}"
                                                    class="btn btn-sm btn-secondary">
                                                    <i class="ti ti-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('showcase.destroy', $item->id) }}" method="POST"
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
                                            <i class="ti ti-photo-off"
                                                style="font-size:2rem; display:block; margin-bottom:8px;"></i>
                                            Belum ada data perbandingan showcase.
                                            <br>
                                            <a href="{{ route('showcase.create') }}" class="btn btn-primary mt-3">Tambah
                                                Kartu Pertama</a>
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
