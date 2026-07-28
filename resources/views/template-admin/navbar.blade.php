<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header justify-content-center">
            <a href="/dashboard-superadmin" class="b-brand text-primary">
                <span class="h4 font-weight-black text-white m-0">retcehStudio Admin</span>
            </a>
        </div>
        @if (Auth::user()->role == 'superadmin')
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item">
                        <a href="/dashboard-superadmin" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Data retcehStudio</label>
                        <i class="ti ti-settings"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manage-settings.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-settings"></i></span>
                            <span class="pc-mtext">Pengaturan AI & Landing</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('showcase.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-photo"></i></span>
                            <span class="pc-mtext">Showcase Sebelum/Sesudah</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('package.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-credit-card"></i></span>
                            <span class="pc-mtext">Paket Topup Saldo</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('riwayat-topup.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-receipt"></i></span>
                            <span class="pc-mtext">Riwayat Topup</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manage-pelanggan.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-user"></i></span>
                            <span class="pc-mtext">Pelanggan & Saldo Kredit</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manage-testimoni.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-message-circle"></i></span>
                            <span class="pc-mtext">Testimoni Pelanggan</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Lainnya</label>
                        <i class="ti ti-menu"></i>
                    </li>
                    <li class="pc-item">
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
