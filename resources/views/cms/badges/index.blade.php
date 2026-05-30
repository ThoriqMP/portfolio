@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="pb-6 border-b-4 border-black">
        <h1 class="text-4xl font-black uppercase tracking-tighter text-black">Kelola Lencana Teknologi</h1>
        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">// Kustomisasikan lencana keahlian yang muncul di profil halaman depan Anda.</p>
    </div>

    <!-- Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Column: Badges List (8 Cols) -->
        <div class="lg:col-span-7 space-y-6">
            <h2 class="text-2xl font-black uppercase tracking-tight text-black">// Lencana Aktif</h2>
            
            @if($badges->isEmpty())
                <div class="p-8 bg-white border-4 border-dashed border-slate-400 text-center">
                    <p class="font-bold text-slate-500 uppercase tracking-wider">// Belum ada lencana keahlian. Tambahkan lencana pertama Anda di samping!</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach($badges as $badge)
                        <div class="bg-white border-4 border-black p-5 shadow-[4px_4px_0px_#000000] flex flex-col justify-between h-full relative" id="badge-card-{{ $badge->id }}">
                            <!-- Color Swatches top accent -->
                            <div class="absolute top-0 left-0 w-full h-2 border-b-2 border-black" style="background-color: {{ $badge->bg_color }}"></div>
                            
                            <div class="mt-2 space-y-4 flex-grow">
                                <!-- Badge Live Preview -->
                                <div>
                                    <span class="block text-xxs font-black uppercase tracking-widest text-slate-400 mb-2.5">Visual Tampilan</span>
                                    <span class="px-2.5 py-1 border border-black shadow-[1.5px_1.5px_0px_#000000] font-black uppercase tracking-wider text-xxs inline-block"
                                          style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }};">
                                        {{ $badge->name }}
                                    </span>
                                </div>
                                
                                <!-- Metadata Hex Codes -->
                                <div class="grid grid-cols-2 gap-2 text-xxs font-bold uppercase text-slate-600 bg-slate-50 p-2 border-2 border-dashed border-black">
                                    <div>Latar: <span class="font-mono text-black font-black block mt-0.5">{{ $badge->bg_color }}</span></div>
                                    <div>Teks: <span class="font-mono text-black font-black block mt-0.5">{{ $badge->text_color }}</span></div>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="mt-6 pt-4 border-t-2 border-black flex items-center justify-end gap-2">
                                <button type="button" 
                                        onclick="enableEditMode({{ $badge->id }}, '{{ addslashes($badge->name) }}', '{{ $badge->bg_color }}', '{{ $badge->text_color }}')"
                                        class="brutal-btn-secondary px-3 py-1.5 text-xxs font-black flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    Edit
                                </button>
                                <button type="button" 
                                        onclick="triggerDelete('{{ route('admin.badges.destroy', $badge->id) }}', 'lencana {{ addslashes($badge->name) }}')"
                                        class="brutal-btn-admin px-3 py-1.5 text-xxs font-black bg-rose-500 hover:bg-rose-600 text-white flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
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

        <!-- Right Column: Interactive Brutalist Form Card (5 Cols) -->
        <div class="lg:col-span-5 sticky lg:top-6">
            <div class="bg-white border-4 border-black p-6 shadow-[6px_6px_0px_#000000] space-y-6" id="form-container">
                <div class="border-b-2 border-black pb-3">
                    <h3 class="text-xl font-black uppercase text-black" id="form-title">// TAMBAH LENCANA</h3>
                    <p class="text-xxs font-bold text-slate-500 uppercase tracking-widest mt-1" id="form-subtitle">Buat lencana baru dengan palet warna pilihan Anda.</p>
                </div>

                <!-- Live Realtime Preview Card -->
                <div class="bg-slate-50 border-3 border-dashed border-black p-4 flex flex-col items-center justify-center space-y-2">
                    <span class="text-xxs font-black uppercase tracking-widest text-slate-400 self-start">// PRATINJAU REAL-TIME:</span>
                    <div class="py-4">
                        <span id="preview-badge-element" class="px-2.5 py-1 border border-black shadow-[1.5px_1.5px_0px_#000000] font-black uppercase tracking-wider text-xxs inline-block"
                              style="background-color: #ff5722; color: #000000;">
                            LENCANA PREVIEW
                        </span>
                    </div>
                </div>

                <form id="badge-crud-form" action="{{ route('admin.badges.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div id="method-spoofing-container"></div>

                    <!-- Badge Name -->
                    <div>
                        <label for="name" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Nama Lencana / Keahlian</label>
                        <input type="text" name="name" id="name" placeholder="Contoh: Laravel 11" required
                               class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                        @error('name')
                            <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Background Color Selectors -->
                    <div class="space-y-2.5">
                        <label class="block text-xs font-black uppercase tracking-widest text-black">Warna Latar (Background)</label>
                        
                        <!-- Curated Presets -->
                        <div class="flex flex-wrap gap-2 pb-2">
                            <button type="button" onclick="selectColorPreset('bg', '#ff5722')" class="w-8 h-8 rounded-none border-2 border-black shadow-[1px_1px_0px_#000000] hover:-translate-y-0.5 hover:shadow-[2px_2px_0px_#000000] active:translate-y-0.5 active:shadow-none transition-all bg-[#ff5722]" title="Brutalist Orange"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#000000')" class="w-8 h-8 rounded-none border-2 border-black shadow-[1px_1px_0px_#000000] hover:-translate-y-0.5 hover:shadow-[2px_2px_0px_#000000] active:translate-y-0.5 active:shadow-none transition-all bg-[#000000]" title="Deep Black"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#ffffff')" class="w-8 h-8 rounded-none border-2 border-black shadow-[1px_1px_0px_#000000] hover:-translate-y-0.5 hover:shadow-[2px_2px_0px_#000000] active:translate-y-0.5 active:shadow-none transition-all bg-[#ffffff]" title="Solid White"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#ccff00')" class="w-8 h-8 rounded-none border-2 border-black shadow-[1px_1px_0px_#000000] hover:-translate-y-0.5 hover:shadow-[2px_2px_0px_#000000] active:translate-y-0.5 active:shadow-none transition-all bg-[#ccff00]" title="Cyber Lime"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#ff007f')" class="w-8 h-8 rounded-none border-2 border-black shadow-[1px_1px_0px_#000000] hover:-translate-y-0.5 hover:shadow-[2px_2px_0px_#000000] active:translate-y-0.5 active:shadow-none transition-all bg-[#ff007f]" title="Hot Pink"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#00e5ff')" class="w-8 h-8 rounded-none border-2 border-black shadow-[1px_1px_0px_#000000] hover:-translate-y-0.5 hover:shadow-[2px_2px_0px_#000000] active:translate-y-0.5 active:shadow-none transition-all bg-[#00e5ff]" title="Electric Blue"></button>
                        </div>

                        <!-- HEX Input and Picker -->
                        <div class="flex items-center gap-3">
                            <div class="relative flex-grow">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 font-mono font-black text-black">HEX:</span>
                                <input type="text" name="bg_color" id="bg_color" value="#ff5722" required
                                       class="w-full bg-white border-3 border-black rounded-none pl-12 pr-4 py-2.5 text-black font-mono font-bold focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                            </div>
                            <input type="color" id="bg_color_picker" value="#ff5722" class="w-12 h-12 border-3 border-black cursor-pointer bg-white">
                        </div>
                        @error('bg_color')
                            <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Text Color Selectors -->
                    <div class="space-y-2.5">
                        <label class="block text-xs font-black uppercase tracking-widest text-black">Warna Teks (Text Color)</label>
                        
                        <!-- Curated Contrast toggles -->
                        <div class="flex gap-3">
                            <button type="button" onclick="selectColorPreset('text', '#000000')" class="brutal-btn-secondary px-3 py-1 text-xxs font-black flex items-center gap-1 bg-white">
                                <span class="w-3 h-3 bg-black border border-black inline-block"></span> Teks Hitam
                            </button>
                            <button type="button" onclick="selectColorPreset('text', '#ffffff')" class="brutal-btn-secondary px-3 py-1 text-xxs font-black flex items-center gap-1 bg-white">
                                <span class="w-3 h-3 bg-white border border-black inline-block"></span> Teks Putih
                            </button>
                        </div>

                        <!-- HEX Input and Picker -->
                        <div class="flex items-center gap-3">
                            <div class="relative flex-grow">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 font-mono font-black text-black">HEX:</span>
                                <input type="text" name="text_color" id="text_color" value="#000000" required
                                       class="w-full bg-white border-3 border-black rounded-none pl-12 pr-4 py-2.5 text-black font-mono font-bold focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                            </div>
                            <input type="color" id="text_color_picker" value="#000000" class="w-12 h-12 border-3 border-black cursor-pointer bg-white">
                        </div>
                        @error('text_color')
                            <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="pt-4 border-t-2 border-black flex items-center justify-end gap-3" id="form-actions">
                        <button type="submit" class="brutal-btn-admin w-full py-3 text-sm font-black" id="submit-form-btn">
                            Simpan Lencana Teknologi
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- JavaScript inline logic for Live Preview, Presets sync, and dynamically toggling edit states -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const nameInput = document.getElementById('name');
        const bgColorInput = document.getElementById('bg_color');
        const bgPicker = document.getElementById('bg_color_picker');
        const textColorInput = document.getElementById('text_color');
        const textPicker = document.getElementById('text_color_picker');
        const previewElement = document.getElementById('preview-badge-element');

        // Update real-time preview helper
        function updateLivePreview() {
            const nameValue = nameInput.value.trim();
            previewElement.textContent = nameValue !== "" ? nameValue : "LENCANA PREVIEW";
            previewElement.style.backgroundColor = bgColorInput.value;
            previewElement.style.color = textColorInput.value;
        }

        // Event listeners for inputs
        nameInput.addEventListener('input', updateLivePreview);

        // Sync Background Picker and Text Input
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

        // Sync Text Picker and Text Input
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

        // Initial preview run
        updateLivePreview();

        // Export preset selection globally
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

    // Toggle CMS inline Edit State
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

        // Dynamic visual update
        formTitle.textContent = '// EDIT LENCANA';
        formSubtitle.textContent = `Sedang mengubah lencana keahlian: "${name}".`;
        formContainer.classList.add('bg-orange-50/20', 'border-[#ff5722]');

        // Fill inputs
        nameInput.value = name;
        bgColorInput.value = bgColor.toUpperCase();
        bgPicker.value = bgColor;
        textColorInput.value = textColor.toUpperCase();
        textPicker.value = textColor;

        // Set action route for update
        form.action = `/cms/badges/${id}`;

        // Inject method PUT spoofing
        methodContainer.innerHTML = '@method("PUT")';

        // Update submit button description
        submitBtn.textContent = 'Perbarui Lencana Teknologi';

        // Create Cancel Edit button if it doesn't already exist
        let cancelBtn = document.getElementById('cancel-edit-btn');
        if (!cancelBtn) {
            cancelBtn = document.createElement('button');
            cancelBtn.type = 'button';
            cancelBtn.id = 'cancel-edit-btn';
            cancelBtn.className = 'brutal-btn-secondary w-full py-2 text-xs font-black bg-white mt-2';
            cancelBtn.textContent = 'Batal Edit (Kembali ke Tambah)';
            cancelBtn.onclick = disableEditMode;
            actionsDiv.appendChild(cancelBtn);
        }

        // Trigger visual preview refresh
        nameInput.dispatchEvent(new Event('input'));
        
        // Scroll to form on mobile devices smoothly
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

        // Reset title & visuals
        formTitle.textContent = '// TAMBAH LENCANA';
        formSubtitle.textContent = 'Buat lencana baru dengan palet warna pilihan Anda.';
        formContainer.classList.remove('bg-orange-50/20', 'border-[#ff5722]');

        // Reset inputs to default values
        nameInput.value = '';
        bgColorInput.value = '#FF5722';
        bgPicker.value = '#FF5722';
        textColorInput.value = '#000000';
        textPicker.value = '#000000';

        // Set action route back to store
        form.action = "{{ route('admin.badges.store') }}";

        // Remove PUT spoofing
        methodContainer.innerHTML = '';

        // Reset submit button text
        submitBtn.textContent = 'Simpan Lencana Teknologi';

        // Remove Cancel Edit button
        if (cancelBtn) cancelBtn.remove();

        // Refresh preview
        nameInput.dispatchEvent(new Event('input'));
    }
</script>
@endsection
