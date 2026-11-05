<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login CMS Admin — Portofolio</title>
    <!-- App Favicon & Icons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">
    
    <!-- Google Fonts: Plus Jakarta Sans & Unbounded -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600;1,700;1,800&family=Unbounded:wght@700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                        brand: ['"Unbounded"', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        accent: {
                            500: '#FF4D2D',
                            600: '#E63D1F',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#0B0F17] text-white min-h-screen flex items-center justify-center p-4 selection:bg-[#FF4D2D] selection:text-white relative overflow-hidden font-sans">

    <!-- Ambient Gradient Glow Effects -->
    <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-[#FF4D2D]/15 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-blue-600/10 blur-3xl pointer-events-none"></div>

    <div class="relative w-full max-w-md z-10">
        <!-- Modern Luxury Glass Card -->
        <div class="bg-gradient-to-b from-[#131B29] to-[#0D1420] border border-slate-800/90 rounded-3xl p-8 sm:p-10 shadow-2xl shadow-black/80 backdrop-blur-xl relative">
            
            <!-- Branding Header -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-400 hover:text-white transition mb-6">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    <span>Kembali ke Website</span>
                </a>

                <div class="relative w-12 h-12 rounded-2xl bg-[#1C2536] border border-slate-700/80 flex items-center justify-center font-brand font-black text-white text-lg mx-auto mb-4 shadow-inner">
                    <span>T</span>
                    <span class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-[#FF4D2D] ring-2 ring-[#0B0F17] shadow-sm shadow-[#FF4D2D]/50 animate-pulse"></span>
                </div>

                <h1 class="text-2xl font-extrabold tracking-tight text-white font-brand">CMS ADMIN<span class="text-[#FF4D2D]">.</span></h1>
                <p class="text-slate-400 text-xs font-medium mt-1">Silakan masuk untuk mengelola portofolio publik</p>
            </div>

            <!-- Toast Flash Messages -->
            @if (session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-medium flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Username Input -->
                <div>
                    <label for="username" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Masukkan username admin" required
                        class="w-full rounded-xl bg-slate-900/90 border border-slate-700/80 px-4 py-3 text-white text-sm font-medium placeholder-slate-500 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/15 transition">
                    @error('username')
                        <p class="text-rose-400 text-xs font-medium mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" required
                        class="w-full rounded-xl bg-slate-900/90 border border-slate-700/80 px-4 py-3 text-white text-sm font-medium placeholder-slate-500 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/15 transition">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center text-slate-400 hover:text-slate-300 text-xs font-medium cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-[#FF4D2D] focus:ring-0 mr-2">
                        Ingat Saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-[#FF4D2D] to-[#E63D1F] hover:from-[#E63D1F] hover:to-[#C42F13] text-white font-bold text-sm shadow-lg shadow-[#FF4D2D]/25 transition active:scale-[0.98] flex items-center justify-center gap-2">
                    <span>Masuk Panel Admin</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

</body>
</html>