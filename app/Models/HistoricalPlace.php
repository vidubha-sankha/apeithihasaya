<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class HistoricalPlace extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'latitude',
        'longitude',
        'status',
    ];

    /**
     * Get the polymorphic SEO meta for this historical place.
     */
    public function seoMeta(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seo_metaable');
    }
}
