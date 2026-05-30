@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-5xl">
    <!-- Header -->
    <div class="pb-6 border-b-4 border-black flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('admin.projects.edit', $project->id) }}" class="inline-flex items-center text-xs font-black uppercase tracking-wider text-black border-2 border-black bg-white hover:bg-[#ff5722] px-3 py-1.5 shadow-[2px_2px_0px_#000000] transition active:translate-x-0.5 active:translate-y-0.5 active:shadow-none mb-3">
                &larr; Kembali ke Form Proyek
            </a>
            <h1 class="text-3xl sm:text-4xl font-black uppercase tracking-tighter text-black">Kelola Gambar & Layout</h1>
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">// Proyek: {{ $project->title }}</p>
        </div>
        
        <!-- Status Indicator -->
        <div class="bg-black text-[#ff5722] border-3 border-black px-4 py-2.5 font-black text-xs uppercase tracking-widest shadow-[3px_3px_0px_#000000] self-start sm:self-center">
            MEDIA GRID MANAGER
        </div>
    </div>

    <!-- Flash message alerts -->
    @if(session('success'))
        <div class="bg-emerald-500 text-black border-4 border-black p-4 font-black text-xs uppercase tracking-wide shadow-[4px_4px_0px_#000000]">
            // {{ session('success') }}
        </div>
    @endif

    <!-- Upload Progress Indicator Bar -->
    <div id="upload-progress-container" class="bg-white border-4 border-black p-4 shadow-[4px_4px_0px_#000000] hidden space-y-2">
        <div class="flex items-center justify-between text-xs font-black uppercase tracking-wider">
            <span id="progress-status">// MENGUNGGAH & MENGOMPRESI GAMBAR (< 1MB)...</span>
            <span id="progress-percent">0%</span>
        </div>
        <div class="w-full bg-slate-200 border-2 border-black h-4 overflow-hidden relative">
            <div id="progress-bar" class="bg-[#ff5722] h-full w-0 transition-all duration-150"></div>
        </div>
    </div>

    <!-- Bulk Upload Drag-Drop Box -->
    <div class="bg-white border-4 border-black p-6 sm:p-8 shadow-[6px_6px_0px_#000000]">
        <h3 class="text-sm font-black uppercase tracking-wider text-black mb-3">// UNGGAH MASAL GAMBAR MOCKUP BARU</h3>
        
        <div id="bulk-dropzone" class="border-4 border-dashed border-black bg-slate-50 p-10 sm:p-14 flex flex-col items-center justify-center cursor-pointer hover:bg-orange-50/20 hover:border-[#ff5722] transition-all relative select-none">
            <svg class="w-12 h-12 text-slate-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2.5 2.5 0 013.536 0L17 16m-2-2l1.586-1.586a2.5 2.5 0 013.536 0L21 14m-9-4h.01M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="text-xs font-black uppercase tracking-wide text-black text-center mb-1">Seret & Lepas Gambar Pendukung ke Sini atau Klik untuk Memilih</span>
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">// Mendukung PNG, JPEG, JPG. Secara otomatis dikompresi di bawah 1MB!</span>
            <input type="file" id="bulk_file_input" multiple accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full">
        </div>
    </div>

    <!-- Grid Image Layout Configurator Form -->
    <div class="bg-white border-4 border-black p-6 sm:p-8 shadow-[6px_6px_0px_#000000]">
        <div class="flex items-center justify-between border-b-3 border-black pb-3 mb-6">
            <h3 class="text-base sm:text-lg font-black uppercase tracking-tighter text-black">// CONFIGURATION LAYOUT GRID</h3>
            <span class="text-xxs font-extrabold uppercase text-slate-500 tracking-wider">GAMBAR AKTIF: {{ $project->images->count() }}</span>
        </div>

        @if($project->images->isEmpty())
            <div class="text-center py-16 bg-slate-50 border-3 border-dashed border-black">
                <p class="text-xs font-extrabold uppercase tracking-wide text-slate-500">// Belum ada gambar pendukung. Silakan seret gambar di atas untuk memulai.</p>
            </div>
        @else
            <form action="{{ route('admin.projects.saveLayout', $project->id) }}" method="POST" class="space-y-8">
                @csrf
                
                <!-- Layout Grid Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="media-cards-grid">
                    @foreach($project->images as $img)
                        <div class="bg-white border-3 border-black p-4 shadow-[4px_4px_0px_#000000] relative flex flex-col justify-between" id="media-card-{{ $img->id }}">
                            
                            <!-- Thumbnail Area -->
                            <div class="aspect-video w-full bg-slate-100 border-2 border-black overflow-hidden flex items-center justify-center relative mb-4">
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="object-cover w-full h-full">
                                
                                <!-- Star Thumbnail Indicator Badge -->
                                @if($img->is_thumbnail)
                                    <div class="absolute top-2 left-2 bg-amber-400 text-black border-2 border-black px-2 py-0.5 text-[8px] font-black uppercase tracking-widest shadow-[1.5px_1.5px_0px_#000000] is-thumbnail-badge">
                                        COVER
                                    </div>
                                @endif
                            </div>

                            <!-- Controls specs inputs -->
                            <div class="space-y-3 font-sans font-bold text-[10px] uppercase text-black">
                                
                                <!-- 1. Cover Star Selection (Radio button) -->
                                <div class="flex items-center justify-between pb-2.5 border-b border-dashed border-slate-200">
                                    <span class="text-slate-500">GAMBAR SAMPUL:</span>
                                    <label class="cursor-pointer group flex items-center gap-1.5 select-none font-black text-xxs tracking-wider">
                                        <input type="radio" name="thumbnail_id" value="{{ $img->id }}" {{ $img->is_thumbnail ? 'checked' : '' }} class="hidden thumbnail-radio-input">
                                        <svg class="w-4 h-4 thumbnail-star-icon transition duration-150 {{ $img->is_thumbnail ? 'fill-amber-400 text-amber-500' : 'text-slate-400 group-hover:text-amber-500' }}" fill="{{ $img->is_thumbnail ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499c.176-.367.697-.367.873 0l2.184 4.547 5.013.727c.412.06.577.568.28.857l-3.628 3.535.856 4.992c.07.411-.363.726-.728.532L12 18.254l-4.475 2.348c-.365.194-.798-.121-.728-.532l.856-4.992L4.025 9.63c-.297-.29-.132-.797.28-.857l5.012-.727L11.48 3.5z" />
                                        </svg>
                                        <span class="cover-text-indicator {{ $img->is_thumbnail ? 'text-[#ff5722]' : 'text-slate-500 group-hover:text-black' }}">{{ $img->is_thumbnail ? 'Cover Sampul' : 'Jadikan Cover' }}</span>
                                    </label>
                                </div>

                                <!-- 2. col_span select -->
                                <div class="flex items-center justify-between pb-2.5 border-b border-dashed border-slate-200">
                                    <label for="col_span_{{ $img->id }}" class="text-slate-500">LEBAR GRID GAMBAR:</label>
                                    <select name="col_span[{{ $img->id }}]" id="col_span_{{ $img->id }}"
                                        class="bg-white border-2 border-black rounded-none px-2 py-1 text-xxs font-black text-black cursor-pointer focus:outline-none focus:bg-orange-50">
                                        <option value="1" {{ $img->col_span == 1 ? 'selected' : '' }}>Regular Card (1/3)</option>
                                        <option value="2" {{ $img->col_span == 2 ? 'selected' : '' }}>Wide Block (2/3)</option>
                                        <option value="3" {{ $img->col_span == 3 ? 'selected' : '' }}>Full View Banner (3/3)</option>
                                    </select>
                                </div>

                                <!-- 3. row_position and sort_order -->
                                <div class="grid grid-cols-2 gap-4 pb-2.5 border-b border-dashed border-slate-200">
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-500">BARIS:</span>
                                        <input type="number" name="row_position[{{ $img->id }}]" value="{{ $img->row_position }}" min="1" required
                                            class="w-12 bg-white border-2 border-black rounded-none px-1.5 py-0.5 text-center font-bold text-black focus:outline-none focus:bg-orange-50">
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-500">URUTAN:</span>
                                        <input type="number" name="sort_order[{{ $img->id }}]" value="{{ $img->sort_order }}" required
                                            class="w-12 bg-white border-2 border-black rounded-none px-1.5 py-0.5 text-center font-bold text-black focus:outline-none focus:bg-orange-50">
                                    </div>
                                </div>

                                <!-- 4. Hapus Button -->
                                <div class="pt-2 flex items-center justify-end">
                                    <button type="button" onclick="confirmDeleteMedia({{ $img->id }})" class="text-rose-600 hover:text-black font-black uppercase text-[10px] tracking-wide select-none">
                                        Hapus Gambar
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Submit Action Configuration Button -->
                <div class="pt-6 border-t-2 border-black flex items-center justify-between">
                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="brutal-btn-secondary px-5 py-2.5 text-xs font-black uppercase tracking-wider">
                        Kembali ke Form
                    </a>
                    
                    <button type="submit" class="brutal-btn-admin px-6 py-3 text-xs font-black uppercase tracking-wider shadow-[4px_4px_0px_#000000] hover:shadow-[6px_6px_0px_#000000]">
                        Simpan Konfigurasi Layout &rarr;
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>

