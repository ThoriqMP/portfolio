@extends('layouts.admin')

@section('content')
<div class="space-y-8 max-w-4xl">
    <!-- Header -->
    <div class="pb-6 border-b-4 border-black">
        <h1 class="text-4xl font-black uppercase tracking-tighter text-black">Pengaturan Profil & Tampilan Portofolio</h1>
        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">// Kustomisasikan foto profil, hapus background, foto tiap section, dan metrik angka portofolio.</p>
    </div>

    @if (session('success'))
        <div class="p-4 bg-emerald-100 border-4 border-black text-black shadow-[4px_4px_0px_#000000] font-bold text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white border-4 border-black p-6 sm:p-8 shadow-[6px_6px_0px_#000000]">
        <form id="profile-form" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Hidden field for transparent base64 image if user applied in modal -->
            <input type="hidden" name="avatar_transparent" id="avatar_transparent">

            <!-- ================= SECTION 1: FOTO PROFIL & HAPUS BACKGROUND ================= -->
            <div class="space-y-4">
                <span class="text-xs font-black uppercase tracking-widest text-[#ff5722] block">// 01. FOTO PROFIL HERO & FITUR HAPUS BACKGROUND</span>
                
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6 p-4 bg-slate-50 border-3 border-black">
                    <!-- Current Avatar Preview with Checkerboard Background for transparency -->
                    <div class="shrink-0 text-center">
                        <span class="block text-xxs font-black uppercase tracking-wider text-slate-500 mb-1.5">Foto Saat Ini</span>
                        <div class="w-28 h-28 bg-[repeating-conic-gradient(#e2e8f0_0%_25%,#ffffff_0%_50%)] bg-[size:16px_16px] border-4 border-black shadow-[4px_4px_0px_#000000] overflow-hidden flex items-center justify-center relative">
                            @if ($user->avatar_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->avatar_path))
                                <img id="current-avatar-img" src="{{ asset('storage/' . $user->avatar_path) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-[#ff5722] text-black font-black text-4xl uppercase flex items-center justify-center">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Upload & Actions -->
                    <div class="flex-grow space-y-3 w-full">
                        <div>
                            <label for="image" class="block text-xs font-black uppercase tracking-widest text-black mb-1.5">Unggah Foto Baru</label>
                            <input type="file" name="image" id="image" accept="image/*" class="text-sm text-black file:mr-4 file:py-2 file:px-4 file:rounded-none file:border-2 file:border-black file:text-xs file:font-black file:uppercase file:bg-[#ff5722] file:text-black hover:file:bg-orange-600 file:cursor-pointer cursor-pointer">
                            <p class="text-slate-500 text-xxs font-bold uppercase mt-1">// Format: JPG, PNG, WEBP. Maks 10MB.</p>
                        </div>

                        <!-- Remove Background Trigger Button -->
                        <div class="pt-2">
                            <button type="button" id="btn-open-remove-bg" class="inline-flex items-center gap-2 px-4 py-2 border-2 border-black bg-purple-600 text-white hover:bg-purple-700 text-xs font-black uppercase tracking-wider shadow-[3px_3px_0px_#000000] active:translate-y-0.5 transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                                </svg>
                                Hapus Background Foto (Chroma / Pas Foto)
                            </button>
                            <span class="block text-xxs text-slate-500 mt-1 font-bold">// Hapus latar belakang merah/biru pas foto secara instan menjadi transparan.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= SECTION 2: BIODATA UTAMA ================= -->
            <div class="space-y-4 pt-4 border-t-2 border-black">
                <span class="text-xs font-black uppercase tracking-widest text-[#ff5722] block">// 02. IDENTITAS & BIOGRAFI</span>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-xs font-black uppercase tracking-widest text-black mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                            class="w-full bg-white border-3 border-black px-4 py-3 text-black font-bold focus:outline-none focus:bg-orange-50">
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-xs font-black uppercase tracking-widest text-black mb-1.5">Gelar / Profesi</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $user->title) }}" placeholder="Fullstack Web Developer"
                            class="w-full bg-white border-3 border-black px-4 py-3 text-black font-bold focus:outline-none focus:bg-orange-50">
                    </div>
                </div>

                <!-- Bio -->
                <div>
                    <label for="bio" class="block text-xs font-black uppercase tracking-widest text-black mb-1.5">Bio Ringkas (Hero Section)</label>
                    <textarea name="bio" id="bio" rows="3" class="w-full bg-white border-3 border-black px-4 py-3 text-black font-bold focus:outline-none focus:bg-orange-50">{{ old('bio', $user->bio) }}</textarea>
                </div>
            </div>

            <!-- ================= SECTION 3: GAMBAR SECTION KHUSUS (ABOUT, BENTO, CTA) ================= -->
            <div class="space-y-6 pt-4 border-t-2 border-black">
                <div>
                    <span class="text-xs font-black uppercase tracking-widest text-[#ff5722] block">// 03. PENGATURAN GAMBAR MASING-MASING SECTION</span>
                    <p class="text-xs text-slate-600 font-bold mt-1">Jika belum diatur atau dikosongkan, halaman depan akan otomatis memakai foto preset mockup yang rapi.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- About Image -->
                    <div class="p-4 bg-slate-50 border-3 border-black space-y-3">
                        <span class="block text-xs font-black uppercase text-black">1. Foto Bagian "About Me"</span>
                        <div class="h-36 bg-slate-200 border-2 border-black overflow-hidden flex items-center justify-center">
                            @if ($user->about_image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->about_image_path))
                                <img src="{{ asset('storage/' . $user->about_image_path) }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-center p-3 text-xs text-slate-500 font-bold uppercase">
                                    [Preset Mockup Aktif: Foto Workplace]
                                </div>
                            @endif
                        </div>
                        <input type="file" name="about_image" accept="image/*" class="text-xs text-slate-700">
                    </div>

                    <!-- Bento Image 1 (Mobile App) -->
                    <div class="p-4 bg-slate-50 border-3 border-black space-y-3">
                        <span class="block text-xs font-black uppercase text-black">2. Foto Bento 1 (App Showcase)</span>
                        <div class="h-36 bg-slate-200 border-2 border-black overflow-hidden flex items-center justify-center">
                            @if ($user->bento_image_1 && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->bento_image_1))
                                <img src="{{ asset('storage/' . $user->bento_image_1) }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-center p-3 text-xs text-slate-500 font-bold uppercase">
                                    [Preset Mockup Aktif: Hand Smartphone]
                                </div>
                            @endif
                        </div>
                        <input type="file" name="bento_image_1" accept="image/*" class="text-xs text-slate-700">
                    </div>

                    <!-- Bento Image 2 (Brand Graphic) -->
                    <div class="p-4 bg-slate-50 border-3 border-black space-y-3">
                        <span class="block text-xs font-black uppercase text-black">3. Foto Bento 2 (Brand / Graphic)</span>
                        <div class="h-36 bg-slate-200 border-2 border-black overflow-hidden flex items-center justify-center">
                            @if ($user->bento_image_2 && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->bento_image_2))
                                <img src="{{ asset('storage/' . $user->bento_image_2) }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-center p-3 text-xs text-slate-500 font-bold uppercase">
                                    [Preset Mockup Aktif: Merchandise / Graphic]
                                </div>
                            @endif
                        </div>
                        <input type="file" name="bento_image_2" accept="image/*" class="text-xs text-slate-700">
                    </div>

                    <!-- CTA Banner Image -->
                    <div class="p-4 bg-slate-50 border-3 border-black space-y-3">
                        <span class="block text-xs font-black uppercase text-black">4. Foto CTA Banner Bawah</span>
                        <div class="h-36 bg-slate-200 border-2 border-black overflow-hidden flex items-center justify-center">
                            @if ($user->cta_image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->cta_image_path))
                                <img src="{{ asset('storage/' . $user->cta_image_path) }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-center p-3 text-xs text-slate-500 font-bold uppercase">
                                    [Preset Mockup Aktif: Cutout Sapaan]
                                </div>
                            @endif
                        </div>
                        <input type="file" name="cta_image" accept="image/*" class="text-xs text-slate-700">
                    </div>
                </div>
            </div>

            <!-- ================= SECTION 4: METRIK & TEKS ABOUT ================= -->
            <div class="space-y-4 pt-4 border-t-2 border-black">
                <span class="text-xs font-black uppercase tracking-widest text-[#ff5722] block">// 04. KUSTOMISASI METRIK ANGKA & ABOUT ME</span>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xxs font-black uppercase text-black mb-1">Tahun Pengalaman</label>
                        <input type="text" name="years_experience" value="{{ old('years_experience', $user->years_experience ?? '10+') }}" placeholder="10+"
                            class="w-full bg-white border-2 border-black px-3 py-2 text-sm font-bold">
                    </div>
                    <div>
                        <label class="block text-xxs font-black uppercase text-black mb-1">Proyek Selesai</label>
                        <input type="text" name="projects_completed" value="{{ old('projects_completed', $user->projects_completed ?? '109+') }}" placeholder="109+"
                            class="w-full bg-white border-2 border-black px-3 py-2 text-sm font-bold">
                    </div>
                    <div>
                        <label class="block text-xxs font-black uppercase text-black mb-1">Dukungan</label>
                        <input type="text" name="support_available" value="{{ old('support_available', $user->support_available ?? '20/7') }}" placeholder="20/7"
                            class="w-full bg-white border-2 border-black px-3 py-2 text-sm font-bold">
                    </div>
                    <div>
                        <label class="block text-xxs font-black uppercase text-black mb-1">Kepuasan Klien</label>
                        <input type="text" name="client_satisfaction" value="{{ old('client_satisfaction', $user->client_satisfaction ?? '96%') }}" placeholder="96%"
                            class="w-full bg-white border-2 border-black px-3 py-2 text-sm font-bold">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-black mb-1.5">Link / Username GitHub Kontributor</label>
                    <input type="text" name="github_link" value="{{ old('github_link', $user->github_link ?? 'https://github.com/ThoriqMP') }}" placeholder="https://github.com/ThoriqMP"
                        class="w-full bg-white border-3 border-black px-4 py-2.5 text-black font-bold focus:outline-none">
                    <p class="text-slate-500 text-xxs font-bold uppercase mt-1">// Profil GitHub ini digunakan untuk mengintegrasikan grafik kontributor, commit calendar, dan repositori secara otomatis.</p>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-black mb-1.5">Judul Bagian "About Me"</label>
                    <input type="text" name="about_title" value="{{ old('about_title', $user->about_title ?? 'Designing with Purpose, Building with Passion') }}"
                        class="w-full bg-white border-3 border-black px-4 py-2.5 text-black font-bold focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-black mb-1.5">Narasi / Cerita "About Me"</label>
                    <textarea name="about_description" rows="3" class="w-full bg-white border-3 border-black px-4 py-2.5 text-black font-bold focus:outline-none"
                        placeholder="Tuliskan cerita pendekatan desain, prinsip kerja, dan keahlian Anda...">{{ old('about_description', $user->about_description) }}</textarea>
                </div>
            </div>

            <!-- ================= SECTION 5: KREDENSIAL AKUN ================= -->
            <div class="space-y-4 pt-4 border-t-2 border-black">
                <span class="text-xs font-black uppercase tracking-widest text-[#ff5722] block">// 05. KREDENSIAL LOGIN</span>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="username" class="block text-xs font-black uppercase tracking-widest text-black mb-1.5">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required
                            class="w-full bg-white border-3 border-black px-4 py-2.5 text-black font-bold focus:outline-none">
                    </div>
                    <div>
                        <label for="password" class="block text-xs font-black uppercase tracking-widest text-black mb-1.5">Password Baru (Kosongkan jika tetap)</label>
                        <input type="password" name="password" id="password"
                            class="w-full bg-white border-3 border-black px-4 py-2.5 text-black font-bold focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-6 border-t-4 border-black flex justify-end">
                <button type="submit" class="brutal-btn-admin px-8 py-3.5 text-sm uppercase font-black">
                    Simpan Semua Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL INTERAKTIF HAPUS BACKGROUND ================= -->
