<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the CMS Admin Dashboard index.
     */
    public function index()
    {
        $stats = [
            'projects_count' => Project::count(),
            'educations_count' => Education::count(),
            'experiences_count' => Experience::count(),
        ];

        return view('cms.dashboard', compact('stats'));
    }
}
