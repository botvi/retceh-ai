<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'retcehStudio - AI Product Design Studio')</title>
    <meta name="description"
        content="Ubah foto produk Anda menjadi foto iklan premium secara instan dengan kecerdasan AI.">

    <!-- Google Fonts: Inter, Outfit, Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@750;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Tailwind CSS v4 CDN -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <style>
        @theme {
            --font-sans: 'Outfit', sans-serif;
            --font-display: 'Plus Jakarta Sans', sans-serif;
            --font-varien: 'Syne', sans-serif;

            --color-wise-green: #9fe870;
            --color-wise-green-hover: #8cd85d;
            --color-forest: #163300;
            --color-forest-hover: #0f2400;
            --color-charcoal: #0e0f0c;
            --color-wise-bg: #f4f6f2;
            --color-wise-border: #e6ece1;

            /* shadcn/ui-inspired radii & shadows */
            --radius: 0.75rem;
            --shadow-card: 0 1px 3px 0 rgb(0 0 0 / 0.06), 0 1px 2px -1px rgb(0 0 0 / 0.06);
            --shadow-card-hover: 0 4px 6px -1px rgb(0 0 0 / 0.08), 0 2px 4px -2px rgb(0 0 0 / 0.05);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.08), 0 4px 6px -4px rgb(0 0 0 / 0.04);

            /* Override standard Tailwind zinc colors to match Wise theme automatically */
            --color-zinc-50: #ffffff;
            --color-zinc-100: #f4f6f2;
            --color-zinc-200: #e6ece1;
            --color-zinc-300: #d9e2d5;
            --color-zinc-400: #8a8d88;
            --color-zinc-500: #454745;
            --color-zinc-600: #3b3d3b;
            --color-zinc-700: #2e302c;
            --color-zinc-800: #1a1b1a;
            --color-zinc-900: #163300;
            --color-zinc-950: #0e0f0c;
        }

        /* ── shadcn/ui CSS Variables ── */
        :root {
            --shad-radius: 0.5rem;
            --shad-ring: 240 5.9% 10%;
            --shad-ring-offset: 0 0% 100%;
            --shad-border: 240 5.9% 90%;
            --shad-muted: 240 4.8% 95.9%;
            --shad-muted-foreground: 240 3.8% 46.1%;
        }

        /* Typography */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Plus Jakarta Sans', 'Outfit', sans-serif !important;
            letter-spacing: -0.025em !important;
            font-weight: 800 !important;
            color: #163300 !important;
        }

        .hero-title {
            font-family: 'Syne', sans-serif !important;
            font-weight: 800 !important;
            letter-spacing: -0.015em !important;
        }

        body {
            font-family: 'Outfit', 'Inter', sans-serif !important;
            background-color: #f4f6f2 !important;
            background-image: radial-gradient(rgba(22, 51, 0, 0.04) 1.2px, transparent 1.2px) !important;
            background-size: 20px 20px !important;
            background-attachment: fixed !important;
        }

        /* ── shadcn/ui Card Style ── */
        .shad-card {
            border-radius: var(--radius) !important;
            border: 1px solid var(--color-wise-border) !important;
            background: #ffffff !important;
            box-shadow: var(--shadow-card) !important;
            transition: all 0.2s ease !important;
        }

        .shad-card:hover {
            box-shadow: var(--shadow-card-hover) !important;
        }

        /* ── Focus Ring (shadcn/ui style) ── */
        input:focus-visible,
        textarea:focus-visible,
        select:focus-visible,
        button:focus-visible {
            outline: none !important;
            ring: 2px solid hsl(var(--shad-ring) / 0.2) !important;
            ring-offset: 2px !important;
        }

        /* Active Navigation */
        .active-nav {
            background-color: #163300 !important;
            color: #9fe870 !important;
            border-radius: 9999px !important;
            box-shadow: 0 4px 6px -1px rgba(22, 51, 0, 0.12), 0 2px 4px -2px rgba(22, 51, 0, 0.12) !important;
        }

        /* Desktop & Mobile Header Navigation Links */
        header nav a {
            padding: 0.5rem 1rem !important;
            border-radius: 9999px !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
            font-weight: 700 !important;
            font-size: 0.75rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            display: inline-flex !important;
            align-items: center !important;
            color: #454745 !important;
            text-decoration: none !important;
        }

        header nav a:hover:not(.active-nav) {
            background-color: rgba(22, 51, 0, 0.06) !important;
            color: #163300 !important;
        }

        /* Primary Buttons - Wise Green styling */
        .btn-start-generating,
        #generate-btn,
        #btn-submit-auth,
        #btn-submit-review,
        #btn-save-profile,
        .btn-purchase-credits {
            background-color: #9fe870 !important;
            color: #163300 !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 700 !important;
            border-radius: 9999px !important;
            border: none !important;
            padding: 0.75rem 1.75rem !important;
            font-size: 0.875rem !important;
            transition: all 0.2s ease-in-out !important;
            box-shadow: none !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
        }

        .btn-start-generating:hover,
        #generate-btn:hover:not(:disabled),
        #btn-submit-auth:hover,
        #btn-submit-review:hover,
        #btn-save-profile:hover,
        .btn-purchase-credits:hover {
            background-color: #8cd85d !important;
            color: #163300 !important;
            transform: translateY(-1px) !important;
        }

        /* Secondary Buttons - Outline / Forest Green styling */
        .ratio-btn,
        #btn-restart,
        .btn-nav-login,
        .btn-logout,
        #btn-clear-gallery,
        #btn-upload-trigger,
        #gallery-empty-state a {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 700 !important;
            border-radius: 9999px !important;
            border: 1.5px solid #163300 !important;
            color: #163300 !important;
            background-color: transparent !important;
            transition: all 0.2s ease-in-out !important;
            box-shadow: none !important;
            cursor: pointer !important;
            padding: 0.5rem 1.25rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .ratio-btn:hover,
        #btn-restart:hover,
        .btn-nav-login:hover,
        .btn-logout:hover,
        #btn-clear-gallery:hover,
        #btn-upload-trigger:hover,
        #gallery-empty-state a:hover {
            background-color: rgba(22, 51, 0, 0.06) !important;
            color: #163300 !important;
        }

        /* ── Mobile Drawer Animation ── */
        .mobile-drawer {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                opacity 0.25s ease,
                padding 0.3s ease;
        }

        .mobile-drawer.open {
            max-height: 500px;
            opacity: 1;
        }

        /* Custom Scrollbar styling matching Wise */
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-none {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* support flipping comparison cards */
        .deck-wrapper>div {
            transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1), z-index 0.6s ease, box-shadow 0.6s ease, filter 0.6s ease, opacity 0.6s ease !important;
        }

        @media (hover: hover) {
            .deck-wrapper:not(.is-flipped):hover>div:first-child {
                transform: rotate(-12deg) translate(-24px) scale(0.96) !important;
            }

            .deck-wrapper:not(.is-flipped):hover>div:last-child {
                transform: rotate(12deg) translate(24px) scale(1.04) !important;
            }

            .deck-wrapper.is-flipped:hover>div:first-child {
                transform: rotate(12deg) translate(24px) scale(1.04) !important;
            }

            .deck-wrapper.is-flipped:hover>div:last-child {
                transform: rotate(-12deg) translate(-24px) scale(0.96) !important;
            }
        }

        .deck-wrapper.is-flipped>div:first-child {
            transform: rotate(6deg) translate(12px) scale(1.02) !important;
            z-index: 25 !important;
        }

        .deck-wrapper.is-flipped>div:first-child img {
            filter: grayscale(0) !important;
            opacity: 1 !important;
        }

        .deck-wrapper.is-flipped>div:last-child {
            transform: rotate(-6deg) translate(-12px) scale(0.98) !important;
            z-index: 15 !important;
        }

        .deck-wrapper.is-flipped>div:last-child img {
            filter: grayscale(85%) !important;
            opacity: 0.85 !important;
        }

        /* Shifter Shifting Animations */
        @keyframes word-shift {

            0%,
            15% {
                transform: translateY(0);
            }

            20%,
            35% {
                transform: translateY(-20%);
            }

            40%,
            55% {
                transform: translateY(-40%);
            }

            60%,
            75% {
                transform: translateY(-60%);
            }

            80%,
            100% {
                transform: translateY(-80%);
            }
        }

        .animate-word-shifter {
            animation: word-shift 10s cubic-bezier(0.76, 0, 0.24, 1) infinite !important;
        }

        @keyframes blob-float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -40px) scale(1.08);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.95);
            }
        }

        @keyframes blob-float-reverse {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(-30px, 30px) scale(0.92);
            }

            66% {
                transform: translate(25px, -20px) scale(1.1);
            }
        }

        .animate-blob-float {
            animation: blob-float 12s ease-in-out infinite !important;
        }

        .animate-blob-float-reverse {
            animation: blob-float-reverse 15s ease-in-out infinite !important;
        }

        .delay-1 {
            animation-delay: 0.15s !important;
        }

        .delay-2 {
            animation-delay: 0.3s !important;
        }

        .delay-3 {
            animation-delay: 0.45s !important;
        }

        @keyframes hero-fade-in-up {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            opacity: 0;
            animation: hero-fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
        }
    </style>
    @yield('styles')
