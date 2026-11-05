<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PublicController extends Controller
{
    /**
     * Display the public portfolio homepage.
     */
    public function index()
    {
        // Fetch the first user (the administrator) along with sorted relationships
        $user = User::with([
            'projects.images', // Eager load project mockups to avoid N+1 queries
            'projects.badges', // Eager load project badges
            'badges',
            'socialLinks',
            'educations' => function ($query) {
                $query->orderBy('start_year', 'desc');
            },
            'experiences' => function ($query) {
                $query->orderBy('start_date', 'desc');
            }
        ])->first();

        // If no user exists, default to empty objects to prevent crashes
        if (!$user) {
            abort(404, 'Portfolio owner not found. Please run the database seeder.');
        }

        // Fetch approved testimonials safely
        $testimonials = collect();
        try {
            if (Schema::hasTable('testimonials')) {
                $testimonials = Testimonial::where('is_approved', true)
                    ->latest()
                    ->get();
            }
        } catch (\Throwable $e) {
            $testimonials = collect();
        }

        return view('public.index', compact('user', 'testimonials'));
    }

    /**
     * Store a testimonial from a public visitor, strictly restricted per device.
     */
    public function storeTestimonial(Request $request)
    {
        // Support both 'content' and 'message' field names from the form
        $content = $request->input('content') ?: $request->input('message');
        $request->merge(['content' => $content]);

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'role' => ['nullable', 'string', 'max:100'],
            'company' => ['nullable', 'string', 'max:100'],
            'content' => ['required', 'string', 'min:5', 'max:1000'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'device_fingerprint' => ['nullable', 'string', 'max:128'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'content.required' => 'Pesan testimoni tidak boleh kosong.',
            'content.min' => 'Pesan testimoni minimal 5 karakter.',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors(),
                ], 422);
            }

            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $deviceFingerprint = $request->input('device_fingerprint');
        $ip = $request->ip();

        if (Schema::hasTable('testimonials')) {
            // Check if device token or IP has already submitted a testimonial
            $existing = Testimonial::where(function ($query) use ($deviceFingerprint, $ip) {
                if (!empty($deviceFingerprint)) {
                    $query->where('device_fingerprint', $deviceFingerprint);
                }
                if (!empty($ip)) {
                    $query->orWhere('ip_address', $ip);
                }
            })->first();

            if ($existing) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Anda sudah pernah mengirimkan testimoni dari perangkat ini. Terima kasih atas apresiasi Anda!',
                        'testimonial' => $existing,
                    ], 429);
                }

                return back()->with('error', 'Anda sudah pernah mengirimkan testimoni dari perangkat ini. Terima kasih!');
            }

            $testimonial = Testimonial::create([
                'name' => $validated['name'],
                'role' => ($validated['role'] ?? null) ?: 'Pengunjung Portofolio',
                'company' => $validated['company'] ?? null,
                'content' => $validated['content'],
                'rating' => $validated['rating'] ?? 5,
                'device_fingerprint' => $deviceFingerprint,
                'ip_address' => $ip,
                'is_approved' => true,
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Terima kasih banyak! Testimoni Anda berhasil dikirimkan.',
                    'testimonial' => $testimonial,
                ]);
            }
        }

        return back()->with('success', 'Terima kasih banyak! Testimoni Anda berhasil dikirimkan.');
    }

    /**
     * Display a specific project's public detail page with interactive carousel.
     */
    public function showProject(Project $project)
    {
        // Eager load relationships
        $project->load(['images' => function ($query) {
            $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
        }, 'badges', 'user']);
        
        $user = $project->user;
        $slides = $project->carousel_slides;
        
        return view('public.projects.show', compact('project', 'user', 'slides'));
    }
}
