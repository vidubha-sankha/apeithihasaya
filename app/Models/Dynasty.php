<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dynasty extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'kingdom_id',
        'description',
        'origin',
        'founded_year',
        'ended_year',
        'status',
    ];

    /**
     * Get the kingdom associated with this dynasty.
     */
    public function kingdom(): BelongsTo
    {
        return $this->belongsTo(Kingdom::class);
    }

    /**
     * Get the kings belonging to this dynasty.
     */
    public function kings(): HasMany
    {
        return $this->hasMany(King::class);
    }

    /**
     * Get all articles related to this dynasty.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
