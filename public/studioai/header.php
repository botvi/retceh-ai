<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Product Design Studio - Powered by retcehStudio AI</title>
    <meta name="description"
        content="Ubah foto produk Anda menjadi foto iklan premium secara instan dengan kecerdasan AI.">
    <!-- Google Fonts: Inter, Outfit, Plus Jakarta Sans & Syne -->
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
        @font-face {
            font-family: 'Varien';
            src: url('fonts/Varien.woff2') format('woff2'),
                url('fonts/Varien.woff') format('woff'),
                url('fonts/Varien.ttf') format('truetype');
            font-weight: 800;
            font-style: normal;
            font-display: swap;
        }

        @theme {
            --font-sans: 'Outfit', sans-serif;
            --font-display: 'Plus Jakarta Sans', sans-serif;
            --font-varien: 'Varien', 'Syne', sans-serif;

            --color-wise-green: #9fe870;
            --color-wise-green-hover: #8cd85d;
            --color-forest: #163300;
            --color-forest-hover: #0f2400;
            --color-charcoal: #0e0f0c;
            --color-wise-bg: #f4f6f2;
            --color-wise-border: #e6ece1;

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
            font-family: 'Varien', 'Syne', sans-serif !important;
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

        body::before,
        body::after {
            display: none !important;
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
        .btn-purchase-credits[data-credits="200"] {
            background-color: #9fe870 !important;
            color: #163300 !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 700 !important;
            border-radius: 9999px !important;
            /* Wise pill buttons */
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
        .btn-purchase-credits[data-credits="200"]:hover {
            background-color: #8cd85d !important;
            color: #163300 !important;
            transform: translateY(-1px) !important;
        }

        .btn-start-generating:active,
        #generate-btn:active:not(:disabled),
        #btn-submit-auth:active,
        #btn-submit-review:active,
        #btn-save-profile:active,
        .btn-purchase-credits[data-credits="200"]:active {
            transform: translateY(0) !important;
        }

        /* Disabled state for generate button */
        #generate-btn:disabled {
            background-color: #d9e2d5 !important;
            color: #8a8d88 !important;
            cursor: not-allowed !important;
            transform: none !important;
        }

        /* Secondary Buttons - Outline / Forest Green styling */
        .ratio-btn,
        #btn-restart,
        .btn-purchase-credits[data-credits="50"],
        .btn-purchase-credits[data-credits="1000"],
        .btn-nav-login,
        .btn-logout,
        a[href="topup.php"].w-full.sm\:w-auto,
        a[href="review.php"].inline-flex,
        #btn-clear-gallery,
        #btn-toggle-auth-mode,
        #btn-upload-trigger,
        #profile-avatar-wrapper,
        #gallery-empty-state a,
        #viewport-placeholder div {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 700 !important;
            border-radius: 9999px !important;
            border: 1.5px solid #163300 !important;
            color: #163300 !important;
            background-color: transparent !important;
            transition: all 0.2s ease-in-out !important;
            box-shadow: none !important;
            cursor: pointer !important;
        }

        .ratio-btn:hover,
        #btn-restart:hover,
        .btn-purchase-credits[data-credits="50"]:hover,
        .btn-purchase-credits[data-credits="1000"]:hover,
        .btn-nav-login:hover,
        .btn-logout:hover,
        a[href="topup.php"].w-full.sm\:w-auto:hover,
        a[href="review.php"].inline-flex:hover,
        #btn-clear-gallery:hover,
        #btn-toggle-auth-mode:hover,
        #btn-upload-trigger:hover,
        #gallery-empty-state a:hover {
            background-color: rgba(22, 51, 0, 0.06) !important;
            color: #163300 !important;
        }

        /* Specific override for active ratio buttons */
        #aspect-ratio-grid .ratio-btn.active-ratio,
        #aspect-ratio-grid .ratio-btn.active-ratio:hover {
            background-color: #163300 !important;
            color: #9fe870 !important;
            border-color: #163300 !important;
        }

        /* Inputs & Form Controls */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        input[type="file"],
        textarea,
        select {
            border: 1.5px solid #e6ece1 !important;
            background-color: #ffffff !important;
            border-radius: 10px !important;
            padding: 0.75rem 1rem !important;
            font-size: 0.875rem !important;
            transition: all 0.2s ease !important;
            color: #0e0f0c !important;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none !important;
            border-color: #163300 !important;
            box-shadow: 0 0 0 2.5px rgba(22, 51, 0, 0.08) !important;
        }

        /* Custom Scrollbar styling matching Wise */
        .scrollbar-thin {
            -ms-overflow-style: auto;
            scrollbar-width: thin;
            scrollbar-color: #d9e2d5 transparent;
        }

        /* Hide scrollbars but keep functionality */
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-none {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .scrollbar-thin::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: transparent;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #d9e2d5;
            border-radius: 99px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: #c3ccbf;
        }

        /* Responsive auth overrides */
        @media (max-width: 767.9px) {

            .desktop-only-auth,
            .desktop-profile-badge {
                display: none !important;
            }
        }

        /* Support flipping/swapping cards when clicked */
        .deck-wrapper>div {
            transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1), z-index 0.6s ease, box-shadow 0.6s ease, filter 0.6s ease, opacity 0.6s ease !important;
        }

        /* Hover hint: slightly fan out to show depth */
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

        /* Flipped state (swapped positions and depth) */
        .deck-wrapper.is-flipped>div:first-child {
            transform: rotate(6deg) translate(12px) scale(1.02) !important;
            z-index: 25 !important;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.15), 0 8px 10px -6px rgb(0 0 0 / 0.15) !important;
        }

        .deck-wrapper.is-flipped>div:first-child img {
            filter: grayscale(0) !important;
            opacity: 1 !important;
        }

        .deck-wrapper.is-flipped>div:last-child {
            transform: rotate(-6deg) translate(-12px) scale(0.98) !important;
            z-index: 15 !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1) !important;
        }

        .deck-wrapper.is-flipped>div:last-child img {
            filter: grayscale(85%) !important;
            opacity: 0.85 !important;
        }

        @media (min-width: 768px) {

            .mobile-only-auth,
            .mobile-profile-badge {
                display: none !important;
            }
        }

        /* Hero Section Animations & Keyframes */
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

        .animate-fade-in-up {
            opacity: 0;
            animation: hero-fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .animate-word-shifter {
            animation: word-shift 10s cubic-bezier(0.76, 0, 0.24, 1) infinite;
        }

        .animate-blob-float {
            animation: blob-float 12s ease-in-out infinite;
        }

        .animate-blob-float-reverse {
            animation: blob-float-reverse 15s ease-in-out infinite;
        }

        .delay-1 {
            animation-delay: 0.15s;
        }

        .delay-2 {
            animation-delay: 0.3s;
        }

        .delay-3 {
            animation-delay: 0.45s;
        }
    </style>
</head>

<body
    class="text-zinc-900 min-h-screen antialiased selection:bg-zinc-900 selection:text-zinc-50 flex flex-col pb-6 transition-all duration-300">

    <!-- Global Header / Navbar -->
    <header class="w-full border-b border-zinc-200 bg-white sticky top-0 z-40 mb-4 shadow-sm">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 py-3 flex items-center justify-between">
            <!-- Left side: Logo & Navigation Links -->
            <div class="flex items-center gap-8">
                <!-- Brand Logo (Wise-like Chevron & Lowercase bold) -->
                <a href="index.php" id="nav-logo"
                    class="flex items-center cursor-pointer font-bold text-zinc-900 no-underline">
                    <span class="tracking-tighter text-lg font-black text-forest lowercase">retceh</span>
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

                <!-- Desktop Navigation Links (Left Aligned next to Logo) -->
                <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-zinc-500">
                    <a href="index.php" id="nav-link-landing"
                        class="nav-link-landing hover:text-zinc-900 transition">Beranda</a>
                    <a href="studio.php" id="nav-link-studio"
                        class="nav-link-studio hover:text-zinc-900 transition">Studio</a>
                    <a href="gallery.php" id="nav-link-gallery"
                        class="nav-link-gallery hover:text-zinc-900 transition">Galeri</a>
                    <a href="topup.php" id="nav-link-topup" class="nav-link-topup hover:text-zinc-900 transition">Top
                        Up</a>

                </nav>
            </div>

            <!-- Right side: User Profile & Actions (Right Aligned) -->
            <div class="flex items-center gap-4">
                <!-- Desktop Profile Badge (Logged In) -->
                <div class="items-center gap-3 hidden desktop-profile-badge">
                    <a href="topup.php"
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-zinc-100 border border-zinc-200 text-xs font-semibold text-zinc-700 hover:bg-zinc-200 transition">
                        <i class="bi bi-cup-hot-fill text-amber-700"></i>
                        <span class="desktop-credit-count">15</span> Gelas Kopi
                    </a>
                    <a href="profile.php" class="flex items-center gap-2 text-zinc-700 hover:text-zinc-900 no-underline"
                        title="Profil Anda">
                        <div
                            class="w-7 h-7 rounded-full bg-zinc-200 border border-zinc-200 flex items-center justify-center overflow-hidden flex-shrink-0">
                            <span class="desktop-avatar-initial text-[11px] font-bold text-zinc-700">U</span>
                            <img class="desktop-avatar-img w-full h-full object-cover hidden" src="" alt="Avatar">
                        </div>
                        <span class="text-xs font-semibold username-display">User</span>
                    </a>
                    <button type="button"
                        class="btn-logout text-xs py-1.5 px-3 border border-zinc-200 rounded-full hover:bg-zinc-150 transition cursor-pointer">Keluar</button>
                </div>

                <!-- Desktop Login / Signup Actions (Logged Out) -->
                <a href="login.php"
                    class="btn-nav-login desktop-only-auth text-xs font-bold text-forest py-2 px-4 rounded-full hover:bg-zinc-100 transition no-underline">Masuk</a>
                <a href="register.php"
                    class="btn-nav-login desktop-only-auth text-xs py-2 px-5 bg-wise-green text-forest rounded-full font-bold transition hover:bg-wise-green-hover cursor-pointer no-underline">Daftar</a>

                <!-- Mobile Hamburger Menu Trigger (Only element beside logo on mobile) -->
                <button type="button" id="mobile-menu-toggle"
                    class="md:hidden flex items-center justify-center w-8 h-8 text-forest hover:bg-zinc-100 rounded-full transition cursor-pointer"
                    title="Menu">
                    <i class="bi bi-list text-xl" id="menu-toggle-icon"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu Drawer (Collapsible) -->
        <div id="mobile-menu-drawer"
            class="hidden md:hidden w-full border-t border-zinc-200 bg-white px-6 py-5 flex flex-col gap-4 shadow-inner">
            <nav class="flex flex-col gap-3 font-semibold text-sm text-zinc-500">
                <a href="index.php" class="nav-link-landing py-1 hover:text-zinc-900 transition">Beranda</a>
                <a href="studio.php" class="nav-link-studio py-1 hover:text-zinc-900 transition">Studio</a>
                <a href="gallery.php" class="nav-link-gallery py-1 hover:text-zinc-900 transition">Galeri</a>
                <a href="topup.php" class="nav-link-topup py-1 hover:text-zinc-900 transition">Top Up</a>

            </nav>

            <!-- Mobile Profile Badge (Logged In) -->
            <div class="mobile-profile-badge hidden flex-col gap-3 pt-3 border-t border-zinc-150">
                <div class="flex items-center justify-between">
                    <a href="profile.php"
                        class="flex items-center gap-2.5 text-zinc-700 hover:text-zinc-900 no-underline"
                        title="Profil Anda">
                        <div
                            class="w-8 h-8 rounded-full bg-zinc-200 border border-zinc-200 flex items-center justify-center overflow-hidden flex-shrink-0">
                            <span class="mobile-avatar-initial text-[12px] font-bold text-zinc-700">U</span>
                            <img class="mobile-avatar-img w-full h-full object-cover hidden" src="" alt="Avatar">
                        </div>
                        <div class="flex flex-col text-left">
                            <span class="text-xs font-bold text-forest username-display">User</span>
                            <span class="text-[10px] text-zinc-400">Kelola Profil</span>
                        </div>
                    </a>

                    <a href="topup.php"
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-zinc-100 border border-zinc-200 text-xs font-semibold text-zinc-700 hover:bg-zinc-200 transition">
                        <i class="bi bi-cup-hot-fill text-amber-700"></i>
                        <span class="mobile-credit-count">15</span> Gelas Kopi
                    </a>
                </div>
                <button type="button"
                    class="btn-logout w-full text-center text-xs py-2 border border-zinc-200 rounded-full hover:bg-zinc-100 transition cursor-pointer font-bold text-forest mt-1">Keluar</button>
            </div>

            <!-- Mobile Login / Signup Actions (Logged Out) -->
            <div class="btn-nav-login mobile-only-auth flex flex-col gap-2 pt-3 border-t border-zinc-150">
                <a href="login.php"
                    class="w-full text-center text-sm font-bold text-forest py-2.5 border border-zinc-200 rounded-full hover:bg-zinc-100 transition no-underline">Masuk</a>
                <a href="register.php"
                    class="w-full text-center text-sm py-2.5 bg-wise-green text-forest rounded-full font-bold transition hover:bg-wise-green-hover cursor-pointer no-underline">Daftar</a>
            </div>
        </div>
    </header>