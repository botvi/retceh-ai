<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - retcheStudio</title>
    
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
            text-align: center !important;
            font-weight: 700 !important;
            letter-spacing: 0.2em !important;
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

    <!-- View: Verify OTP Page -->
    <div id="view-verify-otp" class="w-full max-w-sm">
        <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-xl space-y-6 transition-all duration-300 hover:shadow-2xl">
            <div class="text-center space-y-1.5">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-800 text-[11px] font-bold shadow-sm border border-emerald-500/20">
                    <i class="bi bi-shield-check"></i> VERIFIKASI KODE
                </div>
                <h2 class="text-xl font-extrabold tracking-tight text-forest mt-1.5 lowercase">verifikasi otp.</h2>
                <p class="text-xs text-zinc-550 leading-relaxed">Masukkan 6 digit kode verifikasi OTP yang telah dikirim ke nomor WhatsApp Anda <b>{{ $no_wa }}</b>.</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="p-3 bg-red-50 text-red-600 rounded-xl text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('forgot-password.verify-otp') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Hidden WhatsApp number field -->
                <input type="hidden" name="no_wa" value="{{ $no_wa }}">

                <div class="space-y-2">
                    <label for="otp" class="text-[11px] font-bold text-forest uppercase tracking-wider block text-center">
                        Masukkan Kode OTP Anda
                    </label>
                    <input type="text" name="otp" id="otp" required placeholder="••••••" maxlength="6" class="w-full text-center">
                </div>

                <button type="submit" class="w-full py-3 px-5 bg-wise-green hover:bg-wise-green-hover text-forest rounded-full font-extrabold text-xs uppercase tracking-wider transition-all duration-200 cursor-pointer shadow-md hover:-translate-y-0.5 active:translate-y-0 text-center flex items-center justify-center gap-2 border-none">
                    Verifikasi Kode OTP
                </button>
            </form>

            <div class="text-center pt-2 border-t border-zinc-100 flex flex-col gap-1.5 text-xs text-zinc-500">
                <span>Salah nomor WhatsApp?</span>
                <a href="{{ route('forgot-password') }}" class="text-zinc-800 hover:text-zinc-900 transition underline font-semibold">Request OTP Baru</a>
            </div>
        </div>
    </div>

    @include('components.custom-alert')
</body>
</html>
