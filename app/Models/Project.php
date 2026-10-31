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

    /**
     * Get all consolidated carousel photos (primary thumbnail + all gallery mockups).
     *
     * @return \Illuminate\Support\Collection<int, array{id: int|null, path: string, url: string, is_cover: bool}>
     */
    public function getCarouselSlidesAttribute(): \Illuminate\Support\Collection
    {
        $slides = collect();

        // 1. If images relation has records, collect them
        $galleryImages = $this->relationLoaded('images') ? $this->images : $this->images()->get();
        $seenPaths = [];

        foreach ($galleryImages as $img) {
            if (!empty($img->image_path)) {
                $seenPaths[] = $img->image_path;
                $url = \Illuminate\Support\Facades\Storage::disk('public')->exists($img->image_path)
                    ? asset('storage/' . $img->image_path)
                    : (file_exists(public_path($img->image_path)) ? asset($img->image_path) : asset('storage/' . $img->image_path));

                $slides->push([
                    'id' => $img->id,
                    'path' => $img->image_path,
                    'url' => $url,
                    'is_cover' => (bool)$img->is_thumbnail,
                ]);
            }
        }

        // 2. If primary image_path is set and not already in gallery images, prepend it as cover
        if (!empty($this->image_path) && !in_array($this->image_path, $seenPaths)) {
            $url = \Illuminate\Support\Facades\Storage::disk('public')->exists($this->image_path)
                ? asset('storage/' . $this->image_path)
                : (file_exists(public_path($this->image_path)) ? asset($this->image_path) : asset('storage/' . $this->image_path));

            $slides->prepend([
                'id' => null,
                'path' => $this->image_path,
                'url' => $url,
                'is_cover' => true,
            ]);
        }

        return $slides;
    }
}
