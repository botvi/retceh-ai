<?php include 'header.php'; ?>

<!-- Main View Container -->
<main class="w-full flex-grow px-4 sm:px-6 py-4 flex items-center justify-center">

    <!-- View: Studio Generator Workspace -->
    <div id="view-studio" class="view-section w-full max-w-5xl mx-auto space-y-6">
        <!-- Header inside workspace -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-zinc-200/60 pb-5">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-wise-green/10 text-forest text-[11px] font-bold shadow-sm border border-wise-green/20">
                    <i class="bi bi-fire"></i> RETCEHSTUDIO
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-forest mt-1.5 lowercase">
                    studio.
                </h1>
                <p class="text-xs text-zinc-500 font-normal">
                    Ubah foto produk biasa Anda menjadi materi promosi premium kelas studio secara instan.
                </p>
            </div>
            <!-- Interactive live status badge -->
            <div class="flex items-center gap-2 px-4 py-2 bg-white border border-zinc-200/80 rounded-2xl shadow-sm text-xs font-bold text-zinc-700 w-fit">
                <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span> Status Server: Aktif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-stretch pt-2">
            <!-- Left Panel: Controls (Col span 7) -->
            <section class="md:col-span-7 flex flex-col gap-6">
                <!-- Product Upload Card -->
                <div class="rounded-3xl border border-zinc-200 bg-white p-5 flex flex-col gap-4 shadow-sm hover:shadow-md transition-all duration-300" id="product-upload-card">
                    <div class="flex items-center justify-between border-b border-zinc-100 pb-3">
                        <h3 class="text-[11px] font-bold uppercase tracking-wider text-forest block flex items-center gap-1.5">
                            <i class="bi bi-image text-zinc-400"></i> Foto Produk Utama
                        </h3>
                        <span class="px-2 py-0.5 rounded bg-zinc-100 text-zinc-500 text-[9px] font-bold tracking-wider uppercase">PNG/JPG</span>
                    </div>
                    
                    <div class="border-2 border-dashed border-zinc-200 hover:border-wise-green/80 bg-zinc-50 hover:bg-zinc-50/50 rounded-2xl p-6 flex flex-col items-center justify-center text-center cursor-pointer transition duration-300 relative overflow-hidden min-h-[160px] group" id="product-dropzone">
                        <input type="file" id="product-file" accept="image/jpeg,image/png,image/webp" class="hidden">
                        <div class="dropzone-content flex flex-col items-center gap-2">
                            <div class="w-10 h-10 rounded-full bg-white border border-zinc-200 flex items-center justify-center text-zinc-400 group-hover:text-forest group-hover:scale-110 transition duration-300 shadow-sm">
                                <i class="bi bi-cloud-upload-fill text-lg"></i>
                            </div>
                            <span class="text-xs font-bold text-zinc-800">Unggah berkas foto produk</span>
                            <span class="text-[10px] text-zinc-400">Tarik & lepas gambar di sini (Maks. 5MB)</span>
                        </div>
                        <div class="preview-container hidden absolute inset-0 w-full h-full bg-zinc-50 flex items-center justify-center p-2">
                            <img src="" alt="Product Preview" class="img-preview w-full h-full object-contain rounded-xl">
                            <button type="button" class="remove-btn absolute top-3 right-3 w-7 h-7 bg-white border border-zinc-200 hover:bg-red-50 hover:text-red-500 hover:border-red-200 rounded-full flex items-center justify-center text-zinc-900 transition shadow-sm" title="Hapus Gambar"><i class="bi bi-trash3-fill text-xs"></i></button>
                        </div>
                    </div>

                    <div class="progress-bar-container hidden flex items-center gap-3 w-full mt-1">
                        <div class="flex-grow h-1.5 bg-zinc-100 rounded-full overflow-hidden relative">
                            <div class="progress-bar absolute left-0 top-0 h-full bg-wise-green rounded-full transition-all duration-300" style="width: 0%;"></div>
                        </div>
                        <span class="progress-label text-[10px] font-bold text-forest min-w-[28px] text-right">0%</span>
                    </div>
                </div>

                <!-- Parameters Card -->
                <div class="rounded-3xl border border-zinc-200 bg-white p-5 space-y-5 shadow-sm hover:shadow-md transition-all duration-300">
                    <!-- Product Category (Optional Form) -->
                    <div class="space-y-1.5">
                        <label for="optional-note" class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5">
                            <i class="bi bi-tag text-xs text-zinc-400"></i> Kategori / Jenis Produk (Opsional)
                            <i class="bi bi-info-circle text-[9px] text-zinc-500 cursor-help" title="Kategori produk membantu AI meletakkan bayangan dan pencahayaan yang sesuai."></i>
                        </label>
                        <input type="text" id="optional-note" placeholder="Contoh: kopi, teh, kosmetik, sabun, snack, dll." class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-wise-green/50 focus:border-wise-green text-zinc-950 font-medium placeholder-zinc-400 transition-all">
                    </div>

                    <!-- Edit Instruction (Shown only in Edit Mode) -->
                    <div id="edit-instruction-container" class="hidden space-y-1.5">
                        <label for="edit-instruction" class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5">
                            <i class="bi bi-pencil-square text-xs text-zinc-400"></i> Instruksi Edit / Perubahan
                        </label>
                        <textarea id="edit-instruction" rows="2" placeholder="Contoh: Ubah latar belakang menjadi malam hari, tambahkan embun, dll." class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-wise-green/50 focus:border-wise-green text-zinc-950 font-medium placeholder-zinc-400 transition-all"></textarea>
                    </div>



                    <!-- Energetic Generate Button -->
                    <div class="pt-2">
                        <button type="button" id="generate-btn" class="w-full py-3 px-6 rounded-full font-extrabold text-xs uppercase tracking-wider text-white bg-zinc-900 hover:bg-zinc-800 active:scale-[0.98] transition-all duration-200 disabled:opacity-40 disabled:pointer-events-none flex items-center justify-center gap-2 cursor-pointer shadow-md" disabled>
                            <i class="bi bi-fire"></i> Generate Desain (8 Ignis Token)
                        </button>
                    </div>
                </div>
            </section>

            <!-- Right Panel: Viewport Output (Col span 5) -->
            <section class="md:col-span-5 flex">
                <div class="rounded-3xl border border-zinc-200 bg-white p-5 w-full flex flex-col justify-center items-center relative min-h-[420px] shadow-sm hover:shadow-md transition-all duration-300" id="viewport-card">
                    
                    <!-- Placeholder state -->
                    <div class="text-center max-w-xs flex flex-col items-center gap-4" id="viewport-placeholder">
                        <div class="w-12 h-12 rounded-full bg-zinc-50 border border-zinc-200 flex items-center justify-center text-zinc-400 shadow-inner">
                            <i class="bi bi-image text-lg"></i>
                        </div>
                        <div class="space-y-1.5">
                            <h3 class="text-xs font-bold text-forest uppercase tracking-wider">Area Hasil AI</h3>
                            <p class="text-[11px] text-zinc-450 leading-relaxed">
                                Unggah foto produk Anda, tulis kategori opsional, lalu klik tombol **Generate** untuk meluncurkan AI.
                            </p>
                        </div>
                    </div>

                    <!-- Loading Progress State -->
                    <div class="hidden flex flex-col items-center justify-center gap-6 w-full max-w-xs" id="viewport-loading">
                        <div class="relative w-24 h-24 flex items-center justify-center">
                            <div class="w-20 h-20 border-4 border-zinc-100 border-t-wise-green rounded-full animate-spin"></div>
                            <span class="absolute text-sm font-extrabold text-forest spinner-text">0%</span>
                        </div>
                        
                        <div class="text-center space-y-1.5 w-full">
                            <h3 id="status-heading" class="text-xs font-bold text-forest uppercase tracking-wider">Mengirimkan Tugas...</h3>
                            <p id="status-desc" class="text-[10px] text-zinc-450 leading-relaxed w-full break-words"></p>
                        </div>

                        <div class="w-full h-1.5 bg-zinc-100 rounded-full overflow-hidden">
                            <div class="h-full bg-wise-green rounded-full transition-all duration-300" id="status-bar" style="width: 0%;"></div>
                        </div>
                    </div>

                    <!-- Final Visual Result Viewport -->
                    <div class="hidden w-full h-full flex flex-col gap-4" id="viewport-result">
                        <div class="relative w-full rounded-2xl overflow-hidden bg-white border border-zinc-200 flex items-center justify-center max-h-[380px] transition-all duration-300">
                            <img src="" alt="Generated Product Photo" id="result-img" class="max-w-full max-h-[380px] object-contain rounded-2xl">
                        </div>
                        
                        <!-- Action buttons always visible below the image -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 w-full">
                            <a href="" target="_blank" id="btn-download" class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-zinc-900 hover:bg-zinc-800 text-white rounded-full text-[11px] font-bold transition shadow-sm no-underline uppercase tracking-wider text-center" download="product-design.jpg">
                                <i class="bi bi-download"></i> Unduh
                            </a>
                            <button type="button" id="btn-save-to-gallery" class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-wise-green hover:bg-wise-green-hover text-forest rounded-full text-[11px] font-bold transition shadow-sm uppercase tracking-wider">
                                <i class="bi bi-bookmark-fill"></i> Simpan
                            </button>
                            <button type="button" id="btn-edit" class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-white border border-zinc-200 hover:bg-zinc-50 text-zinc-700 rounded-full text-[11px] font-bold transition shadow-sm uppercase tracking-wider">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                    </div>

                </div>
            </section>
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
