@extends('layouts.public')

@section('content')
<!-- Editorial Project Detail Section -->
<section class="py-24 md:py-36 bg-[#f5f5f5] min-h-screen border-b-8 border-black font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 md:space-y-24">
        
        <!-- Back Navigation & Minimalist Pill (Space Header) -->
        <div class="flex items-center justify-between border-b-4 border-black pb-6">
            <a href="{{ route('home') }}#projects" class="inline-flex items-center justify-center px-4 py-2 border-2 border-black text-[10px] font-black uppercase tracking-wider bg-white hover:bg-[#ff5722] shadow-[3px_3px_0px_#000000] hover:shadow-[5px_5px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all duration-100 select-none">
                &larr; Kembali ke Portofolio
            </a>
            
            <span class="text-xxs font-black uppercase tracking-widest text-slate-500 italic">
                // ARCHIVE / PROJECT DETAIL
            </span>
        </div>

        <!-- Section 1: Massive Typographic Hero Panel -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 md:gap-16 items-end">
            <!-- Project Title (Massive Bold Typography) -->
            <div class="lg:col-span-9 space-y-4">
                <span class="inline-block px-3 py-1.5 bg-[#ff5722] text-black text-xxs font-black uppercase tracking-widest border-2 border-black shadow-[2.5px_2.5px_0px_#000000]">
                    // CASE STUDY ARCHIVE
                </span>
                <h1 class="text-5xl sm:text-7xl md:text-8xl font-black uppercase tracking-tighter leading-[0.9] text-black">
                    {{ $project->title }}
                </h1>
            </div>
            
            <!-- Strategic Whitespace & Tech Badge -->
            <div class="lg:col-span-3 pb-2">
                <div class="border-l-4 border-black pl-6 space-y-2">
                    <span class="block text-xxs font-black text-slate-500 uppercase tracking-widest">// CORE STACK:</span>
                    <div class="flex flex-wrap gap-1.5">
                        @forelse ($project->badges as $badge)
                            <span class="px-2.5 py-1 border-2 border-black text-[9px] font-black tracking-widest uppercase shadow-[1.5px_1.5px_0px_#000000] inline-block"
                                  style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }};">
                                {{ $badge->name }}
                            </span>
                        @empty
                            <span class="px-2.5 py-1 bg-black text-[#ff5722] border-2 border-black text-[9px] font-black tracking-widest uppercase">
                                // UMUM
                            </span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: First Massive Visual (Mockup Banner or Cover) -->
        <div class="relative bg-white border-4 border-black p-4 shadow-[10px_10px_0px_#000000] group overflow-hidden">
            @if($project->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($project->image_path))
                <div class="w-full h-[40vh] sm:h-[60vh] md:h-[75vh] bg-slate-100 border-2 border-black overflow-hidden relative cursor-zoom-in"
                     onclick="openZoomModal('{{ asset('storage/' . $project->image_path) }}')">
                    <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}" class="object-cover w-full h-full group-hover:scale-101 transition duration-500">
                    
                    <div class="absolute bottom-4 right-4 bg-black text-white text-[9px] font-black uppercase tracking-widest px-3 py-1.5 border-2 border-black shadow-[2px_2px_0px_#ff5722] backdrop-blur-xs select-none">
                        KLIK UNTUK ZOOM (+)
                    </div>
                </div>
            @else
                <!-- Fallback brutalist graphic -->
                <div class="w-full h-[50vh] bg-[linear-gradient(45deg,#ff5722_25%,transparent_25%),linear-gradient(-45deg,#ff5722_25%,transparent_25%)] bg-[size:30px_30px] bg-white flex flex-col items-center justify-center border-2 border-black">
                    <span class="px-4 py-2 bg-black text-white font-black text-sm border-2 border-black shadow-[4px_4px_0px_#ff5722]">
                        DEMO MOCKUP ACTIVE
                    </span>
                </div>
            @endif
        </div>

        <!-- Section 3: Spec specifications & Editorial whitespace text split -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 md:gap-16 items-start">
            
            <!-- Left Editorial Text: The Project Story & Description (7 Cols) -->
            <div class="lg:col-span-8 space-y-6">
                <h3 class="text-2xl font-black uppercase tracking-tight text-[#ff5722] border-b-2 border-dashed border-slate-300 pb-2">
                    // Latar Belakang & Implementasi
                </h3>
                <p class="text-base sm:text-lg md:text-xl font-bold text-slate-800 leading-relaxed whitespace-pre-line text-justify font-sans">
                    {{ $project->description }}
                </p>
            </div>
            
            <!-- Right Editorial specs: Spec Side Box (4 Cols) -->
            <div class="lg:col-span-4 bg-[#ff5722] border-4 border-black p-6 sm:p-8 shadow-[8px_8px_0px_#000000] text-black sticky top-28 space-y-6">
                <span class="block text-[10px] font-black uppercase tracking-widest text-black/60">// ARSIP SPESIFIKASI PROYEK</span>
                
                <div class="space-y-4 font-bold text-[10px] uppercase text-black">
                    <div class="pb-3 border-b border-black/20">
                        <span class="block text-[9px] font-extrabold text-black/60 mb-0.5">Pembuat Aplikasi:</span>
                        <span class="text-sm font-black text-black">{{ $project->user->name }}</span>
                    </div>

                    <div class="pb-3 border-b border-black/20">
                        <span class="block text-[9px] font-extrabold text-black/60 mb-0.5">Tipe Lisensi:</span>
                        <span class="text-sm font-black text-black">Open-Source / MIT Licence</span>
                    </div>

                    @if($project->project_link)
                        <div class="pt-2">
                            <a href="{{ $project->project_link }}" target="_blank" rel="noopener noreferrer" 
                               class="w-full brutal-btn text-center block py-4 text-xs font-black uppercase tracking-widest shadow-[4px_4px_0px_#000000] hover:shadow-[5px_5px_0px_#000000] hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                                KUNJUNGI PROYEK LIVE &rarr;
                            </a>
                        </div>
                    @else
                        <div class="pb-3">
                            <span class="block text-[9px] font-extrabold text-black/60 mb-0.5">Tipe Akses:</span>
                            <span class="text-xs font-black text-black italic bg-black text-[#ff5722] px-2 py-0.5 border border-black inline-block mt-0.5">// INTERNAL ENTERPRISE</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Section 4: Asymmetric Visual Grid of Mockup Gallery (Ultra-Large Layout) -->
        @if($project->images->isNotEmpty())
            <div class="space-y-12 md:space-y-20 pt-10 border-t-4 border-black">
                
                <!-- Section Header -->
                <div class="max-w-2xl">
                    <span class="text-xxs font-black uppercase tracking-widest text-[#ff5722]">// DOKUMENTASI VISUAL & DESAIN</span>
                    <h3 class="text-3xl sm:text-4xl font-black uppercase tracking-tighter text-black mt-2">
                        Galeri Antarmuka & Tangkapan Layar {{ $project->title }}
                    </h3>
                </div>

                <!-- Dynamic CSS Grid of Gallery Mockups -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 items-stretch">
                    @foreach($project->images as $img)
                        @php
                            // Set dynamic grid card configurations based on col_span parameter
                            $gridClass = 'col-span-12'; // default col_span = 3 full-width
                            $aspectClass = 'aspect-video';
                            $shadowClass = 'shadow-[8px_8px_0px_#000000]';
                            
                            if ($img->col_span == 2) {
                                $gridClass = 'col-span-12 md:col-span-8'; // wide card 2/3 width
                                $shadowClass = 'shadow-[6px_6px_0px_#000000]';
                            } elseif ($img->col_span == 1) {
                                $gridClass = 'col-span-12 md:col-span-4'; // regular card 1/3 width
                                $shadowClass = 'shadow-[4px_4px_0px_#000000]';
                            }
                        @endphp
                        
                        <div class="{{ $gridClass }} bg-white border-4 border-black p-3.5 {{ $shadowClass }} group overflow-hidden relative flex flex-col justify-between">
                            <div class="w-full h-full min-h-[220px] bg-slate-50 border-2 border-black overflow-hidden relative cursor-zoom-in"
                                 onclick="openZoomModal('{{ asset('storage/' . $img->image_path) }}')">
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="object-cover w-full h-full group-hover:scale-102 transition duration-500">
                                
                                <div class="absolute bottom-2 right-2 bg-black/85 text-white text-[8px] font-bold uppercase tracking-wider px-2 py-1 border border-black backdrop-blur-xxs select-none">
                                    ZOOM (+)
                                </div>
                            </div>
                            
                            <!-- Small mockup metadata indicator -->
                            <div class="mt-2.5 flex items-center justify-between font-mono text-[9px] uppercase tracking-wide text-slate-500 font-bold select-none">
                                <span>// MOCKUP BLOCK {{ $loop->iteration }}</span>
                                <span>SPAN: {{ $img->col_span }}X</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Section 5: Minimalist strategic whitespace call-to-action -->
        <div class="border-t-4 border-black pt-16 md:pt-24 text-center max-w-xl mx-auto space-y-6">
            <span class="text-xxs font-black text-slate-500 uppercase tracking-widest">// SELESAI / AKHIR DARI ARSIP</span>
            <p class="text-sm font-bold text-slate-600 uppercase tracking-wider leading-relaxed">
                Terima kasih telah meninjau detail implementasi studi kasus proyek kami. Silakan kembali ke beranda untuk menjelajahi portofolio keahlian lainnya.
            </p>
            <div>
                <a href="{{ route('home') }}#projects" class="inline-block px-6 py-3 border-3 border-black text-xs font-black uppercase tracking-widest bg-black text-[#ff5722] hover:bg-[#ff5722] hover:text-black shadow-[4px_4px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                    Kembali Ke Portofolio Utama &rarr;
                </a>
            </div>
        </div>

    </div>
