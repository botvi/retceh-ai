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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Testimoni Pelanggan</a></li>
                <li class="breadcrumb-item" aria-current="page">Daftar Testimoni</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Tabel Testimoni Pelanggan</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Search & Filter ] start -->
      <div class="card mb-4" style="border-radius:16px !important;">
          <div class="card-body py-3">
              <form action="{{ route('manage-testimoni.index') }}" method="GET">
                  <div class="row g-2 align-items-center">
                      <div class="col-12 col-md-6">
                          <div class="input-group">
                              <span class="input-group-text bg-white border-end-0 text-muted">
                                  <i class="ti ti-search"></i>
                              </span>
                              <input type="text" name="search" class="form-control border-start-0 ps-0"
                                     placeholder="Cari nama, pekerjaan, atau kata dalam ulasan..."
                                     value="{{ request('search') }}">
                          </div>
                      </div>
                      <div class="col-6 col-md-3">
                          <select name="status" class="form-select">
                              <option value="">Semua Status</option>
                              <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Aktif / Approved</option>
                              <option value="pending"  {{ request('status') == 'pending'  ? 'selected' : '' }}>Tertunda / Pending</option>
                          </select>
                      </div>
                      <div class="col-6 col-md-3 d-flex gap-2">
                          <button type="submit" class="btn btn-primary w-100">
                              <i class="ti ti-filter me-1"></i> Filter
                          </button>
                          @if(request()->filled('search') || request()->filled('status'))
                              <a href="{{ route('manage-testimoni.index') }}" class="btn btn-secondary">
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
                    <h5 class="mb-0">Daftar Testimoni</h5>
                    <small class="text-muted">{{ $testimonis->total() }} ulasan ditemukan</small>
                </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                  <thead>
                    <tr>
                      <th style="width: 40px;">#</th>
                      <th>Pelanggan</th>
                      <th>Tanggal</th>
                      <th>Pekerjaan/Usaha</th>
                      <th>Rating</th>
                      <th>Status</th>
                      <th>Ulasan</th>
                      <th class="text-end" style="padding-right: 1.5rem;">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($testimonis as $e => $item)
                    <tr>
                      <td class="text-muted" style="font-size:0.8rem;">
                          {{ ($testimonis->currentPage() - 1) * $testimonis->perPage() + $e + 1 }}
                      </td>
                      <td>
                        @php
                          $fotoProfile = $item->user->foto_profile ?? null;
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
                            <span class="fw-600 text-dark" style="font-size:0.85rem;">{{ $item->name ?: ($item->user->name ?? '-') }}</span>
                        </div>
                      </td>
                      <td style="font-size:0.8rem; color:#71717a;">{{ $item->created_at->format('d M Y') }}</td>
                      <td style="font-size:0.83rem;">{{ $item->role ?? '-' }}</td>
                      <td class="text-warning">
                          @for($i = 1; $i <= 5; $i++)
                              <i class="ti ti-star{{ $i <= $item->rating ? '-filled' : '' }}"></i>
                          @endfor
                      </td>
                      <td>
                          @if($item->status == 'approved')
                              <span class="badge bg-light-success d-inline-flex align-items-center gap-1">
                                  <i class="ti ti-check"></i> Approved
                              </span>
                          @else
                              <span class="badge bg-light-warning d-inline-flex align-items-center gap-1">
                                  <i class="ti ti-clock"></i> Pending
                              </span>
                          @endif
                      </td>
                      <td>
                        <button type="button" class="btn btn-sm btn-outline-primary btn-lihat-pesan d-inline-flex align-items-center gap-1" data-pesan="{{ $item->pesan }}">
                          <i class="ti ti-eye"></i> Lihat Ulasan
                        </button>
                      </td>
                      <td class="text-end" style="padding-right: 1.5rem;">
                        <form action="{{ route('manage-testimoni.toggle-status', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $item->status == 'approved' ? 'btn-warning' : 'btn-success' }} me-1">
                                {{ $item->status == 'approved' ? 'Sembunyikan' : 'Setujui' }}
                            </button>
                        </form>
                        <form action="{{ route('manage-testimoni.destroy', $item->id) }}" method="POST" style="display:inline;" class="delete-form">
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
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="ti ti-message-off" style="font-size:2rem; display:block; margin-bottom:8px;"></i>
                            Tidak ada testimoni ditemukan
                        </td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
            @if($testimonis->hasPages())
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <small class="text-muted">
                        Menampilkan {{ $testimonis->firstItem() }}–{{ $testimonis->lastItem() }} dari {{ $testimonis->total() }} ulasan
                    </small>
                    <div>{{ $testimonis->links() }}</div>
                </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal detail pesan -->
  <div class="modal fade" id="modalPesan" tabindex="-1" aria-labelledby="modalPesanLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalPesanLabel">Ulasan Pelanggan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="isiPesan" style="white-space: pre-line;"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Modal detail pesan
        const modalPesan = new bootstrap.Modal(document.getElementById('modalPesan'));
        const isiPesan = document.getElementById('isiPesan');

        document.querySelectorAll('.btn-lihat-pesan').forEach(button => {
            button.addEventListener('click', function () {
                const pesan = this.getAttribute('data-pesan');
                isiPesan.textContent = pesan;
                modalPesan.show();
            });
        });

        // Custom confirm modal untuk hapus
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                if (form.dataset.confirmed === 'true') return;
                e.preventDefault();
                
                window.showCustomConfirm({
                    title: 'Apakah Anda yakin?',
                    text: 'Data testimoni akan dihapus secara permanen!',
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