<!-- Global Forgiving Brutalist Confirm Delete Modal -->
<div id="brutal-delete-confirm-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/75 backdrop-blur-xs hidden opacity-0 transition-all duration-300">
    <div class="bg-white border-4 border-black p-5 sm:p-6 max-w-md w-full shadow-[10px_10px_0px_#000000] scale-95 transition-all duration-300 flex flex-col" id="delete-modal-card">
        
        <!-- Header -->
        <div class="pb-3 border-b-3 border-black flex items-center justify-between bg-black text-[#ff5722] px-4 py-3 mb-4 -mx-5 sm:-mx-6 -mt-5 sm:-mt-6 shadow-[0px_3px_0px_#000000]">
            <h3 class="text-xs sm:text-sm font-black uppercase tracking-widest">// KONFIRMASI DELETION //</h3>
            <button type="button" onclick="closeDeleteModal()" class="text-[#ff5722] hover:text-white transition font-black text-xl leading-none">&times;</button>
        </div>
        
        <!-- Content Body -->
        <div class="space-y-4">
            <span class="block text-xs font-black uppercase tracking-wider text-rose-600">// PERINGATAN KERUSAKAN DATA:</span>
            <p class="text-xs font-bold text-slate-700 leading-relaxed uppercase">
                Apakah Anda yakin ingin menghapus gambar ini secara permanen dari server penyimpanan? Tindakan ini tidak dapat dibatalkan!
            </p>
        </div>
        
        <!-- Actions Button -->
        <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t-3 border-black">
            <button type="button" onclick="closeDeleteModal()" class="brutal-btn-secondary px-4 py-2 text-xxs font-black uppercase">
                Batal
            </button>
            <form id="delete-media-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="brutal-btn-admin px-4 py-2 text-xxs font-black uppercase bg-rose-600 text-white border-2 border-black hover:bg-black hover:text-rose-500">
                    Ya, Hapus Permanen!
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Skeleton Loading Placeholder block (Appended dynamically during upload) -->
<template id="skeleton-card-template">
    <div class="bg-white border-3 border-black p-4 shadow-[4px_4px_0px_#000000] animate-pulse flex flex-col justify-between">
        <div class="aspect-video w-full bg-slate-200 border-2 border-black overflow-hidden relative mb-4 flex items-center justify-center">
            <svg class="w-8 h-8 text-slate-350" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2.5 2.5 0 013.536 0L17 16m-2-2l1.586-1.586a2.5 2.5 0 013.536 0L21 14m-9-4h.01M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <div class="absolute bottom-2 right-2 bg-slate-300 w-12 h-3.5 border border-slate-300"></div>
        </div>
        <div class="space-y-3">
            <div class="h-4 bg-slate-200 w-full border border-slate-200"></div>
            <div class="h-4 bg-slate-200 w-full border border-slate-200"></div>
            <div class="h-6 bg-slate-200 w-2/3 border border-slate-200 mt-2"></div>
        </div>
    </div>
