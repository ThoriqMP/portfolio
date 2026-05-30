@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-3xl">
    <!-- Header -->
    <div class="pb-6 border-b-4 border-black">
        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center text-xs font-black uppercase tracking-wider text-black border-2 border-black bg-white hover:bg-[#ff5722] px-3 py-1.5 shadow-[2px_2px_0px_#000000] transition active:translate-x-0.5 active:translate-y-0.5 active:shadow-none mb-4">
            &larr; Kembali ke Proyek
        </a>
        <h1 class="text-4xl font-black uppercase tracking-tighter text-black">Edit Proyek</h1>
        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">// Perbaruilah data proyek portofolio Anda.</p>
    </div>

    @if(session()->has('draft_restored'))
        <div class="bg-[#ff5722] text-black border-4 border-black p-4 font-black text-xs uppercase tracking-wide shadow-[4px_4px_0px_#000000] mb-4">
            // {{ session('draft_restored') }}
        </div>
    @endif

    <!-- Form Card (Brutalist Box) -->
    <div class="bg-white border-4 border-black p-6 sm:p-8 shadow-[6px_6px_0px_#000000]">
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Judul Proyek</label>
                <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" placeholder="Masukkan nama atau judul proyek" required
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                @error('title')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Deskripsi Proyek</label>
                <textarea name="description" id="description" rows="5" placeholder="Tuliskan penjelasan detail mengenai latar belakang, fitur, dan teknologi proyek ini..." required
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Existing Image Preview (Brutalist card) -->
            <div>
                <span class="block text-xs font-black uppercase tracking-widest text-black mb-2">Gambar Saat Ini</span>
                <div class="w-48 aspect-video bg-slate-100 border-3 border-black flex items-center justify-center overflow-hidden shadow-[3px_3px_0px_#000000] mb-4">
                    @if ($project->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($project->image_path))
                        <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}" class="object-cover w-full h-full">
                    @else
                        <span class="text-xs font-bold text-slate-500 uppercase italic">// Tidak ada gambar</span>
                    @endif
                </div>

                <!-- Update Image -->
                <label for="image" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Ganti Gambar Utama (Thumbnail)</label>
                <div class="w-full bg-white border-3 border-black rounded-none px-4 py-4 focus-within:-translate-y-0.5 focus-within:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                    <input type="file" name="image" id="image" accept="image/*" class="text-sm text-black file:mr-4 file:py-2 file:px-4 file:rounded-none file:border-2 file:border-black file:text-xs file:font-black file:uppercase file:bg-[#ff5722] file:text-black hover:file:bg-orange-600 file:cursor-pointer cursor-pointer">
                </div>
                <p class="text-slate-500 text-xxs font-bold uppercase mt-1.5">// Biarkan kosong jika tidak ingin mengganti. Maksimal file 10MB.</p>
                @error('image')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Thumbnail Composition -->
            <div>
                <label for="thumbnail_composition" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Komposisi Layout Gambar Thumbnail</label>
                <div class="relative w-full">
                    <select name="thumbnail_composition" id="thumbnail_composition" required
                        class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold appearance-none focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150 cursor-pointer">
                        <option value="single" {{ old('thumbnail_composition', $project->thumbnail_composition) == 'single' ? 'selected' : '' }}>Tunggal (1 Gambar Utama)</option>
                        <option value="split" {{ old('thumbnail_composition', $project->thumbnail_composition) == 'split' ? 'selected' : '' }}>Split Kolase (50/50 Dual Grid)</option>
                        <option value="mosaic" {{ old('thumbnail_composition', $project->thumbnail_composition) == 'mosaic' ? 'selected' : '' }}>Mosaik Kolase (2/3 & 1/3 Mosaic Grid)</option>
                        <option value="carousel" {{ old('thumbnail_composition', $project->thumbnail_composition) == 'carousel' ? 'selected' : '' }}>Slider Otomatis (Carousel Slideshow)</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 border-l-3 border-black bg-[#ff5722] text-black">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-slate-500 text-xxs font-bold uppercase mt-1.5">// Menggabungkan seluruh foto proyek menjadi 1 komposisi tata letak pada kartu halaman utama.</p>
                @error('thumbnail_composition')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Dedicated Media & Layout Manager Place Section -->
            <div class="border-3 border-dashed border-black bg-orange-50/10 p-6 text-center space-y-4 shadow-[4px_4px_0px_#000000] hover:shadow-[6px_6px_0px_#000000] transition-all">
                <span class="block text-xs font-black uppercase tracking-widest text-[#ff5722]">
                    // DEDICATED MEDIA & LAYOUT GRID MANAGER
                </span>
                <p class="text-xs font-bold text-slate-700 uppercase tracking-wide leading-relaxed max-w-lg mx-auto">
                    Kelola galeri gambar pendukung, kustomisasi urutan mockup, setel gambar sampul utama (thumbnail), serta atur lebar kolom grid (1: Standar, 2: Lebar, 3: Banner Penuh) secara asimetris.
                </p>
                <div>
                    <button type="submit" formaction="{{ route('admin.projects.saveDraft', $project->id) }}"
                        class="inline-flex items-center text-xs font-black uppercase tracking-wider text-black border-2 border-black bg-white hover:bg-[#ff5722] px-5 py-2.5 shadow-[4px_4px_0px_#000000] hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                        [ Kelola Gambar & Layout ]
                    </button>
                </div>
            </div>

            <!-- Grid Composition Span -->
            <div>
                <label for="grid_span" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Komposisi Layout Kartu (Grid Span)</label>
                <div class="relative w-full">
                    <select name="grid_span" id="grid_span" required
                        class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold appearance-none focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150 cursor-pointer">
                        <option value="1" {{ old('grid_span', $project->grid_span) == 1 ? 'selected' : '' }}>Standar (1 Blok Kolom)</option>
                        <option value="2" {{ old('grid_span', $project->grid_span) == 2 ? 'selected' : '' }}>Lebar (2 Blok Kolom)</option>
                        <option value="3" {{ old('grid_span', $project->grid_span) == 3 ? 'selected' : '' }}>Penuh (3 Blok Kolom / Full Width)</option>
                    </select>
                    <!-- Custom Brutalist arrow indicator -->
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 border-l-3 border-black bg-[#ff5722] text-black">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-slate-500 text-xxs font-bold uppercase mt-1.5">// Mengatur seberapa lebar kartu proyek ini muncul di halaman portofolio utama.</p>
                @error('grid_span')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Project Link -->
            <div>
                <label for="project_link" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Link Proyek (Opsional)</label>
                <input type="url" name="project_link" id="project_link" value="{{ old('project_link', $project->project_link) }}" placeholder="https://github.com/username/project-name"
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                @error('project_link')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="pt-6 border-t-2 border-black flex items-center justify-end gap-3">
                <a href="{{ route('admin.projects.index') }}" class="brutal-btn-secondary px-5 py-2.5 text-sm">Batal</a>
                <button type="submit" class="brutal-btn-admin px-5 py-2.5 text-sm">
                    Perbarui Proyek
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
