<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Traits\HandlesImageCompression;

class ProfileController extends Controller
{
    use HandlesImageCompression;

    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('cms.profile.edit', compact('user'));
    }

    /**
     * Update the administrator's profile.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Strict Validation (increased image limit to 10MB to support large photo compression)
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'title' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:10240'],
            'password' => ['nullable', 'string', 'min:6'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username tersebut sudah digunakan oleh akun lain.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, jpg, atau png.',
            'image.max' => 'Ukuran gambar maksimal adalah 10MB.',
            'password.min' => 'Password minimal harus 6 karakter.',
        ]);

        // Keep all fields except password
        $dataToUpdate = [
            'name' => $validated['name'],
            'username' => $validated['username'],
            'title' => $validated['title'],
            'bio' => $validated['bio'],
        ];

        // Handle image upload with auto-compression
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($user->avatar_path && Storage::disk('public')->exists($user->avatar_path)) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            // Store new compressed image
            $path = $this->compressAndStoreImage($request->file('image'), 'avatars');
            $dataToUpdate['avatar_path'] = $path;
        }

        // Hash and update password if filled
        if (!empty($validated['password'])) {
            $dataToUpdate['password'] = Hash::make($validated['password']);
        }

        $user->update($dataToUpdate);

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profil Anda berhasil diperbarui secara dinamis!');
    }
}
