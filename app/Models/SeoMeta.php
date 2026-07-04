<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SeoMeta extends Model
{
    protected $table = 'seo_metas';

    protected $fillable = [
        'seo_metaable_type',
        'seo_metaable_id',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'og_image',
    ];

    /**
     * Get the parent model that owns this SEO metadata.
     */
    public function seo_metaable(): MorphTo
    {
        return $this->morphTo();
    }
}
