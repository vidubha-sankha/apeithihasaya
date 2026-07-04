<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class King extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'kingdom_id',
        'biography',
    ];

    public function kingdom(): BelongsTo
    {
        return $this->belongsTo(Kingdom::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
