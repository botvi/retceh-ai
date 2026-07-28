@extends('layouts.studio')

@section('title', 'Checkout Pembayaran | StudioAI')

@section('content')
<main class="w-full flex-grow px-4 sm:px-6 py-5 flex items-center justify-center">

    <!-- View: Mock Checkout -->
    <div id="view-checkout" class="view-section w-full max-w-sm mx-auto">
        <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-xl space-y-6 transition-all duration-300 hover:shadow-2xl">
            <div class="text-center space-y-1.5">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-wise-green/10 text-forest text-[11px] font-bold shadow-sm border border-wise-green/20">
                    <i class="bi bi-wallet2"></i> SIMULASI PEMBAYARAN
                </div>
                <h2 class="text-xl font-bold tracking-tight text-forest mt-1.5 lowercase">checkout.</h2>
                <p class="text-xs text-zinc-550 leading-relaxed">Selesaikan pembelian saldo retcheStudio Anda.</p>
            </div>

            <!-- Package Details Summary -->
            <div class="bg-zinc-50 border border-zinc-200/80 rounded-2xl p-4 space-y-3">
                <div class="flex items-center justify-between border-b border-zinc-200/60 pb-2">
                    <span class="text-xs text-zinc-500 font-medium">Paket Dipilih</span>
                    <span class="text-xs font-bold text-forest uppercase tracking-wider">{{ $package->name }}</span>
                </div>
                <div class="flex items-center justify-between border-b border-zinc-200/60 pb-2">
                    <span class="text-xs text-zinc-500 font-medium">Jumlah Kredit</span>
                    <span class="text-xs font-extrabold text-forest flex items-center gap-1">
                        <i class="bi bi-cup-hot-fill text-amber-700 text-xs"></i>
                        {{ $package->credits }} Gelas Kopi
                    </span>
                </div>
                <div class="flex items-center justify-between pt-1">
                    <span class="text-xs text-zinc-500 font-semibold">Total Tagihan</span>
                    <span class="text-sm font-black text-forest">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Payment Simulation Form -->
            <form action="{{ route('topup.process', $package->id) }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-1.5">
                    <label for="payment-method" class="text-[11px] font-bold text-forest uppercase tracking-wider block flex items-center gap-1.5">
                        <i class="bi bi-credit-card text-xs text-zinc-400"></i> Cara Simulasi Pembayaran
                    </label>
                    <select name="payment_method" id="payment-method" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-wise-green/50 focus:border-wise-green text-zinc-950 font-medium transition-all">
                        <option value="qris">QRIS</option>
                    </select>
                </div>

                <button type="submit" class="w-full py-3 px-5 bg-wise-green text-forest hover:bg-wise-green-hover rounded-full font-extrabold text-xs uppercase tracking-wider transition-all duration-200 cursor-pointer shadow-md hover:-translate-y-0.5 active:translate-y-0 text-center flex items-center justify-center gap-2">
                    <i class="bi bi-shield-lock-fill"></i> Bayar & Konfirmasi Instan
                </button>
            </form>

            <div class="text-center pt-2">
                <a href="{{ route('topup.index') }}" class="text-xs text-zinc-500 hover:text-zinc-900 transition underline font-semibold">Batal Pembelian</a>
            </div>
        </div>
    </div>

</main>
@endsection
