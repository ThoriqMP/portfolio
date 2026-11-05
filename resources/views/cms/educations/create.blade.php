@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-3xl mx-auto">
    <!-- Header -->
    <div class="pb-6 border-b border-slate-200/80">
        <a href="{{ route('admin.educations.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-slate-900 transition mb-3">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Riwayat Pendidikan
        </a>
        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">Tambah Riwayat Pendidikan</h1>
        <p class="text-sm font-medium text-slate-500 mt-1">Lengkapi form berikut untuk mencatat riwayat sekolah, kampus, atau kursus formal Anda.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-8 shadow-xs">
        <form action="{{ route('admin.educations.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Institution Name -->
            <div>
                <label for="institution_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nama Institusi</label>
                <input type="text" name="institution_name" id="institution_name" value="{{ old('institution_name') }}" placeholder="Contoh: Universitas Indonesia" required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 text-sm font-medium placeholder-slate-400 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
                @error('institution_name')
                    <p class="text-rose-600 text-xs font-semibold mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Degree / Course -->
            <div>
                <label for="degree" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Gelar / Bidang Studi</label>
                <input type="text" name="degree" id="degree" value="{{ old('degree') }}" placeholder="Contoh: S1 Teknik Informatika" required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 text-sm font-medium placeholder-slate-400 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
                @error('degree')
                    <p class="text-rose-600 text-xs font-semibold mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Years Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Start Year -->
                <div>
                    <label for="start_year" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Tahun Mulai</label>
                    <input type="number" name="start_year" id="start_year" value="{{ old('start_year', date('Y')) }}" min="1900" max="2100" required
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 text-sm font-medium focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
                    @error('start_year')
                        <p class="text-rose-600 text-xs font-semibold mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- End Year -->
                <div>
                    <label for="end_year" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Tahun Lulus (Opsional)</label>
                    <input type="number" name="end_year" id="end_year" value="{{ old('end_year') }}" min="1900" max="2100" placeholder="Kosongkan jika masih aktif belajar"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 text-sm font-medium placeholder-slate-400 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
                    @error('end_year')
                        <p class="text-rose-600 text-xs font-semibold mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Pencapaian / Deskripsi (Opsional)</label>
                
                <!-- Input Format Selector -->
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-xs font-semibold text-slate-500">Format Input:</span>
                    <button type="button" id="format-text-btn" class="px-3 py-1.5 rounded-lg font-semibold text-xs transition bg-slate-900 text-white shadow-xs">
                        Paragraf
                    </button>
                    <button type="button" id="format-list-btn" class="px-3 py-1.5 rounded-lg font-semibold text-xs transition bg-slate-100 hover:bg-slate-200 text-slate-700">
                        Daftar Poin
                    </button>
                </div>

                <!-- Textarea (paragraph format) -->
                <textarea name="description" id="description" rows="4" placeholder="Tuliskan pencapaian akademik, kegiatan organisasi, atau penghargaan..."
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 text-sm font-medium placeholder-slate-400 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition leading-relaxed">{{ old('description') }}</textarea>

                <!-- Bullet Points Container (list format) -->
                <div id="bullet-points-wrapper" class="hidden space-y-4">
                    <div id="bullet-points-list" class="space-y-3">
                        <!-- Dynamic inputs will be generated here -->
                    </div>
                    <button type="button" id="add-point-btn" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition">
                        <svg class="w-4 h-4 text-[#FF4D2D]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>Tambah Poin Baru</span>
                    </button>
                </div>

                @error('description')
                    <p class="text-rose-600 text-xs font-semibold mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="pt-6 border-t border-slate-200/80 flex items-center justify-end gap-3">
                <a href="{{ route('admin.educations.index') }}" class="brutal-btn-secondary text-xs">Batal</a>
                <button type="submit" class="brutal-btn-admin text-xs">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span>Simpan Riwayat</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const textBtn = document.getElementById('format-text-btn');
    const listBtn = document.getElementById('format-list-btn');
    const textarea = document.getElementById('description');
    const wrapper = document.getElementById('bullet-points-wrapper');
    const listContainer = document.getElementById('bullet-points-list');
    const addBtn = document.getElementById('add-point-btn');

    let currentFormat = 'text';

    function init() {
        const rawValue = textarea.value.trim();
        let isJson = false;
        let parsedData = [];

        try {
            if (rawValue.startsWith('[') && rawValue.endsWith(']')) {
                parsedData = JSON.parse(rawValue);
                if (Array.isArray(parsedData)) {
                    isJson = true;
                }
            }
        } catch (e) {
            isJson = false;
        }

        if (isJson) {
            setFormat('list');
            renderPoints(parsedData);
        } else {
            setFormat('text');
            if (rawValue === '') {
                renderPoints(['']);
            } else {
                const lines = rawValue.split('\n').map(line => {
                    return line.replace(/^[\s\-\*•\+]+/, '').trim();
                });
                renderPoints(lines);
            }
        }
    }

    function setFormat(format) {
        currentFormat = format;
        if (format === 'text') {
            textBtn.className = "px-3 py-1.5 rounded-lg font-semibold text-xs transition bg-slate-900 text-white shadow-xs";
            listBtn.className = "px-3 py-1.5 rounded-lg font-semibold text-xs transition bg-slate-100 hover:bg-slate-200 text-slate-700";
            
            textarea.classList.remove('hidden');
            wrapper.classList.add('hidden');
        } else {
            listBtn.className = "px-3 py-1.5 rounded-lg font-semibold text-xs transition bg-slate-900 text-white shadow-xs";
            textBtn.className = "px-3 py-1.5 rounded-lg font-semibold text-xs transition bg-slate-100 hover:bg-slate-200 text-slate-700";
            
            textarea.classList.add('hidden');
            wrapper.classList.remove('hidden');
        }
    }

    function renderPoints(points) {
        listContainer.innerHTML = '';
        points.forEach(point => {
            addPointRow(point);
        });
        if (listContainer.children.length === 0) {
            addPointRow('');
        }
    }

    function addPointRow(value = '') {
        const div = document.createElement('div');
        div.className = 'flex items-center gap-2 bullet-point-row';
        div.innerHTML = `
            <span class="text-[#FF4D2D] font-bold text-lg select-none">•</span>
            <input type="text" value="${escapeHtml(value)}" placeholder="Tuliskan pencapaian akademik, kepanitiaan, atau detail..." 
                class="bullet-input flex-grow rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 text-sm font-medium placeholder-slate-400 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
            <button type="button" class="remove-point-btn p-2 rounded-xl border border-rose-100 bg-rose-50 hover:bg-rose-100 text-rose-600 transition flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        `;
        listContainer.appendChild(div);

        div.querySelector('.remove-point-btn').addEventListener('click', () => {
            div.remove();
            if (listContainer.children.length === 0) {
                addPointRow('');
            }
            updateTextareaValue();
        });

        div.querySelector('.bullet-input').addEventListener('input', updateTextareaValue);
    }

    function updateTextareaValue() {
        if (currentFormat === 'list') {
            const inputs = listContainer.querySelectorAll('.bullet-input');
            const points = [];
            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    points.push(input.value.trim());
                }
            });
            textarea.value = points.length > 0 ? JSON.stringify(points) : '';
        }
    }

    function escapeHtml(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    textBtn.addEventListener('click', () => {
        if (currentFormat === 'text') return;
        
        const inputs = listContainer.querySelectorAll('.bullet-input');
        const points = [];
        inputs.forEach(input => {
            if (input.value.trim() !== '') {
                points.push(input.value.trim());
            }
        });
        
        textarea.value = points.join('\n');
        setFormat('text');
    });

    listBtn.addEventListener('click', () => {
        if (currentFormat === 'list') return;

        const lines = textarea.value.split('\n')
            .map(line => line.replace(/^[\s\-\*•\+]+/, '').trim())
            .filter(line => line !== '');
        
        renderPoints(lines.length > 0 ? lines : ['']);
        setFormat('list');
        updateTextareaValue();
    });

    addBtn.addEventListener('click', () => {
        addPointRow('');
        const rows = listContainer.querySelectorAll('.bullet-input');
        if (rows.length > 0) {
            rows[rows.length - 1].focus();
        }
    });

    const form = textarea.closest('form');
    if (form) {
        form.addEventListener('submit', () => {
            updateTextareaValue();
        });
    }

    init();
});
</script>
@endsection