</section>

<!-- Click-to-Zoom High-Fidelity Modal Overlay -->
<div id="zoom-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/90 backdrop-blur-xs hidden opacity-0 transition-all duration-300">
    <div class="bg-white border-4 border-black p-3.5 max-w-5xl w-full shadow-[12px_12px_0px_#000000] scale-95 transition-all duration-300 relative flex flex-col items-center justify-center" id="zoom-modal-card">
        <!-- Close button brutalist -->
        <button type="button" onclick="closeZoomModal()" class="absolute -top-3.5 -right-3.5 w-8.5 h-8.5 bg-[#ff5722] text-black border-2 border-black font-black uppercase text-base flex items-center justify-center shadow-[2px_2px_0px_#000000] hover:bg-black hover:text-white transition select-none cursor-pointer">
            &times;
        </button>
        <!-- Large Image -->
        <div class="w-full max-h-[82vh] overflow-hidden border-2 border-black bg-slate-50">
            <img id="zoom-modal-image" src="" class="w-full h-full object-contain">
        </div>
        <div class="mt-2.5 text-xxs font-black uppercase tracking-widest text-slate-500 self-start">
            // Tampilan Foto Resolusi Tinggi
        </div>
    </div>
</div>

<script>
    // Click-to-zoom dynamic modal logic
    const zModal = document.getElementById('zoom-modal');
    const zModalCard = document.getElementById('zoom-modal-card');
    const zModalImg = document.getElementById('zoom-modal-image');

    function openZoomModal(imageSrc) {
        if (!zModal || !zModalImg) return;
        zModalImg.src = imageSrc;
        zModal.classList.remove('hidden');
        setTimeout(() => {
            zModal.classList.remove('opacity-0');
            zModalCard.classList.remove('scale-95');
        }, 10);
    }

    function closeZoomModal() {
        if (!zModal) return;
        zModal.classList.add('opacity-0');
        zModalCard.classList.add('scale-95');
        setTimeout(() => {
            zModal.classList.add('hidden');
            zModalImg.src = '';
        }, 300);
    }

    // Dismiss on overlay click
    if (zModal) {
        zModal.addEventListener('click', (e) => {
            if (e.target === zModal) closeZoomModal();
        });
    }
</script>
@endsection
