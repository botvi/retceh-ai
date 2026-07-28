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
                            <li class="breadcrumb-item" aria-current="page">Edit Kartu Perbandingan</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Edit Kartu Perbandingan #{{ $item->id }}</h2>
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

                        <form action="{{ route('showcase.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Nama / Judul Produk</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title', $item->title) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Label Kategori Produk (Tag bawah)</label>
                                    <input type="text" name="category_label" class="form-control" value="{{ old('category_label', $item->category_label) }}" required>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <label class="form-label font-weight-bold">Deskripsi Perubahan</label>
                                    <textarea name="description" class="form-control" rows="3" required>{{ old('description', $item->description) }}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Label Sebelum (Left Card)</label>
                                    <input type="text" name="label_before" class="form-control" value="{{ old('label_before', $item->label_before) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Label Sesudah (Right Card)</label>
                                    <input type="text" name="label_after" class="form-control" value="{{ old('label_after', $item->label_after) }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Foto Sebelum (Asli)</label>
                                    <div class="mb-2">
                                        <img src="{{ asset($item->image_before) }}" alt="Old Before" width="100" class="rounded border">
                                    </div>
                                    <input type="file" name="image_before" class="form-control" accept="image/*">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Foto Sesudah (Hasil AI)</label>
                                    <div class="mb-2">
                                        <img src="{{ asset($item->image_after) }}" alt="Old After" width="100" class="rounded border">
                                    </div>
                                    <input type="file" name="image_after" class="form-control" accept="image/*">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <a href="{{ route('showcase.index') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
