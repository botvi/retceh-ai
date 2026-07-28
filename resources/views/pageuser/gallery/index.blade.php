@extends('layouts.studio')

@section('title', 'Galeri Desain | retcehStudio')

@section('content')
<main class="w-full flex-grow px-4 sm:px-6 py-4 flex items-center justify-center">

    <!-- View: Saved Gallery -->
    <div id="view-gallery" class="view-section w-full max-w-4xl mx-auto space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-zinc-200/60 pb-4 transition-colors">
            <div class="space-y-1">
                <h2 class="text-xl font-bold tracking-tight text-forest lowercase font-black">galeri.</h2>
                <p class="text-xs text-zinc-500">Lihat, kelola, dan unduh seluruh hasil desain iklan produk yang telah Anda simpan.</p>
            </div>
            
            @if(count($generations) > 0)
                <form action="{{ route('gallery.clear') }}" method="POST" class="delete-form" data-confirm="Apakah Anda yakin ingin menghapus semua hasil desain di galeri Anda? Tindakan ini tidak dapat dibatalkan.">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="btn-clear-gallery" class="text-xs py-1.5 px-4 text-red-500 hover:text-red-600 hover:bg-red-50/50 rounded-full border border-red-200 transition cursor-pointer font-bold uppercase tracking-wider w-fit">
                        <i class="bi bi-trash3"></i> Hapus Semua
                    </button>
                </form>
            @endif
        </div>

        @if(count($generations) > 0)
            <!-- Gallery Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 pt-2" id="gallery-grid">
                @foreach($generations as $gen)
                    <div class="relative group rounded-2xl overflow-hidden bg-white border border-zinc-200 shadow-sm transition duration-300 hover:shadow-md">
                        <!-- Visual Image -->
                        <div class="w-full aspect-square bg-zinc-50 flex items-center justify-center overflow-hidden border-b border-zinc-100">
                            <img src="{{ $gen->generated_image_url }}" alt="Design Generated" class="w-full h-full object-cover">
                        </div>

                        <!-- Date and Category -->
                        <div class="p-3 text-left leading-tight">
                            <span class="text-[9px] font-bold text-zinc-450 block uppercase tracking-wider">{{ $gen->created_at->format('d M Y') }}</span>
                            <h4 class="text-xs font-extrabold text-forest mt-0.5 truncate">{{ $gen->category ?? 'Produk' }}</h4>
                        </div>

                        <!-- Quick Hover Overlay Controls -->
                        <div class="absolute inset-0 bg-forest/40 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center gap-2.5 p-3">
                            <a href="{{ $gen->generated_image_url }}" target="_blank"  class="w-28 py-1.5 bg-white hover:bg-zinc-100 text-zinc-900 text-center rounded-full text-[10px] font-bold uppercase tracking-wider shadow no-underline" download="design-{{ $gen->id }}.jpg">
                                <i class="bi bi-download"></i> Unduh
                            </a>
                      
                            
                            <form action="{{ route('gallery.destroy', $gen->id) }}" method="POST" class="w-28 delete-form" data-confirm="Hapus desain ini dari galeri Anda?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-1.5 bg-red-500 hover:bg-red-600 text-white text-center rounded-full text-[10px] font-bold uppercase tracking-wider shadow border-none cursor-pointer">
                                    <i class="bi bi-trash3-fill"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Gallery Empty Placeholder -->
            <div class="rounded-3xl border border-zinc-200 bg-white p-12 text-center space-y-5 max-w-md mx-auto shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5" id="gallery-empty-state">
                <div class="w-14 h-14 rounded-full bg-zinc-50 border border-zinc-200 flex items-center justify-center text-zinc-400 mx-auto shadow-inner">
                    <i class="bi bi-folder-x text-2xl"></i>
                </div>
                <div class="space-y-1.5">
                    <h3 class="text-sm font-bold text-forest uppercase tracking-wider">Belum ada desain tersimpan</h3>
                    <p class="text-xs text-zinc-450 leading-relaxed">
                        Desain iklan produk komersial yang Anda hasilkan di studio dan Anda simpan akan muncul di halaman galeri ini secara otomatis.
                    </p>
                </div>
                <div class="pt-2">
                    <a href="{{ route('studio.index') }}" class="inline-flex py-2.5 px-6 bg-wise-green text-forest hover:bg-wise-green-hover rounded-full font-bold text-xs transition no-underline uppercase tracking-wider shadow">
                        Buat Desain Pertama
                    </a>
                </div>
            </div>
        @endif
    </div>

</main>
@endsection
