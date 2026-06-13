<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image_path',
        'project_link',
        'grid_span',
        'thumbnail_composition',
    ];

    /**
     * Get the user that owns the project.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the additional mockups/images for this project.
     */
    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Get the technology badges for the project.
     */
    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'project_badge');
    }
}
