<?php

use Illuminate\Support\Facades\Schema;

test('creates the historical content tables', function () {
    $tables = [
        'roles',
        'kingdoms',
        'dynasties',
        'kings',
        'historical_articles',
        'categories',
        'gallery_images',
        'videos',
        'timelines',
        'comments',
    ];

    foreach ($tables as $table) {
        expect(Schema::hasTable($table))->toBeTrue();
    }
});
