@extends('layouts.public')

@section('content')
<!-- Modern Project Detail Section -->
<section class="py-24 md:py-36 bg-gradient-to-b from-accent-50/40 via-white to-white min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 md:space-y-16">
        
        <!-- Back Navigation & Category Pill -->
        <div class="flex items-center justify-between pb-6 border-b border-slate-200/80">
            <a href="{{ route('home') }}#projects" class="inline-flex items-center gap-2 px-5 py-2 rounded-full border border-slate-200 bg-white hover:border-accent-500 hover:text-accent-500 text-xs font-semibold text-slate-700 shadow-sm transition-all duration-150">
                &larr; Back to Portfolio
            </a>
            
            <span class="text-xs font-bold uppercase tracking-wider text-accent-500">
                CASE STUDY
            </span>
        </div>

        <!-- Hero Header: Title & Badges -->
        <div class="space-y-4">
            <div class="flex flex-wrap items-center gap-2">
                @forelse ($project->badges as $badge)
                    <span class="px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase inline-block border"
                          style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }}; border-color: rgba(0,0,0,0.06);">
                        {{ $badge->name }}
                    </span>
                @empty
                    <span class="px-3 py-1 rounded-full bg-accent-50 text-accent-600 text-xs font-bold tracking-wider uppercase border border-accent-200">
                        UI/UX & Web
                    </span>
                @endforelse
            </div>

            <h1 class="text-4xl sm:text-5xl md:text-6xl font-black text-slate-950 tracking-tight leading-tight">
                {{ $project->title }}
            </h1>
        </div>

        <!-- Main Cover Image Banner -->
        <div class="relative rounded-3xl overflow-hidden shadow-xl border border-slate-200/80 group">
            @php
                $mainImg = ($project->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($project->image_path)) 
                    ? asset('storage/' . $project->image_path) 
                    : 'https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?auto=format&fit=crop&w=1400&q=80';
            @endphp
            <div class="w-full h-[45vh] sm:h-[60vh] md:h-[70vh] bg-slate-100 overflow-hidden relative cursor-zoom-in"
                 onclick="openZoomModal('{{ $mainImg }}')">
                <img src="{{ $mainImg }}" 
                     alt="{{ $project->title }}" 
                     class="object-cover w-full h-full group-hover:scale-102 transition-transform duration-500">
                
                <div class="absolute bottom-4 right-4 bg-black/60 backdrop-blur-md text-white text-xs font-semibold px-4 py-2 rounded-full flex items-center gap-1.5 select-none">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                    </svg>
                    Click to Zoom
                </div>
            </div>
        </div>

        <!-- Description & Meta Specs Split -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start pt-6">
            <!-- Left: Description / Story -->
            <div class="lg:col-span-8 space-y-6">
                <h2 class="text-2xl font-extrabold text-slate-950 tracking-tight">
                    Project Overview & Solution
                </h2>
                <div class="prose prose-slate max-w-none text-base sm:text-lg text-slate-600 leading-relaxed font-normal whitespace-pre-line">
                    {{ $project->description }}
                </div>
            </div>
            
            <!-- Right: Meta Specs Sidebar Card -->
            <div class="lg:col-span-4 bg-white rounded-3xl border border-slate-200/80 p-8 shadow-sm space-y-6 sticky top-28">
                <span class="text-xs font-bold uppercase tracking-wider text-accent-500 block">
                    PROJECT SPECIFICATIONS
                </span>
                
                <div class="space-y-4 text-xs font-medium text-slate-600">
                    <div class="pb-3 border-b border-slate-100">
                        <span class="block text-slate-400 mb-1">Author / Lead:</span>
                        <span class="text-sm font-bold text-slate-900">{{ $project->user->name ?? 'Ethan Ward' }}</span>
                    </div>

                    <div class="pb-3 border-b border-slate-100">
                        <span class="block text-slate-400 mb-1">Role & Focus:</span>
                        <span class="text-sm font-bold text-slate-900">{{ $project->user->title ?? 'UI/UX & Frontend' }}</span>
                    </div>

                    @if($project->project_link)
                        <div class="pt-2">
                            <a href="{{ $project->project_link }}" target="_blank" rel="noopener noreferrer" 
                               class="w-full inline-flex items-center justify-center gap-2 py-3 px-6 rounded-full bg-accent-500 hover:bg-accent-600 text-white font-semibold text-xs sm:text-sm shadow-md shadow-accent-500/25 transition-all">
                                Visit Live Project
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    @else
                        <div class="pb-3">
                            <span class="block text-slate-400 mb-1">Access:</span>
                            <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-3 py-1 rounded-full inline-block">Internal Confidential Case Study</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Mockup Gallery (If available) -->
        @if($project->images->isNotEmpty())
            <div class="space-y-8 pt-12 border-t border-slate-100">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-accent-500 block">
                        VISUAL DOCUMENTATION
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-950 tracking-tight mt-1">
                        Interface Gallery & Screens
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    @foreach($project->images as $img)
                        @php
                            $gridClass = 'col-span-12';
                            if ($img->col_span == 2) {
                                $gridClass = 'col-span-12 md:col-span-8';
                            } elseif ($img->col_span == 1) {
                                $gridClass = 'col-span-12 md:col-span-4';
                            }
                        @endphp
                        
                        <div class="{{ $gridClass }} bg-white rounded-3xl border border-slate-200/80 p-3 shadow-sm group overflow-hidden">
                            <div class="w-full h-full min-h-[260px] rounded-2xl overflow-hidden relative cursor-zoom-in"
                                 onclick="openZoomModal('{{ asset('storage/' . $img->image_path) }}')">
                                <img src="{{ asset('storage/' . $img->image_path) }}" 
                                     alt="Mockup Screen"
                                     class="object-cover w-full h-full group-hover:scale-103 transition-transform duration-500">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Bottom Return CTA -->
        <div class="pt-16 text-center space-y-4">
            <p class="text-sm text-slate-500">
                Interested in discovering more case studies or collaborating on a new product?
            </p>
            <div>
                <a href="{{ route('home') }}#projects" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-slate-900 hover:bg-accent-500 text-white font-semibold text-sm transition-all duration-200 shadow-sm">
                    Back to All Projects &rarr;
                </a>
            </div>
        </div>

    </div>
</section>

<!-- Zoom Modal Component -->
<div id="zoom-modal" class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md hidden items-center justify-center p-4" onclick="closeZoomModal()">
    <button class="absolute top-6 right-6 text-white/80 hover:text-white p-3 rounded-full bg-white/10" aria-label="Close modal">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <img id="zoom-modal-img" src="" alt="Zoomed view" class="max-w-[90vw] max-h-[85vh] object-contain rounded-2xl shadow-2xl">
</div>

<script>
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
