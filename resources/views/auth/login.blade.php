<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - retcehStudio</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Tailwind CSS v4 CDN -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    
    <style>
        @theme {
            --font-sans: 'Outfit', sans-serif;
            --font-display: 'Plus Jakarta Sans', sans-serif;
            --color-wise-green: #9fe870;
            --color-wise-green-hover: #8cd85d;
            --color-forest: #163300;
        }
        body {
            font-family: 'Outfit', sans-serif !important;
            background-color: #f4f6f2 !important;
            background-image: radial-gradient(rgba(22, 51, 0, 0.04) 1.2px, transparent 1.2px) !important;
            background-size: 20px 20px !important;
        }
        input {
            border: 1.5px solid #e6ece1 !important;
            background-color: #ffffff !important;
            border-radius: 12px !important;
            padding: 0.75rem 1rem !important;
            font-size: 0.875rem !important;
            transition: all 0.2s ease !important;
            color: #0e0f0c !important;
        }
        input:focus {
            outline: none !important;
            border-color: #163300 !important;
            box-shadow: 0 0 0 2.5px rgba(22, 51, 0, 0.08) !important;
        }
    </style>
</head>
<body class="text-zinc-900 min-h-screen antialiased flex flex-col justify-center items-center py-10 px-4">

    <!-- Brand Logo -->
    <a href="{{ route('index') }}" class="flex items-center cursor-pointer font-bold text-zinc-900 no-underline mb-6">
        <span class="tracking-tighter text-2xl font-black text-forest lowercase">retche</span>
        <span class="relative inline-block text-wise-green bg-forest px-1.5 py-0.5 rounded-lg tracking-tighter text-2xl font-black lowercase align-middle">
            studio.ai
        </span>
    </a>

    <!-- View: Login Page -->
    <div id="view-login" class="w-full max-w-sm">
        <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-xl space-y-6 transition-all duration-300 hover:shadow-2xl">
            <div class="text-center space-y-1.5">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-wise-green/10 text-forest text-[11px] font-bold shadow-sm border border-wise-green/20">
                    <i class="bi bi-shield-lock-fill"></i> LOG MASUK
                </div>
                <h2 class="text-xl font-extrabold tracking-tight text-forest mt-1.5 lowercase">masuk.</h2>
                <p class="text-xs text-zinc-500 leading-relaxed">Masuk ke akun retcehStudio Anda untuk melanjutkan.</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="p-3 bg-red-50 text-red-600 rounded-xl text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- Login form wrapper -->
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-1.5">
                    <label for="login-email" class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5">
                        <i class="bi bi-envelope text-xs text-zinc-400"></i> Username atau Email
                    </label>
                    <input type="text" name="username" id="login-email" required placeholder="username atau nama@contoh.com" value="{{ old('username') }}" class="w-full">
                </div>
                <div class="space-y-1.5">
                    <div class="flex justify-between items-center">
                        <label for="login-password" class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5 mb-0">
                            <i class="bi bi-key text-xs text-zinc-400"></i> Kata Sandi
                        </label>
                        <a href="{{ route('forgot-password') }}" class="text-[10px] text-zinc-400 hover:text-zinc-950 transition underline font-bold uppercase tracking-wider">Lupa Sandi?</a>
                    </div>
                    <div class="relative">
                        <input type="password" name="password" id="login-password" required placeholder="••••••••" class="w-full pr-10">
                        <button type="button" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-zinc-900 cursor-pointer border-none bg-transparent" onclick="togglePasswordVisibility('login-password', this)">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full py-3 px-5 bg-wise-green hover:bg-wise-green-hover text-forest rounded-full font-extrabold text-xs uppercase tracking-wider transition-all duration-200 cursor-pointer shadow-md hover:-translate-y-0.5 active:translate-y-0 text-center flex items-center justify-center gap-2 border-none">
                    Masuk
                </button>
            </form>

            <div class="relative flex py-1 items-center">
                <div class="flex-grow border-t border-zinc-200"></div>
                <span class="flex-shrink mx-3 text-[10px] text-zinc-400 font-bold uppercase tracking-wider">atau</span>
                <div class="flex-grow border-t border-zinc-200"></div>
            </div>

            <!-- Google Login Button -->
            <a href="{{ route('google.login') }}" class="w-full py-2.5 px-4 bg-white border border-zinc-200 hover:bg-zinc-50 rounded-full flex items-center justify-center gap-2 font-bold text-xs text-zinc-700 transition cursor-pointer shadow-sm no-underline">
                <svg class="w-4 h-4" viewBox="0 0 24 24" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
                </svg>
                Lanjutkan dengan Google
            </a>

            <div class="text-center pt-2">
                <a href="{{ route('register') }}" class="text-xs text-zinc-500 hover:text-zinc-900 transition underline font-semibold">Belum punya akun? Daftar</a>
            </div>
        </div>
    </div>

    @include('components.custom-alert')
    <script>
        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye';
            }
        }
    </script>
</body>
</html>
