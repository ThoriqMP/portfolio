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

        <!-- ======================================================== -->
        <!-- FOTO UTAMA & CAROUSEL MINI (SHOWCASE MEDIA PROYEK)      -->
        <!-- ======================================================== -->
        @php
            $carouselSlides = $slides ?? $project->carousel_slides;
            $allGalleryItems = collect();

            // Check if thumbnail_url is already in carouselSlides
            $hasCoverInSlides = $carouselSlides->contains(function ($slide) use ($project) {
                return ($slide['url'] ?? '') === $project->thumbnail_url || !empty($slide['is_cover']);
            });

            if (!$hasCoverInSlides && !empty($project->thumbnail_url)) {
                $allGalleryItems->push([
                    'url' => $project->thumbnail_url,
                    'badge' => 'Cover Proyek',
                    'title' => 'Cover Utama Proyek',
                    'is_cover' => true,
                ]);
            }

            foreach ($carouselSlides as $idx => $slide) {
                $isCover = !empty($slide['is_cover']) || ($slide['url'] === $project->thumbnail_url && $allGalleryItems->isEmpty());
                $allGalleryItems->push([
                    'url' => $slide['url'],
                    'badge' => $isCover ? 'Cover Proyek' : 'Dokumentasi ' . ($allGalleryItems->count() + 1),
                    'title' => $isCover ? 'Cover Proyek' : 'Dokumentasi Proyek #' . ($allGalleryItems->count() + 1),
                    'is_cover' => $isCover,
                ]);
            }

            if ($allGalleryItems->isEmpty()) {
                $allGalleryItems->push([
                    'url' => $project->thumbnail_url,
                    'badge' => 'Cover Proyek',
                    'title' => 'Cover Utama Proyek',
                    'is_cover' => true,
                ]);
            }

            $firstItem = $allGalleryItems->first();
        @endphp

        <div class="space-y-3">
            <div class="flex items-center justify-between px-1">
                <span class="text-xs font-extrabold uppercase tracking-widest text-slate-500">
                    // FOTO &amp; DOKUMENTASI PROYEK
                </span>
                <div class="flex items-center gap-2">
                    @if ($allGalleryItems->count() > 1)
                        <span class="text-[11px] font-semibold text-slate-500 hidden sm:inline-block">
                            {{ $allGalleryItems->count() }} Foto Galeri
                        </span>
                    @endif
                    <span id="active-badge-indicator" class="text-[11px] font-bold text-accent-600 bg-accent-50 px-3 py-0.5 rounded-full border border-accent-200 transition-all">
                        {{ $firstItem['badge'] }}
                    </span>
                </div>
            </div>

            <!-- Paper Card Container -->
            <div class="paper-card p-3 sm:p-4 bg-white overflow-hidden relative space-y-3 sm:space-y-4">
                
                <!-- Main Large Display Frame -->
                <div id="project-main-display" class="relative w-full h-[38vh] sm:h-[50vh] md:h-[62vh] min-h-[300px] max-h-[720px] bg-slate-950 rounded-2xl overflow-hidden select-none group flex items-center justify-center">
                    
                    <!-- Main Display Image with Smooth Fade Transition -->
                    <img id="main-display-img"
                         src="{{ $firstItem['url'] }}" 
                         alt="{{ $project->title }}" 
                         class="w-full h-full object-contain md:object-cover transition-opacity duration-300 cursor-zoom-in"
                         onclick="openActiveZoom()">
                    
                    <!-- Vignette Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-black/20 pointer-events-none"></div>

                    <!-- Top Left: Current Slide Pill -->
                    <div class="absolute top-4 left-4 z-20 flex items-center gap-2">
                        <span id="main-slide-badge" class="px-3 py-1 rounded-full bg-black/60 backdrop-blur-md border border-white/10 text-white text-[11px] sm:text-xs font-bold tracking-wide shadow-sm">
                            {{ $firstItem['badge'] }}
                        </span>
                    </div>

                    <!-- Top Right: Slide Counter (if > 1 items) -->
                    @if ($allGalleryItems->count() > 1)
                        <div class="absolute top-4 right-4 z-20 bg-black/60 backdrop-blur-md border border-white/20 text-white text-xs font-bold px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm">
                            <svg class="w-3.5 h-3.5 text-accent-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span id="slide-counter-current">1</span>
                            <span class="text-white/50">/</span>
                            <span>{{ $allGalleryItems->count() }}</span>
                        </div>
                    @endif

                    <!-- Bottom Right: Click to Zoom CTA -->
                    <button type="button" 
                            onclick="openActiveZoom()"
                            class="absolute bottom-4 right-4 z-20 bg-black/60 hover:bg-black/85 backdrop-blur-md text-white text-xs font-semibold px-3.5 py-1.5 sm:px-4 sm:py-2 rounded-full flex items-center gap-1.5 transition-all shadow-sm active:scale-95 cursor-pointer border border-white/10">
                        <svg class="w-3.5 h-3.5 text-accent-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                        </svg>
                        <span>Perbesar Foto (+)</span>
                    </button>

                    <!-- Navigation Arrows (If > 1 items) -->
                    @if ($allGalleryItems->count() > 1)
                        <button type="button" 
                                id="showcase-prev-btn" 
                                class="absolute left-3 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-black/50 hover:bg-accent-500 text-white backdrop-blur-md border border-white/20 flex items-center justify-center transition-all duration-200 shadow-xl opacity-90 sm:opacity-0 group-hover:opacity-100 hover:scale-105 active:scale-95 cursor-pointer"
                                aria-label="Foto Sebelumnya">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        <button type="button" 
                                id="showcase-next-btn" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-black/50 hover:bg-accent-500 text-white backdrop-blur-md border border-white/20 flex items-center justify-center transition-all duration-200 shadow-xl opacity-90 sm:opacity-0 group-hover:opacity-100 hover:scale-105 active:scale-95 cursor-pointer"
                                aria-label="Foto Selanjutnya">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    @endif
                </div>

                <!-- Compact Carousel Strip Directly Underneath Main Photo -->
                @if ($allGalleryItems->count() > 1)
                    <div class="pt-2 sm:pt-3 border-t border-paper-200">
                        <div class="flex items-center justify-between mb-2 px-1">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-accent-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-700">
                                    Carousel Foto &amp; Dokumentasi
                                </span>
                            </div>
                            <span class="text-[10px] sm:text-[11px] font-medium text-slate-400">
                                Klik thumbnail untuk menampilkan foto di atas
                            </span>
                        </div>

                        <!-- Horizontal scrollable strip of small cards -->
                        <div class="relative flex items-center">
                            <div id="carousel-strip" class="flex items-center gap-2.5 overflow-x-auto py-1 px-0.5 scrollbar-thin scrollbar-thumb-slate-300 w-full scroll-smooth">
                                @foreach ($allGalleryItems as $idx => $item)
                                    <button type="button"
                                            class="carousel-thumb relative shrink-0 w-20 h-13 sm:w-24 sm:h-16 md:w-28 md:h-18 rounded-xl overflow-hidden border-2 transition-all duration-200 cursor-pointer group/thumb {{ $idx === 0 ? 'border-accent-500 ring-2 ring-accent-500/40 opacity-100 scale-102 shadow-xs' : 'border-paper-300 opacity-60 hover:opacity-100 hover:border-slate-400' }}"
                                            data-thumb-index="{{ $idx }}"
                                            title="{{ $item['title'] }}"
                                            aria-label="{{ $item['title'] }}">
                                        <img src="{{ $item['url'] }}" 
                                             alt="{{ $item['title'] }}" 
                                             class="w-full h-full object-cover">
                                        
                                        @if($item['is_cover'])
                                            <div class="absolute bottom-0 inset-x-0 bg-accent-500/90 text-white text-[9px] font-bold uppercase py-0.5 text-center leading-none tracking-wider">
                                                Cover
                                            </div>
                                        @else
                                            <div class="absolute bottom-0 inset-x-0 bg-black/60 backdrop-blur-xs text-white text-[9px] font-bold py-0.5 text-center leading-none">
                                                #{{ $idx + 1 }}
                                            </div>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <!-- ======================================================== -->
        <!-- DESKRIPSI & SPESIFIKASI PROYEK                           -->
        <!-- ======================================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start pt-2">
            <!-- Left: Description / Story (Article Format) -->
            <div class="lg:col-span-8 space-y-4">
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                    Deskripsi &amp; Ruang Lingkup Proyek
                </h2>
                <div class="article-body text-base text-slate-700 leading-relaxed font-normal">
                    @if (strip_tags($project->description) !== $project->description)
                        <div class="article-content space-y-4">
                            {!! $project->description !!}
                        </div>
                    @else
                        <div class="whitespace-pre-line leading-relaxed text-slate-700">
                            {!! nl2br(e($project->description)) !!}
                        </div>
                    @endif
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
    // Gallery items data
    const galleryItems = @json($allGalleryItems->values());
    let currentIndex = 0;
    const totalItems = galleryItems.length;

    const mainDisplayImg = document.getElementById('main-display-img');
    const mainSlideBadge = document.getElementById('main-slide-badge');
    const activeBadgeIndicator = document.getElementById('active-badge-indicator');
    const counterCurrent = document.getElementById('slide-counter-current');
    const thumbs = document.querySelectorAll('.carousel-thumb');

    function updateDisplay(index) {
        if (!totalItems || !galleryItems[index]) return;

        // Wrap around
        if (index < 0) {
            currentIndex = totalItems - 1;
        } else if (index >= totalItems) {
            currentIndex = 0;
        } else {
            currentIndex = index;
        }

        const item = galleryItems[currentIndex];

        // Smooth image swap with micro-fade
        if (mainDisplayImg) {
            mainDisplayImg.style.opacity = '0.35';
            setTimeout(() => {
                mainDisplayImg.src = item.url;
                mainDisplayImg.alt = item.title || 'Foto Proyek';
                mainDisplayImg.style.opacity = '1';
            }, 120);
        }

        // Update badges
        if (mainSlideBadge) {
            mainSlideBadge.textContent = item.badge || 'Foto Proyek';
        }
        if (activeBadgeIndicator) {
            activeBadgeIndicator.textContent = item.badge || 'Foto Proyek';
        }

        // Update counter
        if (counterCurrent) {
            counterCurrent.textContent = currentIndex + 1;
        }

        // Update thumbnails active styling
        thumbs.forEach((thumb, i) => {
            if (i === currentIndex) {
                thumb.classList.remove('border-paper-300', 'opacity-60');
                thumb.classList.add('border-accent-500', 'ring-2', 'ring-accent-500/40', 'opacity-100', 'scale-102', 'shadow-xs');
                thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            } else {
                thumb.classList.remove('border-accent-500', 'ring-2', 'ring-accent-500/40', 'opacity-100', 'scale-102', 'shadow-xs');
                thumb.classList.add('border-paper-300', 'opacity-60');
            }
        });
    }

    function nextSlide() {
        updateDisplay(currentIndex + 1);
    }

    function prevSlide() {
        updateDisplay(currentIndex - 1);
    }

    // Bind prev / next buttons
    const prevBtn = document.getElementById('showcase-prev-btn');
    const nextBtn = document.getElementById('showcase-next-btn');

    if (prevBtn) prevBtn.addEventListener('click', prevSlide);
    if (nextBtn) nextBtn.addEventListener('click', nextSlide);

    // Bind thumbnail click
    thumbs.forEach((thumb) => {
        thumb.addEventListener('click', () => {
            const idx = parseInt(thumb.getAttribute('data-thumb-index'), 10);
            updateDisplay(idx);
        });
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            prevSlide();
        } else if (e.key === 'ArrowRight') {
            nextSlide();
        } else if (e.key === 'Escape') {
            closeZoomModal();
        }
    });

    // Touch swipe on mobile
    const displayEl = document.getElementById('project-main-display');
    if (displayEl) {
        let touchStartX = 0;
        let touchEndX = 0;

        displayEl.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        displayEl.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            const diff = touchEndX - touchStartX;
            if (Math.abs(diff) > 40) {
                if (diff < 0) {
                    nextSlide();
                } else {
                    prevSlide();
                }
            }
        }, { passive: true });
    }

    // Zoom modal functions
    function openActiveZoom() {
        if (galleryItems[currentIndex]) {
            openZoomModal(galleryItems[currentIndex].url);
        }
    }

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

    // Attach click-to-zoom to any inline article images
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.article-content img').forEach(img => {
            img.addEventListener('click', function () {
                openZoomModal(this.src);
            });
        });
    });
