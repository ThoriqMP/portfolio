<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\BadgeController;
use App\Http\Controllers\Admin\SocialLinkController;

// Public Home
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/projects/{project}', [PublicController::class, 'showProject'])->name('projects.show');

// CMS Authentication
Route::get('/cms', [AuthController::class, 'showLogin'])->name('login');
Route::post('/cms/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/cms/logout', [AuthController::class, 'logout'])->name('logout');

// CMS Protected Admin Panel
Route::middleware('auth')->prefix('cms')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('projects', ProjectController::class);
    
    // Dedicated Media Uploader & Draft Caching Routes
    Route::match(['post', 'put'], 'projects/{project}/save-draft', [ProjectController::class, 'saveDraftAndRedirect'])->name('projects.saveDraft');
    Route::post('projects/store-draft-new', [ProjectController::class, 'storeDraftNew'])->name('projects.storeDraftNew');
    Route::get('projects/{project}/media-uploader', [ProjectController::class, 'mediaUploader'])->name('projects.mediaUploader');
    Route::post('projects/{project}/media-uploader/upload', [ProjectController::class, 'uploadMedia'])->name('projects.uploadMedia');
    Route::post('projects/{project}/media-uploader/save-layout', [ProjectController::class, 'saveLayout'])->name('projects.saveLayout');
    Route::delete('projects/{project}/media-uploader/{image}', [ProjectController::class, 'deleteMedia'])->name('projects.deleteMedia');
    Route::resource('educations', EducationController::class);
    Route::resource('experiences', ExperienceController::class);
    Route::resource('badges', BadgeController::class)->except(['create', 'show', 'edit']);
    Route::resource('socials', SocialLinkController::class)->except(['create', 'show', 'edit']);
    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
