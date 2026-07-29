@extends('layouts.studio')

@section('title', 'Studio | retcehstudio')

@section('content')
    <main class="w-full flex-grow px-4 sm:px-6 py-6 flex items-center justify-center">

        <!-- View: Studio Generator Workspace -->
        <div id="view-studio" class="view-section w-full max-w-5xl mx-auto space-y-6">

            <!-- Header inside workspace -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-zinc-200/80 pb-5">
                <div class="space-y-1">
                    <div
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-wise-green/10 text-forest text-[11px] font-extrabold shadow-xs border border-wise-green/30 tracking-wider uppercase">
                        <i class="bi bi-sparkles text-amber-500 animate-pulse"></i> Studio AI Generator
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-forest mt-1 lowercase">
                        studio.
                    </h1>
                    <p class="text-xs sm:text-sm text-zinc-500 font-medium max-w-xl leading-relaxed">
                        Ubah foto produk biasa Anda menjadi materi promosi premium kelas studio secara instan.
                    </p>
                </div>

                <!-- Interactive live status badge & Guest Notice -->
                <div class="flex flex-wrap items-center gap-2">
                    @guest
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-wise-green/20 hover:bg-wise-green/30 border border-wise-green/40 rounded-full text-xs font-bold text-forest transition shadow-xs no-underline">
                            <i class="bi bi-box-arrow-in-right"></i> Masuk untuk Simpan
                        </a>
                    @endguest
                    <div
                        class="flex items-center gap-2 px-3.5 py-1.5 bg-white border border-zinc-200 rounded-full shadow-xs text-xs font-bold text-zinc-700">
                        <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-ping"></span> Status Server: Aktif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-stretch pt-1">
                <!-- Left Panel: Controls (Col span 7) -->
                <section class="md:col-span-7 flex flex-col gap-5">

                    <!-- Product Upload Card -->
                    <div class="rounded-3xl border border-zinc-200/80 bg-white p-5 flex flex-col gap-4 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden"
                        id="product-upload-card">
                        <div class="flex items-center justify-between border-b border-zinc-100 pb-3">
                            <h3
                                class="text-xs font-black uppercase tracking-wider text-forest block flex items-center gap-2">
                                <i class="bi bi-image-fill text-wise-green"></i> Foto Produk Utama
                            </h3>
                            <span
                                class="px-2.5 py-0.5 rounded-full bg-zinc-100 text-zinc-500 text-[10px] font-bold tracking-wider uppercase">PNG
                                / JPG / WEBP</span>
                        </div>

                        <div class="border-2 border-dashed border-zinc-200 hover:border-wise-green/90 bg-zinc-50/60 hover:bg-zinc-50 rounded-2xl p-6 flex flex-col items-center justify-center text-center cursor-pointer transition-all duration-300 relative overflow-hidden min-h-[180px] group"
                            id="product-dropzone">
                            <input type="file" id="product-file" accept="image/jpeg,image/png,image/webp" class="hidden">

                            <div class="dropzone-content flex flex-col items-center gap-2.5">
                                <div
                                    class="w-12 h-12 rounded-full bg-white border border-zinc-200 flex items-center justify-center text-forest group-hover:bg-wise-green group-hover:text-forest group-hover:scale-110 transition duration-300 shadow-sm">
                                    <i class="bi bi-cloud-arrow-up-fill text-xl"></i>
                                </div>
                                <div class="space-y-0.5">
                                    <span class="text-xs font-bold text-zinc-800 block">Unggah berkas foto produk
                                        Anda</span>
                                    <span class="text-[10px] text-zinc-400 font-medium">Tarik & lepas gambar di sini
                                        (Maksimal 5MB)</span>
                                </div>
                            </div>

                            <div
                                class="preview-container hidden absolute inset-0 w-full h-full bg-white flex items-center justify-center p-3">
                                <img src="" alt="Product Preview"
                                    class="img-preview w-full h-full object-contain rounded-xl">
                                <button type="button"
                                    class="remove-btn absolute top-3 right-3 w-8 h-8 bg-white/90 backdrop-blur border border-zinc-200 hover:bg-red-50 hover:text-red-500 hover:border-red-200 rounded-full flex items-center justify-center text-zinc-700 transition shadow-md"
                                    title="Hapus Gambar">
                                    <i class="bi bi-trash3-fill text-xs"></i>
                                </button>
                            </div>
                        </div>

                        <div class="progress-bar-container hidden flex items-center gap-3 w-full mt-1"
                            id="upload-progress-container">
                            <div class="flex-grow h-2 bg-zinc-100 rounded-full overflow-hidden relative">
                                <div class="progress-bar absolute left-0 top-0 h-full bg-wise-green rounded-full transition-all duration-300"
                                    id="upload-progress-bar" style="width: 0%;"></div>
                            </div>
                            <span class="progress-label text-[10px] font-extrabold text-forest min-w-[32px] text-right"
                                id="upload-progress-label">0%</span>
                        </div>
                    </div>

                    <!-- Parameters Card -->
                    <div
                        class="rounded-3xl border border-zinc-200/80 bg-white p-5 space-y-4 shadow-sm hover:shadow-md transition-all duration-300">
                        <!-- Product Category Input (AI Suggestion) -->
                        <div class="space-y-2" id="category-section">
                            <label for="optional-note"
                                class="text-xs font-black text-forest uppercase tracking-wider flex items-center justify-between">
                                <span class="flex items-center gap-1.5">
                                    <i class="bi bi-tag-fill text-wise-green"></i> Product Category
                                    <span class="text-[9px] text-zinc-400 font-semibold normal-case ml-1">(Kategori / Jenis
                                        Produk)</span>
                                </span>
                                <span class="flex items-center gap-1 text-[10px] text-zinc-400 font-semibold lowercase">
                                    <i class="bi bi-stars text-amber-400 text-[9px]"></i> AI suggestion
                                </span>
                            </label>

                            <!-- Input Field -->
                            <div class="relative">
                                <input type="text" id="optional-note"
                                    placeholder="e.g. Black Coffee, Serum Bottle, Watch, Snack…"
                                    class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 pr-9 text-xs focus:outline-none focus:ring-2 focus:ring-wise-green/60 focus:border-wise-green text-zinc-950 font-medium placeholder-zinc-400 transition-all">
                                <button type="button" id="clear-category-btn"
                                    class="hidden absolute right-2.5 top-1/2 -translate-y-1/2 w-5 h-5 flex items-center justify-center text-zinc-400 hover:text-zinc-700 transition"
                                    title="Hapus">
                                    <i class="bi bi-x-circle-fill text-xs"></i>
                                </button>
                            </div>

                            <!-- AI Suggestion Chips -->
                            <div id="ai-suggestion-area" class="hidden">
                                <!-- Loading shimmer -->
                                <div id="suggestion-loading" class="hidden items-center gap-2 py-1">
                                    <span
                                        class="w-3.5 h-3.5 border-2 border-zinc-300 border-t-wise-green rounded-full animate-spin"></span>
                                    <span class="text-[10px] text-zinc-400 font-semibold">AI reading your image…</span>
                                </div>
                                <!-- Chips container -->
                                <div id="suggestion-chips" class="flex flex-wrap gap-1.5 pt-0.5"></div>
                            </div>
                        </div>

                        <!-- Edit Instruction (Shown only in Edit Mode) -->
                        <div id="edit-instruction-container" class="hidden space-y-1.5">
                            <label for="edit-instruction"
                                class="text-xs font-black text-forest uppercase tracking-wider block flex items-center gap-1.5">
                                <i class="bi bi-pencil-square text-amber-500"></i> Instruksi Edit / Perubahan Desain
                            </label>
                            <textarea id="edit-instruction" rows="2"
                                placeholder="Contoh: Ubah latar belakang menjadi suasana cafe malam hari dengan pencahayaan hangat."
                                class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-wise-green/60 focus:border-wise-green text-zinc-950 font-medium placeholder-zinc-400 transition-all"></textarea>
                        </div>

                        <!-- Energetic Generate Button -->
                        <div class="pt-2">
                            <button type="button" id="generate-btn"
                                class="w-full py-3.5 px-6 rounded-full font-black text-xs uppercase tracking-wider text-forest bg-wise-green hover:bg-wise-green-hover active:scale-[0.98] transition-all duration-200 disabled:opacity-40 disabled:pointer-events-none flex items-center justify-center gap-2 cursor-pointer shadow-md"
                                disabled>
                                <i class="bi bi-fire"></i> Generate Desain (8 Neurium)
                            </button>

                            @guest
                                <p class="text-[10px] text-zinc-400 text-center mt-2 font-medium">
                                    <i class="bi bi-info-circle"></i> Anda dapat mengunggah foto untuk preview. Login diperlukan
                                    saat memproses gambar.
                                </p>
                            @endguest
                        </div>
                    </div>
                </section>

                <!-- Right Panel: Viewport Output (Col span 5) -->
                <section class="md:col-span-5 flex">
                    <div class="rounded-3xl border border-zinc-200/80 bg-white p-5 w-full flex flex-col justify-center items-center relative min-h-[420px] shadow-sm hover:shadow-md transition-all duration-300"
                        id="viewport-card">

                        <!-- Placeholder state -->
                        <div class="text-center max-w-xs flex flex-col items-center gap-4" id="viewport-placeholder">
                            <div
                                class="w-14 h-14 rounded-full bg-zinc-50 border border-zinc-200/80 flex items-center justify-center text-zinc-400 shadow-inner">
                                <i class="bi bi-card-image text-2xl"></i>
                            </div>
                            <div class="space-y-1.5">
                                <h3 class="text-xs font-black text-forest uppercase tracking-wider">Area Hasil AI Studio
                                </h3>
                                <p class="text-[11px] text-zinc-450 leading-relaxed font-medium">
                                    Unggah foto produk Anda, tulis kategori opsional, lalu klik **Generate Desain** untuk
                                    meluncurkan AI.
                                </p>
                            </div>
                        </div>

                        <!-- Loading Progress State with stunning blue effects -->
                        <div class="hidden flex flex-col items-center justify-center gap-6 w-full max-w-xs"
                            id="viewport-loading">
                            <!-- Epic Blue Spinner with glow rings -->
                            <div class="relative w-28 h-28 flex items-center justify-center">
                                <!-- Outer glow ring -->
                                <div class="absolute w-28 h-28 rounded-full bg-blue-500/20 animate-ping-slow"></div>
                                <!-- Middle ring -->
                                <div class="absolute w-24 h-24 border-[3px] border-blue-200/30 rounded-full"></div>
                                <!-- Main spinning ring -->
                                <div class="absolute w-24 h-24 border-[4px] border-blue-100/20 border-t-blue-600 border-r-blue-500 rounded-full animate-spin"></div>
                                <!-- Inner spinning ring (reverse) -->
                                <div class="absolute w-16 h-16 border-[3px] border-transparent border-b-blue-400 border-l-blue-500 rounded-full animate-spin-slower"></div>
                                <!-- Center icon + percentage -->
                                <div class="absolute flex flex-col items-center justify-center">
                                    <i class="bi bi-cloud-arrow-up-fill text-blue-600 text-lg mb-0.5 animate-bounce-gentle"></i>
                                    <span class="text-base font-black text-blue-700 spinner-text">0%</span>
                                </div>
                            </div>

                            <div class="text-center space-y-1.5 w-full">
                                <h3 id="status-heading"
                                    class="text-xs font-black text-blue-800 uppercase tracking-wider">
                                    Mengirimkan Tugas...</h3>
                                <p id="status-desc"
                                    class="text-[10px] text-blue-500/70 leading-relaxed w-full break-words font-medium"></p>
                            </div>

                            <!-- Glowing progress bar -->
                            <div class="w-full h-2.5 bg-blue-100/60 rounded-full overflow-hidden shadow-inner relative">
                                <div class="h-full bg-gradient-to-r from-blue-500 via-blue-600 to-blue-500 rounded-full transition-all duration-300 relative shadow-lg shadow-blue-500/40"
                                    id="status-bar" style="width: 0%;"></div>
                                <!-- Shimmer overlay -->
                                <div class="absolute inset-0 w-full h-full overflow-hidden rounded-full pointer-events-none">
                                    <div class="absolute -top-1 -bottom-1 w-12 bg-white/30 rotate-12 -translate-x-full animate-shimmer"></div>
                                </div>
                            </div>

                            <!-- Particle dots -->
                            <div class="flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse delay-0"></span>
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse delay-150"></span>
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse delay-300"></span>
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse delay-500"></span>
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse delay-700"></span>
                            </div>
                        </div>

                        <!-- Final Visual Result Viewport -->
                        <div class="hidden w-full h-full flex flex-col gap-4" id="viewport-result">
                            <div
                                class="relative w-full rounded-2xl overflow-hidden bg-white border border-zinc-200 flex items-center justify-center max-h-[380px] transition-all duration-300">
                                <img src="" alt="Generated Product Photo" id="result-img"
                                    class="max-w-full max-h-[380px] object-contain rounded-2xl">
                            </div>

                            <!-- Action buttons -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 w-full">
                                <a href="" target="_blank" id="btn-download"
                                    class="inline-flex items-center justify-center gap-1.5 px-3 py-2.5 bg-forest hover:bg-forest-hover text-wise-green rounded-full text-[11px] font-black transition shadow-xs no-underline uppercase tracking-wider text-center"
                                    download="product-design.jpg">
                                    <i class="bi bi-download"></i> Unduh
                                </a>
                                <button type="button" id="btn-save-to-gallery"
                                    class="inline-flex items-center justify-center gap-1.5 px-3 py-2.5 bg-wise-green hover:bg-wise-green-hover text-forest rounded-full text-[11px] font-black transition shadow-xs uppercase tracking-wider">
                                    <i class="bi bi-bookmark-fill"></i> Simpan
                                </button>
                                <button type="button" id="btn-edit"
                                    class="inline-flex items-center justify-center gap-1.5 px-3 py-2.5 bg-white border border-zinc-200 hover:bg-zinc-50 text-zinc-700 rounded-full text-[11px] font-bold transition shadow-xs uppercase tracking-wider">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>

    </main>
