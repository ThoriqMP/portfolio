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
     * Get the resolved URL for the primary project thumbnail.
     */
    public function getThumbnailUrlAttribute(): string
    {
        if (!empty($this->image_path)) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($this->image_path)) {
                return asset('storage/' . $this->image_path);
            }
            if (file_exists(public_path($this->image_path))) {
                return asset($this->image_path);
            }
            return asset('storage/' . $this->image_path);
        }

        return 'https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?auto=format&fit=crop&w=1200&q=80';
    }

    /**
     * Get all dedicated carousel photos for the project.
     *
     * @return \Illuminate\Support\Collection<int, array{id: int, path: string, url: string, is_cover: bool}>
     */
    public function getCarouselSlidesAttribute(): \Illuminate\Support\Collection
    {
        $slides = collect();
        $galleryImages = $this->relationLoaded('images') ? $this->images : $this->images()->get();

        foreach ($galleryImages as $img) {
            if (!empty($img->image_path)) {
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

        return $slides;
    }
}
