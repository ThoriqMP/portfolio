@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="pb-6 border-b-4 border-black">
        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center text-xs font-black uppercase tracking-wider text-black border-2 border-black bg-white hover:bg-[#ff5722] px-3 py-1.5 shadow-[2px_2px_0px_#000000] transition active:translate-x-0.5 active:translate-y-0.5 active:shadow-none mb-4">
            &larr; Kembali ke Proyek
        </a>
        <h1 class="text-4xl font-black uppercase tracking-tighter text-black">Edit Proyek</h1>
        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">// Perbaruilah data proyek portofolio Anda.</p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-400 text-black border-4 border-black p-4 font-black text-xs uppercase tracking-wide shadow-[4px_4px_0px_#000000] mb-4">
            // {{ session('success') }}
        </div>
    @endif

    <!-- Toast Notification Container for Instant AJAX Actions -->
    <div id="ajax-toast" class="hidden fixed top-6 right-6 z-50 bg-[#ff5722] text-black border-3 border-black px-4 py-3 font-black text-xs uppercase tracking-wider shadow-[4px_4px_0px_#000000] transition-all">
        <span id="ajax-toast-msg">// Pesan Notifikasi</span>
    </div>

    <!-- Form Card (Brutalist Box) -->
    <div class="bg-white border-4 border-black p-6 sm:p-8 shadow-[6px_6px_0px_#000000]">
        <form id="project-edit-form" action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
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
                    <!-- Current Thumbnail Display -->
                    <div class="sm:col-span-5 space-y-1.5">
                        <span class="text-[10px] font-black uppercase tracking-wider text-slate-700 block">Thumbnail Saat Ini:</span>
                        <div class="aspect-video w-full bg-slate-200 border-2 border-black overflow-hidden relative shadow-[2px_2px_0px_#000000]">
                            <img id="current-thumbnail-preview" 
                                 src="{{ $project->thumbnail_url }}" 
                                 alt="{{ $project->title }}" 
                                 class="object-cover w-full h-full">
                            <span id="new-thumb-tag" class="hidden absolute top-1.5 left-1.5 bg-emerald-400 text-black text-[9px] font-black uppercase px-2 py-0.5 border border-black shadow-[1px_1px_0px_#000000]">
                                File Baru Terpilih
                            </span>
                        </div>
                    </div>

                    <!-- Input to Change Thumbnail -->
                    <div class="sm:col-span-7 space-y-2">
                        <label for="thumbnail_file_input" class="block text-xs font-black uppercase tracking-wider text-black">
                            Ganti Foto Thumbnail
                        </label>
                        <div class="w-full bg-white border-2 border-black px-4 py-3 focus-within:-translate-y-0.5 focus-within:shadow-[3px_3px_0px_#000000] transition-all">
                            <input type="file" name="image" id="thumbnail_file_input" accept="image/*"
                                class="text-xs text-black file:mr-3 file:py-1.5 file:px-3 file:border-2 file:border-black file:text-xs file:font-black file:uppercase file:bg-[#ff5722] file:text-black hover:file:bg-orange-600 file:cursor-pointer cursor-pointer w-full">
                        </div>
                        <p class="text-slate-500 text-[10px] font-bold uppercase leading-relaxed">
                            // Pilih gambar baru untuk mengganti thumbnail. Maksimal 10MB (otomatis dikompresi).
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
            <div class="border-3 border-black p-5 sm:p-6 bg-white space-y-5 shadow-[4px_4px_0px_#000000]">
                <div class="border-b-2 border-black pb-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div>
                        <span class="block text-xs font-black uppercase tracking-widest text-[#ff5722]">// 2. FOTO CAROUSEL PROYEK</span>
                        <p class="text-xxs font-bold uppercase text-slate-500">Foto-foto ini akan tampil sebagai galeri carousel interaktif di halaman detail proyek.</p>
                    </div>
                    <span id="carousel-count-badge" class="text-xxs font-black uppercase text-black border-2 border-black bg-slate-100 px-3 py-1 shadow-[2px_2px_0px_#000000] self-start sm:self-auto">
                        {{ $project->images->count() }} FOTO TERSIMPAN
                    </span>
                </div>

                <!-- Live Upload Progress Bar (Shows during instant upload) -->
                <div id="carousel-upload-progress" class="hidden border-2 border-black bg-orange-50 p-3.5 space-y-2">
                    <div class="flex items-center justify-between text-xxs font-black uppercase tracking-wider">
                        <span id="progress-status-text">// Mengunggah foto carousel...</span>
                        <span id="progress-percent-text">0%</span>
                    </div>
                    <div class="w-full bg-white border-2 border-black h-3 overflow-hidden">
                        <div id="progress-fill-bar" class="h-full bg-[#ff5722] w-0 transition-all duration-150"></div>
                    </div>
                </div>

                <!-- Instant Upload Dropzone & Button -->
                <div id="carousel-dropzone" 
                     class="border-3 border-dashed border-black bg-slate-50 p-6 sm:p-8 flex flex-col items-center justify-center text-center hover:bg-orange-50/40 hover:border-[#ff5722] transition-all cursor-pointer relative select-none group">
                    <svg class="w-10 h-10 text-slate-400 group-hover:text-[#ff5722] mb-2 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2.5 2.5 0 013.536 0L17 16m-2-2l1.586-1.586a2.5 2.5 0 013.536 0L21 14m-9-4h.01M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-xs font-black uppercase tracking-wide text-black mb-1">
                        + Tambah Foto Carousel (Bisa Pilih Banyak Sekaligus)
                    </span>
                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                        Seret &amp; lepas foto ke sini atau klik untuk memilih file. Foto otomatis tersimpan langsung ke server!
                    </span>
                    <input type="file" id="ajax_carousel_file_input" multiple accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full">
                </div>

                <!-- Carousel Photos Grid List -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-black uppercase tracking-wider text-slate-700">Daftar Foto Carousel:</span>
                        <span class="text-[9px] font-bold text-slate-500 uppercase">// Klik "Hapus" untuk menghapus foto secara langsung tanpa reload</span>
                    </div>

                    <div id="carousel-items-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3.5">
                        @forelse ($project->images as $img)
                            <div class="carousel-item-card relative group border-2 border-black bg-slate-100 aspect-video overflow-hidden shadow-[2px_2px_0px_#000000] flex flex-col justify-between"
                                 id="carousel-img-card-{{ $img->id }}">
                                <img src="{{ asset('storage/' . $img->image_path) }}" alt="Carousel Slide" class="w-full h-full object-cover">
                                
                                <!-- Hover Actions Overlay -->
                                <div class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center gap-1.5 p-2 transition-opacity">
                                    <button type="button" 
                                            onclick="deleteCarouselImage({{ $img->id }}, '{{ route('admin.projects.deleteMedia', [$project->id, $img->id]) }}')"
                                            class="w-full py-1 bg-rose-600 text-white font-black text-[9px] uppercase border border-black shadow-[1px_1px_0px_#000000] hover:bg-rose-700 transition cursor-pointer">
                                        Hapus Foto
                                    </button>
                                    <button type="button" 
                                            onclick="setAsThumbnail({{ $img->id }}, '{{ route('admin.projects.setThumbnail', [$project->id, $img->id]) }}')"
                                            class="w-full py-1 bg-[#ff5722] text-black font-black text-[9px] uppercase border border-black shadow-[1px_1px_0px_#000000] hover:bg-orange-500 transition cursor-pointer">
                                        Jadikan Thumbnail
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div id="empty-carousel-notice" class="col-span-full py-8 text-center bg-slate-50 border-2 border-dashed border-slate-300">
                                <p class="text-xs font-bold text-slate-400 uppercase italic">// Belum ada foto di galeri carousel. Unggah foto di atas.</p>
                            </div>
                        @endforelse
                    </div>
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
                                    {{ (is_array(old('badges')) && in_array($badge->id, old('badges'))) || (!is_array(old('badges')) && $project->badges->contains($badge->id)) ? 'checked' : '' }}
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
                        <option value="1" {{ old('grid_span', $project->grid_span) == 1 ? 'selected' : '' }}>Standar (1 Blok Kolom)</option>
                        <option value="2" {{ old('grid_span', $project->grid_span) == 2 ? 'selected' : '' }}>Lebar (2 Blok Kolom)</option>
                        <option value="3" {{ old('grid_span', $project->grid_span) == 3 ? 'selected' : '' }}>Penuh (3 Blok Kolom / Full Width)</option>
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
                <input type="url" name="project_link" id="project_link" value="{{ old('project_link', $project->project_link) }}" placeholder="https://github.com/username/project-name atau https://domain.com"
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
                    Simpan Perubahan Proyek &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ======================================================== -->
<!-- CLIENT-SIDE SCRIPT FOR SEAMLESS INSTANT PHOTO HANDLING   -->
<!-- ======================================================== -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = document.querySelector('meta[name="csrf-token"]') 
            ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            : '{{ csrf_token() }}';

        // 1. Live Instant Preview for Thumbnail
        const thumbInput = document.getElementById('thumbnail_file_input');
        const thumbPreview = document.getElementById('current-thumbnail-preview');
        const thumbTag = document.getElementById('new-thumb-tag');

        if (thumbInput && thumbPreview) {
            thumbInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const objectUrl = URL.createObjectURL(file);
                    thumbPreview.src = objectUrl;
                    if (thumbTag) thumbTag.classList.remove('hidden');
                    showToast('Preview thumbnail diperbarui! Klik "Simpan Perubahan Proyek" untuk menyimpan.');
                }
            });
        }

        // 2. Drag & Drop + Instant AJAX Upload for Carousel
        const dropzone = document.getElementById('carousel-dropzone');
        const ajaxInput = document.getElementById('ajax_carousel_file_input');
        const uploadProgress = document.getElementById('carousel-upload-progress');
        const progressFill = document.getElementById('progress-fill-bar');
        const progressStatus = document.getElementById('progress-status-text');
        const progressPercent = document.getElementById('progress-percent-text');
        const itemsGrid = document.getElementById('carousel-items-grid');
        const countBadge = document.getElementById('carousel-count-badge');
        const emptyNotice = document.getElementById('empty-carousel-notice');

        const uploadUrl = '{{ route("admin.projects.uploadMedia", $project->id) }}';

        if (ajaxInput) {
            ajaxInput.addEventListener('change', function () {
                if (this.files && this.files.length > 0) {
                    handleFilesUpload(Array.from(this.files));
                    this.value = ''; // Reset input
                }
            });
        }

        // Drag and drop events
        if (dropzone) {
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.add('bg-orange-100/50', 'border-[#ff5722]');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.remove('bg-orange-100/50', 'border-[#ff5722]');
                }, false);
            });

            dropzone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files && files.length > 0) {
                    handleFilesUpload(Array.from(files));
                }
            });
        }

        // Function to upload files one by one to avoid hitting server body size limits
        async function handleFilesUpload(files) {
            if (files.length === 0) return;

            uploadProgress.classList.remove('hidden');
            let completed = 0;
            const total = files.length;

            for (let i = 0; i < total; i++) {
                const file = files[i];
                progressStatus.textContent = `// Mengunggah & mengompresi foto ${i + 1} dari ${total}...`;
                const percent = Math.round((i / total) * 100);
                progressFill.style.width = percent + '%';
                progressPercent.textContent = percent + '%';

                const formData = new FormData();
                formData.append('file', file);
                formData.append('_token', csrfToken);

                try {
                    const response = await fetch(uploadUrl, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();
                    if (response.ok && data.success) {
                        appendImageCard(data.image);
                        completed++;
                    } else {
                        showToast(data.error || 'Gagal mengunggah foto ' + file.name);
                    }
                } catch (err) {
                    console.error(err);
                    showToast('Terjadi kesalahan saat mengunggah foto ' + file.name);
                }
            }

            // Finish progress
            progressFill.style.width = '100%';
            progressPercent.textContent = '100%';
            progressStatus.textContent = `// Berhasil mengunggah ${completed} foto carousel!`;
            showToast(`${completed} foto baru berhasil tersimpan ke galeri carousel!`);

            setTimeout(() => {
                uploadProgress.classList.add('hidden');
                progressFill.style.width = '0%';
            }, 2000);
        }

        function appendImageCard(image) {
            if (emptyNotice) {
                emptyNotice.remove();
            }

            const card = document.createElement('div');
            card.id = `carousel-img-card-${image.id}`;
            card.className = 'carousel-item-card relative group border-2 border-black bg-slate-100 aspect-video overflow-hidden shadow-[2px_2px_0px_#000000] flex flex-col justify-between animate-fade-in';
            card.innerHTML = `
                <img src="${image.url}" alt="Carousel Slide" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center gap-1.5 p-2 transition-opacity">
                    <button type="button" 
                            onclick="deleteCarouselImage(${image.id}, '${image.delete_url}')"
                            class="w-full py-1 bg-rose-600 text-white font-black text-[9px] uppercase border border-black shadow-[1px_1px_0px_#000000] hover:bg-rose-700 transition cursor-pointer">
                        Hapus Foto
                    </button>
                    <button type="button" 
                            onclick="setAsThumbnail(${image.id}, '${image.set_thumbnail_url}')"
                            class="w-full py-1 bg-[#ff5722] text-black font-black text-[9px] uppercase border border-black shadow-[1px_1px_0px_#000000] hover:bg-orange-500 transition cursor-pointer">
                        Jadikan Thumbnail
                    </button>
                </div>
            `;

            itemsGrid.appendChild(card);
            updateCountBadge();
        }

        function updateCountBadge() {
            const count = document.querySelectorAll('.carousel-item-card').length;
            if (countBadge) {
                countBadge.textContent = `${count} FOTO TERSIMPAN`;
            }
        }

        // Global functions for card action buttons
        window.deleteCarouselImage = async function (id, url) {
            if (!confirm('Hapus foto ini dari galeri carousel?')) return;

            try {
                const response = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();
                if (response.ok && data.success) {
                    const el = document.getElementById(`carousel-img-card-${id}`);
                    if (el) {
                        el.style.opacity = '0';
                        el.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            el.remove();
                            updateCountBadge();
                            const remaining = document.querySelectorAll('.carousel-item-card').length;
                            if (remaining === 0 && itemsGrid) {
                                itemsGrid.innerHTML = `
                                    <div id="empty-carousel-notice" class="col-span-full py-8 text-center bg-slate-50 border-2 border-dashed border-slate-300">
                                        <p class="text-xs font-bold text-slate-400 uppercase italic">// Belum ada foto di galeri carousel. Unggah foto di atas.</p>
                                    </div>
                                `;
                            }
                        }, 200);
                    }
                    showToast('Foto carousel berhasil dihapus!');
                } else {
                    showToast('Gagal menghapus foto.');
                }
            } catch (err) {
                console.error(err);
                showToast('Gagal menghapus foto.');
            }
        };

        window.setAsThumbnail = async function (id, url) {
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();
                if (response.ok && data.success) {
                    if (thumbPreview && data.thumbnail_url) {
                        thumbPreview.src = data.thumbnail_url;
                    }
                    showToast('Foto carousel ini telah dijadikan Foto Thumbnail utama proyek!');
                } else {
                    showToast('Gagal mengubah thumbnail.');
                }
            } catch (err) {
                console.error(err);
                showToast('Gagal mengubah thumbnail.');
            }
        };

        function showToast(msg) {
            const toast = document.getElementById('ajax-toast');
            const toastMsg = document.getElementById('ajax-toast-msg');
            if (toast && toastMsg) {
                toastMsg.textContent = '// ' + msg;
                toast.classList.remove('hidden');
                clearTimeout(window.toastTimer);
                window.toastTimer = setTimeout(() => {
                    toast.classList.add('hidden');
                }, 4000);
            }
        }
    });
</script>
@endsection
