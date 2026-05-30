<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login CMS Admin - Portofolio</title>
    <!-- Google Fonts: Space Grotesk -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;850&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Space Grotesk"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#f5f5f5] text-black min-h-screen flex items-center justify-center p-4">

    <div class="relative w-full max-w-md">
        <!-- Structural Brutalist Login Card -->
        <div class="bg-white border-4 border-black p-8 sm:p-10 shadow-[12px_12px_0px_#000000] relative">
            <!-- Decorative Corner Blocks -->
            <div class="absolute -top-3 -left-3 w-6 h-6 bg-[#ff5722] border-2 border-black"></div>
            <div class="absolute -bottom-3 -right-3 w-6 h-6 bg-[#ff5722] border-2 border-black"></div>

            <!-- Header -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center text-xs font-black uppercase tracking-wider text-black border-2 border-black bg-white hover:bg-[#ff5722] px-3 py-1.5 shadow-[2px_2px_0px_#000000] transition active:translate-x-0.5 active:translate-y-0.5 active:shadow-none mb-6">
                    <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali Ke Website
                </a>
                <h1 class="text-3xl font-black uppercase tracking-tighter text-black mt-2">CMS Admin</h1>
                <p class="text-slate-600 text-xs font-bold uppercase tracking-wider mt-2">// Silakan login untuk mengelola portofolio</p>
            </div>

            <!-- Toast Flash Messages (Brutalist style) -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-100 border-3 border-black text-black text-xs font-bold uppercase shadow-[3px_3px_0px_#000000] flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Username Input -->
                <div>
                    <label for="username" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Masukkan username Anda" required
                        class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                    @error('username')
                        <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" required
                        class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-black text-sm font-extrabold uppercase cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 bg-white border-2 border-black rounded-none text-[#ff5722] focus:ring-0 focus:ring-offset-0 mr-2">
                        Ingat Saya
                    </label>
                </div>

                <!-- Submit Button (Brutalist Orange Block) -->
                <button type="submit" class="w-full py-3.5 px-4 bg-[#ff5722] hover:bg-orange-600 text-black font-black uppercase tracking-widest border-3 border-black shadow-[4px_4px_0px_#000000] hover:shadow-[6px_6px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition duration-100">
                    Masuk Panel Admin &rarr;
                </button>
            </form>
        </div>
    </div>

</body>
</html>
