<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header d-flex align-items-center justify-content-center">
            <a href="/dashboard-superadmin" class="b-brand text-center">
                <span class="h5 m-0 fw-700">retcehStudio</span>
            </a>
        </div>
        @if (Auth::user()->role == 'superadmin')
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item {{ request()->is('dashboard-superadmin') ? 'active' : '' }}">
                        <a href="/dashboard-superadmin" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Data retcehStudio</label>
                    </li>

                    <li class="pc-item {{ request()->is('manage-settings*') ? 'active' : '' }}">
                        <a href="{{ route('manage-settings.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-settings"></i></span>
                            <span class="pc-mtext">Pengaturan AI & Landing</span>
                        </a>
                    </li>

                    <li class="pc-item {{ request()->is('showcase*') ? 'active' : '' }}">
                        <a href="{{ route('showcase.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-photo"></i></span>
                            <span class="pc-mtext">Showcase Sebelum/Sesudah</span>
                        </a>
                    </li>

                    <li class="pc-item {{ request()->is('package*') ? 'active' : '' }}">
                        <a href="{{ route('package.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-credit-card"></i></span>
                            <span class="pc-mtext">Paket Topup Saldo</span>
                        </a>
                    </li>

                    <li class="pc-item {{ request()->is('riwayat-topup*') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-topup.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-receipt"></i></span>
                            <span class="pc-mtext">Riwayat Topup</span>
                        </a>
                    </li>

                    <li class="pc-item {{ request()->is('manage-pelanggan*') ? 'active' : '' }}">
                        <a href="{{ route('manage-pelanggan.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-users"></i></span>
                            <span class="pc-mtext">Pelanggan & Saldo Kredit</span>
                        </a>
                    </li>

                    <li class="pc-item {{ request()->is('manage-testimoni*') ? 'active' : '' }}">
                        <a href="{{ route('manage-testimoni.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-message-circle"></i></span>
                            <span class="pc-mtext">Testimoni Pelanggan</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Lainnya</label>
                    </li>

                    <li class="pc-item {{ request()->is('whatsapp-api*') ? 'active' : '' }}">
                        <a href="{{ route('whatsapp-api.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-brand-whatsapp"></i></span>
                            <span class="pc-mtext">API Whatsapp</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</nav>
