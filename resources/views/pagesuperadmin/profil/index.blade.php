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
                                <h5 class="mb-0">Profil Superadmin</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Profil</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Informasi Profil</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profil-superadmin.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Foto Profile --}}
                                <div class="row mb-4">
                                    <div class="col-12 text-center">
                                        <div class="position-relative d-inline-block">
                                            <div class="rounded-circle border d-flex align-items-center justify-content-center overflow-hidden"
                                                style="width: 120px; height: 120px; border-color: hsl(var(--border)) !important;">
                                                @if ($data->foto_profile)
                                                    @php
                                                        $fotoProfile = $data->foto_profile;
                                                        $srcFoto = \Illuminate\Support\Str::startsWith($fotoProfile, [
                                                            'http://',
                                                            'https://',
                                                        ])
                                                            ? $fotoProfile
                                                            : asset('uploads/foto_profile/' . $fotoProfile);
                                                    @endphp
                                                    <img src="{{ $srcFoto }}" alt="Foto Profile"
                                                        style="width: 100%; height: 100%; object-fit: cover;">
                                                @else
                                                    <div class="bg-primary d-flex align-items-center justify-content-center text-white fw-700"
                                                        style="width: 100%; height: 100%; font-size: 3rem;">
                                                        {{ strtoupper(substr($data->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <label for="foto_profile"
                                                class="position-absolute bottom-0 end-0 rounded-circle p-2 d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px; background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); cursor: pointer;">
                                                <i class="ti ti-camera" style="font-size: 1rem;"></i>
                                            </label>
                                            <input type="file" id="foto_profile" name="foto_profile" class="d-none"
                                                accept="image/*">
                                        </div>
                                        <p class="text-muted mt-2 mb-0" style="font-size:0.813rem;">Klik ikon kamera untuk
                                            mengubah foto</p>
                                    </div>
                                </div>

                                {{-- Informasi Dasar --}}
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $data->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="username" class="form-label">Username <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            id="username" name="username" value="{{ old('username', $data->username) }}"
                                            required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', $data->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="no_wa" class="form-label">No. WhatsApp <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('no_wa') is-invalid @enderror"
                                            id="no_wa" name="no_wa" value="{{ old('no_wa', $data->no_wa) }}"
                                            placeholder="Contoh: 08123456789" required>
                                        @error('no_wa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Password Baru</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password"
                                            placeholder="Kosongkan jika tidak ingin mengubah">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Minimal 8 karakter</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="Konfirmasi password baru">
                                    </div>
                                </div>

                                {{-- Tombol Aksi --}}
                                <div class="d-flex justify-content-end mt-4">
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

@section('script')
    <script>
        document.getElementById('foto_profile').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const container = document.querySelector('.rounded-circle.border');
                    if (container) {
                        // Remove existing content
                        container.innerHTML = '';
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100%';
                        img.style.height = '100%';
                        img.style.objectFit = 'cover';
                        container.appendChild(img);
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const confirmPassword = document.getElementById('password_confirmation');
            if (password && confirmPassword.value) {
                confirmPassword.setCustomValidity(password !== confirmPassword.value ? 'Password tidak cocok' : '');
            }
        });

        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            this.setCustomValidity(password && this.value && password !== this.value ? 'Password tidak cocok' : '');
        });
    </script>
@endsection
};
reader.readAsDataURL(file);
}
});

// Validasi password confirmation
document.getElementById('password').addEventListener('input', function() {
const password = this.value;
const confirmPassword = document.getElementById('password_confirmation');

if (password && confirmPassword.value) {
if (password !== confirmPassword.value) {
confirmPassword.setCustomValidity('Password tidak cocok');
} else {
confirmPassword.setCustomValidity('');
}
}
});

document.getElementById('password_confirmation').addEventListener('input', function() {
const password = document.getElementById('password').value;
const confirmPassword = this.value;

if (password && confirmPassword) {
if (password !== confirmPassword) {
this.setCustomValidity('Password tidak cocok');
} else {
this.setCustomValidity('');
}
}
});
</script>
@endsection
