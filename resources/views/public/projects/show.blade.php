@extends('layouts.public')

@section('content')
<!-- Project Detail Section (Paper Aesthetic) -->
<section class="py-24 md:py-36 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-14">
        
        <!-- Back Navigation & Category Pill -->
        <div class="flex items-center justify-between pb-5 border-b border-paper-300">
            <a href="{{ route('home') }}#projects" class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-paper-300 bg-white hover:border-accent-500 hover:text-accent-500 text-xs font-semibold text-slate-700 shadow-2xs transition-colors">
                &larr; Kembali ke Portofolio
            </a>
            
            <span class="text-xs font-bold uppercase tracking-wider text-accent-500">
                STUDI KASUS PROYEK
            </span>
        </div>

        <!-- Header: Title & Badges -->
        <div class="space-y-3">
            <div class="flex flex-wrap items-center gap-2">
                @forelse ($project->badges as $badge)
                    <span class="px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase inline-block border"
                          style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }}; border-color: rgba(0,0,0,0.06);">
                        {{ $badge->name }}
                    </span>
                @empty
                    <span class="px-3 py-1 rounded-full bg-accent-50 text-accent-600 text-xs font-bold tracking-wider uppercase border border-accent-200">
                        Web Application
                    </span>
                @endforelse
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                {{ $project->title }}
            </h1>
        </div>

        <!-- ========================================== -->
        <!-- PHOTO CAROUSEL / SLIDESHOW COMPONENT (MVC) -->
        <!-- ========================================== -->
        @php
            $carouselSlides = $slides ?? $project->carousel_slides;
        @endphp

        <div class="space-y-4">
            <!-- Carousel Main Box -->
            <div class="paper-card p-3 sm:p-4 bg-white overflow-hidden relative">
                @if ($carouselSlides->isNotEmpty())
                    <div id="project-carousel" class="relative w-full h-[45vh] sm:h-[60vh] md:h-[68vh] min-h-[320px] bg-slate-950 rounded-2xl overflow-hidden select-none group">
                        
                        <!-- Slides Track -->
                        <div id="carousel-track" class="relative w-full h-full">
                            @foreach ($carouselSlides as $idx => $slide)
                                <div class="carousel-slide absolute inset-0 w-full h-full flex items-center justify-center transition-all duration-500 ease-out {{ $idx === 0 ? 'opacity-100 z-10 scale-100' : 'opacity-0 z-0 scale-98 pointer-events-none' }}"
                                     data-slide-index="{{ $idx }}"
                                     data-slide-url="{{ $slide['url'] }}">
                                    <img src="{{ $slide['url'] }}" 
                                         alt="{{ $project->title }} - Slide {{ $idx + 1 }}" 
                                         class="w-full h-full object-contain md:object-cover cursor-zoom-in transition-transform duration-700 hover:scale-101"
                                         onclick="openZoomModal('{{ $slide['url'] }}')">
                                    
                                    <!-- Subtle Vignette Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-black/20 pointer-events-none"></div>

                                    @if ($slide['is_cover'])
                                        <div class="absolute top-4 left-4 z-20">
                                            <span class="px-3 py-1 rounded-full bg-accent-500/90 backdrop-blur-md text-white text-[10px] sm:text-xs font-bold uppercase tracking-wider shadow-sm">
                                                Cover Utama
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Top Right: Slide Counter Badge -->
                        @if ($carouselSlides->count() > 1)
                            <div class="absolute top-4 right-4 z-20 bg-black/60 backdrop-blur-md border border-white/20 text-white text-xs font-bold px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm">
                                <svg class="w-3.5 h-3.5 text-accent-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span id="slide-counter-current">1</span>
                                <span class="text-white/50">/</span>
                                <span>{{ $carouselSlides->count() }}</span>
                            </div>
                        @endif

                        <!-- Bottom Right: Click to Zoom CTA -->
                        <button type="button" 
                                onclick="openCurrentSlideZoom()"
                                class="absolute bottom-4 right-4 z-20 bg-black/60 hover:bg-black/85 backdrop-blur-md text-white text-xs font-semibold px-4 py-2 rounded-full flex items-center gap-1.5 transition-all shadow-sm active:scale-95 cursor-pointer">
                            <svg class="w-3.5 h-3.5 text-accent-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                            </svg>
                            <span>Perbesar (+)</span>
                        </button>

                        <!-- Next & Previous Arrows (If multiple slides) -->
                        @if ($carouselSlides->count() > 1)
                            <button type="button" 
                                    id="carousel-prev-btn" 
                                    class="absolute left-3 sm:left-5 top-1/2 -translate-y-1/2 z-20 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-black/50 hover:bg-accent-500 text-white backdrop-blur-md border border-white/20 flex items-center justify-center transition-all duration-200 shadow-xl opacity-90 sm:opacity-0 group-hover:opacity-100 hover:scale-105 active:scale-95 cursor-pointer"
                                    aria-label="Foto Sebelumnya">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>

                            <button type="button" 
                                    id="carousel-next-btn" 
                                    class="absolute right-3 sm:right-5 top-1/2 -translate-y-1/2 z-20 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-black/50 hover:bg-accent-500 text-white backdrop-blur-md border border-white/20 flex items-center justify-center transition-all duration-200 shadow-xl opacity-90 sm:opacity-0 group-hover:opacity-100 hover:scale-105 active:scale-95 cursor-pointer"
                                    aria-label="Foto Selanjutnya">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                            <!-- Bottom Center: Indicator Dots -->
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2 bg-black/40 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/10">
                                @foreach ($carouselSlides as $idx => $slide)
                                    <button type="button" 
                                            class="carousel-dot h-2 rounded-full transition-all duration-300 cursor-pointer {{ $idx === 0 ? 'w-6 bg-accent-500' : 'w-2 bg-white/50 hover:bg-white' }}"
                                            data-dot-index="{{ $idx }}"
                                            aria-label="Menuju foto {{ $idx + 1 }}"></button>
                                @endforeach
                            </div>
                        @endif

                    </div>

                    <!-- Underneath Thumbnail Strip (Filmstrip) for Multiple Photos -->
                    @if ($carouselSlides->count() > 1)
                        <div class="pt-3 border-t border-paper-300">
                            <div class="flex items-center justify-between mb-2 px-1">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                    Galeri Foto Proyek (Klik untuk memilih)
                                </span>
                                <span class="text-[11px] font-medium text-slate-400">
                                    {{ $carouselSlides->count() }} foto tersedia &bull; Geser atau navigasi panah
                                </span>
                            </div>

                            <div class="flex items-center gap-2.5 overflow-x-auto pb-2 scrollbar-thin scrollbar-thumb-slate-300">
                                @foreach ($carouselSlides as $idx => $slide)
                                    <button type="button"
                                            class="carousel-thumb relative shrink-0 w-20 h-14 sm:w-24 sm:h-16 rounded-xl overflow-hidden border-2 transition-all duration-200 cursor-pointer {{ $idx === 0 ? 'border-accent-500 ring-2 ring-accent-500/40 scale-102' : 'border-paper-300 opacity-60 hover:opacity-100 hover:border-slate-400' }}"
                                            data-thumb-index="{{ $idx }}">
                                        <img src="{{ $slide['url'] }}" 
                                             alt="Thumbnail {{ $idx + 1 }}" 
                                             class="w-full h-full object-cover">
                                        @if ($slide['is_cover'])
                                            <span class="absolute bottom-0 inset-x-0 bg-black/70 text-[8px] font-extrabold text-accent-400 uppercase py-0.5 text-center">
                                                Cover
                                            </span>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                @else
                    <!-- Fallback Placeholder when no image exists -->
                    <div class="w-full h-[35vh] bg-paper-warm rounded-2xl flex flex-col items-center justify-center p-6 text-slate-400">
                        <svg class="w-12 h-12 text-slate-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs uppercase font-bold tracking-wider">// Tangkapan Layar Proyek</span>
                        <span class="text-base font-bold text-slate-700 mt-1">{{ $project->title }}</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Description & Meta Specs Split -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start pt-4">
            <!-- Left: Description / Story -->
            <div class="lg:col-span-8 space-y-4">
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                    Deskripsi & Ruang Lingkup Proyek
                </h2>
                <div class="prose prose-slate max-w-none text-base text-slate-700 leading-relaxed font-normal whitespace-pre-line">
                    {{ $project->description }}
                </div>
            </div>
            
            <!-- Right: Meta Specs Sidebar Card -->
            <div class="lg:col-span-4 paper-card p-6 sm:p-7 space-y-5 sticky top-28">
                <span class="text-xs font-bold uppercase tracking-wider text-accent-500 block">
                    SPESIFIKASI PROYEK
                </span>
                
                <div class="space-y-3.5 text-xs font-medium text-slate-600">
                    <div class="pb-3 border-b border-paper-300">
                        <span class="block text-slate-400 mb-0.5">Pengembang:</span>
                        <span class="text-sm font-bold text-slate-900">{{ $project->user->name ?? $user->name }}</span>
                    </div>

                    <div class="pb-3 border-b border-paper-300">
                        <span class="block text-slate-400 mb-0.5">Fokus Teknis:</span>
                        <span class="text-sm font-bold text-slate-900">{{ $project->user->title ?? 'Fullstack Web Development' }}</span>
                    </div>

                    @if($project->project_link)
                        <div class="pt-2">
                            <a href="{{ $project->project_link }}" target="_blank" rel="noopener noreferrer" 
                               class="w-full inline-flex items-center justify-center gap-2 py-3 px-6 rounded-full bg-accent-500 hover:bg-accent-600 text-white font-semibold text-xs sm:text-sm shadow-sm transition-all">
                                Buka Aplikasi Live
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    @else
                        <div class="pb-1">
                            <span class="block text-slate-400 mb-0.5">Akses:</span>
                            <span class="text-xs font-semibold text-slate-600 bg-paper-200 px-3 py-1 rounded-full inline-block">Sistem Internal / Portofolio Riil</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Bottom Return CTA -->
        <div class="pt-12 text-center space-y-3">
            <div>
                <a href="{{ route('home') }}#projects" class="inline-flex items-center gap-2 px-7 py-3 rounded-full bg-slate-900 hover:bg-accent-500 text-white font-semibold text-xs sm:text-sm transition-colors shadow-sm">
                    &larr; Kembali ke Semua Proyek
                </a>
            </div>
        </div>

    </div>
