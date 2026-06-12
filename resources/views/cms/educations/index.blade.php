@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b-4 border-black">
        <div>
            <h1 class="text-4xl font-black uppercase tracking-tighter text-black">Riwayat Pendidikan</h1>
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">// Kelola histori pendidikan Anda dalam tampilan kartu brutalist.</p>
        </div>
        <div>
            <a href="{{ route('admin.educations.create') }}" class="brutal-btn-admin inline-flex items-center gap-2 px-5 py-3 text-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Riwayat Baru
            </a>
        </div>
    </div>

    <!-- Educations Card Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($educations as $education)
            <div class="bg-white border-4 border-black p-6 shadow-[6px_6px_0px_#000000] hover:shadow-[10px_10px_0px_#000000] hover:-translate-x-1 hover:-translate-y-1 transition duration-150 flex flex-col h-full justify-between">
                <!-- Card Contents -->
                <div>
                    <!-- Period Badge -->
                    <span class="inline-flex items-center px-3 py-1 bg-black text-[#ff5722] border-2 border-black font-extrabold text-xs uppercase shadow-[2px_2px_0px_#ff5722] mb-4">
                        {{ $education->start_year }} - {{ $education->end_year ?? 'Sekarang' }}
                    </span>

                    <h3 class="text-xl font-black uppercase tracking-tight text-black mb-1 leading-tight">
                        {{ $education->institution_name }}
                    </h3>
                    <p class="text-sm font-extrabold uppercase text-[#ff5722] tracking-wider mb-4">
                        {{ $education->degree }}
                    </p>

                    @if ($education->description)
                        @php
                            $points = json_decode($education->description, true);
                        @endphp
                        @if (is_array($points))
                            <ul class="list-disc pl-5 mb-6 text-sm font-bold text-slate-700 leading-relaxed space-y-1">
                                @foreach ($points as $point)
                                    @if (trim($point) !== '')
                                        <li>{{ $point }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm font-bold text-slate-700 leading-relaxed mb-6">
                                {{ $education->description }}
                            </p>
                        @endif
                    @endif
                </div>

                <!-- Action Buttons inside card -->
                <div class="pt-4 border-t-2 border-black flex items-center justify-end gap-2 mt-auto">
                    <!-- Edit -->
                    <a href="{{ route('admin.educations.edit', $education->id) }}" class="px-3 py-1.5 border-2 border-black bg-white hover:bg-blue-100 text-black text-xs font-black uppercase shadow-[2px_2px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition duration-100 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        Edit
                    </a>
                    <!-- Delete -->
                    <button type="button" onclick="triggerDelete('{{ route('admin.educations.destroy', $education->id) }}', '{{ addslashes($education->institution_name) }}')" class="px-3 py-1.5 border-2 border-black bg-[#ff5722] hover:bg-orange-600 text-black text-xs font-black uppercase shadow-[2px_2px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition duration-100 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 bg-white border-4 border-dashed border-slate-350 p-8 shadow-[4px_4px_0px_#000000]">
                <p class="font-black uppercase tracking-wider text-slate-500">// Belum ada riwayat pendidikan. Silakan tambahkan riwayat baru.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
