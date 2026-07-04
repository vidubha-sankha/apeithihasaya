<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricalMap extends Model
{
    protected $fillable = [
        'title',
        'description',
        'map_url',
        'image_path',
        'period',
        'status',
    ];
}
