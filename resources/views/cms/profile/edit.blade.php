@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-3xl">
    <!-- Header -->
    <div class="pb-6 border-b-4 border-black">
        <h1 class="text-4xl font-black uppercase tracking-tighter text-black">Pengaturan Profil</h1>
        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">// Kustomisasikan teks portofolio publik Anda secara instan.</p>
    </div>

    <!-- Live Preview Note Alert (Brutalist Panel) -->
    <div class="p-4 bg-orange-100 border-4 border-black text-black shadow-[4px_4px_0px_#000000] flex gap-3">
        <svg class="w-6 h-6 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 11.517 1.28l-.042.02v.003H12v.006h-.002v.013h-.005v.022h-.01v.035h-.02v.056h-.04v.09h-.08v.144H11.5v.23h-.1v.37h-.2v.592h-.4v.947H10.5v1.515h-.1V18.75h.1v.23h.1v.115h.1v.057h.1v.029h.1v.015h.1v.007h.1v.004h.1v.002H11.5v.001h.227v-.001h.001v-.002h.002v-.004h.004v-.007h.008v-.015h.015v-.029h.03v-.057h.059v-.115h.118v-.23h.236v-.46h.473v-.921h.947v-1.842h.1v-.37h.1v-.185h.1v-.092h.1v-.046h.1v-.023h.1v-.011H14.5v-.006h.001v-.002h.002v-.004h.004v-.008h.008v-.016h.015v-.03h.03v-.061h.059v-.122h.119v-.244H15v-.488h.1v-.977h.1V12.75h-.1V12.5h-.1v-.125h-.1v-.062h-.1v-.031H14.5v-.016H14.5v-.008h-.001v-.004h-.002v-.002h-.004v-.001H14.227v.001h-.001v.002h-.002v.004h-.004v.007h-.008v.015h-.015v.029h-.03v.057h-.059v.115h-.118v.23h-.236v.46h-.473v.921h-.947v1.842h-.1v.37h-.1v.185h-.1v.092h-.1v.046h-.1v-.023h-.1v-.011h-.1v-.006" />
        </svg>
        <div class="text-sm font-bold uppercase tracking-wider">
            <span class="text-base font-black">// INFO SINKRONISASI</span>
            <ul class="list-disc pl-5 mt-2 space-y-1.5 text-xs">
                <li><strong>Nama Lengkap</strong> memengaruhi sapaan Hero, brand navigasi, dan judul browser.</li>
                <li><strong>Gelar Profesional</strong> mengubah teks sub-hero depan & status avatar.</li>
                <li><strong>Biografi Singkat</strong> memengaruhi kalimat perkenalan utama di halaman depan.</li>
            </ul>
        </div>
    </div>

    <!-- Form Card (Brutalist Box) -->
    <div class="bg-white border-4 border-black p-6 sm:p-8 shadow-[6px_6px_0px_#000000]">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Avatar Upload Area -->
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6 pb-6 border-b-2 border-dashed border-black">
                <!-- Preview -->
                <div>
                    <span class="block text-xs font-black uppercase tracking-widest text-black mb-2">Foto Profil Saat Ini</span>
                    <div class="w-24 h-24 bg-white border-4 border-black shadow-[4px_4px_0px_#000000] overflow-hidden flex items-center justify-center">
                        @if ($user->avatar_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->avatar_path))
                            <img src="{{ asset('storage/' . $user->avatar_path) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-[#ff5722] text-black font-black text-3xl uppercase flex items-center justify-center border border-black">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Upload field -->
                <div class="flex-grow w-full">
                    <label for="image" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Unggah Foto Baru</label>
                    <div class="w-full bg-white border-3 border-black rounded-none px-4 py-4 focus-within:-translate-y-0.5 focus-within:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                        <input type="file" name="image" id="image" accept="image/*" class="text-sm text-black file:mr-4 file:py-2 file:px-4 file:rounded-none file:border-2 file:border-black file:text-xs file:font-black file:uppercase file:bg-[#ff5722] file:text-black hover:file:bg-orange-600 file:cursor-pointer cursor-pointer">
                    </div>
                    <p class="text-slate-500 text-xxs font-bold uppercase mt-1.5">// Format: JPEG, JPG, PNG. Maksimal 2MB.</p>
                    @error('image')
                        <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" placeholder="Contoh: Thoriq" required
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                @error('name')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Title -->
            <div>
                <label for="title" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Gelar Profesional</label>
                <input type="text" name="title" id="title" value="{{ old('title', $user->title) }}" placeholder="Contoh: Fullstack Web Developer"
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                @error('title')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Bio -->
            <div>
                <label for="bio" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Biografi Singkat</label>
                <textarea name="bio" id="bio" rows="4" placeholder="Tuliskan biografi atau kalimat pengantar profesional Anda..."
                    class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">{{ old('bio', $user->bio) }}</textarea>
                @error('bio')
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                @enderror
            </div>

            <!-- Contact & Social Media Info -->
            <div class="border-t-2 border-black pt-6 space-y-6">
                <h3 class="text-sm font-black uppercase text-[#ff5722] tracking-wider">// Informasi Kontak & Sosial Media</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Email Contact -->
                    <div>
                        <label for="email_contact" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Email Kontak</label>
                        <input type="email" name="email_contact" id="email_contact" value="{{ old('email_contact', $user->email_contact) }}" placeholder="Contoh: thoriq@example.com"
                            class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                        @error('email_contact')
                            <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number / WhatsApp -->
                    <div>
                        <label for="phone" class="block text-xs font-black uppercase tracking-widest text-black mb-2">No. HP / WhatsApp (Format: 628...)</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 6281234567890"
                            class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                        @error('phone')
                            <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <!-- GitHub Link -->
                    <div>
                        <label for="github_link" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Link GitHub</label>
                        <input type="url" name="github_link" id="github_link" value="{{ old('github_link', $user->github_link) }}" placeholder="https://github.com/username"
                            class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                        @error('github_link')
                            <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- LinkedIn Link -->
                    <div>
                        <label for="linkedin_link" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Link LinkedIn</label>
                        <input type="url" name="linkedin_link" id="linkedin_link" value="{{ old('linkedin_link', $user->linkedin_link) }}" placeholder="https://linkedin.com/in/username"
                            class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                        @error('linkedin_link')
                            <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Instagram Link -->
                    <div>
                        <label for="instagram_link" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Link Instagram</label>
                        <input type="url" name="instagram_link" id="instagram_link" value="{{ old('instagram_link', $user->instagram_link) }}" placeholder="https://instagram.com/username"
                            class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                        @error('instagram_link')
                            <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="border-t-2 border-black pt-6 space-y-6">
                <h3 class="text-sm font-black uppercase text-[#ff5722] tracking-wider">// Kredensial Masuk Akun</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Username Baru</label>
                        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required
                            class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                        @error('username')
                            <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-xs font-black uppercase tracking-widest text-black mb-2">Ganti Password (Opsional)</label>
                        <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak diganti"
                            class="w-full bg-white border-3 border-black rounded-none px-4 py-3 text-black font-sans font-bold placeholder-slate-400 focus:outline-none focus:bg-orange-50/70 focus:-translate-y-0.5 focus:shadow-[4px_4px_0px_#000000] transition-all duration-150">
                        <p class="text-slate-500 text-xxs font-bold uppercase mt-1.5">// Isi hanya jika Anda ingin memperbarui password masuk.</p>
                        @error('password')
                            <p class="text-rose-600 text-xs font-bold uppercase tracking-wide mt-1.5">// {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-6 border-t-2 border-black flex items-center justify-end">
                <button type="submit" class="brutal-btn-admin px-6 py-3 text-sm">
                    Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