</template>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dropzone = document.getElementById('bulk-dropzone');
        const fileInput = document.getElementById('bulk_file_input');
        const progressContainer = document.getElementById('upload-progress-container');
        const progressBar = document.getElementById('progress-bar');
        const progressPercent = document.getElementById('progress-percent');
        const cardsGrid = document.getElementById('media-cards-grid');
        const skeletonTemplate = document.getElementById('skeleton-card-template');

        // Check if drag/drop events exist
        if (dropzone && fileInput) {
            
            // Highlight dropzone on drag over
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    dropzone.classList.add('bg-orange-50/50', 'border-[#ff5722]');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    dropzone.classList.remove('bg-orange-50/50', 'border-[#ff5722]');
                }, false);
            });

            // Handle dropped files
            dropzone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length > 0) {
                    uploadMultipleFiles(files);
                }
            });

            // Handle file input selection click
            fileInput.addEventListener('change', (e) => {
                const files = e.target.files;
                if (files.length > 0) {
                    uploadMultipleFiles(files);
                }
            });
        }

        // Bulk Files Upload Processing AJAX
        async function uploadMultipleFiles(files) {
            const imageFiles = Array.from(files).filter(file => file.type.startsWith('image/'));
            if (imageFiles.length === 0) return;

            // Show and reset progress bar
            progressContainer.classList.remove('hidden');
            progressBar.style.width = '0%';
            progressPercent.innerText = '0%';

            let totalFiles = imageFiles.length;
            let currentUploaded = 0;

            // Append skeleton cards dynamically in the grid to provide instant visual feedback!
            if (cardsGrid) {
                // If there's an empty placeholder container, clear it
                const emptyState = cardsGrid.closest('.bg-white').querySelector('.text-center.py-16');
                if (emptyState) {
                    // Quick page reload structure later, but for now we let it reload.
                }

                for (let i = 0; i < totalFiles; i++) {
                    const skeleton = skeletonTemplate.content.cloneNode(true);
                    cardsGrid.appendChild(skeleton);
                }
            }

            for (let i = 0; i < totalFiles; i++) {
                const file = imageFiles[i];
                const formData = new FormData();
                formData.append('file', file);
                formData.append('_token', '{{ csrf_token() }}');

                try {
                    const response = await fetch("{{ route('admin.projects.uploadMedia', $project->id) }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        currentUploaded++;
                        const percentVal = Math.round((currentUploaded / totalFiles) * 100);
                        progressBar.style.width = percentVal + '%';
                        progressPercent.innerText = percentVal + '%';
                    }
                } catch (err) {
                    console.error("Gagal mengunggah berkas " + file.name, err);
                }
            }

            // Once the entire upload queue finishes, reload the page to display fully configured native controllers!
            setTimeout(() => {
                window.location.reload();
            }, 800);
        }

        // Star Highlight toggle selection client side
        const radioInputs = document.querySelectorAll('.thumbnail-radio-input');
        radioInputs.forEach(radio => {
            radio.addEventListener('change', () => {
                // Unhighlight all stars
                document.querySelectorAll('.thumbnail-star-icon').forEach(icon => {
                    icon.classList.remove('fill-amber-400', 'text-amber-500');
                    icon.classList.add('text-slate-400');
                    icon.setAttribute('fill', 'none');
                });
                document.querySelectorAll('.cover-text-indicator').forEach(txt => {
                    txt.classList.remove('text-[#ff5722]');
                    txt.classList.add('text-slate-500');
                    txt.innerText = 'Jadikan Cover';
                });
                document.querySelectorAll('.is-thumbnail-badge').forEach(badge => badge.remove());

                // Highlight selected star
                if (radio.checked) {
                    const label = radio.closest('label');
                    const starIcon = label.querySelector('.thumbnail-star-icon');
                    starIcon.classList.remove('text-slate-400');
                    starIcon.classList.add('fill-amber-400', 'text-amber-500');
                    starIcon.setAttribute('fill', 'currentColor');
                    
                    const text = label.querySelector('.cover-text-indicator');
                    text.classList.remove('text-slate-500');
                    text.classList.add('text-[#ff5722]');
                    text.innerText = 'Cover Sampul';

                    // Dynamically prepend indicator badge to preview container
                    const card = radio.closest('[id^="media-card-"]');
                    const previewBox = card.querySelector('.aspect-video');
                    const newBadge = document.createElement('div');
                    newBadge.className = 'absolute top-2 left-2 bg-amber-400 text-black border-2 border-black px-2 py-0.5 text-[8px] font-black uppercase tracking-widest shadow-[1.5px_1.5px_0px_#000000] is-thumbnail-badge';
                    newBadge.innerText = 'COVER';
                    previewBox.appendChild(newBadge);
                }
            });
        });
    });

    // Global Forgiving Delete Confirmation Modal methods
    const deleteModal = document.getElementById('brutal-delete-confirm-modal');
    const deleteCard = document.getElementById('delete-modal-card');
    const deleteForm = document.getElementById('delete-media-form');

    function confirmDeleteMedia(imageId) {
        if (!deleteModal) return;
        
        // Dynamically build cascade action path
        const actionPath = "/cms/projects/{{ $project->id }}/media-uploader/" + imageId;
        deleteForm.action = actionPath;

        // Open modal
        deleteModal.classList.remove('hidden');
        setTimeout(() => {
            deleteModal.classList.remove('opacity-0');
            deleteCard.classList.remove('scale-95');
        }, 10);
    }

    function closeDeleteModal() {
        if (!deleteModal) return;
        deleteModal.classList.add('opacity-0');
        deleteCard.classList.add('scale-95');
        setTimeout(() => {
            deleteModal.classList.add('hidden');
            deleteForm.action = "";
        }, 300);
    }

    // Dismiss overlay click
    if (deleteModal) {
        deleteModal.addEventListener('click', (e) => {
            if (e.target === deleteModal) closeDeleteModal();
        });
    }
</script>
@endsection
