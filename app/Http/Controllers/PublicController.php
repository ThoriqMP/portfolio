<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

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

        return view('public.index', compact('user'));
    }

    /**
     * Display a specific project's public detail page.
     */
    public function showProject(Project $project)
    {
        // Eager load relationships
        $project->load(['images', 'user']);
        
        $user = $project->user;
        
        return view('public.projects.show', compact('project', 'user'));
    }
}
