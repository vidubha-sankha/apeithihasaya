<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timeline extends Model
{
    protected $table = 'timelines';

    protected $fillable = [
        'event_title',
        'description',
        'event_year',
        'kingdom_id',
        'dynasty_id',
        'king_id',
    ];

    /**
     * Get the kingdom associated with this timeline event.
     */
    public function kingdom(): BelongsTo
    {
        return $this->belongsTo(Kingdom::class);
    }

    /**
     * Get the dynasty associated with this timeline event.
     */
    public function dynasty(): BelongsTo
    {
        return $this->belongsTo(Dynasty::class);
    }

    /**
     * Get the king associated with this timeline event.
     */
    public function king(): BelongsTo
    {
        return $this->belongsTo(King::class);
    }
}
