<?php include 'header.php'; ?>

<!-- Main View Container -->
<main class="w-full flex-grow px-4 sm:px-6 flex items-center justify-center py-5">

    <!-- View: Profile Settings Page -->
    <div id="view-profile" class="view-section w-full max-w-md mx-auto">
        <!-- Main Card -->
        <div class="rounded-3xl border border-zinc-200 bg-white shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
            
            <!-- Beautiful Card Banner -->
            <div class="h-32 bg-gradient-to-tr from-forest to-charcoal relative flex items-end justify-center">
                <!-- Decorative Pattern -->
                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#9fe870_1px,transparent_1px)] [background-size:16px_16px]"></div>
                <!-- Ambient glow -->
                <div class="absolute -top-12 -left-12 w-32 h-32 bg-wise-green/30 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-emerald-500/20 rounded-full blur-2xl"></div>
            </div>

            <!-- Avatar & Profile Intro Section (Half overlapping) -->
            <div class="relative px-6 pb-4 flex flex-col items-center -mt-10">
                <div class="relative group">
                    <div class="w-20 h-20 rounded-full bg-zinc-100 border-4 border-white shadow-md flex items-center justify-center overflow-hidden cursor-pointer transition-all duration-300 hover:scale-105" id="profile-avatar-wrapper" title="Ganti Foto Profil">
                        <span class="text-2xl font-black text-forest" id="profile-avatar-initial">U</span>
                        <img class="w-full h-full object-cover hidden" id="profile-avatar-preview" src="" alt="Avatar Preview">
                        
                        <!-- Overlay on Hover -->
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-white rounded-full">
                            <i class="bi bi-camera-fill text-lg"></i>
                        </div>
                    </div>
                    <!-- Small Camera Badge -->
                    <div id="btn-upload-trigger" class="absolute bottom-0 right-0 w-6 h-6 bg-wise-green hover:bg-wise-green-hover text-forest rounded-full border-2 border-white flex items-center justify-center shadow cursor-pointer transition">
                        <i class="bi bi-pencil-fill text-[9px]"></i>
                    </div>
                </div>
                <input type="file" id="profile-avatar-input" accept="image/jpeg,image/png,image/webp" class="hidden">
                
                <div class="text-center mt-3">
                    <h3 class="text-lg font-extrabold text-forest username-display">User</h3>
                    <p class="text-[10px] uppercase font-bold tracking-widest text-zinc-400">Pengguna RetcehStudio</p>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-zinc-100 mx-6"></div>

            <!-- Form Section -->
            <form id="form-profile" class="p-6 space-y-5">
                
                <!-- Input: Full Name -->
                <div class="space-y-1.5">
                    <label for="profile-name" class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5">
                        <i class="bi bi-person text-xs text-zinc-400"></i> Nama Lengkap
                    </label>
                    <input type="text" id="profile-name" required placeholder="Masukkan nama lengkap" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-wise-green/50 focus:border-wise-green text-zinc-950 font-medium placeholder-zinc-400 transition-all">
                </div>

                <!-- Input: Email Address (Read Only) -->
                <div class="space-y-1.5">
                    <label for="profile-email" class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5">
                        <i class="bi bi-envelope text-xs text-zinc-400"></i> Alamat Email
                    </label>
                    <input type="email" id="profile-email" readonly class="w-full bg-zinc-50/50 border border-zinc-200/50 rounded-xl p-3 text-xs text-zinc-400 cursor-not-allowed outline-none select-none font-medium">
                </div>

                <!-- Input: WhatsApp Number -->
                <div class="space-y-1.5">
                    <label for="profile-whatsapp" class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5">
                        <i class="bi bi-whatsapp text-xs text-zinc-400"></i> Nomor WhatsApp
                    </label>
                    <input type="tel" id="profile-whatsapp" placeholder="Contoh: 081234567890" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-wise-green/50 focus:border-wise-green text-zinc-950 font-medium placeholder-zinc-400 transition-all">
                </div>

                <!-- Session Credit Indicator Card (Stunning design) -->
                <div class="p-4 rounded-2xl border border-wise-green bg-wise-green/5 flex items-center justify-between shadow-sm">
                    <div class="space-y-0.5">
                        <span class="text-[9px] text-zinc-550 font-bold uppercase tracking-wider block">Sisa Saldo Gelas Kopi</span>
                        <div class="flex items-center gap-1">
                            <div class="w-5 h-5 rounded-full bg-amber-500/10 flex items-center justify-center">
                                <i class="bi bi-cup-hot-fill text-amber-700 text-xs"></i>
                            </div>
                            <span class="text-base font-extrabold text-forest" id="profile-credits-count">15</span>
                            <span class="text-[10px] text-zinc-500 font-semibold uppercase tracking-wider">Gelas Kopi</span>
                        </div>
                    </div>
                    <a href="topup.php" class="inline-flex py-2 px-4 bg-forest hover:bg-forest-hover text-wise-green rounded-full font-bold text-[10px] uppercase tracking-wider transition hover:scale-105 active:scale-95 no-underline shadow">
                        Isi Saldo
                    </a>
                </div>

                <!-- Action Button -->
                <div class="pt-2">
                    <button type="submit" id="btn-save-profile" class="w-full py-3 px-5 bg-wise-green text-forest hover:bg-wise-green-hover rounded-full font-extrabold text-xs uppercase tracking-wider transition-all duration-200 cursor-pointer shadow-md hover:-translate-y-0.5 active:translate-y-0 text-center flex items-center justify-center gap-2">
                        <i class="bi bi-check-circle-fill"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
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
