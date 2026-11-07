@extends('layouts.admin')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
<style>
    .ql-toolbar.ql-snow {
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 1px solid #e2e8f0;
        background: #f8fafc;
        padding: 10px 14px;
        font-family: inherit;
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
    }
    .ql-container.ql-snow {
        border: none;
        font-family: "Plus Jakarta Sans", system-ui, sans-serif;
        font-size: 0.95rem;
        border-bottom-left-radius: 0.75rem;
        border-bottom-right-radius: 0.75rem;
    }
    .ql-editor {
        min-height: 280px;
        padding: 18px;
        line-height: 1.75;
        color: #1e293b;
    }
    .ql-editor.ql-blank::before {
        font-style: normal;
        color: #94a3b8;
        font-weight: 400;
        left: 18px;
        right: 18px;
    }
    .ql-editor img {
        display: block;
        max-width: 100%;
        height: auto;
        border-radius: 14px;
        margin: 16px 0;
        box-shadow: 0 4px 14px -2px rgba(0,0,0,0.08);
        border: 1px solid #e2e8f0;
    }
    .ql-editor h2 {
        font-size: 1.45rem;
        font-weight: 800;
        margin-top: 1.5rem;
        margin-bottom: 0.6rem;
        color: #0f172a;
        letter-spacing: -0.02em;
    }
    .ql-editor h3 {
        font-size: 1.2rem;
        font-weight: 700;
        margin-top: 1.25rem;
        margin-bottom: 0.5rem;
        color: #1e293b;
        letter-spacing: -0.01em;
    }
    .ql-editor blockquote {
        border-left: 4px solid #FF4D2D;
        padding-left: 16px;
        color: #475569;
        font-style: italic;
        background: #fff8f5;
        padding-top: 6px;
        padding-bottom: 6px;
        border-radius: 0 8px 8px 0;
    }
