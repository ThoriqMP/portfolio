@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <!-- Header -->
    <div class="pb-6 border-b border-slate-200/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('admin.projects.edit', $project->id) }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-slate-900 transition mb-3">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Form Proyek
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">Kelola Galeri Media &amp; Grid</h1>
            <p class="text-sm font-medium text-slate-500 mt-1">Proyek: <strong class="text-slate-800">{{ $project->title }}</strong></p>
        </div>
        
        <!-- Status Indicator -->
        <div class="bg-slate-900 text-white rounded-xl px-4 py-2 font-semibold text-xs self-start sm:self-center shadow-xs">
            Media Grid Manager
        </div>
    </div>

    <!-- Flash message alerts -->
    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-800 border border-emerald-200/80 rounded-2xl p-4 text-xs font-semibold shadow-xs">
            {{ session('success') }}
        </div>
    @endif

    <!-- Upload Progress Indicator Bar -->
    <div id="upload-progress-container" class="bg-white rounded-2xl border border-slate-200/90 p-4 shadow-xs hidden space-y-2">
        <div class="flex items-center justify-between text-xs font-semibold text-slate-800">
            <span id="progress-status">Mengunggah &amp; mengompresi gambar...</span>
            <span id="progress-percent" class="text-[#FF4D2D]">0%</span>
        </div>
        <div class="w-full bg-slate-200 rounded-full h-2.5 overflow-hidden">
            <div id="progress-bar" class="bg-gradient-to-r from-[#FF4D2D] to-[#E63D1F] h-full w-0 transition-all duration-150 rounded-full"></div>
        </div>
    </div>

    <!-- Bulk Upload Drag-Drop Box -->
    <div class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-8 shadow-xs">
        <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-3">Unggah Masal Gambar Pendukung</h3>
        
        <div id="bulk-dropzone" class="rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50/60 p-10 sm:p-14 flex flex-col items-center justify-center cursor-pointer hover:bg-orange-50/20 hover:border-[#FF4D2D]/60 transition-all relative select-none">
            <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 text-slate-400 mb-3 flex items-center justify-center shadow-xs">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </div>
            <span class="text-sm font-bold text-slate-800 text-center mb-1">Seret &amp; Lepas Gambar Pendukung ke Sini atau Klik untuk Memilih</span>
            <span class="text-xs text-slate-400 font-medium">Mendukung PNG, JPEG, JPG, WEBP. Otomatis dikompresi di bawah 1MB!</span>
            <input type="file" id="bulk_file_input" multiple accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full">
        </div>
    </div>

    <!-- Grid Image Layout Configurator Form -->
    <div class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-8 shadow-xs">
        <div class="flex items-center justify-between border-b border-slate-200/80 pb-3 mb-6">
            <h3 class="text-base font-bold text-slate-900">Konfigurasi Layout Grid</h3>
            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600">GAMBAR AKTIF: {{ $project->images->count() }}</span>
        </div>

        @if($project->images->isEmpty())
            <div class="text-center py-16 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                <p class="text-xs font-medium text-slate-400">Belum ada gambar pendukung. Silakan seret gambar di atas untuk memulai.</p>
            </div>
        @else
            <form action="{{ route('admin.projects.saveLayout', $project->id) }}" method="POST" class="space-y-8">
                @csrf
                
                <!-- Layout Grid Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="media-cards-grid">
                    @foreach($project->images as $img)
                        <div class="bg-white rounded-2xl border border-slate-200/90 p-4 shadow-xs relative flex flex-col justify-between" id="media-card-{{ $img->id }}">
                            
                            <!-- Thumbnail Area -->
                            <div class="aspect-video w-full bg-slate-100 rounded-xl border border-slate-200 overflow-hidden flex items-center justify-center relative mb-4">
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="object-cover w-full h-full">
                                
                                <!-- Star Thumbnail Indicator Badge -->
                                @if($img->is_thumbnail)
                                    <div class="absolute top-2 left-2 bg-amber-400 text-slate-900 rounded-md px-2 py-0.5 text-[10px] font-bold uppercase shadow-sm is-thumbnail-badge">
                                        COVER
                                    </div>
                                @endif
                            </div>

                            <!-- Controls specs inputs -->
                            <div class="space-y-3 text-xs font-semibold text-slate-700">
                                
                                <!-- 1. Cover Star Selection (Radio button) -->
                                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                                    <span class="text-slate-400 text-[10px] uppercase font-bold">Gambar Sampul:</span>
                                    <label class="cursor-pointer group flex items-center gap-1.5 select-none font-bold text-xs">
                                        <input type="radio" name="thumbnail_id" value="{{ $img->id }}" {{ $img->is_thumbnail ? 'checked' : '' }} class="hidden thumbnail-radio-input">
                                        <svg class="w-4 h-4 thumbnail-star-icon transition duration-150 {{ $img->is_thumbnail ? 'fill-amber-400 text-amber-500' : 'text-slate-400 group-hover:text-amber-500' }}" fill="{{ $img->is_thumbnail ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499c.176-.367.697-.367.873 0l2.184 4.547 5.013.727c.412.06.577.568.28.857l-3.628 3.535.856 4.992c.07.411-.363.726-.728.532L12 18.254l-4.475 2.348c-.365.194-.798-.121-.728-.532l.856-4.992L4.025 9.63c-.297-.29-.132-.797.28-.857l5.012-.727L11.48 3.5z" />
                                        </svg>
                                        <span class="cover-text-indicator {{ $img->is_thumbnail ? 'text-[#FF4D2D]' : 'text-slate-500 group-hover:text-slate-900' }}">{{ $img->is_thumbnail ? 'Cover Sampul' : 'Jadikan Cover' }}</span>
                                    </label>
                                </div>

                                <!-- 2. col_span select -->
                                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                                    <label for="col_span_{{ $img->id }}" class="text-slate-400 text-[10px] uppercase font-bold">Lebar Grid:</label>
                                    <select name="col_span[{{ $img->id }}]" id="col_span_{{ $img->id }}"
                                        class="bg-white rounded-lg border border-slate-200 px-2 py-1 text-xs font-semibold text-slate-800 cursor-pointer focus:outline-none focus:border-[#FF4D2D]">
                                        <option value="1" {{ $img->col_span == 1 ? 'selected' : '' }}>Regular (1/3)</option>
                                        <option value="2" {{ $img->col_span == 2 ? 'selected' : '' }}>Wide (2/3)</option>
                                        <option value="3" {{ $img->col_span == 3 ? 'selected' : '' }}>Full (3/3)</option>
                                    </select>
                                </div>

                                <!-- 3. row_position and sort_order -->
                                <div class="grid grid-cols-2 gap-4 pb-2 border-b border-slate-100">
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-400 text-[10px] uppercase font-bold">Baris:</span>
                                        <input type="number" name="row_position[{{ $img->id }}]" value="{{ $img->row_position }}" min="1" required
                                            class="w-12 bg-white rounded-lg border border-slate-200 px-1.5 py-0.5 text-center font-bold text-slate-800 focus:outline-none focus:border-[#FF4D2D]">
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-400 text-[10px] uppercase font-bold">Urutan:</span>
                                        <input type="number" name="sort_order[{{ $img->id }}]" value="{{ $img->sort_order }}" required
                                            class="w-12 bg-white rounded-lg border border-slate-200 px-1.5 py-0.5 text-center font-bold text-slate-800 focus:outline-none focus:border-[#FF4D2D]">
                                    </div>
                                </div>

                                <!-- 4. Hapus Button -->
                                <div class="pt-1 flex items-center justify-end">
                                    <button type="button" onclick="confirmDeleteMedia({{ $img->id }})" class="text-rose-600 hover:text-rose-700 font-semibold text-xs select-none">
                                        Hapus Gambar
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Submit Action Configuration Button -->
                <div class="pt-6 border-t border-slate-200/80 flex items-center justify-between">
                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="brutal-btn-secondary text-xs">
                        Kembali ke Form
                    </a>
                    
                    <button type="submit" class="brutal-btn-admin text-xs">
                        <span>Simpan Konfigurasi Layout</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>