@endsection

@section('scripts')
    <style>
        /* AI Suggestion Chips */
        .suggestion-chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 99px;
            font-size: 10px;
            font-weight: 700;
            border: 1.5px solid #d4f1bc;
            background: #f0fbe8;
            color: #2d6a2d;
            cursor: pointer;
            transition: all 0.18s ease;
            white-space: nowrap;
            animation: chipFadeIn 0.3s ease both;
        }

        .suggestion-chip:hover {
            background: #b8f0a0;
            border-color: #7ed957;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(100, 200, 80, 0.2);
        }

        .suggestion-chip.active {
            background: #2d6a2d;
            color: #b8f0a0;
            border-color: #2d6a2d;
        }

        @keyframes chipFadeIn {
            from {
                opacity: 0;
                transform: translateY(6px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .suggestion-chip:nth-child(1) {
            animation-delay: 0.00s;
        }

        .suggestion-chip:nth-child(2) {
            animation-delay: 0.05s;
        }

        .suggestion-chip:nth-child(3) {
            animation-delay: 0.10s;
        }

        .suggestion-chip:nth-child(4) {
            animation-delay: 0.15s;
        }

        .suggestion-chip:nth-child(5) {
            animation-delay: 0.20s;
        }

        .suggestion-chip:nth-child(6) {
            animation-delay: 0.25s;
        }

        .suggestion-chip:nth-child(7) {
            animation-delay: 0.30s;
        }

        .suggestion-chip:nth-child(8) {
            animation-delay: 0.35s;
        }

        /* ===== Blue Loading Effects ===== */

        /* Slow ping for outer glow ring */
        @keyframes ping-slow {
            0% {
                transform: scale(0.95);
                opacity: 0.6;
            }
            50% {
                transform: scale(1.15);
                opacity: 0.2;
            }
            100% {
                transform: scale(0.95);
                opacity: 0.6;
            }
        }
        .animate-ping-slow {
            animation: ping-slow 2.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Slower reverse spin for the inner ring */
        @keyframes spin-slower {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(-360deg);
            }
        }
        .animate-spin-slower {
            animation: spin-slower 3s linear infinite;
        }

        /* Gentle bounce on the upload icon */
        @keyframes bounce-gentle {
            0%,
            100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-4px);
            }
        }
        .animate-bounce-gentle {
            animation: bounce-gentle 1.2s ease-in-out infinite;
        }

        /* Shimmer sweep across progress bar */
        @keyframes shimmer {
            0% {
                transform: translateX(-100%) rotate(12deg);
            }
            100% {
                transform: translateX(400%) rotate(12deg);
            }
        }
        .animate-shimmer {
            animation: shimmer 2s ease-in-out infinite;
        }

        /* Particle dot delay variants */
        .delay-0 {
            animation-delay: 0s;
        }
        .delay-150 {
            animation-delay: 0.15s;
        }
        .delay-300 {
            animation-delay: 0.3s;
        }
        .delay-500 {
            animation-delay: 0.5s;
        }
        .delay-700 {
            animation-delay: 0.7s;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Auth state
            const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
            let credits = {{ Auth::check() ? Auth::user()->credits ?? 0 : 0 }};

            // UI Elements
            const productDropzone = document.getElementById('product-dropzone');
            const productFileInput = document.getElementById('product-file');
            const productCard = document.getElementById('product-upload-card');
            const optionalNoteInput = document.getElementById('optional-note');
            const generateBtn = document.getElementById('generate-btn');
            const clearCategoryBtn = document.getElementById('clear-category-btn');
            const aiSuggestionArea = document.getElementById('ai-suggestion-area');
            const suggestionLoading = document.getElementById('suggestion-loading');
            const suggestionChips = document.getElementById('suggestion-chips');

            // State variables
            let productUrl = null;
            let isUploadingProduct = false;
            let isFetchingSuggestions = false;
            let pollIntervalId = null;
            let progressIntervalId = null;
            let isEditMode = false;
            let lastGeneratedUrl = null;

            function validateForm() {
                if (productUrl && !isUploadingProduct && !isFetchingSuggestions) {
                    generateBtn.disabled = false;
                } else {
                    generateBtn.disabled = true;
                }
            }

            // ------- AI Category Suggestion -------
            async function fetchAISuggestions(imageUrl) {
                isFetchingSuggestions = true;
                validateForm();

                aiSuggestionArea.classList.remove('hidden');
                suggestionLoading.style.display = 'flex';
                suggestionChips.innerHTML = '';

                try {
                    const response = await fetch('{{ route('studio.suggest') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            image_url: imageUrl
                        })
                    });

                    if (!response.ok) throw new Error('Server error: ' + response.status);

                    const data = await response.json();

                    if (data && data.success && Array.isArray(data.suggestions)) {
                        renderChips(data.suggestions);
                    } else {
                        throw new Error(data.error || 'No suggestions returned');
                    }

                } catch (err) {
                    console.error('AI suggestion error:', err);
                    suggestionChips.innerHTML =
                        `<span class="text-[10px] text-zinc-400 italic">Suggestion tidak tersedia saat ini.</span>`;
                } finally {
                    isFetchingSuggestions = false;
                    suggestionLoading.style.display = 'none';
                    validateForm();
                }
            }

            function renderChips(suggestions) {
                suggestionChips.innerHTML = '';
                if (!Array.isArray(suggestions) || suggestions.length === 0) return;

                suggestions.forEach(label => {
                    const chip = document.createElement('button');
                    chip.type = 'button';
                    chip.className = 'suggestion-chip';
                    chip.innerHTML = `<i class="bi bi-tag text-[9px]"></i>${label}`;
                    chip.addEventListener('click', () => {
                        // Toggle: if already active & value matches, clear
                        if (optionalNoteInput.value === label && chip.classList.contains(
                                'active')) {
                            optionalNoteInput.value = '';
                            chip.classList.remove('active');
                            clearCategoryBtn.classList.add('hidden');
                        } else {
                            optionalNoteInput.value = label;
                            // Mark only this chip as active
                            suggestionChips.querySelectorAll('.suggestion-chip').forEach(c => c
                                .classList.remove('active'));
                            chip.classList.add('active');
                            clearCategoryBtn.classList.remove('hidden');
                        }
                    });
                    suggestionChips.appendChild(chip);
                });
            }

            // Clear category button
            clearCategoryBtn.addEventListener('click', () => {
                optionalNoteInput.value = '';
                clearCategoryBtn.classList.add('hidden');
                suggestionChips.querySelectorAll('.suggestion-chip').forEach(c => c.classList.remove(
                    'active'));
                optionalNoteInput.focus();
            });

            // Show/hide clear button on typing
            optionalNoteInput.addEventListener('input', () => {
                if (optionalNoteInput.value.trim()) {
                    clearCategoryBtn.classList.remove('hidden');
                    // Deactivate chips if user typed manually
                    suggestionChips.querySelectorAll('.suggestion-chip.active').forEach(c => c.classList
                        .remove('active'));
                } else {
                    clearCategoryBtn.classList.add('hidden');
                }
            });

            const uploadProgressContainer = document.getElementById('upload-progress-container');
            const uploadProgressBar = document.getElementById('upload-progress-bar');
            const uploadProgressLabel = document.getElementById('upload-progress-label');

            const viewportPlaceholder = document.getElementById('viewport-placeholder');
            const viewportLoading = document.getElementById('viewport-loading');
            const viewportResult = document.getElementById('viewport-result');
            const statusBar = document.getElementById('status-bar');
            const statusHeading = document.getElementById('status-heading');
            const statusDesc = document.getElementById('status-desc');
            const spinnerPercent = document.querySelector('.spinner-text');
            const resultImg = document.getElementById('result-img');
            const btnDownload = document.getElementById('btn-download');
            const btnSaveToGallery = document.getElementById('btn-save-to-gallery');
            const btnEdit = document.getElementById('btn-edit');

            function uploadFile(file, card, dropzone, onSuccess, onError) {
                isUploadingProduct = true;
                validateForm();

                uploadProgressContainer.classList.remove('hidden');
                uploadProgressBar.style.width = '0%';
                uploadProgressLabel.innerText = '0%';

                const formData = new FormData();
                formData.append('file', file);

                const xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('studio.upload') }}');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                xhr.upload.onprogress = (e) => {
                    if (e.lengthComputable) {
                        const percent = Math.round((e.loaded / e.total) * 100);
                        uploadProgressBar.style.width = `${percent}%`;
                        uploadProgressLabel.innerText = `${percent}%`;
                    }
                };

                xhr.onload = () => {
                    isUploadingProduct = false;
                    validateForm();
                    uploadProgressContainer.classList.add('hidden');

                    if (xhr.status === 200) {
                        try {
                            const res = JSON.parse(xhr.responseText);
                            if (res && res.success && res.file_url) {
                                const reader = new FileReader();
                                reader.onload = (event) => {
                                    dropzone.querySelector('.preview-container img').src = event.target
                                        .result;
                                    dropzone.querySelector('.preview-container').classList.remove('hidden');
                                    dropzone.querySelector('.dropzone-content').classList.add('hidden');
                                };
                                reader.readAsDataURL(file);

                                onSuccess(res.file_url);
                                showToast('Foto Produk berhasil diunggah', 'success');
                            } else {
                                throw new Error(res.error || 'Unggah gagal');
                            }
                        } catch (err) {
                            onError(err.message);
                        }
                    } else {
                        onError('Gagal mengunggah gambar ke server');
                    }
                };

                xhr.onerror = () => {
                    isUploadingProduct = false;
                    validateForm();
                    uploadProgressContainer.classList.add('hidden');
                    onError('Koneksi jaringan bermasalah saat mengunggah');
                };

                xhr.send(formData);
            }

            // Setup dropzone click and drag & drop
            productDropzone.addEventListener('click', (e) => {
                if (e.target.closest('.remove-btn')) return;
                productFileInput.click();
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                productDropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    productDropzone.classList.add('border-wise-green', 'bg-wise-green/10');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                productDropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    productDropzone.classList.remove('border-wise-green', 'bg-wise-green/10');
                }, false);
            });

            productDropzone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files && files.length > 0) {
                    const file = files[0];
                    uploadFile(file, productCard, productDropzone,
                        (url) => {
                            productUrl = url;
                            validateForm();
                            // Trigger AI suggestion after successful upload
                            fetchAISuggestions(url);
                        },
                        (errorMsg) => {
                            showToast(errorMsg, 'error');
                            resetDropzone();
                        }
                    );
                }
            });

            productFileInput.addEventListener('change', () => {
                if (productFileInput.files.length > 0) {
                    const file = productFileInput.files[0];
                    uploadFile(file, productCard, productDropzone,
                        (url) => {
                            productUrl = url;
                            validateForm();
                            // Trigger AI suggestion after successful upload
                            fetchAISuggestions(url);
                        },
                        (errorMsg) => {
                            showToast(errorMsg, 'error');
                            resetDropzone();
                        }
                    );
                }
            });

            const removeBtn = productDropzone.querySelector('.remove-btn');
            if (removeBtn) {
                removeBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    resetDropzone();
                });
            }

            function resetDropzone() {
                productFileInput.value = '';
                productUrl = null;
                isFetchingSuggestions = false;
                productDropzone.querySelector('.preview-container').classList.add('hidden');
                productDropzone.querySelector('.dropzone-content').classList.remove('hidden');
                validateForm();
                exitEditMode();
                // Reset category suggestions
                optionalNoteInput.value = '';
                clearCategoryBtn.classList.add('hidden');
                aiSuggestionArea.classList.add('hidden');
                suggestionChips.innerHTML = '';
            }

            function exitEditMode() {
                isEditMode = false;
                const editContainer = document.getElementById('edit-instruction-container');
                if (editContainer) {
                    editContainer.classList.add('hidden');
                    document.getElementById('edit-instruction').value = '';
                }
                generateBtn.innerHTML = '<i class="bi bi-fire"></i> Generate Desain (8 Neurium)';
            }

            // Handle Generation Click
            generateBtn.addEventListener('click', () => {
                if (!productUrl) return;

                // Check Guest User Auth
                if (!isLoggedIn) {
                    window.showCustomConfirm({
                        title: 'Login Diperlukan',
                        text: 'Silakan masuk ke akun Anda terlebih dahulu untuk menghasilkan foto produk berkelas studio.',
                        icon: 'info',
                        confirmText: 'Masuk / Daftar',
                        cancelText: 'Batal',
                        onConfirm: () => {
                            window.location.href = '{{ route('login') }}';
                        }
                    });
                    return;
                }

                const requiredCredits = isEditMode ? 6 : 8;
                if (credits < requiredCredits) {
                    showToast(
                        `Neurium Anda tidak mencukupi (memerlukan ${requiredCredits} Neurium).`,
                        'error');
                    setTimeout(() => {
                        window.location.href = '{{ route('topup.index') }}';
                    }, 1500);
                    return;
                }

                viewportPlaceholder.style.display = 'none';
                viewportResult.style.display = 'none';
                viewportLoading.style.display = 'flex';

                statusBar.style.width = '5%';
                spinnerPercent.textContent = '5%';
                statusHeading.textContent = 'Mengirimkan Tugas Desain...';
                statusDesc.textContent = 'Menghubungi server retcehStudio...';

                const payload = {
                    optional_note: optionalNoteInput.value.trim(),
                    image_urls: isEditMode ? [lastGeneratedUrl] : [productUrl]
                };

                if (isEditMode) {
                    payload.edit_instruction = document.getElementById('edit-instruction').value.trim();
                }

                fetch('{{ route('studio.submit') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(payload)
                    })
                    .then(response => {
                        if (response.status === 401) {
                            window.location.href = '{{ route('login') }}';
                            throw new Error('Silakan login terlebih dahulu.');
                        }
                        return response.json();
                    })
                    .then(res => {
                        if (res && res.success && res.task_id) {
                            credits = res.remaining_credits;
                            const counts = document.querySelectorAll(
                                '.desktop-credit-count, .mobile-credit-count');
                            counts.forEach(c => c.textContent = credits);

                            statusBar.style.width = '10%';
                            spinnerPercent.textContent = '10%';
                            statusHeading.textContent = 'Tugas Berhasil Dikirim';
                            statusDesc.innerHTML =
                                `Tugas ID: ${res.task_id}<br><span style="font-size:0.8rem; display:block; margin-top:5px; opacity:0.8;">Produk Teridentifikasi: <strong>${res.product_desc || 'Produk utama'}</strong></span>`;

                            startPolling(res.task_id);
                        } else {
                            throw new Error(res.error || 'Gagal mengirim tugas');
                        }
                    })
                    .catch(err => {
                        showToast(err.message, 'error');
                        resetViewportToPlaceholder();
                    });
            });

            // Polling status logic
            function startPolling(taskId) {
                if (pollIntervalId) clearTimeout(pollIntervalId);
                if (progressIntervalId) clearInterval(progressIntervalId);

                let attempts = 0;
                const maxAttempts = 120;
                let pollInterval = 3000;
                let fakeProgress = 10;

                progressIntervalId = setInterval(() => {
                    if (fakeProgress < 95) {
                        if (fakeProgress < 40) {
                            fakeProgress += Math.floor(Math.random() * 3) + 2;
                        } else if (fakeProgress < 75) {
                            fakeProgress += Math.floor(Math.random() * 2) + 1;
                        } else {
                            fakeProgress += (Math.random() > 0.6 ? 1 : 0);
                        }
                        statusBar.style.width = `${fakeProgress}%`;
                        spinnerPercent.textContent = `${fakeProgress}%`;
                    }
                }, 1000);

                function poll() {
                    attempts++;
                    if (attempts > maxAttempts) {
                        clearInterval(progressIntervalId);
                        showToast('Waktu pembuatan desain habis.', 'error');
                        resetViewportToPlaceholder();
                        return;
                    }

                    fetch(`{{ url('studio/status') }}/${taskId}`)
                        .then(response => response.json())
                        .then(res => {
                            if (res && res.success) {
                                const status = res.status.toLowerCase();

                                if (status === 'finished' || status === 'succeed' || status === 'success' ||
                                    status === 'completed') {
                                    clearInterval(progressIntervalId);
                                    statusBar.style.width = '100%';
                                    spinnerPercent.textContent = '100%';

                                    setTimeout(() => {
                                        resultImg.src = res.file_url;
                                        btnDownload.href = res.file_url;
                                        lastGeneratedUrl = res.file_url;

                                        btnSaveToGallery.disabled = false;
                                        btnSaveToGallery.innerHTML =
                                            '<i class="bi bi-bookmark-fill"></i> Simpan ke Galeri';

                                        viewportLoading.style.display = 'none';
                                        viewportResult.style.display = 'flex';
                                        showToast('Desain foto produk berhasil dibuat!', 'success');
                                    }, 500);
                                } else if (status === 'failed' || status === 'error') {
                                    clearInterval(progressIntervalId);
                                    throw new Error(res.error_message || 'Pembuatan desain gagal di server');
                                } else {
                                    statusHeading.textContent = status === 'pending' || status === 'queued' ?
                                        'Dalam Antrean' : 'Memproses Desain';
                                    statusDesc.textContent = status === 'pending' || status === 'queued' ?
                                        'Menunggu antrean di server...' :
                                        `Membuat latar belakang realistik (Kemajuan: ${fakeProgress}%).`;
                                    pollIntervalId = setTimeout(poll, pollInterval);
                                }
                            } else {
                                throw new Error(res.error || 'Status error');
                            }
                        })
                        .catch(err => {
                            clearInterval(progressIntervalId);
                            showToast(err.message, 'error');
                            resetViewportToPlaceholder();
                        });
                }

                pollIntervalId = setTimeout(poll, pollInterval);
            }

            function resetViewportToPlaceholder() {
                if (pollIntervalId) clearTimeout(pollIntervalId);
                if (progressIntervalId) clearInterval(progressIntervalId);
                exitEditMode();
                viewportLoading.style.display = 'none';
                viewportResult.style.display = 'none';
                viewportPlaceholder.style.display = 'flex';
            }

            // Edit button triggers edit mode
            btnEdit.addEventListener('click', () => {
                isEditMode = true;
                document.getElementById('edit-instruction-container').classList.remove('hidden');
                generateBtn.innerHTML = '<i class="bi bi-fire"></i> Edit Desain (6 Neurium)';
                document.getElementById('product-upload-card').scrollIntoView({
                    behavior: 'smooth'
                });
                showToast('Mode Edit Aktif! Tulis instruksi perubahan di kolom kiri.', 'info');
            });

            // Save generated image to gallery
            btnSaveToGallery.addEventListener('click', () => {
                if (!lastGeneratedUrl) return;

                if (!isLoggedIn) {
                    window.location.href = '{{ route('login') }}';
                    return;
                }

                btnSaveToGallery.disabled = true;
                btnSaveToGallery.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';

                fetch('{{ route('studio.save') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            original_image_path: productUrl,
                            generated_image_url: lastGeneratedUrl,
                            category: optionalNoteInput.value.trim(),
                            prompt: lastGeneratedUrl
                        })
                    })
                    .then(response => response.json())
                    .then(res => {
                        if (res && res.success) {
                            showToast('Berhasil disimpan ke Galeri!', 'success');
                            btnSaveToGallery.innerHTML =
                                '<i class="bi bi-check-circle-fill"></i> Tersimpan';
                        } else {
                            btnSaveToGallery.disabled = false;
                            btnSaveToGallery.innerHTML =
                                '<i class="bi bi-bookmark-fill"></i> Simpan ke Galeri';
                            showToast(res.error || 'Gagal menyimpan ke galeri', 'error');
                        }
                    })
                    .catch(err => {
                        btnSaveToGallery.disabled = false;
                        btnSaveToGallery.innerHTML =
                            '<i class="bi bi-bookmark-fill"></i> Simpan ke Galeri';
                        showToast('Terjadi kesalahan jaringan', 'error');
                    });
            });
        });
    </script>
@endsection