</style>
@endpush

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
        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">Edit Proyek Portofolio</h1>
        <p class="text-sm font-medium text-slate-500 mt-1">Perbarui rincian proyek, foto thumbnail cover, dan galeri carousel interaktif.</p>
    </div>

    <!-- Toast Notification for AJAX Actions -->
    <div id="ajax-toast" class="hidden fixed bottom-6 right-6 z-50 bg-slate-900 text-white border border-slate-700/80 rounded-2xl px-5 py-3.5 shadow-2xl flex items-center gap-3 transition-all duration-300">
        <div class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center flex-shrink-0">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </div>
        <span id="ajax-toast-msg" class="text-xs font-semibold tracking-wide">Pesan Notifikasi</span>
    </div>

    <!-- Main Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-8 shadow-xs">
        <form id="project-edit-form" action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Judul Proyek</label>
                <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" placeholder="Contoh: Aplikasi Telemedicine Mobile" required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 text-sm font-medium placeholder-slate-400 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
                @error('title')
                    <p class="text-rose-600 text-xs font-semibold mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description (Article Editor with Inline Image Support) -->
            <div>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Deskripsi &amp; Narasi Proyek (Format Artikel)</label>
                        <p class="text-[11px] text-slate-500 font-medium">Tulis layaknya artikel: buat sub-heading, daftar poin, dan sisipkan foto dokumentasi di antara paragraf.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" id="btn-insert-inline-img" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 hover:border-accent-500 text-slate-700 hover:text-accent-600 text-xs font-semibold shadow-xs transition cursor-pointer">
                            <svg class="w-3.5 h-3.5 text-accent-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span>+ Sisipkan Foto di Paragraf</span>
                        </button>
                    </div>
                </div>

                <!-- Hidden file input for inline image upload -->
                <input type="file" id="quill-image-file-input" accept="image/jpeg,image/png,image/jpg,image/webp,image/gif" class="hidden">

                <!-- Upload status indicator -->
                <div id="inline-upload-indicator" class="hidden items-center gap-2 px-3 py-2 mb-2 rounded-xl bg-orange-50 border border-orange-200 text-accent-700 text-xs font-medium animate-pulse">
                    <svg class="w-4 h-4 animate-spin text-accent-600" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>Sedang mengunggah dan mengompres foto ke server...</span>
                </div>

                <!-- Quill Editor Container -->
                <div class="rounded-xl border border-slate-200 bg-white overflow-hidden shadow-xs focus-within:border-accent-500 focus-within:ring-4 focus-within:ring-accent-500/10 transition">
                    <div id="quill-editor" class="min-h-[280px]">
                        @php
                            $initContent = old('description', $project->description);
                        @endphp
                        @if (strip_tags($initContent) !== $initContent)
                            {!! $initContent !!}
                        @else
                            {!! nl2br(e($initContent)) !!}
                        @endif
                    </div>
                </div>

                <!-- Hidden input to submit with the form -->
                <input type="hidden" name="description" id="description_input" value="{{ old('description', $project->description) }}">

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
                        <span class="block text-xs font-bold uppercase tracking-wider text-slate-900">1. Foto Thumbnail Utama</span>
                        <p class="text-xs text-slate-500 font-medium">Tampil di kartu halaman depan &amp; header halaman detail proyek.</p>
                    </div>
                    <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-orange-50 text-[#FF4D2D] border border-orange-200/60">
                        Cover Portofolio
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-12 gap-5 items-start">
                    <!-- Current Thumbnail Display -->
                    <div class="sm:col-span-5 space-y-2">
                        <span class="text-xs font-semibold text-slate-600 block">Thumbnail Saat Ini:</span>
                        <div class="aspect-video w-full bg-slate-200 rounded-xl border border-slate-200/90 overflow-hidden relative shadow-xs">
                            <img id="current-thumbnail-preview" 
                                 src="{{ $project->thumbnail_url }}" 
                                 alt="{{ $project->title }}" 
                                 class="object-cover w-full h-full">
                            <span id="new-thumb-tag" class="hidden absolute top-2 left-2 bg-emerald-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-md shadow-sm">
                                File Baru Terpilih
                            </span>
                        </div>
                    </div>

                    <!-- Input to Change Thumbnail -->
                    <div class="sm:col-span-7 space-y-2">
                        <label for="thumbnail_file_input" class="block text-xs font-semibold text-slate-700">
                            Ganti Foto Thumbnail
                        </label>
                        <div class="w-full bg-white rounded-xl border border-slate-200 p-3 hover:border-slate-300 transition">
                            <input type="file" name="image" id="thumbnail_file_input" accept="image/*"
                                class="text-xs text-slate-600 file:mr-3 file:py-2 file:px-3.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-[#FF4D2D] hover:file:bg-orange-100 file:cursor-pointer cursor-pointer w-full">
                        </div>
                        <p class="text-slate-500 text-xs font-medium leading-relaxed">
                            Pilih file baru untuk mengganti foto cover. Maks 10MB (otomatis dikompresi).
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
            <div class="rounded-2xl border border-slate-200/90 bg-white p-5 sm:p-6 space-y-5 shadow-xs">
                <div class="border-b border-slate-200/80 pb-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider text-[#FF4D2D]">2. Foto Galeri Carousel</span>
                        <p class="text-xs text-slate-500 font-medium">Foto-foto ini akan tampil sebagai slideshow carousel interaktif di halaman detail proyek.</p>
                    </div>
                    <span id="carousel-count-badge" class="text-xs font-semibold text-slate-700 bg-slate-100 px-3 py-1 rounded-full self-start sm:self-auto border border-slate-200">
                        {{ $project->images->count() }} FOTO TERSIMPAN
                    </span>
                </div>

                <!-- Live Upload Progress Bar -->
                <div id="carousel-upload-progress" class="hidden rounded-xl bg-orange-50/80 border border-orange-200/80 p-4 space-y-2">
                    <div class="flex items-center justify-between text-xs font-semibold text-slate-800">
                        <span id="progress-status-text">Mengunggah &amp; mengompresi foto carousel...</span>
                        <span id="progress-percent-text" class="text-[#FF4D2D]">0%</span>
                    </div>
                    <div class="w-full bg-slate-200/80 rounded-full h-2.5 overflow-hidden">
                        <div id="progress-fill-bar" class="h-full bg-gradient-to-r from-[#FF4D2D] to-[#E63D1F] w-0 transition-all duration-150 rounded-full"></div>
                    </div>
                </div>

                <!-- Instant Upload Dropzone -->
                <div id="carousel-dropzone" 
                     class="rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50/50 hover:bg-orange-50/20 hover:border-[#FF4D2D]/60 p-6 sm:p-8 flex flex-col items-center justify-center text-center transition-all cursor-pointer relative select-none group">
                    <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 text-slate-400 group-hover:text-[#FF4D2D] group-hover:border-[#FF4D2D]/30 flex items-center justify-center mb-3 transition shadow-xs">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-slate-800 group-hover:text-[#FF4D2D] transition mb-1">
                        + Tambah Foto Carousel (Bisa Pilih Banyak Sekaligus)
                    </span>
                    <span class="text-xs text-slate-500 font-medium max-w-sm">
                        Seret &amp; lepas file ke sini atau klik untuk memilih. Foto otomatis terunggah &amp; tersimpan langsung ke server!
                    </span>
                    <input type="file" id="ajax_carousel_file_input" multiple accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full">
                </div>

                <!-- Carousel Photos Grid List -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-700">Daftar Foto Carousel:</span>
                        <span class="text-xs text-slate-400 font-medium">Klik "Hapus" untuk menghapus instan</span>
                    </div>

                    <div id="carousel-items-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3.5">
                        @forelse ($project->images as $img)
                            <div class="carousel-item-card relative group rounded-xl border border-slate-200 overflow-hidden bg-slate-100 aspect-video shadow-xs flex flex-col justify-between"
                                 id="carousel-img-card-{{ $img->id }}">
                                <img src="{{ asset('storage/' . $img->image_path) }}" alt="Carousel Slide" class="w-full h-full object-cover">
                                
                                <!-- Hover Actions Overlay -->
                                <div class="absolute inset-0 bg-slate-950/75 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center gap-1.5 p-2 transition-opacity duration-200">
                                    <button type="button" 
                                            onclick="deleteCarouselImage({{ $img->id }}, '{{ route('admin.projects.deleteMedia', [$project->id, $img->id]) }}')"
                                            class="w-full py-1.5 bg-rose-600 hover:bg-rose-700 text-white font-semibold text-[10px] rounded-lg shadow-xs transition cursor-pointer">
                                        Hapus Foto
                                    </button>
                                    <button type="button" 
                                            onclick="setAsThumbnail({{ $img->id }}, '{{ route('admin.projects.setThumbnail', [$project->id, $img->id]) }}')"
                                            class="w-full py-1.5 bg-[#FF4D2D] hover:bg-[#E63D1F] text-white font-semibold text-[10px] rounded-lg shadow-xs transition cursor-pointer">
                                        Jadikan Thumbnail
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div id="empty-carousel-notice" class="col-span-full py-8 text-center bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                                <p class="text-xs font-medium text-slate-400">Belum ada foto di galeri carousel. Unggah foto di atas.</p>
                            </div>
                        @endforelse
                    </div>
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
                                    {{ (is_array(old('badges')) && in_array($badge->id, old('badges'))) || (!is_array(old('badges')) && $project->badges->contains($badge->id)) ? 'checked' : '' }}
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
                    <input type="text" name="new_badges" id="new_badges" value="{{ old('new_badges') }}" placeholder="Contoh: Next.js, TypeScript, PostgreSQL"
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
                        <option value="1" {{ old('grid_span', $project->grid_span) == 1 ? 'selected' : '' }}>Standar (1 Kolom)</option>
                        <option value="2" {{ old('grid_span', $project->grid_span) == 2 ? 'selected' : '' }}>Lebar (2 Kolom)</option>
                        <option value="3" {{ old('grid_span', $project->grid_span) == 3 ? 'selected' : '' }}>Penuh (3 Kolom / Full Width)</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
                <p class="text-slate-400 text-xs font-medium mt-1">Mengatur lebar kartu portofolio pada tata letak grid halaman depan.</p>
                @error('grid_span')
                    <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Project Link -->
            <div>
                <label for="project_link" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Tautan Proyek / Demo Live (Opsional)</label>
                <input type="url" name="project_link" id="project_link" value="{{ old('project_link', $project->project_link) }}" placeholder="https://example.com atau https://github.com/username/project"
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span>Simpan Perubahan Proyek</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ======================================================== -->
<!-- CLIENT-SIDE SCRIPT FOR SEAMLESS INSTANT PHOTO HANDLING   -->
<!-- ======================================================== -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = document.querySelector('meta[name="csrf-token"]') 
            ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            : '{{ csrf_token() }}';

        // --- Quill Article Editor Setup ---
        const quillEditorEl = document.getElementById('quill-editor');
        const descriptionInput = document.getElementById('description_input');
        const fileInput = document.getElementById('quill-image-file-input');
        const btnInsertImg = document.getElementById('btn-insert-inline-img');
        const uploadIndicator = document.getElementById('inline-upload-indicator');
        const form = document.getElementById('project-edit-form');

        let quill = null;
        if (quillEditorEl) {
            quill = new Quill('#quill-editor', {
                theme: 'snow',
                placeholder: 'Tulis deskripsi proyek seperti menulis artikel... Gunakan sub-judul, daftar poin, dan sisipkan foto di antara paragraf.',
                modules: {
                    toolbar: {
                        container: [
                            [{ 'header': [2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            ['blockquote', 'code-block'],
                            ['link', 'image'],
                            ['clean']
                        ],
                        handlers: {
                            image: function () {
                                triggerImageUpload();
                            }
                        }
                    }
                }
            });

            function triggerImageUpload() {
                if (fileInput) {
                    fileInput.value = '';
                    fileInput.click();
                }
            }

            if (btnInsertImg) {
                btnInsertImg.addEventListener('click', triggerImageUpload);
            }

            if (fileInput) {
                fileInput.addEventListener('change', function () {
                    const file = this.files[0];
                    if (!file) return;
                    uploadFileToQuill(file);
                });
            }

            function uploadFileToQuill(file) {
                if (!file.type.match(/^image\//)) {
                    alert('File yang dipilih harus berupa gambar (JPG, PNG, WebP, GIF).');
                    return;
                }

                if (file.size > 12 * 1024 * 1024) {
                    alert('Ukuran file foto maksimal 12MB.');
                    return;
                }

                const formData = new FormData();
                formData.append('image', file);

                if (uploadIndicator) {
                    uploadIndicator.classList.remove('hidden');
                    uploadIndicator.classList.add('flex');
                }

                fetch("{{ route('admin.projects.uploadContentImage') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(res => {
                    if (!res.ok) {
                        return res.json().then(err => { throw err; });
                    }
                    return res.json();
                })
                .then(data => {
                    if (data.success && data.url) {
                        const range = quill.getSelection(true) || { index: quill.getLength() };
                        quill.insertEmbed(range.index, 'image', data.url);
                        quill.setSelection(range.index + 1);
                        syncDescription();
                        showToast('Foto berhasil disisipkan ke paragraf!');
                    } else {
                        alert('Gagal mengunggah foto. Silakan coba lagi.');
                    }
                })
                .catch(err => {
                    console.error('Error uploading inline image:', err);
                    const msg = (err && err.message) ? err.message : 'Terjadi kesalahan saat mengunggah foto.';
                    alert(msg);
                })
                .finally(() => {
                    if (uploadIndicator) {
                        uploadIndicator.classList.add('hidden');
                        uploadIndicator.classList.remove('flex');
                    }
                });
            }

            // Intercept paste of image files to auto-upload to server instead of inserting raw base64
            quill.root.addEventListener('paste', function (e) {
                const clipboardData = e.clipboardData || window.clipboardData;
                if (!clipboardData || !clipboardData.items) return;

                for (let i = 0; i < clipboardData.items.length; i++) {
                    const item = clipboardData.items[i];
                    if (item.type.indexOf('image') !== -1) {
                        const file = item.getAsFile();
                        if (file) {
                            e.preventDefault();
                            uploadFileToQuill(file);
                            return;
                        }
                    }
                }
            });

            function syncDescription() {
                if (!descriptionInput) return;
                const text = quill.getText().trim();
                const hasImages = quill.root.querySelector('img') !== null;
                if (!text && !hasImages) {
                    descriptionInput.value = '';
                } else {
                    descriptionInput.value = quill.root.innerHTML;
                }
            }

            quill.on('text-change', syncDescription);

            if (form) {
                form.addEventListener('submit', function (e) {
                    syncDescription();
                    if (!descriptionInput.value.trim()) {
                        e.preventDefault();
                        alert('Deskripsi proyek wajib diisi.');
                        quill.focus();
                    }
                });
            }
        }

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
                    showToast('Pratinjau thumbnail diperbarui. Klik Simpan untuk mempermanenkan.');
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
                    dropzone.classList.add('bg-orange-100/50', 'border-[#FF4D2D]');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.remove('bg-orange-100/50', 'border-[#FF4D2D]');
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
                progressStatus.textContent = `Mengunggah & mengompresi foto ${i + 1} dari ${total}...`;
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
            progressStatus.textContent = `Berhasil mengunggah ${completed} foto carousel!`;
            showToast(`${completed} foto baru berhasil ditambahkan ke galeri carousel!`);

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
            card.className = 'carousel-item-card relative group rounded-xl border border-slate-200 overflow-hidden bg-slate-100 aspect-video shadow-xs flex flex-col justify-between animate-fade-in';
            card.innerHTML = `
                <img src="${image.url}" alt="Carousel Slide" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-slate-950/75 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center gap-1.5 p-2 transition-opacity duration-200">
                    <button type="button" 
                            onclick="deleteCarouselImage(${image.id}, '${image.delete_url}')"
                            class="w-full py-1.5 bg-rose-600 hover:bg-rose-700 text-white font-semibold text-[10px] rounded-lg shadow-xs transition cursor-pointer">
                        Hapus Foto
                    </button>
                    <button type="button" 
                            onclick="setAsThumbnail(${image.id}, '${image.set_thumbnail_url}')"
                            class="w-full py-1.5 bg-[#FF4D2D] hover:bg-[#E63D1F] text-white font-semibold text-[10px] rounded-lg shadow-xs transition cursor-pointer">
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
                                    <div id="empty-carousel-notice" class="col-span-full py-8 text-center bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                                        <p class="text-xs font-medium text-slate-400">Belum ada foto di galeri carousel. Unggah foto di atas.</p>
                                    </div>
                                `;
                            }
                        }, 200);
                    }
                    showToast('Foto carousel berhasil dihapus.');
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
                    showToast('Foto carousel ini berhasil dijadikan Thumbnail utama!');
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
                toastMsg.textContent = msg;
                toast.classList.remove('hidden');
                clearTimeout(window.toastTimer);
                window.toastTimer = setTimeout(() => {
                    toast.classList.add('hidden');
                }, 4000);
            }
        }
    });
</script>
@endpush
@endsection