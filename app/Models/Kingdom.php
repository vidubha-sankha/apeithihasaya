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
        'region',
        'capital',
        'period',
        'map',
        'image',
        'status',
    ];

    /**
     * Get the kings associated with this kingdom.
     */
    public function kings(): HasMany
    {
        return $this->hasMany(King::class);
    }

    /**
     * Get the dynasties associated with this kingdom.
     */
    public function dynasties(): HasMany
    {
        return $this->hasMany(Dynasty::class);
    }

    /**
     * Get the articles associated with this kingdom.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Get all gallery images associated with this kingdom.
     */
    public function galleryImages(): HasMany
    {
        return $this->hasMany(GalleryImage::class);
    }

    /**
     * Get all videos associated with this kingdom.
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    /**
     * Get all timeline events associated with this kingdom.
     */
    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class);
    }

    /**
     * Get the comments on this kingdom.
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get the bookmarks for this kingdom.
     */
    public function bookmarks(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    /**
     * Get the polymorphic SEO meta for this kingdom.
     */
    public function seoMeta(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seo_metaable');
    }
}
