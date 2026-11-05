@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="pb-6 border-b border-slate-200/80">
        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">Kelola Sosial Media &amp; Kontak</h1>
        <p class="text-slate-500 font-medium text-sm mt-1">Hubungkan tautan media sosial dan kontak Anda secara dinamis ke beranda publik.</p>
    </div>

    <!-- Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Column: Social Links List (7 Cols) -->
        <div class="lg:col-span-7 space-y-6">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900 tracking-tight">Sosial Media Aktif</h2>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-100 text-slate-700">
                    {{ $socialLinks->count() }} Tautan
                </span>
            </div>
            
            @if($socialLinks->isEmpty())
                <div class="p-10 bg-white rounded-3xl border-2 border-dashed border-slate-200 text-center">
                    <p class="font-medium text-slate-500 text-sm">Belum ada media sosial. Tambahkan media sosial pertama Anda di samping!</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($socialLinks as $social)
                        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs hover:shadow-md transition duration-200 flex flex-col justify-between h-full relative group" id="social-card-{{ $social->id }}">
                            <div class="space-y-3 flex-grow">
                                <!-- Social Link Preview Button -->
                                <div>
                                    <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Tampilan Tombol:</span>
                                    @php
                                        $href = $social->link;
                                        $target = 'target="_blank"';
                                        if ($social->icon === 'email') {
                                            $href = str_starts_with($social->link, 'mailto:') ? $social->link : 'mailto:' . $social->link;
                                            $target = '';
                                        } elseif ($social->icon === 'whatsapp') {
                                            if (!str_starts_with($social->link, 'http://') && !str_starts_with($social->link, 'https://')) {
                                                $cleanNumber = preg_replace('/[^0-9]/', '', $social->link);
                                                $href = 'https://wa.me/' . $cleanNumber;
                                            }
                                        }
                                    @endphp
                                    <a href="{{ $href }}" {!! $target !!} rel="noopener noreferrer" 
                                       class="flex items-center justify-between px-3.5 py-2.5 rounded-xl font-semibold text-xs shadow-xs transition hover:scale-[1.02]"
                                       style="background-color: {{ $social->bg_color }}; color: {{ $social->text_color }};">
                                        <span>{{ $social->name }}</span>
                                        @switch($social->icon)
                                            @case('github')
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.137 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" /></svg>
                                                @break
                                            @case('linkedin')
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" /></svg>
                                                @break
                                            @case('instagram')
                                                <svg class="w-4 h-4 fill-currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" /></svg>
                                                @break
                                            @case('whatsapp')
                                                <svg class="w-4 h-4 fill-currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.717-1.458L0 24zm6.26-4.526c1.661.987 3.291 1.488 4.966 1.489 5.517 0 10.005-4.48 10.008-9.998.001-2.673-1.037-5.185-2.923-7.072C16.483 2.006 13.977.969 11.3.969 5.787.969 1.3 5.449 1.297 10.969c-.001 1.761.464 3.424 1.348 4.96L1.67 21.5l5.59-1.463c-.347-.206-.693-.412-1.04-.619-.103-.062-.206-.124-.309-.187-.001-.001-.001-.001-.001-.001v.001zm11.517-7.834c-.27-.135-1.597-.788-1.846-.878-.248-.09-.429-.135-.61.135-.181.271-.7 1.035-.858 1.216-.158.18-.316.203-.586.068-.27-.136-1.14-.42-2.171-1.339-.802-.716-1.343-1.6-1.501-1.871-.158-.271-.017-.417.118-.552.122-.122.27-.316.406-.474.135-.158.18-.271.27-.451.09-.18.045-.339-.022-.475-.068-.135-.61-1.467-.836-2.009-.22-.53-.442-.458-.61-.466-.158-.008-.339-.008-.52-.008-.18 0-.474.068-.722.339-.248.271-.948.927-.948 2.26 0 1.332.97 2.617 1.106 2.798.135.18 1.907 2.911 4.62 4.082.645.278 1.149.444 1.542.569.648.206 1.237.177 1.703.107.519-.078 1.597-.653 1.822-1.284.226-.632.226-1.173.158-1.285-.068-.113-.248-.18-.519-.315z" /></svg>
                                                @break
                                            @case('email')
                                                <svg class="w-4 h-4 fill-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                                                @break
                                            @default
                                                <svg class="w-4 h-4 fill-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" /></svg>
                                        @endswitch
                                    </a>
                                </div>
                                
                                <!-- Link details -->
                                <div class="text-[10px] font-medium text-slate-500 bg-slate-50 rounded-xl p-3 border border-slate-100 space-y-1">
                                    <div>Tautan: <span class="font-mono text-slate-800 font-semibold block truncate">{{ $social->link }}</span></div>
                                    <div class="grid grid-cols-2 gap-2 mt-2 pt-2 border-t border-slate-200">
                                        <div>Ikon: <span class="text-slate-800 font-semibold block">{{ strtoupper($social->icon) }}</span></div>
                                        <div>Palet: <span class="font-mono text-slate-800 font-semibold block">{{ $social->bg_color }}</span></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                                <button type="button" 
                                        onclick="enableEditMode({{ $social->id }}, '{{ addslashes($social->name) }}', '{{ addslashes($social->link) }}', '{{ $social->icon }}', '{{ $social->bg_color }}', '{{ $social->text_color }}')"
                                        class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    Edit
                                </button>
                                <button type="button" 
                                        onclick="triggerDelete('{{ route('admin.socials.destroy', $social->id) }}', 'media sosial {{ addslashes($social->name) }}')"
                                        class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 transition flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Right Column: Interactive Form Card (5 Cols) -->
        <div class="lg:col-span-5 sticky lg:top-20">
            <div class="bg-white rounded-3xl border border-slate-200/90 p-6 shadow-xs space-y-6" id="form-container">
                <div class="border-b border-slate-200/80 pb-3">
                    <h3 class="text-base font-bold text-slate-900" id="form-title">Tambah Media Sosial</h3>
                    <p class="text-xs text-slate-500 font-medium mt-0.5" id="form-subtitle">Tambahkan link sosial media dengan warna dan ikon pilihan.</p>
                </div>

                <!-- Live Realtime Preview Card -->
                <div class="bg-slate-50 rounded-2xl border border-slate-200 p-5 flex flex-col items-center justify-center space-y-2">
                    <span class="text-xs font-semibold text-slate-500 self-start">Pratinjau Tampilan:</span>
                    <div class="py-3 w-full">
                        <a id="preview-social-element" href="#" target="_blank" rel="noopener noreferrer"
                           class="flex items-center justify-between px-4 py-3 rounded-xl font-semibold text-xs shadow-xs transition pointer-events-none"
                           style="background-color: #0B0F17; color: #ffffff;">
                            <span id="preview-name-label">PREVIEW LABEL</span>
                            <div id="preview-icon-wrapper" class="w-4 h-4 text-inherit flex items-center justify-center">
                            </div>
                        </a>
                    </div>
                </div>

                <form id="social-crud-form" action="{{ route('admin.socials.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div id="method-spoofing-container"></div>

                    <!-- Social Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nama Tampilan</label>
                        <input type="text" name="name" id="name" placeholder="Contoh: GitHub Profil" required
                               class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 text-sm font-medium placeholder-slate-400 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
                        @error('name')
                            <p class="text-rose-600 text-xs font-semibold mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- URL / Contact Address -->
                    <div>
                        <label for="link" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Tautan / Kontak</label>
                        <input type="text" name="link" id="link" placeholder="Contoh: https://github.com/username" required
                               class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 text-sm font-medium placeholder-slate-400 focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
                        <p id="link-helper" class="text-slate-400 text-xs font-medium mt-1">Bisa berupa URL lengkap, mailto:email, wa.me/nomor, dll.</p>
                        @error('link')
                            <p class="text-rose-600 text-xs font-semibold mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Icon Preset Selector -->
                    <div>
                        <label for="icon" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Pilih Ikon</label>
                        <div class="relative w-full">
                            <select name="icon" id="icon" required
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 text-sm font-medium appearance-none focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition cursor-pointer">
                                <option value="github" selected>GitHub</option>
                                <option value="linkedin">LinkedIn</option>
                                <option value="instagram">Instagram</option>
                                <option value="whatsapp">WhatsApp</option>
                                <option value="email">Email</option>
                                <option value="facebook">Facebook</option>
                                <option value="youtube">YouTube</option>
                                <option value="twitter">X / Twitter</option>
                                <option value="link">Website / Tautan Umum</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>
                        @error('icon')
                            <p class="text-rose-600 text-xs font-semibold mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Background Color Selectors -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Warna Latar (Background)</label>
                        
                        <!-- Curated Presets -->
                        <div class="flex flex-wrap gap-2 pb-1">
                            <button type="button" onclick="selectColorPreset('bg', '#0B0F17')" class="w-7 h-7 rounded-lg border border-slate-300 hover:scale-110 transition bg-[#0B0F17]" title="Midnight Dark"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#0077b5')" class="w-7 h-7 rounded-lg border border-slate-300 hover:scale-110 transition bg-[#0077b5]" title="LinkedIn Blue"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#e1306c')" class="w-7 h-7 rounded-lg border border-slate-300 hover:scale-110 transition bg-[#e1306c]" title="Instagram"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#25d366')" class="w-7 h-7 rounded-lg border border-slate-300 hover:scale-110 transition bg-[#25d366]" title="WhatsApp"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#FF4D2D')" class="w-7 h-7 rounded-lg border border-slate-300 hover:scale-110 transition bg-[#FF4D2D]" title="Signature Orange"></button>
                            <button type="button" onclick="selectColorPreset('bg', '#F8FAFC')" class="w-7 h-7 rounded-lg border border-slate-300 hover:scale-110 transition bg-[#F8FAFC]" title="Light White"></button>
                        </div>

                        <!-- HEX Input and Picker -->
                        <div class="flex items-center gap-3">
                            <div class="relative flex-grow">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 font-mono font-bold text-slate-400 text-xs">HEX:</span>
                                <input type="text" name="bg_color" id="bg_color" value="#0B0F17" required
                                       class="w-full rounded-xl border border-slate-200 bg-white pl-12 pr-4 py-2 text-slate-900 font-mono text-xs font-semibold focus:outline-none focus:border-[#FF4D2D] focus:ring-4 focus:ring-[#FF4D2D]/10 transition">
                            </div>
                            <input type="color" id="bg_color_picker" value="#0B0F17" class="w-10 h-10 rounded-xl border border-slate-200 cursor-pointer p-0.5 bg-white">
                        </div>
                        @error('bg_color')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hidden Text Color input (automatically calculated from background color) -->
                    <input type="hidden" name="text_color" id="text_color" value="#ffffff">

                    <!-- Submit Buttons -->
                    <div class="pt-4 border-t border-slate-100 flex flex-col gap-2" id="form-actions">
                        <button type="submit" class="brutal-btn-admin w-full text-xs font-semibold" id="submit-form-btn">
                            Simpan Media Sosial
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- SVG Icon Dictionary for Real-time Javascript Preview -->
<script>
    const ICON_SVGS = {
        github: `<svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.137 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" /></svg>`,
        linkedin: `<svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" /></svg>`,
        instagram: `<svg class="w-4 h-4 fill-currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" /></svg>`,
        whatsapp: `<svg class="w-4 h-4 fill-currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.717-1.458L0 24zm6.26-4.526c1.661.987 3.291 1.488 4.966 1.489 5.517 0 10.005-4.48 10.008-9.998.001-2.673-1.037-5.185-2.923-7.072C16.483 2.006 13.977.969 11.3.969 5.787.969 1.3 5.449 1.297 10.969c-.001 1.761.464 3.424 1.348 4.96L1.67 21.5l5.59-1.463c-.347-.206-.693-.412-1.04-.619-.103-.062-.206-.124-.309-.187-.001-.001-.001-.001-.001-.001v.001zm11.517-7.834c-.27-.135-1.597-.788-1.846-.878-.248-.09-.429-.135-.61.135-.181.271-.7 1.035-.858 1.216-.158.18-.316.203-.586.068-.27-.136-1.14-.42-2.171-1.339-.802-.716-1.343-1.6-1.501-1.871-.158-.271-.017-.417.118-.552.122-.122.27-.316.406-.474.135-.158.18-.271.27-.451.09-.18.045-.339-.022-.475-.068-.135-.61-1.467-.836-2.009-.22-.53-.442-.458-.61-.466-.158-.008-.339-.008-.52-.008-.18 0-.474.068-.722.339-.248.271-.948.927-.948 2.26 0 1.332.97 2.617 1.106 2.798.135.18 1.907 2.911 4.62 4.082.645.278 1.149.444 1.542.569.648.206 1.237.177 1.703.107.519-.078 1.597-.653 1.822-1.284.226-.632.226-1.173.158-1.285-.068-.113-.248-.18-.519-.315z" /></svg>`,
        email: `<svg class="w-4 h-4 fill-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>`,
        link: `<svg class="w-4 h-4 fill-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" /></svg>`,
        facebook: `<svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>`,
        youtube: `<svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.108C19.525 3.5 12 3.5 12 3.5s-7.525 0-9.388.555A3.002 3.002 0 0 0 .502 6.163C0 8.07 0 12 0 12s0 3.93.502 5.837a3.003 3.003 0 0 0 2.11 2.108C4.475 20.5 12 20.5 12 20.5s7.525 0 9.388-.555a3.002 3.002 0 0 0 2.11-2.108C24 15.93 24 12 24 12s0-3.93-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>`,
        twitter: `<svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>`,
    };

    document.addEventListener('DOMContentLoaded', () => {
        const nameInput = document.getElementById('name');
        const linkInput = document.getElementById('link');
        const iconSelect = document.getElementById('icon');
        const bgColorInput = document.getElementById('bg_color');
        const bgPicker = document.getElementById('bg_color_picker');
        const textColorInput = document.getElementById('text_color');
        
        const previewElement = document.getElementById('preview-social-element');
        const previewNameLabel = document.getElementById('preview-name-label');
        const previewIconWrapper = document.getElementById('preview-icon-wrapper');
        const linkHelper = document.getElementById('link-helper');

        const PLACEHOLDERS = {
            github: "Contoh: https://github.com/username",
            linkedin: "Contoh: https://linkedin.com/in/username",
            instagram: "Contoh: https://instagram.com/username",
            whatsapp: "Contoh: 6281234567890 (Gunakan kode negara, tanpa tanda + atau spasi)",
            email: "Contoh: emailAnda@domain.com (Cukup masukkan email saja, tanpa mailto:)",
            facebook: "Contoh: https://facebook.com/username",
            youtube: "Contoh: https://youtube.com/@channel",
            twitter: "Contoh: https://x.com/username",
            link: "Contoh: https://domainanda.com"
        };

        const HELPERS = {
            github: "Masukkan URL lengkap profil GitHub Anda.",
            linkedin: "Masukkan URL lengkap profil LinkedIn Anda.",
            instagram: "Masukkan URL lengkap profil Instagram Anda.",
            whatsapp: "Cukup masukkan nomor WhatsApp. Sistem otomatis merujuk ke chat wa.me.",
            email: "Cukup masukkan alamat email aktif Anda. Sistem otomatis memformat ke tautan mailto:.",
            facebook: "Masukkan URL lengkap profil Facebook Anda.",
            youtube: "Masukkan URL lengkap channel YouTube Anda.",
            twitter: "Masukkan URL lengkap akun X / Twitter Anda.",
            link: "Masukkan URL lengkap situs web atau tautan umum lainnya."
        };

        function getContrastColor(hexColor) {
            let hex = hexColor.replace('#', '');
            if (hex.length === 3) {
                hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
            }
            if (hex.length !== 6) return '#FFFFFF';
            const r = parseInt(hex.substring(0, 2), 16);
            const g = parseInt(hex.substring(2, 4), 16);
            const b = parseInt(hex.substring(4, 6), 16);
            const brightness = (r * 299 + g * 587 + b * 114) / 1000;
            return (brightness >= 150) ? '#0B0F17' : '#FFFFFF';
        }

        function updateLivePreview() {
            const nameValue = nameInput.value.trim();
            previewNameLabel.textContent = nameValue !== "" ? nameValue : "NAMA SOSIAL MEDIA";
            
            const selectedIcon = iconSelect.value;
            previewIconWrapper.innerHTML = ICON_SVGS[selectedIcon] || ICON_SVGS['link'];
            
            const bgColor = bgColorInput.value;
            const contrastColor = getContrastColor(bgColor);
            
            previewElement.style.backgroundColor = bgColor;
            previewElement.style.color = contrastColor;
            if (textColorInput) {
                textColorInput.value = contrastColor;
            }

            if (PLACEHOLDERS[selectedIcon]) {
                linkInput.placeholder = PLACEHOLDERS[selectedIcon];
            }
            if (HELPERS[selectedIcon]) {
                linkHelper.textContent = HELPERS[selectedIcon];
            }
        }

        nameInput.addEventListener('input', updateLivePreview);
        iconSelect.addEventListener('change', updateLivePreview);

        bgColorInput.addEventListener('input', (e) => {
            let val = e.target.value;
            if (val.startsWith('#') && (val.length === 4 || val.length === 7)) {
                bgPicker.value = val;
            }
            updateLivePreview();
        });

        bgPicker.addEventListener('input', (e) => {
            bgColorInput.value = e.target.value.toUpperCase();
            updateLivePreview();
        });

        updateLivePreview();

        window.selectColorPreset = function(type, hex) {
            if (type === 'bg') {
                bgColorInput.value = hex.toUpperCase();
                bgPicker.value = hex;
            }
            updateLivePreview();
        };
    });

    function enableEditMode(id, name, link, icon, bgColor, textColor) {
        const formContainer = document.getElementById('form-container');
        const formTitle = document.getElementById('form-title');
        const formSubtitle = document.getElementById('form-subtitle');
        const form = document.getElementById('social-crud-form');
        const nameInput = document.getElementById('name');
        const linkInput = document.getElementById('link');
        const iconSelect = document.getElementById('icon');
        const bgColorInput = document.getElementById('bg_color');
        const bgPicker = document.getElementById('bg_color_picker');
        const textColorInput = document.getElementById('text_color');
        const methodContainer = document.getElementById('method-spoofing-container');
        const submitBtn = document.getElementById('submit-form-btn');
        const actionsDiv = document.getElementById('form-actions');

        formTitle.textContent = 'Edit Media Sosial';
        formSubtitle.textContent = `Sedang mengubah media sosial: "${name}".`;
        formContainer.classList.add('ring-2', 'ring-[#FF4D2D]/30');

        nameInput.value = name;
        linkInput.value = link;
        iconSelect.value = icon;
        bgColorInput.value = bgColor.toUpperCase();
        bgPicker.value = bgColor;
        if (textColorInput) {
            textColorInput.value = textColor.toUpperCase();
        }

        form.action = `/cms/socials/${id}`;
        methodContainer.innerHTML = '@method("PUT")';
        submitBtn.textContent = 'Perbarui Media Sosial';

        let cancelBtn = document.getElementById('cancel-edit-btn');
        if (!cancelBtn) {
            cancelBtn = document.createElement('button');
            cancelBtn.type = 'button';
            cancelBtn.id = 'cancel-edit-btn';
            cancelBtn.className = 'brutal-btn-secondary w-full text-xs font-semibold';
            cancelBtn.textContent = 'Batal Edit (Kembali ke Tambah)';
            cancelBtn.onclick = disableEditMode;
            actionsDiv.appendChild(cancelBtn);
        }

        nameInput.dispatchEvent(new Event('input'));
        iconSelect.dispatchEvent(new Event('change'));
        formContainer.scrollIntoView({ behavior: 'smooth' });
    }

    function disableEditMode() {
        const formContainer = document.getElementById('form-container');
        const formTitle = document.getElementById('form-title');
        const formSubtitle = document.getElementById('form-subtitle');
        const form = document.getElementById('social-crud-form');
        const nameInput = document.getElementById('name');
        const linkInput = document.getElementById('link');
        const iconSelect = document.getElementById('icon');
        const bgColorInput = document.getElementById('bg_color');
        const bgPicker = document.getElementById('bg_color_picker');
        const textColorInput = document.getElementById('text_color');
        const methodContainer = document.getElementById('method-spoofing-container');
        const submitBtn = document.getElementById('submit-form-btn');
        const cancelBtn = document.getElementById('cancel-edit-btn');

        formTitle.textContent = 'Tambah Media Sosial';
        formSubtitle.textContent = 'Tambahkan link sosial media dengan warna dan ikon pilihan.';
        formContainer.classList.remove('ring-2', 'ring-[#FF4D2D]/30');

        nameInput.value = '';
        linkInput.value = '';
        iconSelect.value = 'github';
        bgColorInput.value = '#0B0F17';
        bgPicker.value = '#0B0F17';
        if (textColorInput) {
            textColorInput.value = '#FFFFFF';
        }

        form.action = "{{ route('admin.socials.store') }}";
        methodContainer.innerHTML = '';
        submitBtn.textContent = 'Simpan Media Sosial';

        if (cancelBtn) cancelBtn.remove();
        nameInput.dispatchEvent(new Event('input'));
        iconSelect.dispatchEvent(new Event('change'));
    }
</script>
@endsection