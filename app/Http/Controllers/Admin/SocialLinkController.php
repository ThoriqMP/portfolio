<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the social links.
     */
    public function index()
    {
        $socialLinks = Auth::user()->socialLinks()->get();
        return view('cms.socials.index', compact('socialLinks'));
    }

    /**
     * Store a newly created social link in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'link' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string', 'in:github,linkedin,instagram,whatsapp,email,link,facebook,youtube,twitter'],
            'bg_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'text_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        ], [
            'name.required' => 'Nama sosial media wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 50 karakter.',
            'link.required' => 'Link / url kontak wajib diisi.',
            'link.max' => 'Link tidak boleh lebih dari 255 karakter.',
            'icon.required' => 'Ikon sosial media wajib dipilih.',
            'icon.in' => 'Pilihan ikon sosial media tidak valid.',
            'bg_color.required' => 'Warna latar wajib ditentukan.',
            'bg_color.regex' => 'Warna latar harus berupa format HEX yang valid (contoh: #ff5722).',
            'text_color.required' => 'Warna teks wajib ditentukan.',
            'text_color.regex' => 'Warna teks harus berupa format HEX yang valid (contoh: #000000).',
        ]);

        Auth::user()->socialLinks()->create($validated);

        return redirect()->route('admin.socials.index')
            ->with('success', 'Media sosial baru berhasil ditambahkan!');
    }

    /**
     * Update the specified social link in storage.
     */
    public function update(Request $request, SocialLink $social)
    {
        // Security check
        if ($social->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan mengubah media sosial ini.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'link' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string', 'in:github,linkedin,instagram,whatsapp,email,link,facebook,youtube,twitter'],
            'bg_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'text_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        ], [
            'name.required' => 'Nama sosial media wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 50 karakter.',
            'link.required' => 'Link / url kontak wajib diisi.',
            'link.max' => 'Link tidak boleh lebih dari 255 karakter.',
            'icon.required' => 'Ikon sosial media wajib dipilih.',
            'icon.in' => 'Pilihan ikon sosial media tidak valid.',
            'bg_color.required' => 'Warna latar wajib ditentukan.',
            'bg_color.regex' => 'Warna latar harus berupa format HEX yang valid (contoh: #ff5722).',
            'text_color.required' => 'Warna teks wajib ditentukan.',
            'text_color.regex' => 'Warna teks harus berupa format HEX yang valid (contoh: #000000).',
        ]);

        $social->update($validated);

        return redirect()->route('admin.socials.index')
            ->with('success', 'Media sosial berhasil diperbarui!');
    }

    /**
     * Remove the specified social link from storage.
     */
    public function destroy(SocialLink $social)
    {
        // Security check
        if ($social->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan menghapus media sosial ini.');
        }

        $social->delete();

        return redirect()->route('admin.socials.index')
            ->with('success', 'Media sosial berhasil dihapus!');
    }
}