</head>

<body class="text-zinc-900 min-h-screen antialiased selection:bg-zinc-900 selection:text-zinc-50 flex flex-col pb-6">

    <!-- Global Header / Navbar -->
    <header class="w-full border-b border-zinc-200 bg-white sticky top-0 z-40 mb-4 shadow-sm">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 py-3 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <!-- Brand Logo -->
                <a href="{{ route('index') }}" id="nav-logo"
                    class="flex items-center cursor-pointer font-bold text-zinc-900 no-underline">
                    <span class="tracking-tighter text-lg font-black text-forest lowercase">retche</span>
                    <span
                        class="relative inline-block text-wise-green bg-forest px-1.5 py-0.5 rounded-lg tracking-tighter text-lg font-black lowercase overflow-hidden text-left align-middle whitespace-nowrap">
                        <!-- Spacer to automatically and responsively set container width/height matching the longest word -->
                        <span class="invisible block opacity-0 select-none pointer-events-none">design</span>
                        <!-- Shifter element containing the list of sliding words -->
                        <span class="absolute left-1.5 right-1.5 top-0.5 animate-word-shifter flex flex-col">
                            <span>studio</span>
                            <span>ai</span>
                            <span>ads</span>
                            <span>design</span>
                            <span>studio</span>
                        </span>
                    </span>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-zinc-500">
                    <a href="{{ route('index') }}"
                        class="nav-link-landing {{ Route::is('index') ? 'active-nav' : '' }}">Beranda</a>
                    <a href="{{ route('studio.index') }}"
                        class="nav-link-studio {{ Route::is('studio.index') ? 'active-nav' : '' }}">Studio</a>
                    <a href="{{ route('gallery.index') }}"
                        class="nav-link-gallery {{ Route::is('gallery.index') ? 'active-nav' : '' }}">Galeri</a>
                    <a href="{{ route('topup.index') }}"
                        class="nav-link-topup {{ Route::is('topup.index') ? 'active-nav' : '' }}">Top Up</a>
                </nav>
            </div>

            <!-- Right side: User Profile & Actions -->
            <div class="flex items-center gap-4">
                @auth
                    <!-- Desktop Profile Badge (Logged In) -->
                    <div class="items-center gap-3 hidden md:flex">
                        <a href="{{ route('topup.index') }}"
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-zinc-100 border border-zinc-200 text-xs font-semibold text-zinc-700 hover:bg-zinc-200 transition no-underline">
                            <i class="bi bi-cup-hot-fill text-amber-700"></i>
                            <span>{{ Auth::user()->credits }}</span> Gelas Kopi
                        </a>
                        <a href="{{ route('profil') }}"
                            class="flex items-center gap-2 text-zinc-700 hover:text-zinc-900 no-underline"
                            title="Profil Anda">
                            <div
                                class="w-7 h-7 rounded-full bg-zinc-200 border border-zinc-200 flex items-center justify-center overflow-hidden flex-shrink-0">
                                @if (Auth::user()->foto_profile)
                                    @php
                                        $foto = Auth::user()->foto_profile;
                                        $src = Str::startsWith($foto, ['http://', 'https://'])
                                            ? $foto
                                            : asset('uploads/foto_profile/' . $foto);
                                    @endphp
                                    <img class="w-full h-full object-cover" src="{{ $src }}" alt="Avatar">
                                @else
                                    <span
                                        class="text-[11px] font-bold text-zinc-700">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                @endif
                            </div>
                            <span class="text-xs font-semibold">{{ Auth::user()->name }}</span>
                        </a>
                        <a href="{{ route('logout') }}"
                            class="btn-logout text-xs py-1.5 px-3 border border-zinc-200 rounded-full hover:bg-zinc-150 transition cursor-pointer no-underline">Keluar</a>
                    </div>
                @else
                    <!-- Desktop Login / Signup Actions (Logged Out) -->
                    <a href="{{ route('login') }}"
                        class="btn-nav-login hidden md:inline-flex text-xs font-bold text-forest py-2 px-4 rounded-full hover:bg-zinc-100 transition no-underline">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="btn-nav-login hidden md:inline-flex text-xs py-2 px-5 bg-wise-green text-forest rounded-full font-bold transition hover:bg-wise-green-hover cursor-pointer no-underline">Daftar</a>
                @endauth

                <!-- Mobile Hamburger Menu Trigger -->
                <button type="button" id="mobile-menu-toggle"
                    class="md:hidden flex items-center justify-center w-8 h-8 text-forest hover:bg-zinc-100 rounded-full transition cursor-pointer"
                    title="Menu">
                    <i class="bi bi-list text-xl" id="menu-toggle-icon"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu Drawer (animated slide) -->
        <div id="mobile-menu-drawer"
            class="mobile-drawer md:hidden w-full border-t border-zinc-200 bg-white px-6 shadow-inner">
            <div class="py-5 flex flex-col gap-4">
                <nav class="flex flex-col gap-3 font-semibold text-sm text-zinc-500">
                    <a href="{{ route('index') }}"
                        class="py-1.5 hover:text-zinc-900 transition {{ Route::is('index') ? 'text-forest font-bold' : '' }}">Beranda</a>
                    <a href="{{ route('studio.index') }}"
                        class="py-1.5 hover:text-zinc-900 transition {{ Route::is('studio.index') ? 'text-forest font-bold' : '' }}">Studio</a>
                    <a href="{{ route('gallery.index') }}"
                        class="py-1.5 hover:text-zinc-900 transition {{ Route::is('gallery.index') ? 'text-forest font-bold' : '' }}">Galeri</a>
                    <a href="{{ route('topup.index') }}"
                        class="py-1.5 hover:text-zinc-900 transition {{ Route::is('topup.index') ? 'text-forest font-bold' : '' }}">Top
                        Up</a>
                </nav>

                @auth
                    <div class="flex flex-col gap-3 pt-3 border-t border-zinc-150">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('profil') }}"
                                class="flex items-center gap-2.5 text-zinc-700 hover:text-zinc-900 no-underline">
                                <div
                                    class="w-8 h-8 rounded-full bg-zinc-200 border border-zinc-200 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    @if (Auth::user()->foto_profile)
                                        <img class="w-full h-full object-cover"
                                            src="{{ Str::startsWith(Auth::user()->foto_profile, ['http://', 'https://']) ? Auth::user()->foto_profile : asset('uploads/foto_profile/' . Auth::user()->foto_profile) }}"
                                            alt="Avatar">
                                    @else
                                        <span
                                            class="text-[12px] font-bold text-zinc-700">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <div class="flex flex-col text-left">
                                    <span class="text-xs font-bold text-forest">{{ Auth::user()->name }}</span>
                                    <span class="text-[10px] text-zinc-400">Kelola Profil</span>
                                </div>
                            </a>
                            <a href="{{ route('topup.index') }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-zinc-100 border border-zinc-200 text-xs font-semibold text-zinc-700 hover:bg-zinc-200 transition no-underline">
                                <i class="bi bi-cup-hot-fill text-amber-700"></i>
                                <span>{{ Auth::user()->credits }}</span>
                            </a>
                        </div>
                        <a href="{{ route('logout') }}"
                            class="btn-logout w-full text-center text-xs py-2 border border-zinc-200 rounded-full hover:bg-zinc-100 transition cursor-pointer font-bold text-forest mt-1 no-underline">Keluar</a>
                    </div>
                @else
                    <div class="flex flex-col gap-2 pt-3 border-t border-zinc-150">
                        <a href="{{ route('login') }}"
                            class="w-full text-center text-sm font-bold text-forest py-2.5 border border-zinc-200 rounded-full hover:bg-zinc-100 transition no-underline">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="w-full text-center text-sm py-2.5 bg-wise-green text-forest rounded-full font-bold transition hover:bg-wise-green-hover cursor-pointer no-underline">Daftar</a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    @yield('content')

    <!-- Notification Toast -->
    <div id="toast"
        class="hidden fixed bottom-6 right-6 bg-white border border-zinc-200 text-zinc-900 rounded-lg p-4 shadow-xl z-50 flex items-center gap-3 min-w-[280px] max-w-sm transition-all duration-300">
        <i class="bi bi-info-circle-fill toast-icon text-zinc-500 text-lg"></i>
        <span id="toast-message" class="text-xs font-medium leading-normal">Pesan</span>
    </div>

    <!-- Script file -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenuDrawer = document.getElementById('mobile-menu-drawer');
            const menuToggleIcon = document.getElementById('menu-toggle-icon');

            if (mobileMenuToggle && mobileMenuDrawer) {
                mobileMenuToggle.addEventListener('click', () => {
                    const isOpen = mobileMenuDrawer.classList.contains('open');
                    if (isOpen) {
                        mobileMenuDrawer.classList.remove('open');
                        if (menuToggleIcon) menuToggleIcon.className = 'bi bi-list text-xl';
                    } else {
                        mobileMenuDrawer.classList.add('open');
                        if (menuToggleIcon) menuToggleIcon.className = 'bi bi-x text-xl';
                    }
                });
            }
        });

        function showToast(message, type = 'info') {
            if (typeof window.showCustomToast === 'function') {
                window.showCustomToast(message, type);
            }
        }
    </script>
    @include('components.custom-alert')
    @yield('scripts')
</body>

</html>