</script>

<style>
    .article-content {
        color: #334155;
        font-size: 1rem;
        line-height: 1.8;
    }
    .article-content p {
        margin-bottom: 1.25rem;
    }
    .article-content h2 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.02em;
        margin-top: 2rem;
        margin-bottom: 0.75rem;
    }
    .article-content h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        letter-spacing: -0.01em;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
    }
    .article-content ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 1.25rem;
    }
    .article-content ol {
        list-style-type: decimal;
        padding-left: 1.5rem;
        margin-bottom: 1.25rem;
    }
    .article-content li {
        margin-bottom: 0.35rem;
    }
    .article-content blockquote {
        border-left: 4px solid #FF4D2D;
        padding: 0.85rem 1.25rem;
        margin: 1.5rem 0;
        background-color: #fff8f5;
        border-radius: 0 14px 14px 0;
        color: #475569;
        font-style: italic;
    }
    .article-content pre {
        background-color: #0f172a;
        color: #e2e8f0;
        padding: 1rem 1.25rem;
        border-radius: 12px;
        overflow-x: auto;
        font-size: 0.875rem;
        margin: 1.25rem 0;
    }
    .article-content a {
        color: #FF4D2D;
        text-decoration: underline;
        font-weight: 600;
        transition: color 0.15s;
    }
    .article-content a:hover {
        color: #e63d1f;
    }
    .article-content img {
        display: block;
        width: 100%;
        max-width: 100%;
        height: auto;
        max-height: 580px;
        object-fit: cover;
        border-radius: 1rem;
        margin: 1.75rem 0;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(226, 232, 240, 0.85);
        cursor: zoom-in;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .article-content img:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.12), 0 8px 10px -6px rgba(0, 0, 0, 0.06);
    }
</style>
@endsection
