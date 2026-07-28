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
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Paket</a></li>
                            <li class="breadcrumb-item" aria-current="page">Paket Top Up</li>
                        </ul>
                    </div>
                    <div class="col-md-12 d-flex justify-content-between align-items-center">
                        <div class="page-header-title">
                            <h2 class="mb-0">Daftar Paket Top Up Kredit</h2>
                        </div>
                        <a href="{{ route('package.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> Tambah Paket Baru
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
                                        <th>Nama Paket</th>
                                        <th>Harga</th>
                                        <th>Saldo Kredit (Gelas Kopi)</th>
                                        <th>Status Rekomendasi</th>
                                        <th>Fitur Paket</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($packages as $idx => $pkg)
                                        <tr>
                                            <td>{{ $idx + 1 }}</td>
                                            <td class="font-weight-bold">{{ $pkg->name }}</td>
                                            <td>Rp {{ number_format($pkg->price, 0, ',', '.') }}</td>
                                            <td><span class="badge bg-light-success">{{ $pkg->credits }} Gelas</span></td>
                                            <td>
                                                @if($pkg->is_recommended)
                                                    <span class="badge bg-light-primary">Ya (Rekomendasi)</span>
                                                @else
                                                    <span class="badge bg-light-secondary">Tidak</span>
                                                @endif
                                            </td>
                                            <td>
                                                <ul class="mb-0 ps-3 text-xs">
                                                    @if(is_array($pkg->features))
                                                        @foreach($pkg->features as $feat)
                                                            <li>{{ $feat }}</li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('package.edit', $pkg->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                                <form action="{{ route('package.destroy', $pkg->id) }}" method="POST" style="display:inline-block;" class="delete-form" data-confirm="Paket ini akan dihapus secara permanen!">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">Belum ada paket top up terdaftar.</td>
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