</section>

<!-- Zoom Modal Component -->
<div id="zoom-modal" class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md hidden items-center justify-center p-4" onclick="closeZoomModal()">
    <button class="absolute top-6 right-6 text-white/80 hover:text-white p-3 rounded-full bg-white/10 hover:bg-white/20 transition cursor-pointer" aria-label="Tutup modal">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <img id="zoom-modal-img" src="" alt="Zoomed view" class="max-w-[92vw] max-h-[88vh] object-contain rounded-2xl shadow-2xl" onclick="event.stopPropagation()">
</div>

<!-- Carousel & Zoom Script -->
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    const thumbs = document.querySelectorAll('.carousel-thumb');
    const counterCurrent = document.getElementById('slide-counter-current');
    const totalSlides = slides.length;

    function goToSlide(index) {
        if (totalSlides <= 1) return;
        
        // Wrap around
        if (index < 0) {
            currentSlide = totalSlides - 1;
        } else if (index >= totalSlides) {
            currentSlide = 0;
        } else {
            currentSlide = index;
        }

        // Update slides visibility
        slides.forEach((slide, i) => {
            if (i === currentSlide) {
                slide.classList.remove('opacity-0', 'pointer-events-none', 'z-0', 'scale-98');
                slide.classList.add('opacity-100', 'z-10', 'scale-100');
            } else {
                slide.classList.remove('opacity-100', 'z-10', 'scale-100');
                slide.classList.add('opacity-0', 'pointer-events-none', 'z-0', 'scale-98');
            }
        });

        // Update counter
        if (counterCurrent) {
            counterCurrent.textContent = currentSlide + 1;
        }

        // Update dots
        dots.forEach((dot, i) => {
            if (i === currentSlide) {
                dot.classList.remove('w-2', 'bg-white/50');
                dot.classList.add('w-6', 'bg-accent-500');
            } else {
                dot.classList.remove('w-6', 'bg-accent-500');
                dot.classList.add('w-2', 'bg-white/50');
            }
        });

        // Update thumbnail active ring
        thumbs.forEach((thumb, i) => {
            if (i === currentSlide) {
                thumb.classList.remove('border-paper-300', 'opacity-60');
                thumb.classList.add('border-accent-500', 'ring-2', 'ring-accent-500/40', 'scale-102', 'opacity-100');
                thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            } else {
                thumb.classList.remove('border-accent-500', 'ring-2', 'ring-accent-500/40', 'scale-102', 'opacity-100');
                thumb.classList.add('border-paper-300', 'opacity-60');
            }
        });
    }

    function nextSlide() {
        goToSlide(currentSlide + 1);
    }

    function prevSlide() {
        goToSlide(currentSlide - 1);
    }

    function openCurrentSlideZoom() {
        if (slides.length > 0 && slides[currentSlide]) {
            const url = slides[currentSlide].getAttribute('data-slide-url');
            if (url) {
                openZoomModal(url);
            }
        }
    }

    // Bind Controls
    const prevBtn = document.getElementById('carousel-prev-btn');
    const nextBtn = document.getElementById('carousel-next-btn');

    if (prevBtn) prevBtn.addEventListener('click', prevSlide);
    if (nextBtn) nextBtn.addEventListener('click', nextSlide);

    dots.forEach((dot) => {
        dot.addEventListener('click', () => {
            const idx = parseInt(dot.getAttribute('data-dot-index'), 10);
            goToSlide(idx);
        });
    });

    thumbs.forEach((thumb) => {
        thumb.addEventListener('click', () => {
            const idx = parseInt(thumb.getAttribute('data-thumb-index'), 10);
            goToSlide(idx);
        });
    });

    // Keyboard Arrow Navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            prevSlide();
        } else if (e.key === 'ArrowRight') {
            nextSlide();
        } else if (e.key === 'Escape') {
            closeZoomModal();
        }
    });

    // Touch Swipe Support for Mobile
    const carouselEl = document.getElementById('project-carousel');
    if (carouselEl) {
        let touchStartX = 0;
        let touchEndX = 0;

        carouselEl.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        carouselEl.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });

        function handleSwipe() {
            const diff = touchEndX - touchStartX;
            if (Math.abs(diff) > 45) {
                if (diff < 0) {
                    nextSlide(); // swiped left
                } else {
                    prevSlide(); // swiped right
                }
            }
        }
    }

    // Zoom Modal
    function openZoomModal(imgSrc) {
        const modal = document.getElementById('zoom-modal');
        const modalImg = document.getElementById('zoom-modal-img');
        if (modal && modalImg) {
            modalImg.src = imgSrc;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeZoomModal() {
        const modal = document.getElementById('zoom-modal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }
    }
</script>
@endsection
