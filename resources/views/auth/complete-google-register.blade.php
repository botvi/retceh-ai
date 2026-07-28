<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Pendaftaran - retcehStudio</title>
    
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

    <!-- View: Complete Registration Page -->
    <div id="view-complete-google-register" class="w-full max-w-sm">
        <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-xl space-y-6 transition-all duration-300 hover:shadow-2xl">
            <div class="text-center space-y-1.5">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-wise-green/10 text-forest text-[11px] font-bold shadow-sm border border-wise-green/20 text-emerald-600">
                    <i class="bi bi-check-circle-fill"></i> GOOGLE TERHUBUNG
                </div>
                <h2 class="text-xl font-extrabold tracking-tight text-forest mt-1.5 lowercase">lengkapi data.</h2>
                <p class="text-xs text-zinc-550 leading-relaxed">Hubungkan akun Google Anda dengan melengkapi data berikut.</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="p-3 bg-red-50 text-red-600 rounded-xl text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('google.complete.register') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Hidden user_id -->
                <input type="hidden" name="user_id" value="{{ $user->id ?? '' }}">

                <div class="space-y-1.5">
                    <label for="username" class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5">
                        <i class="bi bi-at text-xs text-zinc-400"></i> Username
                    </label>
                    <input type="text" name="username" id="username" required placeholder="Buat username unik" value="{{ old('username') }}" class="w-full">
                </div>
                <div class="space-y-1.5">
                    <label for="no_wa" class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5">
                        <i class="bi bi-whatsapp text-xs text-zinc-400"></i> Nomor WhatsApp
                    </label>
                    <input type="tel" name="no_wa" id="no_wa" required placeholder="Contoh: 081234567890" value="{{ old('no_wa') }}" class="w-full">
                </div>

                <div class="space-y-1.5 pt-1">
                    <label class="inline-flex items-start gap-2.5 text-xs text-zinc-500 cursor-pointer select-none">
                        <input type="checkbox" name="agree-terms" required class="mt-0.5 rounded border-zinc-350 text-wise-green focus:ring-wise-green">
                        <span>Saya menyetujui syarat & ketentuan serta kebijakan privasi.</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-3 px-5 bg-wise-green hover:bg-wise-green-hover text-forest rounded-full font-extrabold text-xs uppercase tracking-wider transition-all duration-200 cursor-pointer shadow-md hover:-translate-y-0.5 active:translate-y-0 text-center flex items-center justify-center gap-2 border-none">
                    Selesaikan Pendaftaran
                </button>
            </form>

            <div class="text-center pt-2">
                <a href="{{ route('login') }}" class="text-xs text-zinc-500 hover:text-zinc-900 transition underline font-semibold">Kembali ke Masuk</a>
            </div>
        </div>
    </div>

    @include('components.custom-alert')
</body>
</html>
