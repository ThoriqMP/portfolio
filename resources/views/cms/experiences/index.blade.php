@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200/80">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">Pengalaman Kerja</h1>
            <p class="text-slate-500 font-medium text-sm mt-1">Kelola histori karir, posisi, perusahaan, dan tanggung jawab profesional Anda.</p>
        </div>
        <div>
            <a href="{{ route('admin.experiences.create') }}" class="brutal-btn-admin text-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Tambah Pengalaman Baru</span>
            </a>
        </div>
    </div>

    <!-- Experiences Card Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($experiences as $experience)
            <div class="bg-white rounded-3xl border border-slate-200/90 p-6 shadow-xs hover:shadow-lg hover:-translate-y-1 transition duration-200 flex flex-col h-full justify-between group">
                <!-- Card Contents -->
                <div>
                    <!-- Period Badge -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200/60 font-semibold text-xs">
                            {{ $experience->start_date->format('M Y') }} &mdash; 
                            {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Sekarang' }}
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-slate-900 mb-1 leading-snug group-hover:text-[#FF4D2D] transition">
                        {{ $experience->position }}
                    </h3>
                    <p class="text-xs font-semibold text-[#FF4D2D] tracking-wide mb-4 uppercase">
                        {{ $experience->company_name }}
                    </p>

                    @if ($experience->description)
                        @php
                            $points = json_decode($experience->description, true);
                        @endphp
                        @if (is_array($points))
                            <ul class="list-disc pl-5 mb-6 text-xs text-slate-600 leading-relaxed space-y-1.5">
                                @foreach ($points as $point)
                                    @if (trim($point) !== '')
                                        <li>{{ $point }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <p class="text-xs text-slate-600 leading-relaxed mb-6">
                                {{ $experience->description }}
                            </p>
                        @endif
                    @endif
                </div>

                <!-- Action Buttons inside card -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2 mt-auto">
                    <!-- Edit -->
                    <a href="{{ route('admin.experiences.edit', $experience->id) }}" 
                       class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold transition shadow-xs flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <span>Edit</span>
                    </a>
                    <!-- Delete -->
                    <button type="button" 
                            onclick="triggerDelete('{{ route('admin.experiences.destroy', $experience->id) }}', '{{ addslashes($experience->company_name) }}')" 
                            class="px-3 py-1.5 rounded-xl border border-rose-100 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-semibold transition shadow-xs flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        <span>Hapus</span>
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 bg-white rounded-3xl border-2 border-dashed border-slate-200 p-8">
                <div class="w-16 h-16 rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-600 mx-auto mb-3 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-800">Belum Ada Pengalaman Kerja</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Tambahkan rekam jejak profesional atau karir Anda.</p>
                <div class="mt-5">
                    <a href="{{ route('admin.experiences.create') }}" class="brutal-btn-admin text-xs">
                        + Tambah Pengalaman Pertama
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection