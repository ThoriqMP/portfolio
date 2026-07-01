@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Welcome Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b-4 border-black">
        <div>
            <h1 class="text-4xl font-black uppercase tracking-tighter text-black">Ringkasan Panel Kontrol</h1>
            <p class="text-slate-650 font-bold uppercase tracking-wider text-xs mt-1">// Kelola data portofolio publik Anda secara instan.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.cv.download') }}" target="_blank" class="brutal-btn-admin inline-flex items-center gap-2 px-5 py-3 text-sm bg-black text-white hover:bg-white hover:text-black">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Download CV
            </a>
            <a href="/" target="_blank" class="brutal-btn-admin inline-flex items-center gap-2 px-5 py-3 text-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Kunjungi Website Publik
            </a>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Projects Stat Card -->
        <div class="bg-white border-4 border-black p-6 flex items-center justify-between shadow-[6px_6px_0px_#000000] hover:shadow-[8px_8px_0px_#000000] hover:-translate-y-0.5 hover:-translate-x-0.5 transition duration-150">
            <div class="space-y-2">
                <span class="text-xs font-black uppercase tracking-widest text-slate-500">Total Proyek</span>
                <h3 class="text-5xl font-black text-black">{{ $stats['projects_count'] }}</h3>
                <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center text-xs font-black uppercase text-[#ff5722] hover:underline pt-2">
                    Kelola Proyek &rarr;
                </a>
            </div>
            <div class="p-3 bg-[#ff5722] text-black border-2 border-black shadow-[2px_2px_0px_#000000]">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3M12 3v18m0-18l-3 3m3-3l3 3" />
                </svg>
            </div>
        </div>

        <!-- Educations Stat Card -->
        <div class="bg-white border-4 border-black p-6 flex items-center justify-between shadow-[6px_6px_0px_#000000] hover:shadow-[8px_8px_0px_#000000] hover:-translate-y-0.5 hover:-translate-x-0.5 transition duration-150">
            <div class="space-y-2">
                <span class="text-xs font-black uppercase tracking-widest text-slate-500">Pendidikan</span>
                <h3 class="text-5xl font-black text-black">{{ $stats['educations_count'] }}</h3>
                <a href="{{ route('admin.educations.index') }}" class="inline-flex items-center text-xs font-black uppercase text-[#ff5722] hover:underline pt-2">
                    Kelola Pendidikan &rarr;
                </a>
            </div>
            <div class="p-3 bg-[#ff5722] text-black border-2 border-black shadow-[2px_2px_0px_#000000]">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                </svg>
            </div>
        </div>

        <!-- Experiences Stat Card -->
        <div class="bg-white border-4 border-black p-6 flex items-center justify-between shadow-[6px_6px_0px_#000000] hover:shadow-[8px_8px_0px_#000000] hover:-translate-y-0.5 hover:-translate-x-0.5 transition duration-150">
            <div class="space-y-2">
                <span class="text-xs font-black uppercase tracking-widest text-slate-500">Pengalaman</span>
                <h3 class="text-5xl font-black text-black">{{ $stats['experiences_count'] }}</h3>
                <a href="{{ route('admin.experiences.index') }}" class="inline-flex items-center text-xs font-black uppercase text-[#ff5722] hover:underline pt-2">
                    Kelola Pengalaman &rarr;
                </a>
            </div>
            <div class="p-3 bg-[#ff5722] text-black border-2 border-black shadow-[2px_2px_0px_#000000]">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Quick Shortcuts Card -->
    <div class="bg-white border-4 border-black p-6 sm:p-8 shadow-[8px_8px_0px_#000000]">
        <h3 class="text-xl font-black uppercase text-black mb-6">Aksi Cepat Panel Admin</h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <a href="{{ route('admin.projects.create') }}" class="p-6 bg-white border-3 border-black hover:border-[#ff5722] flex flex-col items-center justify-center text-center gap-3 group transition shadow-[3px_3px_0px_#000000] hover:shadow-[5px_5px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none duration-100">
                <div class="w-12 h-12 bg-slate-100 border-2 border-black group-hover:bg-[#ff5722] text-black flex items-center justify-center transition duration-200">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <span class="text-sm font-black uppercase text-black">Tambah Proyek</span>
                <span class="text-xs text-slate-500 font-bold uppercase tracking-wider">// Proyek portofolio baru</span>
            </a>

            <a href="{{ route('admin.educations.create') }}" class="p-6 bg-white border-3 border-black hover:border-[#ff5722] flex flex-col items-center justify-center text-center gap-3 group transition shadow-[3px_3px_0px_#000000] hover:shadow-[5px_5px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none duration-100">
                <div class="w-12 h-12 bg-slate-100 border-2 border-black group-hover:bg-[#ff5722] text-black flex items-center justify-center transition duration-200">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <span class="text-sm font-black uppercase text-black">Tambah Pendidikan</span>
                <span class="text-xs text-slate-500 font-bold uppercase tracking-wider">// Riwayat pendidikan baru</span>
            </a>

            <a href="{{ route('admin.experiences.create') }}" class="p-6 bg-white border-3 border-black hover:border-[#ff5722] flex flex-col items-center justify-center text-center gap-3 group transition shadow-[3px_3px_0px_#000000] hover:shadow-[5px_5px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none duration-100">
                <div class="w-12 h-12 bg-slate-100 border-2 border-black group-hover:bg-[#ff5722] text-black flex items-center justify-center transition duration-200">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <span class="text-sm font-black uppercase text-black">Tambah Pengalaman</span>
                <span class="text-xs text-slate-500 font-bold uppercase tracking-wider">// Riwayat pekerjaan baru</span>
            </a>
        </div>
    </div>
</div>
@endsection
