<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Admin Panel - Portofolio</title>
    <!-- Google Fonts: Space Grotesk -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;850&display=swap" rel="stylesheet">
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Cropper.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
    <!-- Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Space Grotesk"', 'sans-serif'],
                    },
                    colors: {
                        brutalOrange: '#ff5722',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
            background-color: #f7f7f7;
        }
        /* Neo-Brutalist Helpers for Admin panel */
        .brutal-btn-admin {
            background-color: #ff5722;
            color: #000000;
            font-weight: 800;
            text-transform: uppercase;
            border: 2px solid #000000;
            box-shadow: 3px 3px 0px #000000;
            transition: all 0.1s ease-out;
        }
        .brutal-btn-admin:hover {
            transform: translate(-1px, -1px);
            box-shadow: 4px 4px 0px #000000;
        }
        .brutal-btn-admin:active {
            transform: translate(3px, 3px);
            box-shadow: 0px 0px 0px #000000;
        }

        .brutal-btn-secondary {
            background-color: #ffffff;
            color: #000000;
            font-weight: 800;
            text-transform: uppercase;
            border: 2px solid #000000;
            box-shadow: 3px 3px 0px #000000;
            transition: all 0.1s ease-out;
        }
        .brutal-btn-secondary:hover {
            transform: translate(-1px, -1px);
            box-shadow: 4px 4px 0px #000000;
        }
        .brutal-btn-secondary:active {
            transform: translate(3px, 3px);
            box-shadow: 0px 0px 0px #000000;
        }
    </style>
