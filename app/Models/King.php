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
        'dynasty_id',
        'title',
        'father',
        'mother',
        'spouse',
        'birth_year',
        'death_year',
        'reign_start',
        'reign_end',
        'successor',
        'predecessor',
        'summary',
        'biography',
        'image',
        'gallery',
        'status',
        'featured',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'featured' => 'boolean',
        ];
    }

    /**
     * Get the kingdom this king ruled over.
     */
    public function kingdom(): BelongsTo
    {
        return $this->belongsTo(Kingdom::class);
    }

    /**
     * Get the dynasty this king belonged to.
     */
    public function dynasty(): BelongsTo
    {
        return $this->belongsTo(Dynasty::class);
    }

    /**
     * Get all articles written about this king.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Get all timeline events associated with this king.
     */
    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class);
    }

    /**
     * Get the comments on this king.
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get the bookmarks for this king.
     */
    public function bookmarks(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    /**
     * Get the polymorphic SEO meta for this king.
     */
    public function seoMeta(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seo_metaable');
    }
}
