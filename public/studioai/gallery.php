<?php include 'header.php'; ?>

<!-- Main View Container -->
<main class="w-full flex-grow px-4 sm:px-6 py-4 flex items-center justify-center">

    <!-- View: Saved Gallery -->
    <div id="view-gallery" class="view-section w-full max-w-4xl mx-auto space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-zinc-200/60 pb-4 transition-colors">
            <div class="space-y-1">
                <h2 class="text-xl font-bold tracking-tight text-forest lowercase font-black">galeri.</h2>
                <p class="text-xs text-zinc-500">Lihat, kelola, dan unduh seluruh hasil desain iklan produk yang telah Anda simpan.</p>
            </div>
            <button type="button" id="btn-clear-gallery" class="text-xs py-1.5 px-4 text-red-500 hover:text-red-600 hover:bg-red-50/50 rounded-full border border-red-200 transition cursor-pointer font-bold uppercase tracking-wider w-fit">
                <i class="bi bi-trash3"></i> Hapus Semua
            </button>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 pt-2" id="gallery-grid">
            <!-- Populated via Javascript -->
        </div>

        <!-- Gallery Empty Placeholder -->
        <div class="rounded-3xl border border-zinc-200 bg-white p-12 text-center space-y-5 max-w-md mx-auto shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5" id="gallery-empty-state">
            <div class="w-14 h-14 rounded-full bg-zinc-50 border border-zinc-200 flex items-center justify-center text-zinc-400 mx-auto shadow-inner">
                <i class="bi bi-folder-x text-2xl"></i>
            </div>
            <div class="space-y-1.5">
                <h3 class="text-sm font-bold text-forest uppercase tracking-wider">Belum ada desain tersimpan</h3>
                <p class="text-xs text-zinc-450 leading-relaxed">
                    Desain iklan produk komersial yang Anda hasilkan di studio dan Anda simpan akan muncul di halaman galeri ini secara otomatis.
                </p>
            </div>
            <div class="pt-2">
                <a href="studio.php" class="inline-flex py-2.5 px-6 bg-wise-green text-forest hover:bg-wise-green-hover rounded-full font-bold text-xs transition no-underline uppercase tracking-wider shadow">
                    Buat Desain Pertama
                </a>
            </div>
        </div>
    </div>

</main>

<!-- Notification Toast (shadcn design) -->
<div id="toast" class="hidden fixed bottom-6 right-6 bg-white border border-zinc-200 text-zinc-900 rounded-lg p-4 shadow-xl z-50 flex items-center gap-3 min-w-[280px] max-w-sm transition-all duration-300">
    <i class="bi bi-info-circle-fill toast-icon text-zinc-500 text-lg"></i>
    <span class="toast-message text-xs font-medium leading-normal">Pesan</span>
</div>

<!-- Script file -->
<script src="app.js"></script>
</body>
</html>
