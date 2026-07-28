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
                            <li class="breadcrumb-item"><a href="{{ route('showcase.index') }}">Showcase</a></li>
                            <li class="breadcrumb-item" aria-current="page">Tambah Kartu Perbandingan</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Tambah Kartu Perbandingan Baru</h2>
                        </div>
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('showcase.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Nama / Judul Produk</label>
                                    <input type="text" name="title" class="form-control" placeholder="Contoh: Cold Brew Coffee" value="{{ old('title') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Label Kategori Produk (Tag bawah)</label>
                                    <input type="text" name="category_label" class="form-control" placeholder="Contoh: Kopi Botol" value="{{ old('category_label') }}" required>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <label class="form-label font-weight-bold">Deskripsi Perubahan</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Jelaskan perubahan efek studio (misal: Pencahayaan flat berganti studio warm amber backlight.)" required>{{ old('description') }}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Label Sebelum (Left Card)</label>
                                    <input type="text" name="label_before" class="form-control" value="Foto Asli" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Label Sesudah (Right Card)</label>
                                    <input type="text" name="label_after" class="form-control" value="Hasil AI" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Foto Sebelum (Asli)</label>
                                    <input type="file" name="image_before" class="form-control" accept="image/*" required>
                                    <small class="text-muted">Rekomendasi rasio gambar: 3:4 atau 1:1, ukuran maks 3MB</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Foto Sesudah (Hasil AI)</label>
                                    <input type="file" name="image_after" class="form-control" accept="image/*" required>
                                    <small class="text-muted">Rekomendasi rasio gambar: 3:4 atau 1:1, ukuran maks 3MB</small>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <a href="{{ route('showcase.index') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Kartu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