</head>
<body class="text-black min-h-screen flex flex-col font-sans selection:bg-black selection:text-[#ff5722]">

    <!-- Mobile Header -->
    <header class="lg:hidden bg-white border-b-4 border-black px-4 py-4 flex items-center justify-between sticky top-0 z-40">
        <a href="{{ route('admin.dashboard') }}" class="text-xl font-black uppercase tracking-tighter text-black flex items-center gap-1">
            CMS PANEL<span class="text-[#ff5722]">_</span>
        </a>
        <button type="button" id="mobile-sidebar-toggle" class="p-2 border-2 border-black bg-white hover:bg-[#ff5722] text-black transition">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </header>

    <div class="flex flex-1 relative">
        <!-- Sidebar Navigation (Brutalist panel) -->
        <aside id="sidebar" class="fixed lg:sticky top-0 lg:top-0 lg:h-screen z-50 lg:z-30 w-64 bg-white border-r-4 border-black p-6 flex flex-col justify-between hidden lg:flex transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <div class="space-y-8">
                <!-- Branding (Desktop Only) -->
                <div class="hidden lg:block pb-6 border-b-2 border-black">
                    <a href="{{ route('admin.dashboard') }}" class="text-2xl font-black tracking-tighter uppercase text-black flex items-center gap-0.5">
                        CMS PORTFOLIO<span class="text-[#ff5722]">_</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="space-y-3">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 border-2 transition {{ Route::is('admin.dashboard') ? 'bg-[#ff5722] text-black border-black shadow-[3px_3px_0px_#000000] font-black' : 'text-slate-700 border-transparent hover:bg-slate-100 hover:text-black font-bold' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                        </svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 px-4 py-3 border-2 transition {{ Route::is('admin.projects.*') ? 'bg-[#ff5722] text-black border-black shadow-[3px_3px_0px_#000000] font-black' : 'text-slate-700 border-transparent hover:bg-slate-100 hover:text-black font-bold' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3M12 3v18m0-18l-3 3m3-3l3 3" />
                        </svg>
                        Proyek Portofolio
                    </a>
                    
                    <a href="{{ route('admin.educations.index') }}" class="flex items-center gap-3 px-4 py-3 border-2 transition {{ Route::is('admin.educations.*') ? 'bg-[#ff5722] text-black border-black shadow-[3px_3px_0px_#000000] font-black' : 'text-slate-700 border-transparent hover:bg-slate-100 hover:text-black font-bold' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        Riwayat Pendidikan
                    </a>
                    
                    <a href="{{ route('admin.experiences.index') }}" class="flex items-center gap-3 px-4 py-3 border-2 transition {{ Route::is('admin.experiences.*') ? 'bg-[#ff5722] text-black border-black shadow-[3px_3px_0px_#000000] font-black' : 'text-slate-700 border-transparent hover:bg-slate-100 hover:text-black font-bold' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Pengalaman Kerja
                    </a>

                    <a href="{{ route('admin.badges.index') }}" class="flex items-center gap-3 px-4 py-3 border-2 transition {{ Route::is('admin.badges.*') ? 'bg-[#ff5722] text-black border-black shadow-[3px_3px_0px_#000000] font-black' : 'text-slate-700 border-transparent hover:bg-slate-100 hover:text-black font-bold' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 003.182 0l4.318-4.318a2.25 2.25 0 000-3.182L11.16 3.659A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 7.5h.008v.008H6V7.5z" />
                        </svg>
                        Lencana Keahlian
                    </a>
 
                    <a href="{{ route('admin.socials.index') }}" class="flex items-center gap-3 px-4 py-3 border-2 transition {{ Route::is('admin.socials.*') ? 'bg-[#ff5722] text-black border-black shadow-[3px_3px_0px_#000000] font-black' : 'text-slate-700 border-transparent hover:bg-slate-100 hover:text-black font-bold' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                        Kelola Sosial Media
                    </a>

                    <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 px-4 py-3 border-2 transition {{ Route::is('admin.profile.*') ? 'bg-[#ff5722] text-black border-black shadow-[3px_3px_0px_#000000] font-black' : 'text-slate-700 border-transparent hover:bg-slate-100 hover:text-black font-bold' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil Saya
                    </a>
                </nav>
            </div>

            <!-- User Session Profile & Logout -->
            <div class="pt-6 border-t-2 border-black space-y-4">
                <div class="flex items-center gap-3 px-2">
                    <div class="w-10 h-10 bg-white border-2 border-black overflow-hidden flex items-center justify-center font-bold">
                        @if (Auth::user()->avatar_path && \Illuminate\Support\Facades\Storage::disk('public')->exists(Auth::user()->avatar_path))
                            <img src="{{ asset('storage/' . Auth::user()->avatar_path) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-[#ff5722] text-black border border-black flex items-center justify-center font-black uppercase">
                                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-sm font-black uppercase leading-none">{{ Auth::user()->name ?? 'Admin' }}</h4>
                        <span class="text-xs text-slate-500 font-semibold">@ {{ Auth::user()->username ?? 'admin' }}</span>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="block w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 border-2 border-transparent hover:border-black hover:bg-rose-100 font-extrabold text-sm text-rose-600 transition">
                        <svg class="w-5 h-5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Keluar Sesi
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-grow p-4 sm:p-6 lg:p-8 lg:max-w-[calc(100vw-16rem)] min-w-0">
            <!-- Brutalist Toast Feedback Banner -->
            @if (session('success'))
                <div id="flash-alert" class="mb-8 p-4 bg-emerald-100 border-4 border-black text-black shadow-[4px_4px_0px_#000000] flex items-center justify-between transition-all duration-300">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-black uppercase tracking-wide">{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="dismissAlert()" class="p-1 border border-black hover:bg-black hover:text-white transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Forgiving Design Confirm Delete Modal Overlay (Brutalist Styled) -->
    <div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-xs hidden opacity-0 transition-all duration-300">
        <div class="bg-white border-4 border-black p-6 max-w-md w-full shadow-[10px_10px_0px_#000000] scale-95 transition-all duration-300" id="delete-modal-card">
            <!-- Brutalist Warning Block -->
            <div class="flex items-center justify-center w-14 h-14 bg-[#ff5722] text-black border-3 border-black mx-auto mb-4 shadow-[3px_3px_0px_#000000]">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="text-2xl font-black uppercase text-black text-center tracking-tighter">Konfirmasi Hapus</h3>
            <p class="text-sm font-bold text-slate-700 text-center mt-3 leading-relaxed" id="delete-modal-text">Apakah Anda yakin ingin menghapus data ini? Tindakan ini bersifat permanen.</p>
            <div class="flex items-center justify-center gap-4 mt-8">
                <button type="button" id="delete-cancel-btn" class="brutal-btn-secondary px-5 py-2.5 text-xs">
                    Batal
                </button>
                <form id="delete-confirm-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="brutal-btn-admin px-5 py-2.5 text-xs bg-rose-500 hover:bg-rose-600 text-white">
                        Hapus Permanen
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Vanilla Javascript Interactivities -->
    <script>
        // Mobile Sidebar Toggle
        const toggleBtn = document.getElementById('mobile-sidebar-toggle');
        const sidebar = document.getElementById('sidebar');

        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                const isHidden = sidebar.classList.contains('hidden');
                if (isHidden) {
                    sidebar.classList.remove('hidden');
                    setTimeout(() => {
                        sidebar.classList.remove('-translate-x-full');
                    }, 10);
                } else {
                    sidebar.classList.add('-translate-x-full');
                    setTimeout(() => {
                        sidebar.classList.add('hidden');
                    }, 300);
                }
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', (e) => {
                if (window.innerWidth < 1024 && !sidebar.classList.contains('hidden') && !sidebar.contains(e.target) && e.target !== toggleBtn) {
                    sidebar.classList.add('-translate-x-full');
                    setTimeout(() => {
                        sidebar.classList.add('hidden');
                    }, 300);
                }
            });
        }

        // Dismiss Alerts
        function dismissAlert() {
            const alert = document.getElementById('flash-alert');
            if (alert) {
                alert.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }
        }

        // Auto-dismiss alert after 5 seconds
        setTimeout(() => {
            dismissAlert();
        }, 5000);

        // Forgiving Design Custom Delete Modal Logic
        const deleteModal = document.getElementById('delete-modal');
        const deleteModalCard = document.getElementById('delete-modal-card');
        const deleteForm = document.getElementById('delete-confirm-form');
        const deleteCancelBtn = document.getElementById('delete-cancel-btn');
        const deleteModalText = document.getElementById('delete-modal-text');

        function triggerDelete(actionUrl, itemName = 'data ini') {
            deleteForm.setAttribute('action', actionUrl);
            deleteModalText.innerHTML = `Apakah Anda yakin ingin menghapus <strong>${itemName}</strong>? Tindakan ini bersifat permanen dan tidak dapat dibatalkan demi keamanan data Anda.`;
            
            // Open modal with transitions
            deleteModal.classList.remove('hidden');
            setTimeout(() => {
                deleteModal.classList.remove('opacity-0');
                deleteModalCard.classList.remove('scale-95');
            }, 10);
        }

        function hideDeleteModal() {
            deleteModal.classList.add('opacity-0');
            deleteModalCard.classList.add('scale-95');
            setTimeout(() => {
                deleteModal.classList.add('hidden');
            }, 300);
        }

        if (deleteCancelBtn) {
            deleteCancelBtn.addEventListener('click', hideDeleteModal);
        }

        if (deleteModal) {
            deleteModal.addEventListener('click', (e) => {
                if (e.target === deleteModal) hideDeleteModal();
            });
        }

        // ==========================================
        // NEO-BRUTALIST CROPPER.JS AUTOMATION
        // ==========================================
        document.addEventListener('DOMContentLoaded', () => {
            const fileInputs = document.querySelectorAll('input[type="file"]');
            
            fileInputs.forEach(fileInput => {
                // Only intercept image file uploads and exclude multiple uploads (gallery inputs)
                if (fileInput.accept && !fileInput.accept.includes('image')) return;
                if (fileInput.multiple) return;
                
                fileInput.addEventListener('change', (e) => {
                    const files = e.target.files;
                    if (!files || files.length === 0) return;
                    
                    const file = files[0];
                    if (!file.type.startsWith('image/')) return;
                    
                    // Prevent processing already cropped programmatically-injected blobs
                    if (fileInput.dataset.cropped === 'true') {
                        fileInput.dataset.cropped = 'false';
                        return;
                    }
                    
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        openCropperModal(fileInput, event.target.result, file.name);
                    };
                    reader.readAsDataURL(file);
                });
            });
        });

        let cropperInstance = null;

        function openCropperModal(fileInput, imageSrc, originalFileName) {
            let modal = document.getElementById('brutal-cropper-modal');
            if (!modal) {
                modal = document.createElement('div');
                modal.id = 'brutal-cropper-modal';
                modal.className = 'fixed inset-0 z-[60] flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-xs transition-all duration-300';
                modal.innerHTML = `
                    <div class="bg-white border-4 border-black p-4 sm:p-6 max-w-2xl w-full shadow-[10px_10px_0px_#000000] scale-95 transition-all duration-300 flex flex-col max-h-[90vh]" id="cropper-modal-card">
                        <!-- Header -->
                        <div class="pb-3 border-b-3 border-black flex items-center justify-between bg-black text-[#ff5722] px-4 py-3 mb-4 -mx-4 sm:-mx-6 -mt-4 sm:-mt-6 shadow-[0px_3px_0px_#000000]">
                            <h3 class="text-base sm:text-lg font-black uppercase tracking-tighter">// EDIT TATA LETAK FOTO // CROPPER</h3>
                            <button type="button" id="cropper-close-x" class="text-[#ff5722] hover:text-white transition font-black text-2xl leading-none">&times;</button>
                        </div>
                        
                        <!-- Cropper Canvas Container -->
                        <div class="flex-grow min-h-[260px] max-h-[45vh] bg-slate-50 border-3 border-black overflow-hidden relative flex items-center justify-center shadow-[inner_0px_2px_4px_rgba(0,0,0,0.1)]">
                            <img id="cropper-target-image" src="" class="max-w-full max-h-full block">
                        </div>
                        
                        <!-- Ratio Toggle Controls -->
                        <div class="mt-4 space-y-3">
                            <div class="flex flex-wrap gap-2 items-center">
                                <span class="text-xs font-black uppercase tracking-wider mr-2 text-black">// RASIO ASPEK:</span>
                                <button type="button" data-ratio="1" class="ratio-btn brutal-btn-secondary px-3 py-1.5 text-xxs font-black">1:1 (KOTAK)</button>
                                <button type="button" data-ratio="1.7777777777777777" class="ratio-btn brutal-btn-secondary px-3 py-1.5 text-xxs font-black">16:9 (LEBAR)</button>
                                <button type="button" data-ratio="0" class="ratio-btn brutal-btn-secondary px-3 py-1.5 text-xxs font-black">BEBAS</button>
                            </div>
                            
                            <!-- Detailed Manipulation controls -->
                            <div class="flex flex-wrap gap-2 items-center pt-2 border-t border-dashed border-slate-300">
                                <span class="text-xs font-black uppercase tracking-wider mr-2 text-black">// ADJ:</span>
                                <button type="button" id="crop-rotate-l" class="brutal-btn-secondary px-2.5 py-1 text-xxs font-black">PUTAR KIRI</button>
                                <button type="button" id="crop-rotate-r" class="brutal-btn-secondary px-2.5 py-1 text-xxs font-black">PUTAR KANAN</button>
                                <button type="button" id="crop-zoom-in" class="brutal-btn-secondary px-2.5 py-1 text-xxs font-black">+ PERBESAR</button>
                                <button type="button" id="crop-zoom-out" class="brutal-btn-secondary px-2.5 py-1 text-xxs font-black">- PERKECIL</button>
                                <button type="button" id="crop-reset" class="brutal-btn-secondary px-2.5 py-1 text-xxs font-black">RESET</button>
                            </div>
                        </div>
                        
                        <!-- Confirmation Action buttons -->
                        <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t-3 border-black">
                            <button type="button" id="cropper-cancel-btn" class="brutal-btn-secondary px-5 py-2.5 text-xs font-black">
                                Batal
                            </button>
                            <button type="button" id="cropper-apply-btn" class="brutal-btn-admin px-5 py-2.5 text-xs font-black">
                                Potong & Terapkan Foto
                            </button>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
            }
            
            const modalCard = modal.querySelector('#cropper-modal-card');
            const targetImage = modal.querySelector('#cropper-target-image');
            
            // Inject source image
            targetImage.src = imageSrc;
            
            // Aspect ratio tuning
            let defaultRatio = 1.7777777777777777; // default widescreen for projects
            if (fileInput.id === 'image' && window.location.href.includes('profile')) {
                defaultRatio = 1; // 1:1 square for profile avatar
            }
            
            // Show modal smoothly
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalCard.classList.remove('scale-95');
            }, 10);
            
            // Destroy former instance
            if (cropperInstance) {
                cropperInstance.destroy();
            }
            
            // Init Cropper
            cropperInstance = new Cropper(targetImage, {
                aspectRatio: defaultRatio,
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 0.9,
                restore: false,
                guides: true,
                center: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false,
                ready: function() {
                    updateRatioButtons(defaultRatio);
                }
            });
            
            // Bind aspect ratio buttons
            const ratioButtons = modal.querySelectorAll('.ratio-btn');
            ratioButtons.forEach(btn => {
                btn.onclick = () => {
                    const ratio = parseFloat(btn.dataset.ratio);
                    if (cropperInstance) {
                        cropperInstance.setAspectRatio(ratio === 0 ? NaN : ratio);
                        updateRatioButtons(ratio);
                    }
                };
            });
            
            function updateRatioButtons(activeRatio) {
                ratioButtons.forEach(btn => {
                    const r = parseFloat(btn.dataset.ratio);
                    if (Math.abs(r - activeRatio) < 0.001 || (isNaN(activeRatio) && r === 0) || (activeRatio === 0 && r === 0)) {
                        // Highlight
                        btn.className = 'ratio-btn brutal-btn-admin px-3 py-1.5 text-xxs font-black bg-[#ff5722]';
                    } else {
                        // Secondary
                        btn.className = 'ratio-btn brutal-btn-secondary px-3 py-1.5 text-xxs font-black bg-white';
                    }
                });
            }
            
            // Bind adjustments
            modal.querySelector('#crop-rotate-l').onclick = () => cropperInstance && cropperInstance.rotate(-90);
            modal.querySelector('#crop-rotate-r').onclick = () => cropperInstance && cropperInstance.rotate(90);
            modal.querySelector('#crop-zoom-in').onclick = () => cropperInstance && cropperInstance.zoom(0.1);
            modal.querySelector('#crop-zoom-out').onclick = () => cropperInstance && cropperInstance.zoom(-0.1);
            modal.querySelector('#crop-reset').onclick = () => cropperInstance && cropperInstance.reset();
            
            const closeModal = () => {
                modal.classList.add('opacity-0');
                modalCard.classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    if (cropperInstance) {
                        cropperInstance.destroy();
                        cropperInstance = null;
                    }
                }, 300);
            };
            
            modal.querySelector('#cropper-close-x').onclick = closeModal;
            modal.querySelector('#cropper-cancel-btn').onclick = () => {
                closeModal();
                fileInput.value = ''; // clear value if cancelled
            };
            
            // Apply Crop Click
            modal.querySelector('#cropper-apply-btn').onclick = () => {
                if (!cropperInstance) return;
                
                const canvasOptions = {
                    maxWidth: 2000,
                    maxHeight: 2000,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high'
                };
                
                const croppedCanvas = cropperInstance.getCroppedCanvas(canvasOptions);
                if (!croppedCanvas) return;
                
                croppedCanvas.toBlob((blob) => {
                    if (!blob) return;
                    
                    // Create new Cropped File object
                    const croppedFile = new File([blob], originalFileName, { type: 'image/jpeg' });
                    
                    // Inject into file input using DataTransfer API
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(croppedFile);
                    
                    fileInput.dataset.cropped = 'true';
                    fileInput.files = dataTransfer.files;
                    
                    // Trigger live preview update
                    updateOnPagePreview(fileInput, blob);
                    
                    closeModal();
                }, 'image/jpeg', 0.9);
            };
        }

        function updateOnPagePreview(fileInput, blob) {
            const objectUrl = URL.createObjectURL(blob);
            
            // 1. Profile Avatar page preview update
            if (window.location.href.includes('profile')) {
                const form = fileInput.closest('form');
                if (form) {
                    const avatarImg = form.querySelector('.w-24.h-24 img');
                    if (avatarImg) {
                        avatarImg.src = objectUrl;
                    } else {
                        // If it displayed the letter initials fallback
                        const avatarBox = form.querySelector('.w-24.h-24');
                        if (avatarBox) {
                            avatarBox.innerHTML = `<img src="${objectUrl}" class="w-full h-full object-cover">`;
                        }
                    }
                }
            }
            
            // 2. Project Create / Edit page preview update
            if (window.location.href.includes('projects')) {
                const form = fileInput.closest('form');
                if (form) {
                    const existingImg = form.querySelector('.w-48.aspect-video img');
                    if (existingImg) {
                        existingImg.src = objectUrl;
                    } else {
                        // Create widescreen preview if not present (create page)
                        let previewContainer = form.querySelector('#project-image-preview-container');
                        if (!previewContainer) {
                            const inputWrapper = fileInput.closest('div');
                            previewContainer = document.createElement('div');
                            previewContainer.id = 'project-image-preview-container';
                            previewContainer.className = 'mb-4';
                            previewContainer.innerHTML = `
                                <span class="block text-xs font-black uppercase tracking-widest text-black mb-2">Pratinjau Hasil Potong</span>
                                <div class="w-48 aspect-video bg-slate-100 border-3 border-black flex items-center justify-center overflow-hidden shadow-[3px_3px_0px_#000000]">
                                    <img src="${objectUrl}" class="object-cover w-full h-full">
                                </div>
                            `;
                            // Insert before the wrapper of file input
                            inputWrapper.parentNode.insertBefore(previewContainer, inputWrapper);
                        } else {
                            const img = previewContainer.querySelector('img');
                            if (img) img.src = objectUrl;
                        }
                    }
                }
            }
        }
    </script>
</body>
</html>
