<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Http\Requests\EducationRequest;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    /**
     * Display a listing of the educations.
     */
    public function index()
    {
        $educations = Education::orderBy('start_year', 'desc')->get();
        return view('cms.educations.index', compact('educations'));
    }

    /**
     * Show the form for creating a new education entry.
     */
    public function create()
    {
        return view('cms.educations.create');
    }

    /**
     * Store a newly created education entry in storage.
     */
    public function store(EducationRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        Education::create($validated);

        return redirect()->route('admin.educations.index')
            ->with('success', 'Riwayat pendidikan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified education entry.
     */
    public function edit(Education $education)
    {
        return view('cms.educations.edit', compact('education'));
    }

    /**
     * Update the specified education entry in storage.
     */
    public function update(EducationRequest $request, Education $education)
    {
        $validated = $request->validated();
        
        $education->update($validated);

        return redirect()->route('admin.educations.index')
            ->with('success', 'Riwayat pendidikan berhasil diperbarui!');
    }

    /**
     * Remove the specified education entry from storage.
     */
    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()->route('admin.educations.index')
            ->with('success', 'Riwayat pendidikan berhasil dihapus!');
    }
}
