<?php include 'header.php'; ?>

<!-- Main View Container -->
<main class="w-full flex-grow px-4 sm:px-6 py-5 flex items-center justify-center">

    <!-- View: Login Page -->
    <div id="view-login" class="view-section w-full max-w-sm mx-auto">
        <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-xl space-y-6 transition-all duration-300 hover:shadow-2xl">
            <div class="text-center space-y-1.5">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-wise-green/10 text-forest text-[11px] font-bold shadow-sm border border-wise-green/20">
                    <i class="bi bi-shield-lock-fill"></i> LOG MASUK
                </div>
                <h2 class="text-xl font-bold tracking-tight text-forest mt-1.5 lowercase">masuk.</h2>
                <p class="text-xs text-zinc-550 leading-relaxed">Masuk ke akun retcehstudio Anda untuk melanjutkan.</p>
            </div>

            <!-- Login form wrapper -->
            <form id="form-login" class="space-y-4">
                <div class="space-y-1.5">
                    <label for="login-email" class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5">
                        <i class="bi bi-envelope text-xs text-zinc-400"></i> Alamat Email
                    </label>
                    <input type="email" id="login-email" required placeholder="nama@contoh.com" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-wise-green/50 focus:border-wise-green text-zinc-950 font-medium placeholder-zinc-400 transition-all">
                </div>
                <div class="space-y-1.5">
                    <label for="login-password" class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5">
                        <i class="bi bi-key text-xs text-zinc-400"></i> Kata Sandi
                    </label>
                    <input type="password" id="login-password" required placeholder="••••••••" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-wise-green/50 focus:border-wise-green text-zinc-950 font-medium placeholder-zinc-400 transition-all">
                </div>

                <button type="submit" id="btn-submit-auth" class="w-full py-3 px-5 bg-wise-green text-forest hover:bg-wise-green-hover rounded-full font-extrabold text-xs uppercase tracking-wider transition-all duration-200 cursor-pointer shadow-md hover:-translate-y-0.5 active:translate-y-0 text-center flex items-center justify-center gap-2">
                    Masuk dengan Email
                </button>
            </form>

            <div class="relative flex py-1 items-center">
                <div class="flex-grow border-t border-zinc-250/60"></div>
                <span class="flex-shrink mx-3 text-[10px] text-zinc-450 font-bold uppercase tracking-wider">atau</span>
                <div class="flex-grow border-t border-zinc-250/60"></div>
            </div>

            <!-- Google Login Button -->
            <button type="button" id="btn-google-login" class="w-full py-2.5 px-4 bg-white border border-zinc-200 hover:bg-zinc-50 rounded-full flex items-center justify-center gap-2 font-bold text-xs text-zinc-700 transition cursor-pointer shadow-sm">
                <svg class="w-4 h-4" viewBox="0 0 24 24" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
                </svg>
                Lanjutkan dengan Google
            </button>

            <div class="text-center pt-2">
                <a href="register.php" class="text-xs text-zinc-500 hover:text-zinc-900 transition underline font-semibold">Belum punya akun? Daftar</a>
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
