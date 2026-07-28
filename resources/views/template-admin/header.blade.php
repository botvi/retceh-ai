<header class="pc-header">
    <div class="header-wrapper d-flex align-items-center justify-content-between px-3">
        <!-- Mobile Sidebar Toggle -->
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled mb-0 d-flex align-items-center gap-1">
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Right Header Items -->
        <div class="ms-auto">
            <ul class="list-unstyled mb-0 d-flex align-items-center gap-2">
                <li class="dropdown pc-h-item header-user-profile">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0 d-flex align-items-center gap-2 px-2.5 py-1.5" data-bs-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside"
                        aria-expanded="false">
                        @php
                            $fotoProfile = Auth::user()->foto_profile ?? null;
                            if ($fotoProfile) {
                                if (Str::startsWith($fotoProfile, ['http://', 'https://'])) {
                                    $srcFoto = $fotoProfile;
                                } else {
                                    $srcFoto = asset('uploads/foto_profile/' . $fotoProfile);
                                }
                            } else {
                                $srcFoto = asset('admin') . '/assets/images/user/avatar-2.jpg';
                            }
                        @endphp
                        <img src="{{ $srcFoto }}" alt="user-image" class="user-avtar" style="width:36px; height:36px; object-fit:cover; border-radius:50%; flex-shrink:0; border:2px solid rgba(102,126,234,0.4);">
                        <span class="d-none d-sm-inline-block font-semibold text-dark" style="font-size:0.83rem;">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown shadow-lg border-0" style="border-radius: 16px;">
                        <div class="dropdown-header p-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ $srcFoto }}" alt="user-image" style="width:44px; height:44px; object-fit:cover; border-radius:50%; flex-shrink:0; border:2px solid rgba(102,126,234,0.4);">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0 font-bold text-dark" style="font-size:0.88rem;">{{ Auth::user()->name }}</h6>
                                    <span class="badge bg-light-primary text-primary text-uppercase" style="font-size:0.65rem;">{{ Auth::user()->role }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider my-1"></div>
                        <div class="d-flex justify-content-between p-3 gap-2">
                            <a href="{{ route('profil-superadmin') }}" class="btn btn-sm btn-outline-primary w-100 d-inline-flex align-items-center justify-content-center gap-1">
                                <i class="ti ti-user"></i> Profil
                            </a>
                            <a href="/logout" class="btn btn-sm btn-outline-danger w-100 d-inline-flex align-items-center justify-content-center gap-1">
                                <i class="ti ti-power"></i> Logout
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
