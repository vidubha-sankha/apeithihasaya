<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kingdom extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function kings(): HasMany
    {
        return $this->hasMany(King::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
