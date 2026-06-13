<!DOCTYPE html>
<html lang="id" class="h-full bg-[#f5f5f5]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Migrasi Database Diperlukan | Portofolio</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Outfit & Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&family=Inter:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, .brutal-title {
            font-family: 'Outfit', sans-serif;
        }
        /* Brutalist Button Accent */
        .brutal-btn {
            background-color: #ff5722;
            color: black;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: 4px solid black;
            box-shadow: 4px 4px 0px #000000;
            transition: all 0.1s ease;
        }
        .brutal-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px #000000;
        }
        .brutal-btn:active {
            transform: translate(2px, 2px);
            box-shadow: none;
        }
    </style>
</head>
<body class="h-full flex flex-col justify-center items-center p-4">

    <!-- Container Card (Neo-Brutalist) -->
    <div class="max-w-3xl w-full bg-white border-4 border-black p-8 sm:p-12 shadow-[10px_10px_0px_#000000] relative overflow-hidden">
        
        <!-- Top Orange Accent Bar -->
        <div class="absolute top-0 left-0 w-full h-4 bg-[#ff5722] border-b-4 border-black"></div>

        <!-- Decorative corner box -->
        <div class="absolute -top-3 -left-3 w-8 h-8 bg-black border-4 border-[#ff5722] rotate-12"></div>

        <!-- Header -->
        <div class="mt-4 pb-6 border-b-4 border-black">
            <span class="inline-flex items-center px-4 py-1.5 border-2 border-black text-xs font-black uppercase tracking-widest bg-black text-[#ff5722] shadow-[2px_2px_0px_#ff5722] mb-6">
                // ERROR CODE: 42S02 (MIGRATION_REQUIRED)
            </span>
            <h1 class="text-3xl sm:text-5xl font-black uppercase tracking-tighter leading-none mb-4 text-black">
                Tabel Database <br class="hidden sm:inline"> Belum Dibuat!
            </h1>
            <p class="text-sm font-bold uppercase tracking-wider text-slate-500">// Struktur database portofolio di server hosting belum terkonfigurasi lengkap.</p>
        </div>

        <!-- Explanation -->
        <div class="my-6 space-y-4">
            <p class="text-lg font-bold text-slate-800 leading-relaxed">
                Aplikasi mendeteksi bahwa tabel pivot baru <code class="bg-orange-100 text-black px-1.5 py-0.5 border border-black font-mono font-black text-sm">project_badge</code> atau tabel lainnya belum ada di database server Anda. Anda perlu menjalankan migrasi database untuk membuat tabel-tabel tersebut.
            </p>
        </div>

        <!-- Action / Commands Panel -->
        <div class="bg-black text-[#ccff00] border-4 border-black p-6 shadow-[4px_4px_0px_#ff5722] font-mono mb-8 relative">
            <span class="absolute top-2 right-4 text-xs font-black uppercase text-slate-500 select-none">// Terminal</span>
            <h3 class="text-xs font-black uppercase text-white tracking-widest mb-4 border-b border-dashed border-slate-700 pb-2">JALANKAN PERINTAH BERIKUT:</h3>
            
            <div class="space-y-4">
                <!-- Command 1 -->
                <div>
                    <p class="text-slate-400 text-xxs font-bold uppercase mb-1"># 1. Jalankan Migrasi Database</p>
                    <div class="flex items-center justify-between bg-slate-900/60 p-3 border border-slate-800 rounded">
                        <code id="cmd-migrate" class="text-sm sm:text-base font-bold text-[#ccff00]">php artisan migrate</code>
                        <button onclick="copyCommand('cmd-migrate')" class="text-xs font-bold uppercase bg-[#ff5722] text-black px-2.5 py-1 hover:bg-orange-600 border border-black shadow-[2px_2px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none">Salin</button>
                    </div>
                </div>

                <!-- Command 2 -->
                <div>
                    <p class="text-slate-400 text-xxs font-bold uppercase mb-1"># 2. Seed Data Awal (Opsional - Jika Database Masih Kosong)</p>
                    <div class="flex items-center justify-between bg-slate-900/60 p-3 border border-slate-800 rounded">
                        <code id="cmd-seed" class="text-sm sm:text-base font-bold text-[#ccff00]">php artisan db:seed</code>
                        <button onclick="copyCommand('cmd-seed')" class="text-xs font-bold uppercase bg-[#ff5722] text-black px-2.5 py-1 hover:bg-orange-600 border border-black shadow-[2px_2px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none">Salin</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Troubleshooting Note (Alert Box) -->
        <div class="p-4 bg-orange-50 border-4 border-black text-black shadow-[4px_4px_0px_#000000] flex gap-3 mb-8">
            <svg class="w-6 h-6 flex-shrink-0 mt-0.5 text-[#ff5722]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
            <div class="text-xs font-bold uppercase tracking-wider">
                <span class="text-sm font-black">// CATATAN PENTING:</span>
                <p class="mt-1 text-slate-700">Jika Anda menggunakan SSH, pastikan masuk ke direktori root aplikasi di server sebelum menjalankan perintah di atas. Jika error berlanjut, hapus cache konfigurasi dengan menjalankan: <code class="bg-black text-white px-1.5 py-0.5 text-[10px]">php artisan config:clear</code>.</p>
            </div>
        </div>

        <!-- Error Detail (Toggleable Accordion) -->
        <div class="border-2 border-black">
            <button onclick="toggleErrorDetail()" class="w-full bg-slate-100 hover:bg-slate-200 p-3 flex justify-between items-center font-bold text-xs uppercase text-slate-700">
                <span>// TAMPILKAN LOG EROR MENTAH (DEBUG LOG)</span>
                <span id="accordion-arrow">&darr;</span>
            </button>
            <div id="error-detail" class="hidden p-4 bg-slate-50 border-t-2 border-black text-left overflow-x-auto font-mono text-[10px] sm:text-xs text-rose-600 max-h-48 whitespace-pre-wrap">
{{ $exception->getMessage() }}
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="mt-8 pt-6 border-t-2 border-black flex flex-wrap gap-4 items-center justify-between">
            <button onclick="window.location.reload()" class="brutal-btn px-6 py-3 text-xs w-full sm:w-auto">
                Muat Ulang Halaman
            </button>
            <span class="text-slate-400 text-xxs font-black uppercase">// Portofolio Dev Mode Helper</span>
        </div>

    </div>

    <!-- JS Helper for Copying & Accordion -->
    <script>
        function copyCommand(elementId) {
            const commandText = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(commandText).then(() => {
                alert('Perintah berhasil disalin ke clipboard!');
            }).catch(err => {
                console.error('Gagal menyalin perintah: ', err);
            });
        }

        function toggleErrorDetail() {
            const detailDiv = document.getElementById('error-detail');
            const arrow = document.getElementById('accordion-arrow');
            if (detailDiv.classList.contains('hidden')) {
                detailDiv.classList.remove('hidden');
                arrow.innerHTML = '&uarr;';
            } else {
                detailDiv.classList.add('hidden');
                arrow.innerHTML = '&darr;';
            }
        }
    </script>
</body>
</html>
