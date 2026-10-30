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
     * Update the administrator's profile and section customizations.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validation
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
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:10240'],
            'avatar_transparent' => ['nullable', 'string'], // base64 transparent PNG
            'about_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:10240'],
            'bento_image_1' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:10240'],
            'bento_image_2' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:10240'],
            'cta_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:10240'],
            'about_title' => ['nullable', 'string', 'max:255'],
            'about_description' => ['nullable', 'string'],
            'years_experience' => ['nullable', 'string', 'max:50'],
            'projects_completed' => ['nullable', 'string', 'max:50'],
            'support_available' => ['nullable', 'string', 'max:50'],
            'client_satisfaction' => ['nullable', 'string', 'max:50'],
            'password' => ['nullable', 'string', 'min:6'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username tersebut sudah digunakan oleh akun lain.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, jpg, png, atau webp.',
            'image.max' => 'Ukuran gambar maksimal adalah 10MB.',
            'password.min' => 'Password minimal harus 6 karakter.',
        ]);

        $dataToUpdate = [
            'name' => $validated['name'],
            'username' => $validated['username'],
            'title' => $validated['title'] ?? null,
            'bio' => $validated['bio'] ?? null,
        ];

        // Custom section settings
        if ($request->has('about_title')) $dataToUpdate['about_title'] = $request->input('about_title');
        if ($request->has('about_description')) $dataToUpdate['about_description'] = $request->input('about_description');
        if ($request->has('years_experience')) $dataToUpdate['years_experience'] = $request->input('years_experience');
        if ($request->has('projects_completed')) $dataToUpdate['projects_completed'] = $request->input('projects_completed');
        if ($request->has('support_available')) $dataToUpdate['support_available'] = $request->input('support_available');
        if ($request->has('client_satisfaction')) $dataToUpdate['client_satisfaction'] = $request->input('client_satisfaction');

        // Handle Base64 Transparent Avatar (generated from client background removal)
        if (!empty($validated['avatar_transparent']) && str_starts_with($validated['avatar_transparent'], 'data:image/png;base64,')) {
            $base64Data = substr($validated['avatar_transparent'], strpos($validated['avatar_transparent'], ',') + 1);
            $decodedImage = base64_decode($base64Data);
            if ($decodedImage !== false) {
                if ($user->avatar_path && Storage::disk('public')->exists($user->avatar_path)) {
                    Storage::disk('public')->delete($user->avatar_path);
                }
                $filename = 'avatars/' . uniqid('nobg_') . '.png';
                Storage::disk('public')->put($filename, $decodedImage);
                $dataToUpdate['avatar_path'] = $filename;
            }
        } elseif ($request->hasFile('image')) {
            // Standard avatar file upload
            if ($user->avatar_path && Storage::disk('public')->exists($user->avatar_path)) {
                Storage::disk('public')->delete($user->avatar_path);
            }
            $path = $this->compressAndStoreImage($request->file('image'), 'avatars');
            $dataToUpdate['avatar_path'] = $path;
        }

        // Handle About Image upload
        if ($request->hasFile('about_image')) {
            if ($user->about_image_path && Storage::disk('public')->exists($user->about_image_path)) {
                Storage::disk('public')->delete($user->about_image_path);
            }
            $dataToUpdate['about_image_path'] = $this->compressAndStoreImage($request->file('about_image'), 'sections');
        }

        // Handle Bento Image 1 upload
        if ($request->hasFile('bento_image_1')) {
            if ($user->bento_image_1 && Storage::disk('public')->exists($user->bento_image_1)) {
                Storage::disk('public')->delete($user->bento_image_1);
            }
            $dataToUpdate['bento_image_1'] = $this->compressAndStoreImage($request->file('bento_image_1'), 'sections');
        }

        // Handle Bento Image 2 upload
        if ($request->hasFile('bento_image_2')) {
            if ($user->bento_image_2 && Storage::disk('public')->exists($user->bento_image_2)) {
                Storage::disk('public')->delete($user->bento_image_2);
            }
            $dataToUpdate['bento_image_2'] = $this->compressAndStoreImage($request->file('bento_image_2'), 'sections');
        }

        // Handle CTA Banner Image upload
        if ($request->hasFile('cta_image')) {
            if ($user->cta_image_path && Storage::disk('public')->exists($user->cta_image_path)) {
                Storage::disk('public')->delete($user->cta_image_path);
            }
            $dataToUpdate['cta_image_path'] = $this->compressAndStoreImage($request->file('cta_image'), 'sections');
        }

        // Password update
        if (!empty($validated['password'])) {
            $dataToUpdate['password'] = Hash::make($validated['password']);
        }

        $user->update($dataToUpdate);

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profil dan pengaturan tampilan portofolio berhasil diperbarui!');
    }

    /**
     * Remove background from current avatar or uploaded image via smart chroma key / GD.
     */
    public function removeBackground(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $tempPath = null;
        if ($request->hasFile('image')) {
            $tempPath = $request->file('image')->getRealPath();
        } elseif ($user->avatar_path && Storage::disk('public')->exists($user->avatar_path)) {
            $tempPath = Storage::disk('public')->path($user->avatar_path);
        }

        if (!$tempPath || !file_exists($tempPath)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada gambar yang dapat diproses.',
            ], 400);
        }

        $imgInfo = @getimagesize($tempPath);
        if (!$imgInfo) {
            return response()->json([
                'success' => false,
                'message' => 'Format gambar tidak valid atau tidak didukung.',
            ], 400);
        }

        $width = $imgInfo[0];
        $height = $imgInfo[1];
        $mime = $imgInfo['mime'];

        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg':
                $src = imagecreatefromjpeg($tempPath);
                break;
            case 'image/png':
                $src = imagecreatefrompng($tempPath);
                break;
            case 'image/webp':
                $src = function_exists('imagecreatefromwebp') ? imagecreatefromwebp($tempPath) : false;
                break;
            default:
                $src = false;
        }

        if (!$src) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membaca gambar dengan library GD.',
            ], 500);
        }

        // Create 32-bit RGBA transparent canvas
        $transparentCanvas = imagecreatetruecolor($width, $height);
        imagealphablending($transparentCanvas, false);
        imagesavealpha($transparentCanvas, true);
        $transparentColor = imagecolorallocatealpha($transparentCanvas, 0, 0, 0, 127);
        imagefilledrectangle($transparentCanvas, 0, 0, $width, $height, $transparentColor);

        // Determine target background color to remove
        $targetR = 210; $targetG = 30; $targetB = 30;
        if ($request->filled('target_color')) {
            $hex = ltrim($request->input('target_color'), '#');
            if (strlen($hex) === 6) {
                $targetR = hexdec(substr($hex, 0, 2));
                $targetG = hexdec(substr($hex, 2, 2));
                $targetB = hexdec(substr($hex, 4, 2));
            }
        } else {
            // Auto sample from top-left corner
            $sampleRgb = imagecolorat($src, min(4, $width - 1), min(4, $height - 1));
            $targetR = ($sampleRgb >> 16) & 0xFF;
            $targetG = ($sampleRgb >> 8) & 0xFF;
            $targetB = $sampleRgb & 0xFF;
        }

        $tolerance = (int) ($request->input('tolerance', 55));
        $toleranceSq = $tolerance * $tolerance;

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $rgb = imagecolorat($src, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $a = ($rgb >> 24) & 0x7F;

                $distSq = (($r - $targetR) ** 2) + (($g - $targetG) ** 2) + (($b - $targetB) ** 2);

                if ($distSq <= $toleranceSq) {
                    imagesetpixel($transparentCanvas, $x, $y, $transparentColor);
                } elseif ($distSq < $toleranceSq * 1.35) {
                    $factor = ($distSq - $toleranceSq) / ($toleranceSq * 0.35);
                    $alpha = (int) round(127 - ($factor * (127 - $a)));
                    $feather = imagecolorallocatealpha($transparentCanvas, $r, $g, $b, max(0, min(127, $alpha)));
                    imagesetpixel($transparentCanvas, $x, $y, $feather);
                } else {
                    $pixelColor = imagecolorallocatealpha($transparentCanvas, $r, $g, $b, $a);
                    imagesetpixel($transparentCanvas, $x, $y, $pixelColor);
                }
            }
        }

        $filename = 'avatars/' . uniqid('nobg_') . '.png';
        $destPath = storage_path('app/public/' . $filename);
        if (!file_exists(dirname($destPath))) {
            mkdir(dirname($destPath), 0755, true);
        }
        imagepng($transparentCanvas, $destPath, 6);

        imagedestroy($src);
        imagedestroy($transparentCanvas);

        if ($user->avatar_path && Storage::disk('public')->exists($user->avatar_path)) {
            Storage::disk('public')->delete($user->avatar_path);
        }

        $user->update(['avatar_path' => $filename]);

        return response()->json([
            'success' => true,
            'message' => 'Background berhasil dihapus menjadi transparan!',
            'avatar_url' => asset('storage/' . $filename),
            'avatar_path' => $filename,
        ]);
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

        $html = view('public.cv.ats', compact('user'))->render();

        $options = new \Dompdf\Options();
        $options->set('defaultFont', 'Helvetica');
        $options->set('isRemoteEnabled', true);
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="CV_' . preg_replace('/[^a-zA-Z0-9]+/', '_', $user->name) . '.pdf"');
    }
}
