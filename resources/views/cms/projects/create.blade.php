@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <!-- Header -->
    <div class="pb-6 border-b border-slate-200/80">
        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-slate-900 transition mb-3">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Daftar Proyek
        </a>
        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">Tambah Proyek Baru</h1>
        <p class="text-sm font-medium text-slate-500 mt-1">Lengkapi form berikut untuk mempublikasikan proyek portofolio baru Anda.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-8 shadow-xs">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Judul Proyek</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Contoh: Aplikasi Telemedicine Mobile" required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 text-sm font-medium placeholder-slate-400 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
                @error('title')
                    <p class="text-rose-600 text-xs font-semibold mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Deskripsi Proyek</label>
                <textarea name="description" id="description" rows="5" placeholder="Jelaskan mengenai latar belakang proyek, masalah yang dipecahkan, fitur unggulan, dan teknologi..." required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 text-sm font-medium placeholder-slate-400 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition leading-relaxed">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-rose-600 text-xs font-semibold mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- ======================================================== -->
            <!-- SECTION 1: FOTO THUMBNAIL PROYEK                         -->
            <!-- ======================================================== -->
            <div class="rounded-2xl border border-slate-200/90 bg-slate-50/70 p-5 sm:p-6 space-y-4">
                <div class="border-b border-slate-200/80 pb-3 flex items-center justify-between">
                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider text-slate-900">1. Foto Thumbnail Utama (Wajib)</span>
                        <p class="text-xs text-slate-500 font-medium">Digunakan pada kartu portofolio beranda utama &amp; cover detail proyek.</p>
                    </div>
                    <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-orange-50 text-[#FF4D2D] border border-orange-200/60">
                        Cover Utama
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-12 gap-5 items-start">
                    <!-- Live Thumbnail Preview -->
                    <div class="sm:col-span-5 space-y-2">
                        <span class="text-xs font-semibold text-slate-600 block">Pratinjau Thumbnail:</span>
                        <div class="aspect-video w-full bg-slate-200 rounded-xl border border-slate-200/90 overflow-hidden relative shadow-xs flex items-center justify-center">
                            <img id="create-thumbnail-preview" src="" alt="Thumbnail Preview" class="object-cover w-full h-full hidden">
                            <span id="create-empty-text" class="text-xs font-medium text-slate-400 p-4 text-center">
                                Pilih foto di samping untuk melihat pratinjau
                            </span>
                        </div>
                    </div>

                    <!-- Input to Select Thumbnail -->
                    <div class="sm:col-span-7 space-y-2">
                        <label for="create_thumbnail_input" class="block text-xs font-semibold text-slate-700">
                            Pilih Foto Cover Utama
                        </label>
                        <div class="w-full bg-white rounded-xl border border-slate-200 p-3 hover:border-slate-300 transition">
                            <input type="file" name="image" id="create_thumbnail_input" accept="image/*" required
                                class="text-xs text-slate-600 file:mr-3 file:py-2 file:px-3.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-[#FF4D2D] hover:file:bg-orange-100 file:cursor-pointer cursor-pointer w-full">
                        </div>
                        <p class="text-slate-500 text-xs font-medium leading-relaxed">
                            Format: JPG, PNG, WEBP (Maks 10MB). Otomatis dikompresi di bawah 1MB.
                        </p>
                        @error('image')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- ======================================================== -->
            <!-- SECTION 2: FOTO CAROUSEL PROYEK (DETAIL PROJECT SLIDER) -->
            <!-- ======================================================== -->
            <div class="rounded-2xl border border-slate-200/90 bg-white p-5 sm:p-6 space-y-4 shadow-xs">
                <div class="border-b border-slate-200/80 pb-3 flex items-center justify-between">
                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider text-[#FF4D2D]">2. Foto Galeri Carousel (Opsional)</span>
                        <p class="text-xs text-slate-500 font-medium">Foto-foto ini akan tampil sebagai slideshow carousel di halaman detail proyek.</p>
                    </div>
                    <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600 border border-slate-200">
                        Opsional
                    </span>
                </div>

                <div>
                    <label for="create_additional_images" class="block text-xs font-semibold text-slate-700 mb-2">
                        Pilih Foto-Foto Carousel (Bisa Pilih Banyak Sekaligus)
                    </label>
                    <div class="w-full bg-slate-50/50 rounded-xl border border-slate-200 p-3 hover:border-slate-300 transition">
                        <input type="file" name="additional_images[]" id="create_additional_images" multiple accept="image/*"
                            class="text-xs text-slate-600 file:mr-3 file:py-2 file:px-3.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-white hover:file:bg-[#FF4D2D] file:cursor-pointer cursor-pointer w-full">
                    </div>
                    <p class="text-slate-500 text-xs font-medium mt-1.5 leading-relaxed">
                        Pilih beberapa foto mockup atau screenshot aplikasi untuk slider detail. Setelah proyek dibuat, Anda juga dapat mengunggah foto carousel langsung kapan saja di halaman edit.
                    </p>
                    <div id="selected-files-summary" class="hidden mt-3 p-3 bg-orange-50 border border-orange-200/80 rounded-xl text-xs font-semibold text-slate-800 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#FF4D2D]"></span>
                        <span id="selected-files-count">0 foto terpilih</span>
                    </div>
                    @error('additional_images')
                        <p class="text-rose-600 text-xs font-semibold mt-1.5">{{ $message }}</p>
                    @enderror
                    @error('additional_images.*')
                        <p class="text-rose-600 text-xs font-semibold mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Project Badges (Technology Tags) -->
            <div class="rounded-2xl border border-slate-200/90 bg-slate-50/70 p-5 sm:p-6 space-y-4">
                <span class="block text-xs font-bold uppercase tracking-wider text-slate-800">Teknologi &amp; Tools yang Digunakan</span>
                
                <!-- Checkbox List of Existing Badges -->
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-slate-500">Pilih dari lencana yang tersedia:</label>
                    <div class="flex flex-wrap gap-2">
                        @forelse ($badges as $badge)
                            <label class="inline-flex items-center gap-2 cursor-pointer bg-white border border-slate-200 hover:border-slate-300 px-3 py-1.5 rounded-xl shadow-xs transition">
                                <input type="checkbox" name="badges[]" value="{{ $badge->id }}"
                                    {{ is_array(old('badges')) && in_array($badge->id, old('badges')) ? 'checked' : '' }}
                                    class="w-4 h-4 rounded text-[#FF4D2D] focus:ring-[#FF4D2D]/30 border-slate-300">
                                <span class="px-2 py-0.5 rounded-md text-xs font-semibold"
                                       style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }};">
                                    {{ $badge->name }}
                                </span>
                            </label>
                        @empty
                            <p class="text-xs text-slate-400">Belum ada lencana teknologi. Masukkan langsung di bawah.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Instant input for new badges -->
                <div>
                    <label for="new_badges" class="block text-xs font-medium text-slate-600 mb-1.5">Tambah Lencana Baru Secara Instan (Pisahkan koma):</label>
                    <input type="text" name="new_badges" id="new_badges" value="{{ old('new_badges') }}" placeholder="Contoh: Laravel 11, Tailwind CSS, Docker"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 text-sm font-medium placeholder-slate-400 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
                    <p class="text-slate-400 text-xs font-medium mt-1">Lencana baru akan otomatis dibuat dan tersimpan ke koleksi.</p>
                </div>
            </div>

            <!-- Grid Composition Span -->
            <div>
                <label for="grid_span" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Ukuran Kartu di Halaman Utama (Grid Span)</label>
                <div class="relative w-full">
                    <select name="grid_span" id="grid_span" required
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 text-sm font-medium appearance-none focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition cursor-pointer">
                        <option value="1" {{ old('grid_span', '1') == 1 ? 'selected' : '' }}>Standar (1 Kolom)</option>
                        <option value="2" {{ old('grid_span') == 2 ? 'selected' : '' }}>Lebar (2 Kolom)</option>
                        <option value="3" {{ old('grid_span') == 3 ? 'selected' : '' }}>Penuh (3 Kolom / Full Width)</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
                <p class="text-slate-400 text-xs font-medium mt-1">Mengatur lebar kartu proyek ini pada tata letak grid halaman portofolio utama.</p>
                @error('grid_span')
                    <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Project Link -->
            <div>
                <label for="project_link" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Tautan Proyek / Demo Live (Opsional)</label>
                <input type="url" name="project_link" id="project_link" value="{{ old('project_link') }}" placeholder="https://github.com/username/project-name atau https://domain.com"
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 text-sm font-medium placeholder-slate-400 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
                @error('project_link')
                    <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="pt-6 border-t border-slate-200/80 flex items-center justify-between">
                <a href="{{ route('admin.projects.index') }}" class="brutal-btn-secondary text-xs">
                    Batal
                </a>
                <button type="submit" class="brutal-btn-admin text-xs">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Simpan &amp; Publikasikan Proyek</span>
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
                    countText.textContent = `${count} foto carousel terpilih dan siap diunggah`;
                    summaryBox.classList.remove('hidden');
                } else {
                    summaryBox.classList.add('hidden');
                }
            });
        }
    });
</script>
@endsection