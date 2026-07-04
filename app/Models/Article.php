<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $table = 'historical_articles';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'kingdom_id',
        'dynasty_id',
        'king_id',
        'user_id',
        'excerpt',
        'featured_image',
        'published_at',
        'status',
        'seo_title',
        'seo_description',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    /**
     * Get the author (user) of the article.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the category of this article.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the kingdom associated with this article.
     */
    public function kingdom(): BelongsTo
    {
        return $this->belongsTo(Kingdom::class);
    }

    /**
     * Get the dynasty associated with this article.
     */
    public function dynasty(): BelongsTo
    {
        return $this->belongsTo(Dynasty::class);
    }

    /**
     * Get the king associated with this article.
     */
    public function king(): BelongsTo
    {
        return $this->belongsTo(King::class);
    }

    /**
     * Get the tags associated with this article.
     */
    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    /**
     * Get the comments for this article.
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get the bookmarks for this article.
     */
    public function bookmarks(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    /**
     * Get the polymorphic SEO meta for this article.
     */
    public function seoMeta(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seo_metaable');
    }
}
