<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'user_id',
        'institution_name',
        'degree',
        'start_year',
        'end_year',
        'description',
    ];

    /**
     * Get the user that owns the education.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
