<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryImage extends Model
{
    protected $fillable = [
        'title',
        'image_path',
        'description',
        'kingdom_id',
        'dynasty_id',
        'king_id',
    ];

    /**
     * Get the kingdom associated with this image.
     */
    public function kingdom(): BelongsTo
    {
        return $this->belongsTo(Kingdom::class);
    }

    /**
     * Get the dynasty associated with this image.
     */
    public function dynasty(): BelongsTo
    {
        return $this->belongsTo(Dynasty::class);
    }

    /**
     * Get the king associated with this image.
     */
    public function king(): BelongsTo
    {
        return $this->belongsTo(King::class);
    }
}
