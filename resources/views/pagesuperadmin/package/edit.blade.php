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
                                <h5 class="mb-0">Edit Paket Top Up #{{ $package->id }}</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('package.index') }}">Paket</a></li>
                                <li class="breadcrumb-item" aria-current="page">Edit Paket</li>
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
                            <h5>Edit Paket #{{ $package->id }}</h5>
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

                            <form action="{{ route('package.update', $package->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Paket</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $package->name) }}" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Harga (Rp)</label>
                                        <input type="number" name="price" class="form-control"
                                            value="{{ old('price', $package->price) }}" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Jumlah Kredit (Neurium)</label>
                                        <input type="number" name="credits" class="form-control"
                                            value="{{ old('credits', $package->credits) }}" required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Fitur Paket</label>
                                        <small class="text-muted d-block mb-2">Satu fitur per baris</small>
                                        <textarea name="features_raw" class="form-control" rows="6" required>{{ old('features_raw', $features_raw) }}</textarea>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_recommended"
                                                id="is_recommended" value="1"
                                                {{ $package->is_recommended ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_recommended">
                                                Tandai sebagai paket <strong>Rekomendasi</strong>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <a href="{{ route('package.index') }}" class="btn btn-secondary">Batal</a>
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
