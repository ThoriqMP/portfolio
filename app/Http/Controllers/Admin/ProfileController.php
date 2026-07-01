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

    /**
     * Download the admin's ATS CV as PDF.
     */
    public function downloadCv()
    {
        $user = \App\Models\User::with([
            'projects',
            'badges',
            'socialLinks',
            'educations' => function ($query) {
                $query->orderBy('start_year', 'desc');
            },
            'experiences' => function ($query) {
                $query->orderBy('start_date', 'desc');
            }
        ])->first();

        if (!$user) {
            abort(404, 'Portfolio owner not found.');
        }

        // Generate HTML
        $html = view('public.cv.ats', compact('user'))->render();

        // Initialize DOMPDF
        $options = new \Dompdf\Options();
        $options->set('defaultFont', 'Helvetica');
        $options->set('isRemoteEnabled', true); // allow remote images if any
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="CV_' . preg_replace('/[^a-zA-Z0-9]+/', '_', $user->name) . '.pdf"');
    }
}
