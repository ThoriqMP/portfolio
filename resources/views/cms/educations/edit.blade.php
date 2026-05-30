@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-3xl">
    <!-- Header -->
    <div class="pb-6 border-b-4 border-black">
        <a href="{{ route('admin.educations.index') }}" class="inline-flex items-center text-xs font-black uppercase tracking-wider text-black border-2 border-black bg-white hover:bg-[#ff5722] px-3 py-1.5 shadow-[2px_2px_0px_#000000] transition active:translate-x-0.5 active:translate-y-0.5 active:shadow-none mb-4">
            &larr; Kembali ke Pendidikan
        </a>
        <h1 class="text-4xl font-black uppercase tracking-tighter text-black">Edit Riwayat Pendidikan</h1>
        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">// Perbaruilah data riwayat akademik Anda.</p>
    </div>

    <!-- Form Card (Brutalist Box) -->
    <div class="bg-white border-4 border-black p-6 sm:p-8 shadow-[6px_6px_0px_#000000]">
        <form action="{{ route('admin.educations.update', $education->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Institution Name -->
            <div>
                <label for="institution_name" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Nama Institusi</label>
                <input type="text" name="institution_name" id="institution_name" value="{{ old('institution_name', $education->institution_name) }}" placeholder="Contoh: Universitas Indonesia" required
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                @error('institution_name')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Degree / Course -->
            <div>
                <label for="degree" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Gelar / Bidang Studi</label>
                <input type="text" name="degree" id="degree" value="{{ old('degree', $education->degree) }}" placeholder="Contoh: S1 Teknik Informatika" required
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                @error('degree')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Years Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Start Year -->
                <div>
                    <label for="start_year" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Tahun Mulai</label>
                    <input type="number" name="start_year" id="start_year" value="{{ old('start_year', $education->start_year) }}" min="1900" max="2100" required
                        class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                    @error('start_year')
                        <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                    @enderror
                </div>

                <!-- End Year -->
                <div>
                    <label for="end_year" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Tahun Lulus (Opsional)</label>
                    <input type="number" name="end_year" id="end_year" value="{{ old('end_year', $education->end_year) }}" min="1900" max="2100" placeholder="Kosongkan jika masih aktif belajar"
                        class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                    @error('end_year')
                        <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Pencapaian / Deskripsi (Opsional)</label>
                <textarea name="description" id="description" rows="4" placeholder="Tuliskan pencapaian akademik, kepanitiaan, atau IPK Anda..."
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">{{ old('description', $education->description) }}</textarea>
                @error('description')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="pt-6 border-t-2 border-black flex items-center justify-end gap-3">
                <a href="{{ route('admin.educations.index') }}" class="brutal-btn-secondary px-5 py-2.5 text-sm">Batal</a>
                <button type="submit" class="brutal-btn-admin px-5 py-2.5 text-sm">
                    Perbarui Riwayat
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
