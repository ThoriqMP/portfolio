@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200/80">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">Riwayat Pendidikan</h1>
            <p class="text-slate-500 font-medium text-sm mt-1">Kelola histori sekolah, universitas, gelar, dan pencapaian akademik.</p>
        </div>
        <div>
            <a href="{{ route('admin.educations.create') }}" class="brutal-btn-admin text-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Tambah Riwayat Baru</span>
            </a>
        </div>
    </div>

    <!-- Educations Card Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($educations as $education)
            <div class="bg-white rounded-3xl border border-slate-200/90 p-6 shadow-xs hover:shadow-lg hover:-translate-y-1 transition duration-200 flex flex-col h-full justify-between group">
                <!-- Card Contents -->
                <div>
                    <!-- Period Badge -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200/60 font-semibold text-xs">
                            {{ $education->start_year }} &mdash; {{ $education->end_year ?? 'Sekarang' }}
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-slate-900 mb-1 leading-snug group-hover:text-[#FF4D2D] transition">
                        {{ $education->institution_name }}
                    </h3>
                    <p class="text-xs font-semibold text-[#FF4D2D] tracking-wide mb-4 uppercase">
                        {{ $education->degree }}
                    </p>

                    @if ($education->description)
                        @php
                            $points = json_decode($education->description, true);
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
                                {{ $education->description }}
                            </p>
                        @endif
                    @endif
                </div>

                <!-- Action Buttons inside card -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2 mt-auto">
                    <!-- Edit -->
                    <a href="{{ route('admin.educations.edit', $education->id) }}" 
                       class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold transition shadow-xs flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <span>Edit</span>
                    </a>
                    <!-- Delete -->
                    <button type="button" 
                            onclick="triggerDelete('{{ route('admin.educations.destroy', $education->id) }}', '{{ addslashes($education->institution_name) }}')" 
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
                <div class="w-16 h-16 rounded-2xl bg-blue-50 border border-blue-100 text-blue-600 mx-auto mb-3 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-800">Belum Ada Riwayat Pendidikan</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Tambahkan histori sekolah, kampus, atau pelatihan akademik Anda.</p>
                <div class="mt-5">
                    <a href="{{ route('admin.educations.create') }}" class="brutal-btn-admin text-xs">
                        + Tambah Riwayat Pertama
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection