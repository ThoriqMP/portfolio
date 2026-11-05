@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200/80">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">Portofolio Proyek</h1>
            <p class="text-slate-500 font-medium text-sm mt-1">Kelola portofolio karya, foto thumbnail utama, dan slide carousel interaktif.</p>
        </div>
        <div>
            <a href="{{ route('admin.projects.create') }}" class="brutal-btn-admin text-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Tambah Proyek Baru</span>
            </a>
        </div>
    </div>

    <!-- Projects Card Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($projects as $project)
            <div class="bg-white rounded-3xl border border-slate-200/90 p-5 sm:p-6 shadow-xs hover:shadow-lg hover:-translate-y-1 transition duration-200 flex flex-col h-full justify-between group">
                <div>
                    <!-- Image Thumbnail Preview Area -->
                    <div class="relative aspect-video rounded-2xl overflow-hidden bg-slate-100 border border-slate-200/90 mb-5 shadow-inner">
                        @if ($project->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($project->image_path))
                            <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}" class="object-cover w-full h-full group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full bg-slate-100 flex flex-col items-center justify-center text-slate-400 gap-1.5 p-4 text-center">
                                <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                <span class="text-xs font-semibold text-slate-400">Belum Ada Thumbnail</span>
                            </div>
                        @endif

                        <!-- Floating Badges on Image -->
                        <div class="absolute top-2.5 left-2.5 right-2.5 flex items-center justify-between pointer-events-none">
                            <span class="px-2.5 py-1 rounded-lg bg-slate-950/80 backdrop-blur-md text-white text-[10px] font-bold tracking-wider uppercase shadow-xs">
                                Grid {{ $project->grid_span }}x
                            </span>
                            @if($project->images && $project->images->count() > 0)
                                <span class="px-2.5 py-1 rounded-lg bg-white/90 backdrop-blur-md text-slate-800 text-[10px] font-bold shadow-xs flex items-center gap-1">
                                    <svg class="w-3 h-3 text-[#FF4D2D]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    {{ $project->images->count() }} Slide
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Card Details -->
                    <div class="space-y-2">
                        <h3 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight group-hover:text-[#FF4D2D] transition leading-snug">
                            {{ $project->title }}
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed line-clamp-3">
                            {{ $project->description }}
                        </p>

                        <!-- External Link if exists -->
                        @if ($project->project_link)
                            <div class="pt-1">
                                <a href="{{ $project->project_link }}" target="_blank" class="text-xs font-semibold text-blue-600 hover:text-blue-700 hover:underline inline-flex items-center gap-1">
                                    <span>Kunjungi Tautan</span>
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions Footer inside card -->
                <div class="pt-4 mt-5 border-t border-slate-100 flex items-center justify-between gap-2">
                    <a href="{{ route('projects.show', $project->id) }}" target="_blank" 
                       class="text-xs font-medium text-slate-400 hover:text-slate-800 transition inline-flex items-center gap-1"
                       title="Lihat Halaman Detail Publik">
                        <span>Lihat Publik</span>
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                    </a>

                    <div class="flex items-center gap-2">
                        <!-- Edit Button -->
                        <a href="{{ route('admin.projects.edit', $project->id) }}" 
                           class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold transition shadow-xs flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            <span>Edit</span>
                        </a>

                        <!-- Delete Button -->
                        <button type="button" 
                                onclick="triggerDelete('{{ route('admin.projects.destroy', $project->id) }}', '{{ addslashes($project->title) }}')" 
                                class="px-3 py-1.5 rounded-xl border border-rose-100 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-semibold transition shadow-xs flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            <span>Hapus</span>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 bg-white rounded-3xl border-2 border-dashed border-slate-200 p-8">
                <div class="w-16 h-16 rounded-2xl bg-orange-50 border border-orange-100 text-[#FF4D2D] mx-auto mb-3 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-800">Belum Ada Proyek Portofolio</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Mulai bangun portofolio Anda dengan menambahkan proyek pertama.</p>
                <div class="mt-5">
                    <a href="{{ route('admin.projects.create') }}" class="brutal-btn-admin text-xs">
                        + Tambah Proyek Pertama
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection