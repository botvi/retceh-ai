@extends('template-admin.layout')

@section('content')
<section class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Showcase</a></li>
                            <li class="breadcrumb-item" aria-current="page">Galeri Sebelum & Sesudah</li>
                        </ul>
                    </div>
                    <div class="col-md-12 d-flex justify-content-between align-items-center">
                        <div class="page-header-title">
                            <h2 class="mb-0">Daftar Galeri Perbandingan AI</h2>
                        </div>
                        <a href="{{ route('showcase.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> Tambah Kartu Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Kategori</th>
                                        <th>Foto Sebelum (Asli)</th>
                                        <th>Foto Sesudah (AI)</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($items as $idx => $item)
                                        <tr>
                                            <td>{{ $idx + 1 }}</td>
                                            <td class="font-weight-bold">{{ $item->title }}</td>
                                            <td>{{ Str::limit($item->description, 60) }}</td>
                                            <td><span class="badge bg-light-secondary">{{ $item->category_label }}</span></td>
                                            <td>
                                                <img src="{{ asset($item->image_before) }}" alt="Before" width="60" class="rounded border">
                                            </td>
                                            <td>
                                                <img src="{{ asset($item->image_after) }}" alt="After" width="60" class="rounded border">
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('showcase.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                                <form action="{{ route('showcase.destroy', $item->id) }}" method="POST" style="display:inline-block;" class="delete-form" data-confirm="Kartu perbandingan ini akan dihapus secara permanen!">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">Belum ada data perbandingan showcase.</td>
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
</section>
@endsection
