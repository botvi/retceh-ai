@extends('layouts.studio')

@section('title', 'Tulis Ulasan | retcehstudio')

@section('content')
    <main class="w-full flex-grow px-4 sm:px-6 py-5 flex items-center justify-center">

        <!-- View: Write Review Form -->
        <div id="view-write-review" class="view-section w-full max-w-md mx-auto">
            <!-- Main Card -->
            <div
                class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-xl space-y-6 transition-all duration-300 hover:shadow-2xl">

                <div class="text-center space-y-1.5">
                    <div
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-wise-green/10 text-forest text-[11px] font-bold shadow-sm border border-wise-green/20">
                        <i class="bi bi-chat-heart-fill text-red-500"></i> TIM TIMBAL BALIK
                    </div>
                    <h2 class="text-xl font-bold tracking-tight text-forest mt-1.5 lowercase">ulasan.</h2>
                    <p class="text-xs text-zinc-550 leading-relaxed">Bagikan pengalaman Anda menggunakan retcehStudio dengan
                        pengguna lain secara instan.</p>
                </div>

                <form action="{{ route('review.store') }}" method="POST" id="form-review" class="space-y-5">
                    @csrf
                    <!-- Stars Selector -->
                    <div class="p-4 rounded-2xl border border-zinc-100 bg-zinc-50/50 space-y-2 text-center shadow-inner">
                        <span class="text-[11px] font-bold text-forest uppercase tracking-wider block">Nilai Kepuasan
                            Anda</span>
                        <div class="flex justify-center gap-2.5 text-3xl text-zinc-300 select-none"
                            id="star-rating-container">
                            <i class="bi bi-star star-select-btn cursor-pointer transition-all duration-200 hover:scale-125 select-none"
                                data-value="1"></i>
                            <i class="bi bi-star star-select-btn cursor-pointer transition-all duration-200 hover:scale-125 select-none"
                                data-value="2"></i>
                            <i class="bi bi-star star-select-btn cursor-pointer transition-all duration-200 hover:scale-125 select-none"
                                data-value="3"></i>
                            <i class="bi bi-star star-select-btn cursor-pointer transition-all duration-200 hover:scale-125 select-none"
                                data-value="4"></i>
                            <i class="bi bi-star star-select-btn cursor-pointer transition-all duration-200 hover:scale-125 select-none"
                                data-value="5"></i>
                        </div>
                        <input type="hidden" name="rating" id="rating-input" value="5">
                    </div>

                    <!-- Input: Name -->
                    <div class="space-y-1.5">
                        <label for="review-name"
                            class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5">
                            <i class="bi bi-person text-xs text-zinc-400"></i> Nama Lengkap
                        </label>
                        <input type="text" name="name" id="review-name" required
                            value="{{ old('name', Auth::user()->name ?? '') }}" placeholder="Contoh: Budi Santoso"
                            class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-wise-green/50 focus:border-wise-green text-zinc-950 font-medium placeholder-zinc-400 transition-all">
                    </div>

                    <!-- Input: Role / Business -->
                    <div class="space-y-1.5">
                        <label for="review-role"
                            class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5">
                            <i class="bi bi-briefcase text-xs text-zinc-400"></i> Pekerjaan / Jenis Usaha
                        </label>
                        <input type="text" name="role" id="review-role" required value="{{ old('role') }}"
                            placeholder="Contoh: Pemilik Toko Kopi, Digital Marketer"
                            class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-wise-green/50 focus:border-wise-green text-zinc-950 font-medium placeholder-zinc-400 transition-all">
                    </div>

                    <!-- Input: Testimonial Message -->
                    <div class="space-y-1.5">
                        <label for="review-text"
                            class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5">
                            <i class="bi bi-chat-left-text text-xs text-zinc-400"></i> Ulasan Umpan Balik
                        </label>
                        <textarea name="pesan" id="review-text" rows="3" required
                            placeholder="Tuliskan pengalaman luar biasa Anda di sini..."
                            class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-wise-green/50 focus:border-wise-green text-zinc-950 font-medium placeholder-zinc-400 transition-all resize-none">{{ old('pesan') }}</textarea>
                    </div>

                    <!-- Submit button -->
                    <div class="pt-2">
                        <button type="submit" id="btn-submit-review"
                            class="w-full py-3 px-5 bg-wise-green text-forest hover:bg-wise-green-hover rounded-full font-extrabold text-xs uppercase tracking-wider transition-all duration-200 cursor-pointer shadow-md hover:-translate-y-0.5 active:translate-y-0 text-center flex items-center justify-center gap-2">
                            Kirim Ulasan Umpan Balik
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </main>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('.star-select-btn');
            const ratingInput = document.getElementById('rating-input');

            stars.forEach(star => {
                star.addEventListener('click', (e) => {
                    const val = parseInt(e.target.getAttribute('data-value'), 10);
                    ratingInput.value = val;
                    updateStars(val);
                });
            });

            // Initialize with default value 5
            updateStars(5);

            function updateStars(val) {
                stars.forEach(star => {
                    const starVal = parseInt(star.getAttribute('data-value'), 10);
                    if (starVal <= val) {
                        star.className =
                            'bi bi-star-fill star-select-btn cursor-pointer transition-all duration-200 hover:scale-125 select-none text-amber-500';
                    } else {
                        star.className =
                            'bi bi-star star-select-btn cursor-pointer transition-all duration-200 hover:scale-125 select-none text-zinc-300';
                    }
                });
            }
        });
    </script>
@endsection
