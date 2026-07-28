@extends('layouts.studio')

@section('title', 'Paket Top Up | retcehStudio')

@section('content')
<main class="w-full flex-grow px-4 sm:px-6 py-6 flex items-center justify-center">

    <!-- View: Top Up / Credits Pricing -->
    <div id="view-topup" class="view-section w-full max-w-5xl mx-auto space-y-8">
        
        <!-- Header Banner -->
        <div class="text-center max-w-xl mx-auto space-y-3">
            <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-wise-green/10 text-forest text-xs font-extrabold shadow-xs border border-wise-green/30 tracking-wider uppercase">
                <i class="bi bi-cup-hot-fill text-amber-700 animate-pulse"></i> Paket Saldo Gelas Kopi
            </div>
            <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-forest lowercase">
                pilih paket.
            </h1>
            <p class="text-xs sm:text-sm text-zinc-500 font-medium leading-relaxed">
                Isi ulang saldo gelas kopi untuk memproses foto iklan produk komersial secara instan. Setiap render memotong 8 gelas kopi.
            </p>
            
            {{-- QRIS & E-Wallet Payment Banner Badge --}}
            <div class="flex flex-wrap items-center justify-center gap-2 pt-1">
                <span class="px-3 py-1 rounded-full bg-white border border-zinc-200 text-[10px] font-extrabold text-zinc-700 shadow-xs flex items-center gap-1.5">
                    <i class="bi bi-qr-code text-emerald-600"></i> QRIS Realtime
                </span>
            </div>
        </div>

        <!-- Pricing packages grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto pt-2">
            @foreach($packages as $pkg)
                <!-- Package tier card -->
                <div class="rounded-3xl bg-white p-6 shadow-sm flex flex-col justify-between space-y-6 relative overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-xl {{ $pkg->is_recommended ? 'border-2 border-forest ring-4 ring-wise-green/30' : 'border border-zinc-200/80' }}">
                    @if($pkg->is_recommended)
                        <!-- Recommended badge -->
                        <div class="absolute top-0 right-0 bg-forest text-wise-green text-[9px] font-black px-4 py-1.5 rounded-bl-2xl tracking-widest uppercase shadow-sm flex items-center gap-1">
                            <i class="bi bi-star-fill text-amber-400"></i> Paling Populer
                        </div>
                    @endif
                    
                    <div class="space-y-5">
                        <div class="space-y-2">
                            <span class="text-xs font-black uppercase tracking-widest px-2.5 py-1 rounded-md {{ $pkg->is_recommended ? 'bg-wise-green/20 text-forest' : 'bg-zinc-100 text-zinc-600' }} inline-block">
                                {{ $pkg->name }}
                            </span>
                            <div class="flex items-baseline gap-1 mt-1">
                                <span class="text-3xl sm:text-4xl font-black text-forest">Rp {{ number_format($pkg->price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="border-t border-zinc-100 pt-4 space-y-3">
                            <div class="flex items-center gap-2.5 text-xs text-zinc-800 font-bold bg-amber-50/80 border border-amber-200/60 p-2.5 rounded-xl">
                                <div class="w-6 h-6 rounded-full bg-amber-500/20 flex items-center justify-center flex-shrink-0">
                                    <i class="bi bi-cup-hot-fill text-amber-700 text-xs"></i>
                                </div>
                                <span class="text-sm font-black text-forest">{{ $pkg->credits }} Gelas Kopi</span>
                            </div>
                            
                            @if(is_array($pkg->features) || is_string($pkg->features))
                                @php
                                    $feats = is_array($pkg->features) ? $pkg->features : json_decode($pkg->features, true) ?? explode(',', $pkg->features);
                                @endphp
                                @foreach($feats as $feature)
                                    @if(trim($feature))
                                        <div class="flex items-start gap-2 text-xs text-zinc-600 font-medium">
                                            <i class="bi bi-check-circle-fill text-emerald-500 text-sm flex-shrink-0 mt-0.5"></i>
                                            <span>{{ trim($feature) }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    
                    <a href="{{ route('topup.checkout', $pkg->id) }}"
                       class="btn-purchase-credits w-full text-center text-xs font-black uppercase tracking-wider shadow-md no-underline transition-all duration-200 py-3 rounded-full flex items-center justify-center gap-2 {{ $pkg->is_recommended ? 'bg-wise-green text-forest hover:bg-wise-green-hover' : 'bg-forest text-wise-green hover:bg-forest-hover' }}">
                        <i class="bi bi-bag-check-fill"></i> Beli Paket Ini
                    </a>
                </div>
            @endforeach
        </div>

        <!-- FAQ Section -->
        <section class="max-w-3xl mx-auto space-y-6 pt-8 border-t border-zinc-200/80">
            <div class="text-center space-y-1">
                <h3 class="text-xl font-black text-forest uppercase tracking-tight">Pertanyaan Umum (FAQ)</h3>
                <p class="text-xs text-zinc-500 font-medium">Semua hal yang perlu Anda ketahui tentang sistem Gelas Kopi retcehStudio.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- FAQ Item 1 -->
                <div class="rounded-2xl border border-zinc-200/80 bg-white p-4.5 text-left space-y-1.5 shadow-xs">
                    <h4 class="text-xs font-black text-forest uppercase tracking-wider flex items-center gap-2">
                        <i class="bi bi-question-circle-fill text-wise-green"></i> Apa itu sistem Gelas Kopi?
                    </h4>
                    <p class="text-[11px] text-zinc-500 leading-relaxed font-medium">
                        Gelas Kopi adalah saldo render di retcehStudio. Setiap kali Anda menggunakan AI untuk membuat foto produk baru, sistem memotong 8 gelas kopi.
                    </p>
                </div>
                <!-- FAQ Item 2 -->
                <div class="rounded-2xl border border-zinc-200/80 bg-white p-4.5 text-left space-y-1.5 shadow-xs">
                    <h4 class="text-xs font-black text-forest uppercase tracking-wider flex items-center gap-2">
                        <i class="bi bi-question-circle-fill text-wise-green"></i> Apakah saldo bisa kadaluwarsa?
                    </h4>
                    <p class="text-[11px] text-zinc-500 leading-relaxed font-medium">
                        Tidak. Saldo Gelas Kopi yang Anda beli tidak memiliki masa kedaluwarsa dan akan tetap tersimpan aman di akun Anda selamanya.
                    </p>
                </div>
            </div>
        </section>
    </div>

</main>
@endsection
