@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="pb-6 border-b-4 border-black">
        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center text-xs font-black uppercase tracking-wider text-black border-2 border-black bg-white hover:bg-[#ff5722] px-3 py-1.5 shadow-[2px_2px_0px_#000000] transition active:translate-x-0.5 active:translate-y-0.5 active:shadow-none mb-4">
            &larr; Kembali ke Proyek
        </a>
        <h1 class="text-4xl font-black uppercase tracking-tighter text-black">Tambah Proyek Baru</h1>
        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">// Lengkapilah form berikut untuk menambah portofolio baru.</p>
    </div>

    <!-- Form Card (Brutalist Box) -->
    <div class="bg-white border-4 border-black p-6 sm:p-8 shadow-[6px_6px_0px_#000000]">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Judul Proyek</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Masukkan nama atau judul proyek" required
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                @error('title')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Deskripsi Proyek</label>
                <textarea name="description" id="description" rows="5" placeholder="Tuliskan penjelasan detail mengenai latar belakang, fitur, dan teknologi proyek ini..." required
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- ======================================================== -->
            <!-- SECTION 1: FOTO THUMBNAIL PROYEK                         -->
            <!-- ======================================================== -->
            <div class="border-3 border-black p-5 sm:p-6 bg-slate-50 space-y-4 shadow-[4px_4px_0px_#000000]">
                <div class="border-b-2 border-black pb-2 flex items-center justify-between">
                    <div>
                        <span class="block text-xs font-black uppercase tracking-widest text-black">// 1. FOTO THUMBNAIL PROYEK</span>
                        <p class="text-xxs font-bold uppercase text-slate-500">Digunakan pada kartu portofolio halaman utama &amp; bagian atas halaman detail proyek.</p>
                    </div>
                    <span class="text-[10px] font-black uppercase bg-[#ff5722] text-black px-2 py-0.5 border border-black shadow-[1px_1px_0px_#000000]">
                        Cover Utama
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-12 gap-5 items-start">
                    <!-- Live Thumbnail Preview -->
                    <div class="sm:col-span-5 space-y-1.5">
                        <span class="text-[10px] font-black uppercase tracking-wider text-slate-700 block">Preview Thumbnail:</span>
                        <div class="aspect-video w-full bg-slate-200 border-2 border-black overflow-hidden relative shadow-[2px_2px_0px_#000000] flex items-center justify-center">
                            <img id="create-thumbnail-preview" src="" alt="Thumbnail Preview" class="object-cover w-full h-full hidden">
                            <span id="create-empty-text" class="text-xs font-bold text-slate-400 uppercase italic p-3 text-center">
                                // Pilih foto di samping
                            </span>
                        </div>
                    </div>

                    <!-- Input to Select Thumbnail -->
                    <div class="sm:col-span-7 space-y-2">
                        <label for="create_thumbnail_input" class="block text-xs font-black uppercase tracking-wider text-black">
                            Pilih Foto Thumbnail (Wajib)
                        </label>
                        <div class="w-full bg-white border-2 border-black px-4 py-3 focus-within:-translate-y-0.5 focus-within:shadow-[3px_3px_0px_#000000] transition-all">
                            <input type="file" name="image" id="create_thumbnail_input" accept="image/*" required
                                class="text-xs text-black file:mr-3 file:py-1.5 file:px-3 file:border-2 file:border-black file:text-xs file:font-black file:uppercase file:bg-[#ff5722] file:text-black hover:file:bg-orange-600 file:cursor-pointer cursor-pointer w-full">
                        </div>
                        <p class="text-slate-500 text-[10px] font-bold uppercase leading-relaxed">
                            // Format: JPG, PNG, WEBP (Maks 10MB). Otomatis dikompresi di bawah 1MB.
                        </p>
                        @error('image')
                            <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- ======================================================== -->
            <!-- SECTION 2: FOTO CAROUSEL PROYEK (DETAIL PROJECT SLIDER) -->
            <!-- ======================================================== -->
            <div class="border-3 border-black p-5 sm:p-6 bg-white space-y-4 shadow-[4px_4px_0px_#000000]">
                <div class="border-b-2 border-black pb-2 flex items-center justify-between">
                    <div>
                        <span class="block text-xs font-black uppercase tracking-widest text-[#ff5722]">// 2. FOTO CAROUSEL PROYEK</span>
                        <p class="text-xxs font-bold uppercase text-slate-500">Foto-foto ini akan tampil sebagai slideshow carousel di halaman detail proyek.</p>
                    </div>
                    <span class="text-[10px] font-black uppercase bg-slate-100 text-black px-2 py-0.5 border border-black shadow-[1px_1px_0px_#000000]">
                        Opsional
                    </span>
                </div>

                <div>
                    <label for="create_additional_images" class="block text-xs font-black uppercase tracking-wider text-black mb-2">
                        Pilih Foto-Foto Carousel (Bisa Pilih Banyak Sekaligus)
                    </label>
                    <div class="w-full bg-white border-2 border-black px-4 py-4 focus-within:-translate-y-0.5 focus-within:shadow-[3px_3px_0px_#000000] transition-all">
                        <input type="file" name="additional_images[]" id="create_additional_images" multiple accept="image/*"
                            class="text-xs text-black file:mr-3 file:py-2 file:px-4 file:border-2 file:border-black file:text-xs file:font-black file:uppercase file:bg-black file:text-white hover:file:bg-[#ff5722] hover:file:text-black file:cursor-pointer cursor-pointer w-full">
                    </div>
                    <p class="text-slate-500 text-[10px] font-bold uppercase mt-1.5">
                        // Pilih beberapa foto mockup atau screenshot aplikasi untuk slider detail. Setelah proyek dibuat, Anda juga dapat mengunggah foto carousel langsung kapan saja di halaman edit.
                    </p>
                    <div id="selected-files-summary" class="hidden mt-2 p-2.5 bg-orange-50 border-2 border-black text-xxs font-black uppercase text-black">
                        <span id="selected-files-count">0 foto terpilih</span>
                    </div>
                    @error('additional_images')
                        <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                    @enderror
                    @error('additional_images.*')
                        <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Project Badges (Technology Tags) -->
            <div class="border-3 border-black p-5 bg-slate-50">
                <span class="block text-xs font-black uppercase tracking-widest text-black mb-3">// TEKNOLOGI / SOFTWARE YANG DIGUNAKAN</span>
                
                <!-- Checkbox List of Existing Badges -->
                <div class="mb-4">
                    <label class="block text-xxs font-black uppercase tracking-wider text-slate-500 mb-2">Pilih Teknologi/Software yang Sudah Ada:</label>
                    <div class="flex flex-wrap gap-2.5">
                        @forelse ($badges as $badge)
                            <label class="inline-flex items-center gap-2 cursor-pointer bg-white border-2 border-black px-2.5 py-1.5 shadow-[2px_2px_0px_#000000] hover:-translate-y-0.5 active:translate-y-0 active:shadow-none transition-all">
                                <input type="checkbox" name="badges[]" value="{{ $badge->id }}"
                                    {{ is_array(old('badges')) && in_array($badge->id, old('badges')) ? 'checked' : '' }}
                                    class="w-4 h-4 border-2 border-black rounded-none accent-[#ff5722] cursor-pointer">
                                <span class="px-2 py-0.5 font-sans font-bold text-xs uppercase shadow-[1px_1px_0px_#000000]"
                                       style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }};">
                                    {{ $badge->name }}
                                </span>
                            </label>
                        @empty
                            <p class="text-xs font-bold text-slate-500 uppercase italic">// Belum ada teknologi/software. Silakan input langsung di bawah.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Instant input for new badges -->
                <div>
                    <label for="new_badges" class="block text-xxs font-black uppercase tracking-wider text-slate-500 mb-1">Ketik Teknologi/Software Baru Instan (Pisahkan dengan koma jika lebih dari satu):</label>
                    <input type="text" name="new_badges" id="new_badges" value="{{ old('new_badges') }}" placeholder="Contoh: Laravel 11, Tailwind CSS, Docker"
                        class="w-full bg-white border-2 border-black rounded-none px-3 py-2 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[3px_3px_0px_#000000] transition-all duration-150">
                    <p class="text-slate-500 text-xxs font-bold uppercase mt-1.5">// Teknologi/software baru akan dibuat otomatis dan bisa dikustomisasi di menu Lencana Keahlian.</p>
                </div>
            </div>

            <!-- Grid Composition Span -->
            <div>
                <label for="grid_span" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Ukuran Kartu di Halaman Utama (Grid Span)</label>
                <div class="relative w-full">
                    <select name="grid_span" id="grid_span" required
                        class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold appearance-none focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150 cursor-pointer">
                        <option value="1" {{ old('grid_span', '1') == 1 ? 'selected' : '' }}>Standar (1 Blok Kolom)</option>
                        <option value="2" {{ old('grid_span') == 2 ? 'selected' : '' }}>Lebar (2 Blok Kolom)</option>
                        <option value="3" {{ old('grid_span') == 3 ? 'selected' : '' }}>Penuh (3 Blok Kolom / Full Width)</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 border-l-3 border-black bg-[#ff5722] text-black">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-slate-500 text-xxs font-bold uppercase mt-1.5">// Mengatur seberapa lebar kartu proyek ini muncul di grid halaman portofolio utama.</p>
                @error('grid_span')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Project Link -->
            <div>
                <label for="project_link" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Link Proyek / Aplikasi Live (Opsional)</label>
                <input type="url" name="project_link" id="project_link" value="{{ old('project_link') }}" placeholder="https://github.com/username/project-name atau https://domain.com"
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                @error('project_link')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="pt-6 border-t-4 border-black flex items-center justify-between">
                <a href="{{ route('admin.projects.index') }}" class="brutal-btn-secondary px-5 py-2.5 text-xs font-black uppercase tracking-wider">
                    Batal
                </a>
                <button type="submit" class="brutal-btn-admin px-6 py-3 text-xs font-black uppercase tracking-wider shadow-[4px_4px_0px_#000000] hover:shadow-[6px_6px_0px_#000000]">
                    Simpan Proyek Baru &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Thumbnail Live Preview
        const thumbInput = document.getElementById('create_thumbnail_input');
        const thumbPreview = document.getElementById('create-thumbnail-preview');
        const emptyText = document.getElementById('create-empty-text');

        if (thumbInput && thumbPreview) {
            thumbInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    thumbPreview.src = URL.createObjectURL(file);
                    thumbPreview.classList.remove('hidden');
                    if (emptyText) emptyText.classList.add('hidden');
                }
            });
        }

        // Additional Carousel Images count preview
        const addImagesInput = document.getElementById('create_additional_images');
        const summaryBox = document.getElementById('selected-files-summary');
        const countText = document.getElementById('selected-files-count');

        if (addImagesInput && summaryBox && countText) {
            addImagesInput.addEventListener('change', function () {
                const count = this.files ? this.files.length : 0;
                if (count > 0) {
                    countText.textContent = `// ${count} foto carousel terpilih dan siap diunggah`;
                    summaryBox.classList.remove('hidden');
                } else {
                    summaryBox.classList.add('hidden');
                }
            });
        }
    });
</script>
@endsection
