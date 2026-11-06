@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Welcome Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200/80">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">Ringkasan Panel Kontrol</h1>
            <p class="text-slate-500 font-medium text-sm mt-1">Kelola data portofolio publik, profil, dan galeri proyek secara langsung.</p>
        </div>
        <div class="flex items-center gap-2.5">
            <button type="button" onclick="openCvModal()" class="brutal-btn-secondary text-xs cursor-pointer">
                <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Unduh CV
            </button>
            <a href="/" target="_blank" class="brutal-btn-admin text-xs">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Kunjungi Website
            </a>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Projects Stat Card -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition duration-200 flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Portofolio</span>
                    <h3 class="text-4xl font-extrabold text-slate-900 mt-2 tracking-tight">{{ $stats['projects_count'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-orange-50 border border-orange-100 text-[#FF4D2D] flex items-center justify-center shadow-xs">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
            </div>
            <div class="pt-5 mt-4 border-t border-slate-100 flex items-center justify-between">
                <span class="text-xs font-medium text-emerald-600 flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Aktif di Website
                </span>
                <a href="{{ route('admin.projects.index') }}" class="text-xs font-semibold text-[#FF4D2D] hover:text-[#E63D1F] inline-flex items-center gap-1 group">
                    Kelola Proyek 
                    <span class="transform group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                </a>
            </div>
        </div>

        <!-- Educations Stat Card -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition duration-200 flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Riwayat Pendidikan</span>
                    <h3 class="text-4xl font-extrabold text-slate-900 mt-2 tracking-tight">{{ $stats['educations_count'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center shadow-xs">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                    </svg>
                </div>
            </div>
            <div class="pt-5 mt-4 border-t border-slate-100 flex items-center justify-between">
                <span class="text-xs font-medium text-slate-500">Institusi &amp; Gelar</span>
                <a href="{{ route('admin.educations.index') }}" class="text-xs font-semibold text-[#FF4D2D] hover:text-[#E63D1F] inline-flex items-center gap-1 group">
                    Kelola Pendidikan 
                    <span class="transform group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                </a>
            </div>
        </div>

        <!-- Experiences Stat Card -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition duration-200 flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Pengalaman Kerja</span>
                    <h3 class="text-4xl font-extrabold text-slate-900 mt-2 tracking-tight">{{ $stats['experiences_count'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center shadow-xs">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
            </div>
            <div class="pt-5 mt-4 border-t border-slate-100 flex items-center justify-between">
                <span class="text-xs font-medium text-slate-500">Histori Karir</span>
                <a href="{{ route('admin.experiences.index') }}" class="text-xs font-semibold text-[#FF4D2D] hover:text-[#E63D1F] inline-flex items-center gap-1 group">
                    Kelola Pengalaman 
                    <span class="transform group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-8 shadow-xs">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-bold text-slate-900 tracking-tight">Aksi Cepat</h3>
                <p class="text-xs text-slate-500 font-medium">Pintasan praktis untuk memperbarui portofolio Anda.</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <a href="{{ route('admin.projects.create') }}" 
               class="p-5 rounded-2xl border border-slate-200/90 hover:border-[#FF4D2D]/50 hover:bg-orange-50/20 bg-slate-50/50 flex flex-col items-center justify-center text-center gap-3 group transition duration-200 hover:-translate-y-0.5 hover:shadow-sm">
                <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 group-hover:border-[#FF4D2D]/30 group-hover:bg-[#FF4D2D] group-hover:text-white text-slate-700 flex items-center justify-center transition duration-200 shadow-xs">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <div>
                    <span class="text-sm font-bold text-slate-900 group-hover:text-[#FF4D2D] transition block">Tambah Proyek Baru</span>
                    <span class="text-xs text-slate-500 font-medium mt-0.5 block">Unggah portofolio &amp; foto carousel</span>
                </div>
            </a>

            <a href="{{ route('admin.educations.create') }}" 
               class="p-5 rounded-2xl border border-slate-200/90 hover:border-[#FF4D2D]/50 hover:bg-orange-50/20 bg-slate-50/50 flex flex-col items-center justify-center text-center gap-3 group transition duration-200 hover:-translate-y-0.5 hover:shadow-sm">
                <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 group-hover:border-[#FF4D2D]/30 group-hover:bg-[#FF4D2D] group-hover:text-white text-slate-700 flex items-center justify-center transition duration-200 shadow-xs">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <div>
                    <span class="text-sm font-bold text-slate-900 group-hover:text-[#FF4D2D] transition block">Tambah Pendidikan</span>
                    <span class="text-xs text-slate-500 font-medium mt-0.5 block">Catat riwayat studi atau sertifikasi</span>
                </div>
            </a>

            <a href="{{ route('admin.experiences.create') }}" 
               class="p-5 rounded-2xl border border-slate-200/90 hover:border-[#FF4D2D]/50 hover:bg-orange-50/20 bg-slate-50/50 flex flex-col items-center justify-center text-center gap-3 group transition duration-200 hover:-translate-y-0.5 hover:shadow-sm">
                <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 group-hover:border-[#FF4D2D]/30 group-hover:bg-[#FF4D2D] group-hover:text-white text-slate-700 flex items-center justify-center transition duration-200 shadow-xs">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <div>
                    <span class="text-sm font-bold text-slate-900 group-hover:text-[#FF4D2D] transition block">Tambah Pengalaman</span>
                    <span class="text-xs text-slate-500 font-medium mt-0.5 block">Histori karir &amp; tanggung jawab</span>
                </div>
            </a>
        </div>

        <!-- Secondary Shortcuts Row -->
        <div class="mt-6 pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4">
            <span class="text-xs text-slate-500 font-medium">Pengaturan lainnya:</span>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.badges.index') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 003.182 0l4.318-4.318a2.25 2.25 0 000-3.182L11.16 3.659A2.25 2.25 0 009.568 3z" />
                    </svg>
                    Lencana Keahlian
                </a>
                <a href="{{ route('admin.socials.index') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    Sosial Media
                </a>
                <a href="{{ route('admin.profile.edit') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Edit Profil &amp; Foto Hero
                </a>
            </div>
        </div>
    </div>
</div>
@endsection