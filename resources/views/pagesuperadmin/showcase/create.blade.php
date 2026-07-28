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
                                <h5 class="mb-0">Tambah Kartu Perbandingan</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('showcase.index') }}">Showcase</a></li>
                                <li class="breadcrumb-item" aria-current="page">Tambah Baru</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Informasi Kartu Perbandingan</h5>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger d-flex align-items-start gap-2 mb-4" role="alert">
                                    <i class="ti ti-alert-circle mt-1 flex-shrink-0"></i>
                                    <div>
                                        <strong>Terdapat kesalahan:</strong>
                                        <ul class="mb-0 mt-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('showcase.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama / Judul Produk</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Contoh: Cold Brew Coffee" value="{{ old('title') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Label Kategori</label>
                                        <input type="text" name="category_label" class="form-control"
                                            placeholder="Contoh: Kopi Botol" value="{{ old('category_label') }}" required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Deskripsi Perubahan</label>
                                        <textarea name="description" class="form-control" rows="3"
                                            placeholder="Jelaskan perubahan efek studio (misal: Pencahayaan flat berganti studio warm amber backlight.)"
                                            required>{{ old('description') }}</textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Label Sebelum (Kiri)</label>
                                        <input type="text" name="label_before" class="form-control" value="Foto Asli"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Label Sesudah (Kanan)</label>
                                        <input type="text" name="label_after" class="form-control" value="Hasil AI"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Foto Sebelum (Asli)</label>
                                        <input type="file" name="image_before" class="form-control" accept="image/*"
                                            required>
                                        <small class="text-muted">Rekomendasi rasio 3:4 atau 1:1, maks 3MB</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Foto Sesudah (Hasil AI)</label>
                                        <input type="file" name="image_after" class="form-control" accept="image/*"
                                            required>
                                        <small class="text-muted">Rekomendasi rasio 3:4 atau 1:1, maks 3MB</small>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <a href="{{ route('showcase.index') }}" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-1"></i> Simpan Kartu
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
