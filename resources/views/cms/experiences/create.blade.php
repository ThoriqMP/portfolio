@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-3xl">
    <!-- Header -->
    <div class="pb-6 border-b-4 border-black">
        <a href="{{ route('admin.experiences.index') }}" class="inline-flex items-center text-xs font-black uppercase tracking-wider text-black border-2 border-black bg-white hover:bg-[#ff5722] px-3 py-1.5 shadow-[2px_2px_0px_#000000] transition active:translate-x-0.5 active:translate-y-0.5 active:shadow-none mb-4">
            &larr; Kembali ke Pengalaman
        </a>
        <h1 class="text-4xl font-black uppercase tracking-tighter text-black">Tambah Pengalaman Kerja</h1>
        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">// Lengkapilah form berikut untuk menambah riwayat pekerjaan baru.</p>
    </div>

    <!-- Form Card (Brutalist Box) -->
    <div class="bg-white border-4 border-black p-6 sm:p-8 shadow-[6px_6px_0px_#000000]">
        <form action="{{ route('admin.experiences.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Company Name -->
            <div>
                <label for="company_name" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Nama Perusahaan</label>
                <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" placeholder="Contoh: PT. Teknologi Indonesia" required
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                @error('company_name')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Position / Job Title -->
            <div>
                <label for="position" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Jabatan / Posisi Kerja</label>
                <input type="text" name="position" id="position" value="{{ old('position') }}" placeholder="Contoh: Senior Fullstack Web Developer" required
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                @error('position')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Dates Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Start Date -->
                <div>
                    <label for="start_date" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Tanggal Mulai Kerja</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required
                        class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                    @error('start_date')
                        <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                    @enderror
                </div>

                <!-- End Date -->
                <div>
                    <label for="end_date" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Tanggal Selesai Kerja (Opsional)</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                        class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                    <p class="text-slate-500 text-xxs font-bold uppercase mt-1.5">// Biarkan kosong jika masih aktif bekerja disini.</p>
                    @error('end_date')
                        <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-black mb-2">Tanggung Jawab & Pencapaian</label>
                
                <!-- Input Format Selector -->
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-xxs font-black uppercase tracking-wider text-slate-500">// FORMAT INPUT:</span>
                    <button type="button" id="format-text-btn" class="px-3 py-1.5 border-2 border-black font-extrabold text-xs uppercase transition-all duration-150 active:translate-y-0.5 active:shadow-none shadow-[2px_2px_0px_#000000] bg-white text-black">
                        Paragraf
                    </button>
                    <button type="button" id="format-list-btn" class="px-3 py-1.5 border-2 border-black font-extrabold text-xs uppercase transition-all duration-150 active:translate-y-0.5 active:shadow-none shadow-[2px_2px_0px_#000000] bg-white text-black">
                        Daftar Poin
                    </button>
                </div>

                <!-- Textarea (paragraph format) -->
                <textarea name="description" id="description" rows="5" placeholder="Jelaskan peran Anda, teknologi yang digunakan, dan pencapaian Anda..." required
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">{{ old('description') }}</textarea>

                <!-- Bullet Points Container (list format) -->
                <div id="bullet-points-wrapper" class="hidden space-y-4">
                    <div id="bullet-points-list" class="space-y-3">
                        <!-- Dynamic inputs will be generated here -->
                    </div>
                    <button type="button" id="add-point-btn" class="inline-flex items-center gap-1.5 px-3 py-2 border-2 border-black bg-white hover:bg-slate-100 text-black text-xs font-extrabold uppercase shadow-[2px_2px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Poin Baru
                    </button>
                </div>

                @error('description')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="pt-6 border-t-2 border-black flex items-center justify-end gap-3">
                <a href="{{ route('admin.experiences.index') }}" class="brutal-btn-secondary px-5 py-2.5 text-sm">Batal</a>
                <button type="submit" class="brutal-btn-admin px-5 py-2.5 text-sm">
                    Simpan Pengalaman
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
            textBtn.className = "px-3 py-1.5 border-2 border-black bg-black text-[#ff5722] shadow-[2px_2px_0px_#ff5722] font-black text-xs uppercase active:translate-y-0.5 active:shadow-none";
            listBtn.className = "px-3 py-1.5 border-2 border-black bg-white text-black hover:bg-slate-100 font-extrabold text-xs uppercase shadow-[2px_2px_0px_#000000] active:translate-y-0.5 active:shadow-none";
            
            textarea.classList.remove('hidden');
            wrapper.classList.add('hidden');
            textarea.required = true;
        } else {
            listBtn.className = "px-3 py-1.5 border-2 border-black bg-black text-[#ff5722] shadow-[2px_2px_0px_#ff5722] font-black text-xs uppercase active:translate-y-0.5 active:shadow-none";
            textBtn.className = "px-3 py-1.5 border-2 border-black bg-white text-black hover:bg-slate-100 font-extrabold text-xs uppercase shadow-[2px_2px_0px_#000000] active:translate-y-0.5 active:shadow-none";
            
            textarea.classList.add('hidden');
            wrapper.classList.remove('hidden');
            textarea.required = false;
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
            <span class="text-black font-black text-lg select-none">•</span>
            <input type="text" value="${escapeHtml(value)}" placeholder="Tuliskan poin tugas/tanggung jawab/pencapaian..." required
                class="bullet-input flex-grow bg-white border-3 border-black rounded-none px-4 py-2.5 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[3px_3px_0px_#000000] transition-all duration-150">
            <button type="button" class="remove-point-btn p-2 border-2 border-black bg-[#ff5722] hover:bg-orange-600 text-black shadow-[2px_2px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
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
            textarea.value = JSON.stringify(points);
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
