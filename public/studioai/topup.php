<?php include 'header.php'; ?>

<!-- Main View Container -->
<main class="w-full flex-grow px-4 sm:px-6 py-4 flex items-center justify-center">

    <!-- View: Top Up / Credits Pricing -->
    <div id="view-topup" class="view-section w-full max-w-4xl mx-auto space-y-6">
        <div class="text-center max-w-md mx-auto space-y-2">
            <div
                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-wise-green/10 text-forest text-[11px] font-bold shadow-sm border border-wise-green/20">
                <i class="bi bi-cup-hot-fill text-amber-700 animate-pulse"></i> BELI KOPI
            </div>
            <h2 class="text-2xl font-black tracking-tight text-forest lowercase">beli kopi.</h2>
            <p class="text-xs text-zinc-550 leading-relaxed">
                Top up gelas kopi untuk merender foto iklan produk berkualitas komersial secara instan. Setiap rendering
                memotong 8 gelas kopi.
            </p>
        </div>

        <!-- Pricing packages grid -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-3xl mx-auto pt-2">
            <!-- Starter tier -->
            <div
                class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm flex flex-col justify-between space-y-6 relative overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest">Starter</h3>
                        <div class="flex items-baseline gap-1 mt-2">
                            <span class="text-3xl font-black text-forest">Rp 15k</span>
                            <span class="text-[10px] text-zinc-450 font-bold uppercase tracking-wider">/ sekali
                                beli</span>
                        </div>
                    </div>
                    <div class="border-t border-zinc-100 pt-4 space-y-3">
                        <div class="flex items-center gap-2 text-xs text-zinc-800">
                            <div class="w-4 h-4 rounded-full bg-amber-500/10 flex items-center justify-center">
                                <i class="bi bi-cup-hot-fill text-amber-700 text-[10px]"></i>
                            </div>
                            <span class="font-bold">50 Gelas Kopi</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-zinc-500">
                            <i class="bi bi-check-circle-fill text-emerald-600 text-xs"></i>
                            <span>Prioritas pembuatan standar</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-zinc-500">
                            <i class="bi bi-check-circle-fill text-emerald-600 text-xs"></i>
                            <span>Akses seluruh ukuran studio</span>
                        </div>
                    </div>
                </div>
                <button type="button" data-credits="50"
                    class="btn-purchase-credits w-full py-2.5 px-4 rounded-full font-bold text-xs uppercase tracking-wider transition cursor-pointer shadow-sm">
                    Beli Paket
                </button>
            </div>

            <!-- Pro tier (Recommended) -->
            <div
                class="rounded-3xl border-2 border-forest bg-white p-6 shadow-md flex flex-col justify-between space-y-6 relative overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lg">
                <!-- Recommended badge -->
                <div
                    class="absolute top-0 right-0 bg-wise-green text-forest text-[9px] font-extrabold px-3.5 py-1.5 rounded-bl-2xl tracking-wider uppercase">
                    REKOMENDASI</div>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-xs font-bold text-forest uppercase tracking-widest">Pro</h3>
                        <div class="flex items-baseline gap-1 mt-2">
                            <span class="text-3xl font-black text-forest">Rp 45k</span>
                            <span class="text-[10px] text-zinc-450 font-bold uppercase tracking-wider">/ sekali
                                beli</span>
                        </div>
                    </div>
                    <div class="border-t border-zinc-100 pt-4 space-y-3">
                        <div class="flex items-center gap-2 text-xs text-zinc-800">
                            <div class="w-4 h-4 rounded-full bg-amber-500/10 flex items-center justify-center">
                                <i class="bi bi-cup-hot-fill text-amber-700 text-[10px]"></i>
                            </div>
                            <span class="font-bold">200 Gelas Kopi</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-zinc-500">
                            <i class="bi bi-check-circle-fill text-emerald-600 text-xs"></i>
                            <span class="font-semibold text-zinc-800">Prioritas pembuatan tinggi</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-zinc-500">
                            <i class="bi bi-check-circle-fill text-emerald-600 text-xs"></i>
                            <span>Akses seluruh ukuran studio</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-zinc-500">
                            <i class="bi bi-check-circle-fill text-emerald-600 text-xs"></i>
                            <span>Lisensi penggunaan komersial</span>
                        </div>
                    </div>
                </div>
                <button type="button" data-credits="200"
                    class="btn-purchase-credits w-full py-2.5 px-4 bg-wise-green text-forest hover:bg-wise-green-hover rounded-full font-bold text-xs uppercase tracking-wider transition cursor-pointer shadow">
                    Beli Paket
                </button>
            </div>

            <!-- Enterprise/Unlimited -->
            <div
                class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm flex flex-col justify-between space-y-6 relative overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest">Enterprise</h3>
                        <div class="flex items-baseline gap-1 mt-2">
                            <span class="text-3xl font-black text-forest">Rp 99k</span>
                            <span class="text-[10px] text-zinc-450 font-bold uppercase tracking-wider">/ sekali
                                beli</span>
                        </div>
                    </div>
                    <div class="border-t border-zinc-100 pt-4 space-y-3">
                        <div class="flex items-center gap-2 text-xs text-zinc-800">
                            <div class="w-4 h-4 rounded-full bg-amber-500/10 flex items-center justify-center">
                                <i class="bi bi-cup-hot-fill text-amber-700 text-[10px]"></i>
                            </div>
                            <span class="font-bold">1000 Gelas Kopi</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-zinc-500">
                            <i class="bi bi-check-circle-fill text-emerald-600 text-xs"></i>
                            <span class="font-semibold text-zinc-800">Prioritas pembuatan prioritas utama</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-zinc-500">
                            <i class="bi bi-check-circle-fill text-emerald-600 text-xs"></i>
                            <span>Akses seluruh ukuran studio</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-zinc-500">
                            <i class="bi bi-check-circle-fill text-emerald-600 text-xs"></i>
                            <span>Lisensi komersial & tanpa watermark</span>
                        </div>
                    </div>
                </div>
                <button type="button" data-credits="1000"
                    class="btn-purchase-credits w-full py-2.5 px-4 rounded-full font-bold text-xs uppercase tracking-wider transition cursor-pointer shadow-sm">
                    Beli Paket
                </button>
            </div>
        </div>

        <!-- FAQ Section -->
        <section class="max-w-2xl mx-auto space-y-6 pt-10 border-t border-zinc-200/60">
            <div class="text-center space-y-1.5">
                <h3 class="text-xl font-extrabold text-forest uppercase tracking-tight text-center">Pertanyaan Umum
                    (FAQ)</h3>
                <p class="text-xs text-zinc-500">Semua yang perlu Anda ketahui tentang sistem gelas kopi retcehStudio.
                </p>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <details
                    class="group rounded-2xl border border-zinc-200 bg-white p-4.5 transition-all duration-300 [&_summary::-webkit-details-marker]:hidden cursor-pointer"
                    open>
                    <summary
                        class="flex items-center justify-between gap-1.5 text-xs font-bold text-forest uppercase tracking-wider">
                        <span>Apa itu gelas kopi retcehStudio?</span>
                        <span class="transition duration-300 group-open:-rotate-180">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </summary>
                    <p class="mt-3 text-xs text-zinc-550 leading-relaxed">
                        Gelas kopi adalah alat tukar di dalam studio untuk memanggil mesin kecerdasan buatan (AI) kami.
                        Setiap kali Anda menekan tombol **Generate**, sistem akan memotong sebanyak **8 gelas kopi**
                        untuk merender latar belakang studio dan menyelaraskan pencahayaan foto produk Anda.
                    </p>
                </details>

                <!-- FAQ Item 2 -->
                <details
                    class="group rounded-2xl border border-zinc-200 bg-white p-4.5 transition-all duration-300 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                    <summary
                        class="flex items-center justify-between gap-1.5 text-xs font-bold text-forest uppercase tracking-wider">
                        <span>Apakah gelas kopi saya memiliki masa kedaluwarsa?</span>
                        <span class="transition duration-300 group-open:-rotate-180">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </summary>
                    <p class="mt-3 text-xs text-zinc-550 leading-relaxed">
                        Tidak ada masa kedaluwarsa. Gelas kopi yang Anda beli atau dapatkan secara cuma-cuma saat
                        mendaftar akan tetap tersimpan aman di akun Anda dan dapat digunakan kapan saja.
                    </p>
                </details>

                <!-- FAQ Item 3 -->
                <details
                    class="group rounded-2xl border border-zinc-200 bg-white p-4.5 transition-all duration-300 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                    <summary
                        class="flex items-center justify-between gap-1.5 text-xs font-bold text-forest uppercase tracking-wider">
                        <span>Bagaimana metode pembayaran top up?</span>
                        <span class="transition duration-300 group-open:-rotate-180">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </summary>
                    <p class="mt-3 text-xs text-zinc-550 leading-relaxed">
                        Dalam versi demo/desain saat ini, proses pembayaran dilakukan menggunakan simulasi pembayaran
                        instan. Cukup klik tombol **Beli Paket**, dan saldo gelas kopi Anda akan otomatis bertambah
                        secara langsung untuk memudahkan pengujian visual.
                    </p>
                </details>
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