<div id="remove-bg-modal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-white border-4 border-black w-full max-w-2xl shadow-[8px_8px_0px_#000000] p-6 space-y-6">
        <div class="flex items-center justify-between border-b-2 border-black pb-3">
            <h3 class="text-lg font-black uppercase tracking-tight text-black flex items-center gap-2">
                <span class="p-1.5 bg-purple-600 text-white text-xs">AI / CHROMA</span>
                Hapus Background Foto Pas Foto / Warna Polos
            </h3>
            <button type="button" id="btn-close-remove-bg" class="text-black font-black text-xl hover:text-rose-600">&times;</button>
        </div>

        <div class="space-y-4">
            <!-- Controls Bar -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 bg-slate-100 p-3 border-2 border-black text-xs font-bold">
                <div>
                    <label class="block text-xxs uppercase mb-1">Target Warna Background:</label>
                    <div class="flex items-center gap-2">
                        <input type="color" id="bg-target-color" value="#d81e1e" class="w-8 h-8 cursor-pointer border border-black p-0">
                        <span id="bg-target-hex" class="font-mono text-xs">#D81E1E</span>
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <div class="flex justify-between items-center mb-1">
                        <label for="bg-tolerance" class="text-xxs uppercase">Sensitivitas / Toleransi:</label>
                        <span id="bg-tolerance-val" class="font-mono text-xs">55%</span>
                    </div>
                    <input type="range" id="bg-tolerance" min="10" max="100" value="55" class="w-full cursor-pointer accent-purple-600">
                </div>
            </div>

            <!-- Canvas View (Checkerboard transparency preview) -->
            <div class="border-2 border-black h-80 bg-[repeating-conic-gradient(#cbd5e1_0%_25%,#ffffff_0%_50%)] bg-[size:16px_16px] overflow-hidden flex items-center justify-center relative">
                <canvas id="bg-canvas" class="max-h-full max-w-full object-contain cursor-crosshair" title="Klik pada background foto untuk memilih warna!"></canvas>
                <div id="bg-loading-spinner" class="absolute inset-0 bg-white/70 hidden items-center justify-center font-black text-xs uppercase">
                    Memproses transparansi gambar...
                </div>
            </div>

            <p class="text-xxs font-bold text-slate-500 uppercase">
                Tips: Klik langsung pada area warna merah/background di atas kanvas untuk otomatis mendeteksi warna yang ingin dihapus!
            </p>
        </div>

        <!-- Modal Actions -->
        <div class="flex items-center justify-between pt-4 border-t-2 border-black">
            <button type="button" id="btn-auto-server-bg" class="px-4 py-2 border-2 border-black bg-slate-200 hover:bg-slate-300 text-black text-xs font-black uppercase">
                Hapus Otomatis (Server GD)
            </button>
            <div class="flex gap-2">
                <button type="button" id="btn-cancel-remove-bg" class="px-4 py-2 border-2 border-black bg-white hover:bg-slate-100 text-black text-xs font-bold uppercase">
                    Batal
                </button>
                <button type="button" id="btn-apply-remove-bg" class="px-5 py-2 border-2 border-black bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black uppercase shadow-[2px_2px_0px_#000000]">
                    Terapkan & Simpan Hasil Transparan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Background Removal Javascript -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('remove-bg-modal');
    const btnOpen = document.getElementById('btn-open-remove-bg');
    const btnClose = document.getElementById('btn-close-remove-bg');
    const btnCancel = document.getElementById('btn-cancel-remove-bg');
    const btnApply = document.getElementById('btn-apply-remove-bg');
    const btnAutoServer = document.getElementById('btn-auto-server-bg');
    const colorPicker = document.getElementById('bg-target-color');
    const colorHex = document.getElementById('bg-target-hex');
    const toleranceSlider = document.getElementById('bg-tolerance');
    const toleranceVal = document.getElementById('bg-tolerance-val');
    const canvas = document.getElementById('bg-canvas');
    const ctx = canvas.getContext('2d', { willReadFrequently: true });
    const currentAvatarImg = document.getElementById('current-avatar-img');
    const fileInput = document.getElementById('image');
    const hiddenTransparentInput = document.getElementById('avatar_transparent');
    const spinner = document.getElementById('bg-loading-spinner');

    let originalImageData = null;
    let loadedImage = new Image();

    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // Check if user has selected a file in the input, or use current avatar
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => {
                loadImageToCanvas(e.target.result);
            };
            reader.readAsDataURL(fileInput.files[0]);
        } else if (currentAvatarImg && currentAvatarImg.src) {
            loadImageToCanvas(currentAvatarImg.src);
        }
    }

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    btnOpen.addEventListener('click', openModal);
    btnClose.addEventListener('click', closeModal);
    btnCancel.addEventListener('click', closeModal);

    function loadImageToCanvas(src) {
        spinner.classList.remove('hidden');
        spinner.classList.add('flex');
        loadedImage.crossOrigin = 'Anonymous';
        loadedImage.onload = () => {
            canvas.width = loadedImage.width;
            canvas.height = loadedImage.height;
            ctx.drawImage(loadedImage, 0, 0);
            originalImageData = ctx.getImageData(0, 0, canvas.width, canvas.height);

            // Auto-detect corner pixel color (top-left x=2, y=2)
            const samplePixel = ctx.getImageData(Math.min(3, canvas.width-1), Math.min(3, canvas.height-1), 1, 1).data;
            const hex = "#" + ((1 << 24) + (samplePixel[0] << 16) + (samplePixel[1] << 8) + samplePixel[2]).toString(16).slice(1);
            colorPicker.value = hex;
            colorHex.innerText = hex.toUpperCase();

            spinner.classList.add('hidden');
            spinner.classList.remove('flex');

            processTransparency();
        };
        loadedImage.src = src;
    }

    function hexToRgb(hex) {
        const bigint = parseInt(hex.replace('#', ''), 16);
        return {
            r: (bigint >> 16) & 255,
            g: (bigint >> 8) & 255,
            b: bigint & 255
        };
    }

    function processTransparency() {
        if (!originalImageData) return;

        const target = hexToRgb(colorPicker.value);
        const tolerance = parseInt(toleranceSlider.value);
        const toleranceSq = tolerance * tolerance;

        const imgData = new ImageData(
            new Uint8ClampedArray(originalImageData.data),
            originalImageData.width,
            originalImageData.height
        );
        const data = imgData.data;

        for (let i = 0; i < data.length; i += 4) {
            const r = data[i];
            const g = data[i + 1];
            const b = data[i + 2];
            const a = data[i + 3];

            if (a === 0) continue;

            const distSq = (r - target.r)**2 + (g - target.g)**2 + (b - target.b)**2;

            if (distSq <= toleranceSq) {
                data[i + 3] = 0; // Completely transparent
            } else if (distSq < toleranceSq * 1.35) {
                // Soft edge anti-aliasing
                const factor = (distSq - toleranceSq) / (toleranceSq * 0.35);
                data[i + 3] = Math.round(a * factor);
            }
        }

        ctx.putImageData(imgData, 0, 0);
    }

    // Color picker change
    colorPicker.addEventListener('input', (e) => {
        colorHex.innerText = e.target.value.toUpperCase();
        processTransparency();
    });

    // Tolerance slider change
    toleranceSlider.addEventListener('input', (e) => {
        toleranceVal.innerText = e.target.value + '%';
        processTransparency();
    });

    // Eye-dropper on canvas click
    canvas.addEventListener('click', (e) => {
        const rect = canvas.getBoundingClientRect();
        const scaleX = canvas.width / rect.width;
        const scaleY = canvas.height / rect.height;
        const x = Math.floor((e.clientX - rect.left) * scaleX);
        const y = Math.floor((e.clientY - rect.top) * scaleY);

        if (originalImageData && x >= 0 && x < canvas.width && y >= 0 && y < canvas.height) {
            const index = (y * canvas.width + x) * 4;
            const r = originalImageData.data[index];
            const g = originalImageData.data[index + 1];
            const b = originalImageData.data[index + 2];
            const hex = "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
            colorPicker.value = hex;
            colorHex.innerText = hex.toUpperCase();
            processTransparency();
        }
    });

    // Apply button
    btnApply.addEventListener('click', () => {
        const transparentDataUrl = canvas.toDataURL('image/png');
        hiddenTransparentInput.value = transparentDataUrl;
        if (currentAvatarImg) {
            currentAvatarImg.src = transparentDataUrl;
        }
        closeModal();
        alert('Background berhasil dihapus pada preview! Silakan klik tombol "SIMPAN SEMUA PERUBAHAN" di bawah untuk menyimpan secara permanen ke server.');
    });

    // Auto Server GD button
    btnAutoServer.addEventListener('click', async () => {
        if (!confirm('Jalankan pembersihan background otomatis via server?')) return;

        spinner.classList.remove('hidden');
        spinner.classList.add('flex');

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('target_color', colorPicker.value);
        formData.append('tolerance', toleranceSlider.value);
        if (fileInput.files && fileInput.files[0]) {
            formData.append('image', fileInput.files[0]);
        }

        try {
            const res = await fetch('{{ route("admin.profile.removeBackground") }}', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const data = await res.json();
            if (data.success) {
                if (currentAvatarImg) currentAvatarImg.src = data.avatar_url;
                closeModal();
                alert(data.message);
                location.reload();
            } else {
                alert(data.message || 'Gagal menghapus background.');
            }
        } catch (err) {
            alert('Terjadi kesalahan jaringan.');
        } finally {
            spinner.classList.add('hidden');
            spinner.classList.remove('flex');
        }
    });
});
</script>
@endsection
