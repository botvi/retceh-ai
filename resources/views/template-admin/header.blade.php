<header class="pc-header">
    <div class="header-wrapper d-flex align-items-center justify-content-between">
        <!-- Mobile Sidebar Toggle -->
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled mb-0 d-flex align-items-center gap-2">
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0 d-flex align-items-center justify-content-center"
                        id="sidebar-hide"
                        style="width: 40px; height: 40px; border-radius: var(--radius); transition: background-color 0.15s ease;">
                        <i class="ti ti-menu-2" style="font-size: 1.25rem;"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0 d-flex align-items-center justify-content-center"
                        id="mobile-collapse"
                        style="width: 40px; height: 40px; border-radius: var(--radius); transition: background-color 0.15s ease;">
                        <i class="ti ti-menu-2" style="font-size: 1.25rem;"></i>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Right Header Items -->
        <div class="ms-auto">
            <ul class="list-unstyled mb-0 d-flex align-items-center gap-2">
                <li class="dropdown pc-h-item header-user-profile">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0 d-flex align-items-center gap-2 px-3 py-2"
                        data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                        data-bs-auto-close="outside" aria-expanded="false"
                        style="border-radius: var(--radius); transition: background-color 0.15s ease;">
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
                        <img src="{{ $srcFoto }}" alt="user-image" class="user-avtar">
                        <span class="d-none d-sm-inline-block fw-500"
                            style="font-size: 0.875rem;">{{ Auth::user()->name }}</span>
                        <i class="ti ti-chevron-down d-none d-sm-inline-block" style="font-size: 1rem;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown"
                        style="min-width: 280px; margin-top: 0.5rem;">
                        <div class="dropdown-header p-3 border-bottom">
                            <div class="d-flex align-items-center gap-3">
                                <div class="flex-shrink-0">
                                    <img src="{{ $srcFoto }}" alt="user-image" class="user-avtar"
                                        style="width: 48px; height: 48px;">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-600" style="font-size: 0.9375rem;">{{ Auth::user()->name }}</h6>
                                    <span class="badge bg-light-secondary text-xs">{{ Auth::user()->role }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <a href="{{ route('profil-superadmin') }}"
                                class="dropdown-item d-flex align-items-center gap-2 py-2 px-3">
                                <i class="ti ti-user" style="font-size: 1.125rem;"></i>
                                <span>Profil Saya</span>
                            </a>
                            <div class="dropdown-divider my-1"></div>
                            <a href="/logout"
                                class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 text-danger">
                                <i class="ti ti-logout" style="font-size: 1.125rem;"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
