<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BadgeController extends Controller
{
    /**
     * Display a listing of the badges.
     */
    public function index()
    {
        $badges = Auth::user()->badges()->get();
        return view('cms.badges.index', compact('badges'));
    }

    /**
     * Store a newly created badge in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'bg_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'text_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        ], [
            'name.required' => 'Nama lencana wajib diisi.',
            'name.max' => 'Nama lencana tidak boleh lebih dari 50 karakter.',
            'bg_color.required' => 'Warna latar wajib ditentukan.',
            'bg_color.regex' => 'Warna latar harus berupa format HEX yang valid (contoh: #ff5722).',
            'text_color.required' => 'Warna teks wajib ditentukan.',
            'text_color.regex' => 'Warna teks harus berupa format HEX yang valid (contoh: #000000).',
        ]);

        Auth::user()->badges()->create($validated);

        return redirect()->route('admin.badges.index')
            ->with('success', 'Lencana teknologi baru berhasil ditambahkan!');
    }

    /**
     * Update the specified badge in storage.
     */
    public function update(Request $request, Badge $badge)
    {
        // Security check
        if ($badge->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan mengubah data lencana ini.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'bg_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'text_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        ], [
            'name.required' => 'Nama lencana wajib diisi.',
            'name.max' => 'Nama lencana tidak boleh lebih dari 50 karakter.',
            'bg_color.required' => 'Warna latar wajib ditentukan.',
            'bg_color.regex' => 'Warna latar harus berupa format HEX yang valid (contoh: #ff5722).',
            'text_color.required' => 'Warna teks wajib ditentukan.',
            'text_color.regex' => 'Warna teks harus berupa format HEX yang valid (contoh: #000000).',
        ]);

        $badge->update($validated);

        return redirect()->route('admin.badges.index')
            ->with('success', 'Lencana teknologi berhasil diperbarui!');
    }

    /**
     * Remove the specified badge from storage.
     */
    public function destroy(Badge $badge)
    {
        // Security check
        if ($badge->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan menghapus data lencana ini.');
        }

        $badge->delete();

        return redirect()->route('admin.badges.index')
            ->with('success', 'Lencana teknologi berhasil dihapus!');
    }
}