<!-- Confirm Delete Modal -->
<div id="brutal-delete-confirm-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm hidden opacity-0 transition-all duration-200">
    <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-7 max-w-md w-full shadow-2xl scale-95 transition-all duration-200 flex flex-col" id="delete-modal-card">
        
        <div class="w-12 h-12 rounded-2xl bg-rose-50 border border-rose-100 text-rose-500 mx-auto mb-3 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
        </div>
        
        <div class="text-center space-y-2">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">Hapus Gambar?</h3>
            <p class="text-xs text-slate-500 leading-relaxed">
                Apakah Anda yakin ingin menghapus gambar ini secara permanen dari server penyimpanan?
            </p>
        </div>
        
        <div class="flex items-center justify-center gap-3 mt-6 pt-4 border-t border-slate-100">
            <button type="button" onclick="closeDeleteModal()" class="brutal-btn-secondary text-xs">
                Batal
            </button>
            <form id="delete-media-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 text-xs font-semibold rounded-xl bg-rose-600 hover:bg-rose-700 text-white shadow-xs transition">
                    Ya, Hapus Permanen
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Skeleton Loading Placeholder block -->
<template id="skeleton-card-template">
    <div class="bg-white rounded-2xl border border-slate-200 p-4 shadow-xs animate-pulse flex flex-col justify-between">
        <div class="aspect-video w-full bg-slate-200 rounded-xl overflow-hidden relative mb-4 flex items-center justify-center">
            <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2.5 2.5 0 013.536 0L17 16m-2-2l1.586-1.586a2.5 2.5 0 013.536 0L21 14m-9-4h.01M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        <div class="space-y-3">
            <div class="h-3 bg-slate-200 w-full rounded"></div>
            <div class="h-3 bg-slate-200 w-full rounded"></div>
            <div class="h-5 bg-slate-200 w-2/3 rounded mt-2"></div>
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

        if (dropzone && fileInput) {
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    dropzone.classList.add('bg-orange-50/50', 'border-[#FF4D2D]');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    dropzone.classList.remove('bg-orange-50/50', 'border-[#FF4D2D]');
                }, false);
            });

            dropzone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length > 0) {
                    uploadMultipleFiles(files);
                }
            });

            fileInput.addEventListener('change', (e) => {
                const files = e.target.files;
                if (files.length > 0) {
                    uploadMultipleFiles(files);
                }
            });
        }

        async function uploadMultipleFiles(files) {
            const imageFiles = Array.from(files).filter(file => file.type.startsWith('image/'));
            if (imageFiles.length === 0) return;

            progressContainer.classList.remove('hidden');
            progressBar.style.width = '0%';
            progressPercent.innerText = '0%';

            let totalFiles = imageFiles.length;
            let currentUploaded = 0;

            if (cardsGrid) {
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

            setTimeout(() => {
                window.location.reload();
            }, 800);
        }

        const radioInputs = document.querySelectorAll('.thumbnail-radio-input');
        radioInputs.forEach(radio => {
            radio.addEventListener('change', () => {
                document.querySelectorAll('.thumbnail-star-icon').forEach(icon => {
                    icon.classList.remove('fill-amber-400', 'text-amber-500');
                    icon.classList.add('text-slate-400');
                    icon.setAttribute('fill', 'none');
                });
                document.querySelectorAll('.cover-text-indicator').forEach(txt => {
                    txt.classList.remove('text-[#FF4D2D]');
                    txt.classList.add('text-slate-500');
                    txt.innerText = 'Jadikan Cover';
                });
                document.querySelectorAll('.is-thumbnail-badge').forEach(badge => badge.remove());

                if (radio.checked) {
                    const label = radio.closest('label');
                    const starIcon = label.querySelector('.thumbnail-star-icon');
                    starIcon.classList.remove('text-slate-400');
                    starIcon.classList.add('fill-amber-400', 'text-amber-500');
                    starIcon.setAttribute('fill', 'currentColor');
                    
                    const text = label.querySelector('.cover-text-indicator');
                    text.classList.remove('text-slate-500');
                    text.classList.add('text-[#FF4D2D]');
                    text.innerText = 'Cover Sampul';

                    const card = radio.closest('[id^="media-card-"]');
                    const previewBox = card.querySelector('.aspect-video');
                    const newBadge = document.createElement('div');
                    newBadge.className = 'absolute top-2 left-2 bg-amber-400 text-slate-900 rounded-md px-2 py-0.5 text-[10px] font-bold uppercase shadow-sm is-thumbnail-badge';
                    newBadge.innerText = 'COVER';
                    previewBox.appendChild(newBadge);
                }
            });
        });
    });

    const deleteModal = document.getElementById('brutal-delete-confirm-modal');
    const deleteCard = document.getElementById('delete-modal-card');
    const deleteForm = document.getElementById('delete-media-form');

    function confirmDeleteMedia(imageId) {
        if (!deleteModal) return;
        
        const actionPath = "/cms/projects/{{ $project->id }}/media-uploader/" + imageId;
        deleteForm.action = actionPath;

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
        }, 200);
    }

    if (deleteModal) {
        deleteModal.addEventListener('click', (e) => {
            if (e.target === deleteModal) closeDeleteModal();
        });
    }
</script>
@endsection