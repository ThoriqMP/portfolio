<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Badge;
use App\Http\Requests\ProjectRequest;
use App\Traits\HandlesImageCompression;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    use HandlesImageCompression;

    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        return view('cms.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        $badges = Auth::user()->badges()->get();
        return view('cms.projects.create', compact('badges'));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();

        // Handle primary image upload with auto-compression
        if ($request->hasFile('image')) {
            $path = $this->compressAndStoreImage($request->file('image'), 'projects');
            $validated['image_path'] = $path;
        }

        // Assign user_id automatically
        $validated['user_id'] = Auth::id();

        // Create project
        $project = Project::create($validated);

        // Sync badges
        $badgeIds = $request->input('badges', []);
        
        // Handle new badges inputted instantly
        $newBadgesInput = $request->input('new_badges');
        if (!empty($newBadgesInput)) {
            $newBadgeNames = explode(',', $newBadgesInput);
            foreach ($newBadgeNames as $name) {
                $name = trim($name);
                if ($name !== '') {
                    // Check if badge with the same name already exists for this user
                    $existingBadge = Auth::user()->badges()->where('name', $name)->first();
                    if ($existingBadge) {
                        $badgeIds[] = $existingBadge->id;
                    } else {
                        $newBadge = Auth::user()->badges()->create([
                            'name' => $name,
                            'bg_color' => '#ff5722',
                            'text_color' => '#000000',
                        ]);
                        $badgeIds[] = $newBadge->id;
                    }
                }
            }
        }
        $project->badges()->sync($badgeIds);

        // Handle multiple additional mockup images with auto-compression
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $index => $file) {
                $path = $this->compressAndStoreImage($file, 'projects');
                $project->images()->create([
                    'image_path' => $path,
                    'is_thumbnail' => false,
                    'col_span' => 1,
                    'row_position' => 1,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek baru berhasil ditambahkan dengan galeri foto!');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        $project->load(['images', 'badges']);
        $badges = Auth::user()->badges()->get();

        // Check if there is a cached text draft in the session
        $draftKey = 'project_draft_' . $project->id;
        if (session()->has($draftKey)) {
            $draft = session()->get($draftKey);
            $project->fill($draft);
            session()->flash('draft_restored', 'Data draf Anda dari sesi sebelumnya telah dipulihkan secara otomatis.');
        }

        return view('cms.projects.edit', compact('project', 'badges'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        // Handle updated primary image upload with auto-compression
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
                Storage::disk('public')->delete($project->image_path);
            }

            // Store new compressed image
            $path = $this->compressAndStoreImage($request->file('image'), 'projects');
            $validated['image_path'] = $path;
        }

        // Set default thumbnail composition if not provided
        $validated['thumbnail_composition'] = $request->input('thumbnail_composition', $project->thumbnail_composition ?? 'single');

        $project->update($validated);

        // Sync badges
        $badgeIds = $request->input('badges', []);
        
        // Handle new badges inputted instantly
        $newBadgesInput = $request->input('new_badges');
        if (!empty($newBadgesInput)) {
            $newBadgeNames = explode(',', $newBadgesInput);
            foreach ($newBadgeNames as $name) {
                $name = trim($name);
                if ($name !== '') {
                    // Check if badge with the same name already exists for this user
                    $existingBadge = Auth::user()->badges()->where('name', $name)->first();
                    if ($existingBadge) {
                        $badgeIds[] = $existingBadge->id;
                    } else {
                        $newBadge = Auth::user()->badges()->create([
                            'name' => $name,
                            'bg_color' => '#ff5722',
                            'text_color' => '#000000',
                        ]);
                        $badgeIds[] = $newBadge->id;
                    }
                }
            }
        }
        $project->badges()->sync($badgeIds);

        // Handle newly uploaded additional mockup images for the carousel
        if ($request->hasFile('additional_images')) {
            $currentMaxOrder = $project->images()->max('sort_order') ?? 0;
            foreach ($request->file('additional_images') as $index => $file) {
                $path = $this->compressAndStoreImage($file, 'projects');
                $project->images()->create([
                    'image_path' => $path,
                    'is_thumbnail' => false,
                    'col_span' => 1,
                    'row_position' => 1,
                    'sort_order' => $currentMaxOrder + $index + 1,
                ]);
            }
        }

        // Clean up the session draft as it is now finalized and saved in database
        session()->forget('project_draft_' . $project->id);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil diperbarui!');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project)
    {
        // Delete primary image file from disk
        if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
            Storage::disk('public')->delete($project->image_path);
        }

        // Delete all associated gallery images from disk
        foreach ($project->images as $img) {
            if (Storage::disk('public')->exists($img->image_path)) {
                Storage::disk('public')->delete($img->image_path);
            }
        }

        // Delete project entry (relationships are handled by DB cascade delete)
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil dihapus secara permanen!');
    }

    /**
     * Save current form text inputs into the Session Cache before redirecting to uploader.
     */
    public function saveDraftAndRedirect(\Illuminate\Http\Request $request, Project $project)
    {
        $draft = $request->only(['title', 'description', 'grid_span', 'thumbnail_composition', 'project_link']);
        session()->put('project_draft_' . $project->id, $draft);

        return redirect()->route('admin.projects.mediaUploader', $project->id);
    }

    /**
     * Create a new project draft from text fields and immediately redirect to its uploader.
     */
    public function storeDraftNew(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'project_link' => ['nullable', 'url'],
            'grid_span' => ['required', 'integer', 'between:1,3'],
            'thumbnail_composition' => ['required', 'string', 'in:single,split,mosaic,carousel'],
        ], [
            'title.required' => 'Judul proyek wajib diisi untuk menyimpan draf.',
            'description.required' => 'Deskripsi proyek wajib diisi untuk menyimpan draf.',
        ]);

        $project = new Project();
        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->project_link = $request->input('project_link');
        $project->grid_span = $request->input('grid_span');
        $project->thumbnail_composition = $request->input('thumbnail_composition');
        $project->user_id = Auth::id();
        $project->image_path = ''; // temporary placeholder
        $project->save();

        return redirect()->route('admin.projects.mediaUploader', $project->id)
            ->with('success', 'Draf proyek baru berhasil disimpan! Anda dapat mengunggah gambar portofolio sekarang.');
    }

    /**
     * Render the dedicated media uploader interface.
     */
    public function mediaUploader(Project $project)
    {
        $project->load('images');
        return view('cms.projects.media-uploader', compact('project'));
    }

    /**
     * Handle drag-drop files bulk upload, strictly compressing images under 1MB.
     */
    public function uploadMedia(\Illuminate\Http\Request $request, Project $project)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,webp|max:15360', // Max 15MB upload, compressed below 1MB
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Compress with iterative downscaling and quality adjustment to get under 1MB
            $path = $this->compressAndStoreUnderOneMegabyte($file, 'projects');

            // Find current mockup count
            $currentCount = $project->images()->count();

            // Store carousel image record
            $image = $project->images()->create([
                'image_path' => $path,
                'is_thumbnail' => false,
                'col_span' => 1,
                'row_position' => 1,
                'sort_order' => $currentCount + 1,
            ]);

            // If project has no thumbnail yet, initialize it
            if (empty($project->image_path)) {
                $project->update(['image_path' => $path]);
            }

            return response()->json([
                'success' => true,
                'image' => [
                    'id' => $image->id,
                    'image_path' => $image->image_path,
                    'url' => asset('storage/' . $image->image_path),
                    'is_thumbnail' => (bool)$image->is_thumbnail,
                    'sort_order' => $image->sort_order,
                    'delete_url' => route('admin.projects.deleteMedia', [$project->id, $image->id]),
                    'set_thumbnail_url' => route('admin.projects.setThumbnail', [$project->id, $image->id]),
                ],
                'message' => 'Foto berhasil ditambahkan ke carousel!',
            ]);
        }

        return response()->json(['error' => 'Gagal mengunggah gambar.'], 400);
    }

    /**
     * Set a carousel photo as the primary project thumbnail.
     */
    public function setThumbnail(Project $project, ProjectImage $image)
    {
        $project->update(['image_path' => $image->image_path]);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Foto thumbnail utama berhasil diperbarui!',
                'thumbnail_url' => asset('storage/' . $project->image_path),
            ]);
        }

        return redirect()->back()->with('success', 'Foto thumbnail utama berhasil diperbarui!');
    }

    /**
     * Consolidate layout grid properties and update cover thumbnail path.
     */
    public function saveLayout(\Illuminate\Http\Request $request, Project $project)
    {
        $request->validate([
            'thumbnail_id' => 'required|integer',
            'col_span' => 'nullable|array',
            'col_span.*' => 'required|integer|between:1,3',
            'row_position' => 'nullable|array',
            'row_position.*' => 'required|integer|min:1',
            'sort_order' => 'nullable|array',
            'sort_order.*' => 'required|integer',
        ]);

        $thumbnailId = $request->input('thumbnail_id');
        $colSpans = $request->input('col_span', []);
        $rowPositions = $request->input('row_position', []);
        $sortOrders = $request->input('sort_order', []);

        // Forget the session cache draft now as layout is completely finalized
        session()->forget('project_draft_' . $project->id);

        $thumbnailPath = null;

        // Force reload images list
        $project->load('images');

        foreach ($project->images as $img) {
            $isThumbnail = ($img->id == $thumbnailId);
            
            $img->update([
                'is_thumbnail' => $isThumbnail,
                'col_span' => $colSpans[$img->id] ?? 1,
                'row_position' => $rowPositions[$img->id] ?? 1,
                'sort_order' => $sortOrders[$img->id] ?? 0,
            ]);

            if ($isThumbnail) {
                $thumbnailPath = $img->image_path;
            }
        }

        // Sync parent projects.image_path with selected cover thumbnail
        if ($thumbnailPath) {
            $project->update(['image_path' => $thumbnailPath]);
        }

        return redirect()->route('admin.projects.edit', $project->id)
            ->with('success', 'Konfigurasi tata letak media berhasil disimpan secara permanen!');
    }

    /**
     * Delete mockup from storage disk and database.
     */
    public function deleteMedia(Project $project, ProjectImage $image)
    {
        // Delete file from public disk
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Foto carousel berhasil dihapus.',
                'remaining_count' => $project->images()->count(),
            ]);
        }

        return redirect()->back()->with('success', 'Gambar berhasil dihapus dari galeri.');
    }

    /**
     * Upload an inline article photo for project description.
     */
    public function uploadContentImage(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:12288'],
        ]);

        $file = $request->file('image');
        $storedPath = $this->compressAndStoreImage($file, 'projects/content', 1600, 82);

        return response()->json([
            'success' => true,
            'url' => asset('storage/' . $storedPath),
            'path' => $storedPath,
        ]);
    }
}
