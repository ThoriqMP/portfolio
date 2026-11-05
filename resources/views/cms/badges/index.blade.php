@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="pb-6 border-b border-slate-200/80">
        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">Kelola Lencana Keahlian</h1>
        <p class="text-slate-500 font-medium text-sm mt-1">Kustomisasikan lencana teknologi dan keahlian yang muncul di halaman beranda dan proyek Anda.</p>
    </div>

    <!-- Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Column: Badges List (7 Cols) -->
        <div class="lg:col-span-7 space-y-6">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900 tracking-tight">Koleksi Lencana Aktif</h2>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-100 text-slate-700">
                    {{ $badges->count() }} Lencana
                </span>
            </div>
            
            @if($badges->isEmpty())
                <div class="p-10 bg-white rounded-3xl border-2 border-dashed border-slate-200 text-center">
                    <p class="font-medium text-slate-500 text-sm">Belum ada lencana keahlian. Tambahkan lencana pertama Anda di samping!</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($badges as $badge)
                        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs hover:shadow-md transition duration-200 flex flex-col justify-between h-full relative group" id="badge-card-{{ $badge->id }}">
                            <!-- Color Swatches top accent pill -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-3 py-1 rounded-lg text-xs font-semibold shadow-xs"
                                      style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }};">
                                    {{ $badge->name }}
                                </span>
                                <div class="w-3.5 h-3.5 rounded-full border border-slate-300" style="background-color: {{ $badge->bg_color }}"></div>
                            </div>
                            
                            <!-- Metadata Hex Codes -->
                            <div class="grid grid-cols-2 gap-2 text-[10px] font-semibold text-slate-500 bg-slate-50 rounded-xl p-2.5 border border-slate-100 mt-2">
                                <div>Latar: <span class="font-mono text-slate-800 font-bold block">{{ $badge->bg_color }}</span></div>
                                <div>Teks: <span class="font-mono text-slate-800 font-bold block">{{ $badge->text_color }}</span></div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                                <button type="button" 
                                        onclick="enableEditMode({{ $badge->id }}, '{{ addslashes($badge->name) }}', '{{ $badge->bg_color }}', '{{ $badge->text_color }}')"
                                        class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    Edit
                                </button>
                                <button type="button" 
                                        onclick="triggerDelete('{{ route('admin.badges.destroy', $badge->id) }}', 'lencana {{ addslashes($badge->name) }}')"
                                        class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 transition flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Right Column: Interactive Form Card (5 Cols) -->
        <div class="lg:col-span-5 sticky lg:top-20">
            <div class="bg-white rounded-3xl border border-slate-200/90 p-6 shadow-xs space-y-6" id="form-container">
                <div class="border-b border-slate-200/80 pb-3">
                    <h3 class="text-base font-bold text-slate-900" id="form-title">Tambah Lencana Keahlian</h3>
                    <p class="text-xs text-slate-500 font-medium mt-0.5" id="form-subtitle">Buat lencana baru dengan palet warna pilihan Anda.</p>
                </div>

                <!-- Live Realtime Preview Card -->
                <div class="bg-slate-50 rounded-2xl border border-slate-200 p-5 flex flex-col items-center justify-center space-y-2">
                    <span class="text-xs font-semibold text-slate-500 self-start">Pratinjau Tampilan:</span>
                    <div class="py-3">
                        <span id="preview-badge-element" class="px-3 py-1.5 rounded-xl font-semibold text-xs inline-block shadow-xs transition"
                              style="background-color: #FF4D2D; color: #ffffff;">
                            LENCANA PREVIEW
                        </span>
                    </div>
                </div>

                <form id="badge-crud-form" action="{{ route('admin.badges.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div id="method-spoofing-container"></div>

                    <!-- Badge Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nama Lencana</label>
                        <input type="text" name="name" id="name" placeholder="Contoh: Laravel 11" required
                               class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 text-sm font-medium placeholder-slate-400 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
                        @error('name')
                            <p class="text-rose-600 text-xs font-semibold mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Background Color Selectors -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Warna Latar (Background)</label>
                        
                        <!-- Curated Presets -->
                        <div class="flex flex-wrap gap-2 pb-1">
                            <button type="button" onclick="selectColorPreset('bg', '#FF4D2D')" class="w-7 h-7 rounded-lg border border-slate-300 hover:scale-110 transition bg-[#FF4D2D]" title="Signature Orange"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#0B0F17')" class="w-7 h-7 rounded-lg border border-slate-300 hover:scale-110 transition bg-[#0B0F17]" title="Deep Black"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#2563EB')" class="w-7 h-7 rounded-lg border border-slate-300 hover:scale-110 transition bg-[#2563EB]" title="Blue"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#059669')" class="w-7 h-7 rounded-lg border border-slate-300 hover:scale-110 transition bg-[#059669]" title="Emerald Green"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#7C3AED')" class="w-7 h-7 rounded-lg border border-slate-300 hover:scale-110 transition bg-[#7C3AED]" title="Purple"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#F1F5F9')" class="w-7 h-7 rounded-lg border border-slate-300 hover:scale-110 transition bg-[#F1F5F9]" title="Light Slate"></button>
                        </div>

                        <!-- HEX Input and Picker -->
                        <div class="flex items-center gap-3">
                            <div class="relative flex-grow">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 font-mono font-bold text-slate-400 text-xs">HEX:</span>
                                <input type="text" name="bg_color" id="bg_color" value="#FF4D2D" required
                                       class="w-full rounded-xl border border-slate-200 bg-white pl-12 pr-4 py-2 text-slate-900 font-mono text-xs font-semibold focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
                            </div>
                            <input type="color" id="bg_color_picker" value="#FF4D2D" class="w-10 h-10 rounded-xl border border-slate-200 cursor-pointer p-0.5 bg-white">
                        </div>
                        @error('bg_color')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Text Color Selectors -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Warna Teks</label>
                        
                        <!-- Curated Contrast toggles -->
                        <div class="flex gap-2">
                            <button type="button" onclick="selectColorPreset('text', '#0B0F17')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-800 transition flex items-center gap-1.5">
                                <span class="w-3 h-3 rounded-full bg-slate-900 inline-block"></span> Teks Gelap
                            </button>
                            <button type="button" onclick="selectColorPreset('text', '#FFFFFF')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-800 transition flex items-center gap-1.5">
                                <span class="w-3 h-3 rounded-full bg-white border border-slate-300 inline-block"></span> Teks Putih
                            </button>
                        </div>

                        <!-- HEX Input and Picker -->
                        <div class="flex items-center gap-3">
                            <div class="relative flex-grow">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 font-mono font-bold text-slate-400 text-xs">HEX:</span>
                                <input type="text" name="text_color" id="text_color" value="#FFFFFF" required
                                       class="w-full rounded-xl border border-slate-200 bg-white pl-12 pr-4 py-2 text-slate-900 font-mono text-xs font-semibold focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
                            </div>
                            <input type="color" id="text_color_picker" value="#FFFFFF" class="w-10 h-10 rounded-xl border border-slate-200 cursor-pointer p-0.5 bg-white">
                        </div>
                        @error('text_color')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="pt-4 border-t border-slate-100 flex flex-col gap-2" id="form-actions">
                        <button type="submit" class="brutal-btn-admin w-full text-xs font-semibold" id="submit-form-btn">
                            Simpan Lencana Teknologi
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const nameInput = document.getElementById('name');
        const bgColorInput = document.getElementById('bg_color');
        const bgPicker = document.getElementById('bg_color_picker');
        const textColorInput = document.getElementById('text_color');
        const textPicker = document.getElementById('text_color_picker');
        const previewElement = document.getElementById('preview-badge-element');

        function updateLivePreview() {
            const nameValue = nameInput.value.trim();
            previewElement.textContent = nameValue !== "" ? nameValue : "LENCANA PREVIEW";
            previewElement.style.backgroundColor = bgColorInput.value;
            previewElement.style.color = textColorInput.value;
        }

        nameInput.addEventListener('input', updateLivePreview);

        bgColorInput.addEventListener('input', (e) => {
            let val = e.target.value;
            if (val.startsWith('#') && (val.length === 4 || val.length === 7)) {
                bgPicker.value = val;
            }
            updateLivePreview();
        });

        bgPicker.addEventListener('input', (e) => {
            bgColorInput.value = e.target.value.toUpperCase();
            updateLivePreview();
        });

        textColorInput.addEventListener('input', (e) => {
            let val = e.target.value;
            if (val.startsWith('#') && (val.length === 4 || val.length === 7)) {
                textPicker.value = val;
            }
            updateLivePreview();
        });

        textPicker.addEventListener('input', (e) => {
            textColorInput.value = e.target.value.toUpperCase();
            updateLivePreview();
        });

        updateLivePreview();

        window.selectColorPreset = function(type, hex) {
            if (type === 'bg') {
                bgColorInput.value = hex.toUpperCase();
                bgPicker.value = hex;
            } else if (type === 'text') {
                textColorInput.value = hex.toUpperCase();
                textPicker.value = hex;
            }
            updateLivePreview();
        };
    });

    function enableEditMode(id, name, bgColor, textColor) {
        const formContainer = document.getElementById('form-container');
        const formTitle = document.getElementById('form-title');
        const formSubtitle = document.getElementById('form-subtitle');
        const form = document.getElementById('badge-crud-form');
        const nameInput = document.getElementById('name');
        const bgColorInput = document.getElementById('bg_color');
        const bgPicker = document.getElementById('bg_color_picker');
        const textColorInput = document.getElementById('text_color');
        const textPicker = document.getElementById('text_color_picker');
        const methodContainer = document.getElementById('method-spoofing-container');
        const submitBtn = document.getElementById('submit-form-btn');
        const actionsDiv = document.getElementById('form-actions');

        formTitle.textContent = 'Edit Lencana Keahlian';
        formSubtitle.textContent = `Sedang mengubah lencana: "${name}".`;
        formContainer.classList.add('ring-2', 'ring-[#FF4D2D]/30');

        nameInput.value = name;
        bgColorInput.value = bgColor.toUpperCase();
        bgPicker.value = bgColor;
        textColorInput.value = textColor.toUpperCase();
        textPicker.value = textColor;

        form.action = `/cms/badges/${id}`;
        methodContainer.innerHTML = '@method("PUT")';
        submitBtn.textContent = 'Perbarui Lencana Teknologi';

        let cancelBtn = document.getElementById('cancel-edit-btn');
        if (!cancelBtn) {
            cancelBtn = document.createElement('button');
            cancelBtn.type = 'button';
            cancelBtn.id = 'cancel-edit-btn';
            cancelBtn.className = 'brutal-btn-secondary w-full text-xs font-semibold';
            cancelBtn.textContent = 'Batal Edit (Kembali ke Tambah)';
            cancelBtn.onclick = disableEditMode;
            actionsDiv.appendChild(cancelBtn);
        }

        nameInput.dispatchEvent(new Event('input'));
        formContainer.scrollIntoView({ behavior: 'smooth' });
    }

    function disableEditMode() {
        const formContainer = document.getElementById('form-container');
        const formTitle = document.getElementById('form-title');
        const formSubtitle = document.getElementById('form-subtitle');
        const form = document.getElementById('badge-crud-form');
        const nameInput = document.getElementById('name');
        const bgColorInput = document.getElementById('bg_color');
        const bgPicker = document.getElementById('bg_color_picker');
        const textColorInput = document.getElementById('text_color');
        const textPicker = document.getElementById('text_color_picker');
        const methodContainer = document.getElementById('method-spoofing-container');
        const submitBtn = document.getElementById('submit-form-btn');
        const cancelBtn = document.getElementById('cancel-edit-btn');

        formTitle.textContent = 'Tambah Lencana Keahlian';
        formSubtitle.textContent = 'Buat lencana baru dengan palet warna pilihan Anda.';
        formContainer.classList.remove('ring-2', 'ring-[#FF4D2D]/30');

        nameInput.value = '';
        bgColorInput.value = '#FF4D2D';
        bgPicker.value = '#FF4D2D';
        textColorInput.value = '#FFFFFF';
        textPicker.value = '#FFFFFF';

        form.action = "{{ route('admin.badges.store') }}";
        methodContainer.innerHTML = '';
        submitBtn.textContent = 'Simpan Lencana Teknologi';

        if (cancelBtn) cancelBtn.remove();
        nameInput.dispatchEvent(new Event('input'));
    }
</script>
@endsection