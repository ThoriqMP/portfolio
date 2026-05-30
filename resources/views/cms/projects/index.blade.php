@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b-4 border-black">
        <div>
            <h1 class="text-4xl font-black uppercase tracking-tighter text-black">Portofolio Proyek</h1>
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">// Kelola proyek Anda dalam tampilan kartu brutalist.</p>
        </div>
        <div>
            <a href="{{ route('admin.projects.create') }}" class="brutal-btn-admin inline-flex items-center gap-2 px-5 py-3 text-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Proyek Baru
            </a>
        </div>
    </div>

    <!-- Projects Card Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($projects as $project)
            <div class="bg-white border-4 border-black p-6 shadow-[6px_6px_0px_#000000] hover:shadow-[10px_10px_0px_#000000] hover:-translate-x-1 hover:-translate-y-1 transition duration-150 flex flex-col h-full justify-between">
                <!-- Image Area -->
                <div class="relative aspect-video overflow-hidden bg-slate-100 border-4 border-black shadow-[3px_3px_0px_#000000] mb-6">
                    @if ($project->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($project->image_path))
                        <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}" class="object-cover w-full h-full">
                    @else
                        <div class="w-full h-full bg-[#ff5722] flex items-center justify-center font-black uppercase text-xs tracking-widest text-black border border-black">
                            Tanpa Gambar
                        </div>
                    @endif
                </div>

                <!-- Card Details -->
                <div class="flex-grow flex flex-col">
                    <h3 class="text-xl font-black uppercase tracking-tight text-black mb-3">{{ $project->title }}</h3>
                    <p class="text-sm font-bold text-slate-700 leading-relaxed flex-grow mb-6">{{ $project->description }}</p>

                    <!-- Link Info if exists -->
                    @if ($project->project_link)
                        <div class="mb-4">
                            <span class="text-xxs font-black uppercase text-slate-400 block mb-1">Link Eksternal</span>
                            <a href="{{ $project->project_link }}" target="_blank" class="text-xs font-black uppercase text-blue-600 hover:underline flex items-center gap-1">
                                Kunjungi Tautan
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Actions Footer inside card -->
                <div class="pt-4 border-t-2 border-black flex items-center justify-between gap-3 mt-auto">
                    <span class="px-2 py-0.5 bg-black text-[#ff5722] text-xxs font-black uppercase">GRID: {{ $project->grid_span }}X</span>

                    <div class="inline-flex gap-2">
                        <!-- Edit -->
                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="px-3 py-1.5 border-2 border-black bg-white hover:bg-blue-100 text-black text-xs font-black uppercase shadow-[2px_2px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition duration-100 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            Edit
                        </a>
                        <!-- Delete -->
                        <button type="button" onclick="triggerDelete('{{ route('admin.projects.destroy', $project->id) }}', '{{ addslashes($project->title) }}')" class="px-3 py-1.5 border-2 border-black bg-[#ff5722] hover:bg-orange-600 text-black text-xs font-black uppercase shadow-[2px_2px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition duration-100 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 bg-white border-4 border-dashed border-slate-350 p-8 shadow-[4px_4px_0px_#000000]">
                <p class="font-black uppercase tracking-wider text-slate-500">// Belum ada proyek. Silakan tambahkan proyek baru.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
