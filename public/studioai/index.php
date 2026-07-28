<?php include 'header.php'; ?>

<!-- Main View Container -->
<main class="w-full flex-grow px-4 sm:px-6">

    <!-- View: Landing Page -->
    <div id="view-landing" class="view-section w-full max-w-4xl mx-auto space-y-8 py-3">
        <!-- Hero Section -->
        <section class="text-center py-10 md:py-14 space-y-6 relative overflow-hidden">
            <!-- Floating Glowing Aura Blobs (Aesthetics) -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10">
                <div
                    class="absolute top-[10%] left-[20%] w-[250px] h-[250px] rounded-full bg-wise-green/15 blur-[60px] animate-blob-float">
                </div>
                <div
                    class="absolute bottom-[10%] right-[20%] w-[220px] h-[220px] rounded-full bg-emerald-500/10 blur-[60px] animate-blob-float-reverse">
                </div>
            </div>

            <h1
                class="hero-title text-4xl sm:text-6xl md:text-7xl font-black uppercase tracking-[-0.035em] text-forest max-w-4xl mx-auto leading-[0.98] sm:leading-[0.95] transition-colors duration-300 animate-fade-in-up flex flex-col items-center justify-center">
                <span>Ubah Foto Produk</span>
                <span class="flex flex-wrap items-center justify-center">
                    <span>Menjadi Foto</span>
                    <span
                        class="relative inline-block text-wise-green bg-forest px-3 py-1 sm:py-1.5 rounded-2xl mx-2 overflow-hidden text-left align-middle whitespace-nowrap">
                        <!-- Spacer to automatically and responsively set container width/height matching the longest word -->
                        <span class="invisible block opacity-0 select-none pointer-events-none">Berkelas.</span>
                        <!-- Shifter element containing the list of sliding words -->
                        <span class="absolute left-3 right-3 top-1 sm:top-1.5 animate-word-shifter flex flex-col">
                            <span>Berkelas.</span>
                            <span>Premium.</span>
                            <span>Menjual.</span>
                            <span>Estetik.</span>
                            <span>Berkelas.</span>
                        </span>
                    </span>
                </span>
            </h1>
            <p
                class="text-sm sm:text-base text-zinc-550 font-normal max-w-lg mx-auto leading-relaxed transition-colors duration-300 animate-fade-in-up delay-1">
                Lewati biaya sewa studio foto yang mahal. Cukup unggah foto produk Anda dan buat desain foto iklan
                premium berkualitas komersial secara instan dengan kecerdasan AI.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up delay-2">
                <a href="studio.php"
                    class="btn-start-generating text-sm py-3 px-8 rounded-full font-bold transition shadow-md flex items-center justify-center gap-2">
                    Mulai Buat Desain
                </a>
                <a href="topup.php"
                    class="w-full sm:w-auto text-center text-sm py-3 px-8 bg-white border border-zinc-200 text-zinc-700 hover:bg-zinc-50 rounded-full font-bold transition hover:-translate-y-0.5 active:translate-y-0 shadow-sm">
                    Lihat Paket Harga
                </a>
            </div>
        </section>

        <!-- Showcase Galeri Hasil: Playing Cards Deck Gallery -->
        <section
            class="rounded-3xl border border-zinc-200 bg-white p-8 sm:p-10 shadow-sm overflow-hidden relative transition-colors duration-300 hover:shadow-md text-center space-y-8">
            <div class="space-y-2">
                <div
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-wise-green text-forest text-[11px] font-bold shadow-sm">
                    <i class="bi bi-sparkles"></i> Galeri Sebelum & Sesudah AI
                </div>
                <h3 class="text-2xl font-extrabold text-zinc-900 tracking-tight">Kekuatan AI retcehStudio</h3>
                <p class="text-xs text-zinc-400">Klik kartu untuk menukar posisi Foto Asli & Hasil AI</p>

            </div>

            <!-- The Deck Grid / Mobile Carousel -->
            <div id="deck-carousel"
                class="flex overflow-x-auto md:grid md:grid-cols-3 gap-x-24 md:gap-x-12 max-w-4xl mx-auto py-10 px-8 md:px-4 scrollbar-none snap-x snap-mandatory relative"
                style="perspective: 1000px; scroll-behavior: smooth;">

                <!-- Product 1: Cold Brew Coffee -->
                <div class="snap-center shrink-0 w-[200px] md:w-auto md:shrink carousel-deck-item group relative flex flex-col items-center select-none"
                    style="perspective: 1000px;">
                    <!-- Card Deck Wrapper -->
                    <div
                        class="deck-wrapper relative w-[200px] h-[270px] transition-all duration-300 transform-style-3d cursor-pointer">
                        <!-- Card 1: Foto Asli (Before - Left Card) -->
                        <div
                            class="absolute inset-0 bg-white border border-zinc-200 rounded-2xl shadow-md p-2 transition-all duration-500 ease-out transform origin-bottom-right rotate-[-6deg] translate-x-[-12px] z-10 flex flex-col justify-between">
                            <span
                                class="absolute top-3 left-3 px-2 py-0.5 bg-zinc-900 text-white rounded-full text-[8px] font-bold tracking-wider uppercase z-20">Foto
                                Asli</span>
                            <div class="w-full h-[85%] rounded-xl overflow-hidden bg-zinc-50 border border-zinc-150">
                                <img src="images/coffee_before.png" alt="Coffee Botol Asli"
                                    class="w-full h-full object-cover grayscale opacity-85 transition-all duration-300">
                            </div>
                            <div class="text-center py-1">
                                <span class="text-[8px] font-black text-zinc-400 uppercase tracking-widest">Kopi
                                    Botol</span>
                            </div>
                        </div>

                        <!-- Card 2: Foto Hasil (After - Right Card) -->
                        <div
                            class="absolute inset-0 bg-white border border-zinc-200 rounded-2xl shadow-xl p-2 transition-all duration-500 ease-out transform origin-bottom-left rotate-[6deg] translate-x-[12px] z-20 flex flex-col justify-between">
                            <span
                                class="absolute top-3 right-3 px-2 py-0.5 bg-wise-green text-forest rounded-full text-[8px] font-bold tracking-wider uppercase z-20 shadow-sm animate-pulse">Hasil
                                AI</span>
                            <div
                                class="w-full h-[85%] rounded-xl overflow-hidden bg-zinc-50 border border-zinc-150 relative">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/45 via-transparent to-transparent opacity-40 z-10">
                                </div>
                                <img src="images/coffee_after.png" alt="Coffee Botol Studio"
                                    class="w-full h-full object-cover relative">
                            </div>
                            <div class="text-center py-1">
                                <span class="text-[8px] font-black text-forest uppercase tracking-widest">Studio
                                    Render</span>
                            </div>
                        </div>
                    </div>
                    <!-- Product Description Below Deck -->
                    <div class="mt-8 text-center space-y-1 transition-all duration-300">
                        <h4 class="text-sm font-extrabold text-zinc-800">Cold Brew Coffee</h4>
                        <p class="text-[11px] text-zinc-400 max-w-[180px]">Pencahayaan flat berganti kemegahan studio
                            warm amber backlight.</p>
                    </div>
                </div>

                <!-- Product 2: Skincare Serum -->
                <div class="snap-center shrink-0 w-[200px] md:w-auto md:shrink carousel-deck-item group relative flex flex-col items-center select-none"
                    style="perspective: 1000px;">
                    <!-- Card Deck Wrapper -->
                    <div
                        class="deck-wrapper relative w-[200px] h-[270px] transition-all duration-300 transform-style-3d cursor-pointer">
                        <!-- Card 1: Foto Asli (Before - Left Card) -->
                        <div
                            class="absolute inset-0 bg-white border border-zinc-200 rounded-2xl shadow-md p-2 transition-all duration-500 ease-out transform origin-bottom-right rotate-[-6deg] translate-x-[-12px] z-10 flex flex-col justify-between">
                            <span
                                class="absolute top-3 left-3 px-2 py-0.5 bg-zinc-900 text-white rounded-full text-[8px] font-bold tracking-wider uppercase z-20">Foto
                                Asli</span>
                            <div class="w-full h-[85%] rounded-xl overflow-hidden bg-zinc-50 border border-zinc-150">
                                <img src="images/serum_before.png" alt="Serum Asli"
                                    class="w-full h-full object-cover grayscale opacity-85 transition-all duration-300">
                            </div>
                            <div class="text-center py-1">
                                <span class="text-[8px] font-black text-zinc-400 uppercase tracking-widest">Botol
                                    Serum</span>
                            </div>
                        </div>

                        <!-- Card 2: Foto Hasil (After - Right Card) -->
                        <div
                            class="absolute inset-0 bg-white border border-zinc-200 rounded-2xl shadow-xl p-2 transition-all duration-500 ease-out transform origin-bottom-left rotate-[6deg] translate-x-[12px] z-20 flex flex-col justify-between">
                            <span
                                class="absolute top-3 right-3 px-2 py-0.5 bg-wise-green text-forest rounded-full text-[8px] font-bold tracking-wider uppercase z-20 shadow-sm animate-pulse">Hasil
                                AI</span>
                            <div
                                class="w-full h-[85%] rounded-xl overflow-hidden bg-zinc-50 border border-zinc-150 relative">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/45 via-transparent to-transparent opacity-40 z-10">
                                </div>
                                <img src="images/serum_after.png" alt="Serum Studio"
                                    class="w-full h-full object-cover relative">
                            </div>
                            <div class="text-center py-1">
                                <span class="text-[8px] font-black text-forest uppercase tracking-widest">Studio
                                    Render</span>
                            </div>
                        </div>
                    </div>
                    <!-- Product Description Below Deck -->
                    <div class="mt-8 text-center space-y-1 transition-all duration-300">
                        <h4 class="text-sm font-extrabold text-zinc-800">Organic Face Serum</h4>
                        <p class="text-[11px] text-zinc-400 max-w-[180px]">Tampil segar di atas panggung riak air jernih
                            dan daun monstera.</p>
                    </div>
                </div>

                <!-- Product 3: Potato Chips -->
                <div class="snap-center shrink-0 w-[200px] md:w-auto md:shrink carousel-deck-item group relative flex flex-col items-center select-none"
                    style="perspective: 1000px;">
                    <!-- Card Deck Wrapper -->
                    <div
                        class="deck-wrapper relative w-[200px] h-[270px] transition-all duration-300 transform-style-3d cursor-pointer">
                        <!-- Card 1: Foto Asli (Before - Left Card) -->
                        <div
                            class="absolute inset-0 bg-white border border-zinc-200 rounded-2xl shadow-md p-2 transition-all duration-500 ease-out transform origin-bottom-right rotate-[-6deg] translate-x-[-12px] z-10 flex flex-col justify-between">
                            <span
                                class="absolute top-3 left-3 px-2 py-0.5 bg-zinc-900 text-white rounded-full text-[8px] font-bold tracking-wider uppercase z-20">Foto
                                Asli</span>
                            <div class="w-full h-[85%] rounded-xl overflow-hidden bg-zinc-50 border border-zinc-150">
                                <img src="images/chips_before.png" alt="Snack Asli"
                                    class="w-full h-full object-cover grayscale opacity-85 transition-all duration-300">
                            </div>
                            <div class="text-center py-1">
                                <span class="text-[8px] font-black text-zinc-400 uppercase tracking-widest">Kemasan
                                    Snack</span>
                            </div>
                        </div>

                        <!-- Card 2: Foto Hasil (After - Right Card) -->
                        <div
                            class="absolute inset-0 bg-white border border-zinc-200 rounded-2xl shadow-xl p-2 transition-all duration-500 ease-out transform origin-bottom-left rotate-[6deg] translate-x-[12px] z-20 flex flex-col justify-between">
                            <span
                                class="absolute top-3 right-3 px-2 py-0.5 bg-wise-green text-forest rounded-full text-[8px] font-bold tracking-wider uppercase z-20 shadow-sm animate-pulse">Hasil
                                AI</span>
                            <div
                                class="w-full h-[85%] rounded-xl overflow-hidden bg-zinc-50 border border-zinc-150 relative">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/45 via-transparent to-transparent opacity-40 z-10">
                                </div>
                                <img src="images/chips_after.png" alt="Snack Studio"
                                    class="w-full h-full object-cover relative">
                            </div>
                            <div class="text-center py-1">
                                <span class="text-[8px] font-black text-forest uppercase tracking-widest">Studio
                                    Render</span>
                            </div>
                        </div>
                    </div>
                    <!-- Product Description Below Deck -->
                    <div class="mt-8 text-center space-y-1 transition-all duration-300">
                        <h4 class="text-sm font-extrabold text-zinc-800">Crispy Potato Chips</h4>
                        <p class="text-[11px] text-zinc-400 max-w-[180px]">Kemasan berdiri gagah dengan kepingan kentang
                            melayang di udara.</p>
                    </div>
                </div>

            </div>
        </section>

        <!-- Steps Section (Premium & Aesthetic redesign) -->
        <section class="space-y-5 pt-4 pb-2 relative">
            <!-- Section Header -->
            <div class="text-center space-y-2">
                <div
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-wise-green text-forest text-[11px] font-bold shadow-sm">
                    <i class="bi bi-rocket-takeoff-fill"></i> CEPAT & MUDAH
                </div>
                <h3 class="text-2xl font-extrabold text-zinc-900 tracking-tight">Cara Kerja retcehStudio</h3>
                <p class="text-xs sm:text-sm text-zinc-500 max-w-lg mx-auto">
                    Hanya butuh 3 langkah sederhana untuk menciptakan foto iklan kemasan produk bernilai komersial
                    tinggi.
                </p>
            </div>

            <!-- Steps Cards Flow -->
            <div class="relative grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto px-4 pt-4">
                <!-- Connecting Line (Desktop Only) -->
                <div
                    class="hidden md:block absolute top-[52px] left-[15%] right-[15%] h-[2px] bg-gradient-to-r from-wise-green via-zinc-200 to-wise-green -z-10">
                </div>

                <!-- Step 1 -->
                <div
                    class="bg-white border border-zinc-200 rounded-3xl p-6 text-center space-y-4 transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1 hover:border-zinc-300 relative group">
                    <div
                        class="w-12 h-12 rounded-full bg-wise-green text-forest flex items-center justify-center mx-auto text-base font-extrabold shadow-md ring-4 ring-zinc-50 group-hover:scale-110 transition-transform duration-300">
                        1
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-xs font-black uppercase tracking-wider text-zinc-700">Unggah Foto Produk</h4>
                        <p class="text-[11px] sm:text-xs text-zinc-500 leading-relaxed">
                            Siapkan foto produk mentah Anda. Pastikan produk terlihat jelas di bawah pencahayaan standar
                            tanpa terhalang.
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div
                    class="bg-white border border-zinc-200 rounded-3xl p-6 text-center space-y-4 transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1 hover:border-zinc-300 relative group">
                    <div
                        class="w-12 h-12 rounded-full bg-wise-green text-forest flex items-center justify-center mx-auto text-base font-extrabold shadow-md ring-4 ring-zinc-50 group-hover:scale-110 transition-transform duration-300">
                        2
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-xs font-black uppercase tracking-wider text-zinc-700">Tulis Catatan Opsional
                        </h4>
                        <p class="text-[11px] sm:text-xs text-zinc-500 leading-relaxed">
                            Tulis detail properti latar belakang atau nuansa studio yang diinginkan (misal: nuansa
                            pantai hangat, studio hitam).
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div
                    class="bg-white border border-zinc-200 rounded-3xl p-6 text-center space-y-4 transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1 hover:border-zinc-300 relative group">
                    <div
                        class="w-12 h-12 rounded-full bg-wise-green text-forest flex items-center justify-center mx-auto text-base font-extrabold shadow-md ring-4 ring-zinc-50 group-hover:scale-110 transition-transform duration-300">
                        3
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-xs font-black uppercase tracking-wider text-zinc-700">Gunakan 8 Gelas Kopi</h4>
                        <p class="text-[11px] sm:text-xs text-zinc-500 leading-relaxed">
                            Klik Generate. AI akan merancang latar belakang dan efek pencahayaan profesional dalam
                            hitungan detik.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Value Props / Why Choose Us Section (Wise-style Grid) -->
        <section class="space-y-5 pt-4 pb-2">
            <div class="text-center space-y-2">
                <div
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-wise-green text-forest text-[11px] font-bold shadow-sm">
                    <i class="bi bi-shield-check"></i> KEUNGGULAN UTAMA
                </div>
                <h3 class="text-2xl font-extrabold text-zinc-900 tracking-tight">Mengapa Memilih retcehStudio?</h3>
                <p class="text-xs sm:text-sm text-zinc-500 max-w-lg mx-auto">
                    Platform desain bertenaga AI yang dirancang khusus untuk meningkatkan konversi penjualan produk
                    Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto px-4">
                <div
                    class="p-6 rounded-3xl border border-zinc-200 bg-white space-y-3 text-left transition-all duration-300 hover:shadow-md">
                    <div
                        class="w-10 h-10 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-600">
                        <i class="bi bi-wallet2 text-lg"></i>
                    </div>
                    <h4 class="text-sm font-extrabold text-zinc-800">Hemat Biaya 90%</h4>
                    <p class="text-xs text-zinc-500 leading-relaxed">
                        Tidak perlu membayar jutaan rupiah untuk sewa fotografer dan studio foto fisik. Ciptakan puluhan
                        variasi iklan komersial berkualitas tinggi hanya dengan beberapa ribu rupiah.
                    </p>
                </div>
                <div
                    class="p-6 rounded-3xl border border-zinc-200 bg-white space-y-3 text-left transition-all duration-300 hover:shadow-md">
                    <div class="w-10 h-10 rounded-full bg-amber-500/10 flex items-center justify-center text-amber-600">
                        <i class="bi bi-cup-hot text-lg"></i>
                    </div>
                    <h4 class="text-sm font-extrabold text-zinc-800">Pembuatan Instan 15 Detik</h4>
                    <p class="text-xs text-zinc-500 leading-relaxed">
                        Hindari waktu tunggu berminggu-minggu untuk proses editing foto. AI kami memproses dan
                        menghasilkan latar belakang serta pencahayaan realistis dalam waktu kurang dari 15 detik.
                    </p>
                </div>
                <div
                    class="p-6 rounded-3xl border border-zinc-200 bg-white space-y-3 text-left transition-all duration-300 hover:shadow-md">
                    <div class="w-10 h-10 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-600">
                        <i class="bi bi-award text-lg"></i>
                    </div>
                    <h4 class="text-sm font-extrabold text-zinc-800">Resolusi Komersial Premium</h4>
                    <p class="text-xs text-zinc-500 leading-relaxed">
                        Foto hasil memiliki detail cahaya, bayangan objek, dan resolusi tajam yang siap digunakan untuk
                        banner e-commerce, iklan Instagram/TikTok, hingga cetakan promosi fisik.
                    </p>
                </div>
            </div>
        </section>

        <!-- Reviews / Testimonials Section (Premium redesign) -->
        <section class="space-y-5 pt-4 pb-2">
            <!-- Header Row -->
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 border-b border-zinc-150 pb-4">
                <div class="text-left space-y-2">
                    <div
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-wise-green text-forest text-[11px] font-bold shadow-sm">
                        <i class="bi bi-heart-fill text-red-500"></i> TESTIMONI
                    </div>
                    <h3 class="text-2xl font-extrabold text-zinc-900 tracking-tight">Ulasan Pelanggan</h3>
                    <p class="text-xs text-zinc-500">Apa kata pelaku bisnis dan kreator yang menggunakan retcehStudio.
                    </p>
                </div>
                <a href="review.php"
                    class="inline-flex items-center gap-1.5 py-2 px-5 bg-zinc-900 text-white hover:bg-zinc-800 rounded-full font-bold text-xs transition hover:-translate-y-0.5 active:translate-y-0 no-underline shadow-md w-fit">
                    <i class="bi bi-chat-heart-fill"></i> Beri Ulasan Anda
                </a>
            </div>

            <!-- Dynamic Horizontally Scrollable Reviews List -->
            <div class="flex overflow-x-auto gap-6 text-left pb-6 pt-2 scrollbar-none snap-x snap-mandatory -mx-4 px-4"
                id="reviews-carousel">
                <!-- Loaded dynamically by Javascript -->
            </div>
        </section>

        <!-- Bottom CTA Section -->
        <section
            class="rounded-3xl bg-wise-green p-8 sm:p-12 text-center relative overflow-hidden transition-all duration-300 shadow-lg">
            <!-- Decorative blur shapes -->
            <div class="absolute -top-12 -left-12 w-48 h-48 bg-forest/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-12 -right-12 w-48 h-48 bg-forest/10 rounded-full blur-3xl"></div>

            <div class="relative max-w-xl mx-auto space-y-6">
                <h3 class="hero-title text-3xl sm:text-4xl font-extrabold tracking-tight leading-none lowercase"
                    style="color: var(--color-forest) !important;">retcehstudio.</h3>
                <p class="text-xs sm:text-sm leading-relaxed" style="color: var(--color-forest) !important;">
                    Siap mengubah foto produk biasa Anda menjadi aset visual premium dengan cepat? Gabung sekarang dan
                    dapatkan 15 gelas kopi gratis untuk memulai.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
                    <a href="studio.php"
                        class="w-full sm:w-auto px-8 py-3 bg-forest text-wise-green hover:bg-forest-hover rounded-full font-bold text-xs transition uppercase tracking-wider shadow hover:-translate-y-0.5 active:translate-y-0">
                        Mulai Desain Sekarang
                    </a>
                    <a href="register.php"
                        class="w-full sm:w-auto px-8 py-3 border border-forest text-forest hover:bg-forest/5 rounded-full font-bold text-xs transition hover:-translate-y-0.5 active:translate-y-0 no-underline">
                        Daftar Akun Baru
                    </a>
                </div>
            </div>
        </section>
    </div>

</main>

<!-- Notification Toast (shadcn design) -->
<div id="toast"
    class="hidden fixed bottom-6 right-6 bg-white border border-zinc-200 text-zinc-900 rounded-lg p-4 shadow-xl z-50 flex items-center gap-3 min-w-[280px] max-w-sm transition-all duration-300">
    <i class="bi bi-info-circle-fill toast-icon text-zinc-500 text-lg"></i>
    <span class="toast-message text-xs font-medium leading-normal">Pesan</span>
</div>

<!-- Script file -->
<script src="app.js"></script>
</body>

</html>