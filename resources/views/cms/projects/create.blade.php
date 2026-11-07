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
                        {!! old('description') !!}
                    </div>
                </div>

                <!-- Hidden input to submit with the form -->
                <input type="hidden" name="description" id="description_input" value="{{ old('description') }}">

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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- Quill Article Editor Setup ---
        const quillEditorEl = document.getElementById('quill-editor');
        const descriptionInput = document.getElementById('description_input');
        const fileInput = document.getElementById('quill-image-file-input');
        const btnInsertImg = document.getElementById('btn-insert-inline-img');
        const uploadIndicator = document.getElementById('inline-upload-indicator');
        const form = descriptionInput ? descriptionInput.closest('form') : null;

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
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
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

        // --- Thumbnail Live Preview ---
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

        // --- Additional Carousel Images count preview ---
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
@endpush
@endsection