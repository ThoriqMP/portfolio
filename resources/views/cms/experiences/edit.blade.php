@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-3xl">
    <!-- Header -->
    <div class="pb-6 border-b-4 border-black">
        <a href="{{ route('admin.experiences.index') }}" class="inline-flex items-center text-xs font-black uppercase tracking-wider text-black border-2 border-black bg-white hover:bg-[#ff5722] px-3 py-1.5 shadow-[2px_2px_0px_#000000] transition active:translate-x-0.5 active:translate-y-0.5 active:shadow-none mb-4">
            &larr; Kembali ke Pengalaman
        </a>
        <h1 class="text-4xl font-black uppercase tracking-tighter text-black">Edit Pengalaman Kerja</h1>
        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">// Perbaruilah data riwayat pekerjaan Anda.</p>
    </div>

    <!-- Form Card (Brutalist Box) -->
    <div class="bg-white border-4 border-black p-6 sm:p-8 shadow-[6px_6px_0px_#000000]">
        <form action="{{ route('admin.experiences.update', $experience->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Company Name -->
            <div>
                <label for="company_name" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Nama Perusahaan</label>
                <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $experience->company_name) }}" placeholder="Contoh: PT. Teknologi Indonesia" required
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                @error('company_name')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Position / Job Title -->
            <div>
                <label for="position" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Jabatan / Posisi Kerja</label>
                <input type="text" name="position" id="position" value="{{ old('position', $experience->position) }}" placeholder="Contoh: Senior Fullstack Web Developer" required
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                @error('position')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Dates Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Start Date -->
                <div>
                    <label for="start_date" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Tanggal Mulai Kerja</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $experience->start_date->format('Y-m-d')) }}" required
                        class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                    @error('start_date')
                        <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                    @enderror
                </div>

                <!-- End Date -->
                <div>
                    <label for="end_date" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Tanggal Selesai Kerja (Opsional)</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}"
                        class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                    <p class="text-slate-500 text-xxs font-bold uppercase mt-1.5">// Biarkan kosong jika masih aktif bekerja disini.</p>
                    @error('end_date')
                        <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Tanggung Jawab & Pencapaian</label>
                <textarea name="description" id="description" rows="5" placeholder="Jelaskan peran Anda, teknologi yang digunakan, dan pencapaian Anda..." required
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">{{ old('description', $experience->description) }}</textarea>
                @error('description')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="pt-6 border-t-2 border-black flex items-center justify-end gap-3">
                <a href="{{ route('admin.experiences.index') }}" class="brutal-btn-secondary px-5 py-2.5 text-sm">Batal</a>
                <button type="submit" class="brutal-btn-admin px-5 py-2.5 text-sm">
                    Perbarui Pengalaman
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
