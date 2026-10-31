<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'title',
        'bio',
        'avatar_path',
        'about_image_path',
        'bento_image_1',
        'bento_image_2',
        'cta_image_path',
        'about_title',
        'about_description',
        'years_experience',
        'projects_completed',
        'support_available',
        'client_satisfaction',
        'email_contact',
        'phone',
        'github_link',
        'linkedin_link',
        'instagram_link',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Get the projects for the user.
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get the educations for the user.
     */
    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    /**
     * Get the experiences for the user.
     */
    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Get the badges for the user.
     */
    public function badges(): HasMany
    {
        return $this->hasMany(Badge::class);
    }

    /**
     * Get the social links for the user.
     */
    public function socialLinks(): HasMany
    {
        return $this->hasMany(SocialLink::class);
    }

    /**
     * Get the clean GitHub username from profile or fallback to ThoriqMP.
     */
    public function getGithubUsernameAttribute(): string
    {
        if (!empty($this->github_link)) {
            $parsed = parse_url($this->github_link, PHP_URL_PATH);
            $clean = trim($parsed ?? '', '/');
            if (!empty($clean) && !str_contains($clean, 'admin')) {
                return $clean;
            }
        }

        // Check if there's a socialLink for GitHub
        $githubSocial = $this->relationLoaded('socialLinks') 
            ? $this->socialLinks->firstWhere('icon', 'github') 
            : $this->socialLinks()->where('icon', 'github')->first();

        if ($githubSocial && !empty($githubSocial->link)) {
            $parsed = parse_url($githubSocial->link, PHP_URL_PATH);
            $clean = trim($parsed ?? '', '/');
            if (!empty($clean) && !str_contains($clean, 'admin')) {
                return $clean;
            }
        }

        return 'ThoriqMP';
    }
}
