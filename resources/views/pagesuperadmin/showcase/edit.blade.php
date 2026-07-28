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
                                <h5 class="mb-0">Edit Kartu Perbandingan #{{ $item->id }}</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('showcase.index') }}">Showcase</a></li>
                                <li class="breadcrumb-item" aria-current="page">Edit Kartu</li>
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
                            <h5>Edit Kartu #{{ $item->id }}</h5>
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

                            <form action="{{ route('showcase.update', $item->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama / Judul Produk</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ old('title', $item->title) }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Label Kategori</label>
                                        <input type="text" name="category_label" class="form-control"
                                            value="{{ old('category_label', $item->category_label) }}" required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Deskripsi Perubahan</label>
                                        <textarea name="description" class="form-control" rows="3" required>{{ old('description', $item->description) }}</textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Label Sebelum (Kiri)</label>
                                        <input type="text" name="label_before" class="form-control"
                                            value="{{ old('label_before', $item->label_before) }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Label Sesudah (Kanan)</label>
                                        <input type="text" name="label_after" class="form-control"
                                            value="{{ old('label_after', $item->label_after) }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Foto Sebelum (Asli)</label>
                                        <div class="mb-2">
                                            <img src="{{ asset($item->image_before) }}" alt="Before" width="100"
                                                class="rounded border">
                                        </div>
                                        <input type="file" name="image_before" class="form-control" accept="image/*">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Foto Sesudah (Hasil AI)</label>
                                        <div class="mb-2">
                                            <img src="{{ asset($item->image_after) }}" alt="After" width="100"
                                                class="rounded border">
                                        </div>
                                        <input type="file" name="image_after" class="form-control" accept="image/*">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah</small>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <a href="{{ route('showcase.index') }}" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-1"></i> Simpan Perubahan
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
