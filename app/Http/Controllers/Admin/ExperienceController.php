<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Http\Requests\ExperienceRequest;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the experiences.
     */
    public function index()
    {
        $experiences = Experience::orderBy('start_date', 'desc')->get();
        return view('cms.experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new experience entry.
     */
    public function create()
    {
        return view('cms.experiences.create');
    }

    /**
     * Store a newly created experience entry in storage.
     */
    public function store(ExperienceRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Riwayat pengalaman kerja berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified experience entry.
     */
    public function edit(Experience $experience)
    {
        return view('cms.experiences.edit', compact('experience'));
    }

    /**
     * Update the specified experience entry in storage.
     */
    public function update(ExperienceRequest $request, Experience $experience)
    {
        $validated = $request->validated();

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Riwayat pengalaman kerja berhasil diperbarui!');
    }

    /**
     * Remove the specified experience entry from storage.
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Riwayat pengalaman kerja berhasil dihapus!');
    }
}
