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
                            <li class="breadcrumb-item"><a href="{{ route('package.index') }}">Paket</a></li>
                            <li class="breadcrumb-item" aria-current="page">Tambah Paket Top Up</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Tambah Paket Top Up Baru</h2>
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

                        <form action="{{ route('package.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Nama Paket Tiers</label>
                                    <input type="text" name="name" class="form-control" placeholder="Contoh: Starter, Pro, Enterprise" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label font-weight-bold">Harga Paket (Rupiah)</label>
                                    <input type="number" name="price" class="form-control" placeholder="Contoh: 15000" value="{{ old('price') }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label font-weight-bold">Jumlah Saldo (Gelas Kopi)</label>
                                    <input type="number" name="credits" class="form-control" placeholder="Contoh: 50" value="{{ old('credits') }}" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label font-weight-bold">Fitur-fitur Paket (Satu Fitur per Baris)</label>
                                    <textarea name="features_raw" class="form-control" rows="6" placeholder="Masukkan daftar fitur, pisahkan dengan baris baru.
Contoh:
50 Gelas Kopi
Prioritas pembuatan standar
Akses seluruh ukuran studio" required>{{ old('features_raw') }}</textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_recommended" id="is_recommended" value="1">
                                        <label class="form-check-label font-weight-bold" for="is_recommended">Tandai Paket ini sebagai "REKOMENDASI" utama</label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <a href="{{ route('package.index') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Paket</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
