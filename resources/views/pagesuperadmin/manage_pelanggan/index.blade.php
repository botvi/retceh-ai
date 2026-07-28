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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Pelanggan</a></li>
                <li class="breadcrumb-item" aria-current="page">Daftar Pelanggan</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Manajemen Pelanggan & Kredit</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Search Bar ] start -->
      <div class="card mb-4" style="border-radius:16px !important;">
          <div class="card-body py-3">
              <form action="{{ route('manage-pelanggan.index') }}" method="GET">
                  <div class="row g-2 align-items-center">
                      <div class="col-12 col-md-9">
                          <div class="input-group">
                              <span class="input-group-text bg-white border-end-0 text-muted">
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
                          @if(request()->filled('search'))
                              <a href="{{ route('manage-pelanggan.index') }}" class="btn btn-secondary">
                                  <i class="ti ti-refresh"></i>
                              </a>
                          @endif
                      </div>
                  </div>
              </form>
          </div>
      </div>

      <!-- [ Main Content ] start -->
      <div class="row">
        <div class="col-sm-12">
          <div class="card" style="border-radius:16px !important;">
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
                      <th>No Whatsapp</th>
                      <th>Kredit (Gelas Kopi)</th>
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
                              if (Str::startsWith($fotoProfile, ['http://', 'https://'])) {
                                  $srcFoto = $fotoProfile;
                              } else {
                                  $srcFoto = asset('uploads/foto_profile/' . $fotoProfile);
                              }
                          } else {
                              $srcFoto = asset('env/logo.jpg');
                          }
                        @endphp
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ $srcFoto }}" alt="Foto" width="38" height="38" style="object-fit:cover; border-radius:50%; flex-shrink:0; border:2px solid rgba(102,126,234,0.3);">
                            <div>
                                <div class="fw-600 text-dark" style="font-size:0.85rem;">{{ $item->name ?? '-' }}</div>
                                <div class="text-muted" style="font-size:0.75rem;">{{ $item->email ?? '-' }}</div>
                            </div>
                        </div>
                      </td>
                      <td style="font-size:0.8rem; color:#71717a;">{{ $item->created_at->format('d M Y, H:i') }}</td>
                      <td style="font-size:0.83rem;">{{ $item->username ?? '-' }}</td>
                      <td style="font-size:0.83rem;">{{ $item->no_wa ?? '-' }}</td>
                      <td>
                        <form action="{{ route('manage-pelanggan.update-credit', $item->id) }}" method="POST" class="d-flex align-items-center gap-1">
                          @csrf
                          @method('PATCH')
                          <input type="number" name="credits" class="form-control form-control-sm font-semibold" value="{{ $item->credits }}" style="width: 75px;" min="0" required>
                          <button type="submit" class="btn btn-sm btn-primary p-1 px-2" title="Perbarui Kredit"><i class="ti ti-check"></i></button>
                        </form>
                      </td>
                      <td class="text-end" style="padding-right: 1.5rem;">
                        <form action="{{ route('manage-pelanggan.destroy', $item->id) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1">
                                <i class="ti ti-trash"></i> Hapus
                            </button>
                        </form>
                      </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="ti ti-users-minus" style="font-size:2rem; display:block; margin-bottom:8px;"></i>
                            Tidak ada pelanggan ditemukan
                        </td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
            @if($pelanggan->hasPages())
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <small class="text-muted">
                        Menampilkan {{ $pelanggan->firstItem() }}–{{ $pelanggan->lastItem() }} dari {{ $pelanggan->total() }} pelanggan
                    </small>
                    <div>{{ $pelanggan->links() }}</div>
                </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
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
