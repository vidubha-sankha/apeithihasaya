<?php

namespace App\Services;

use App\Models\King;
use App\Models\Kingdom;
use App\Models\Article;
use App\Models\Timeline;

class SearchService
{
    /**
     * Perform a global search across multiple historical modules.
     */
    public function search(string $query, bool $onlyPublished = true): array
    {
        if (trim($query) === '') {
            return [
                'kings' => collect(),
                'kingdoms' => collect(),
                'articles' => collect(),
                'timelines' => collect(),
            ];
        }

        $term = '%' . $query . '%';

        $kingsQuery = King::query()
            ->where(function ($q) use ($term) {
                $q->where('name', 'ilike', $term)
                  ->orWhere('title', 'ilike', $term)
                  ->orWhere('summary', 'ilike', $term)
                  ->orWhere('biography', 'ilike', $term);
            });

        $kingdomsQuery = Kingdom::query()
            ->where(function ($q) use ($term) {
                $q->where('name', 'ilike', $term)
                  ->orWhere('description', 'ilike', $term)
                  ->orWhere('capital', 'ilike', $term);
            });

        $articlesQuery = Article::query()
            ->where(function ($q) use ($term) {
                $q->where('title', 'ilike', $term)
                  ->orWhere('excerpt', 'ilike', $term)
                  ->orWhere('content', 'ilike', $term);
            });

        $timelinesQuery = Timeline::query()
            ->where(function ($q) use ($term) {
                $q->where('event_title', 'ilike', $term)
                  ->orWhere('description', 'ilike', $term)
                  ->orWhere('event_year', 'ilike', $term);
            });

        if ($onlyPublished) {
            $kingsQuery->where('status', 'published');
            $kingdomsQuery->where('status', 'published');
            $articlesQuery->where('status', 'published');
        }

        return [
            'kings' => $kingsQuery->limit(10)->get(),
            'kingdoms' => $kingdomsQuery->limit(10)->get(),
            'articles' => $articlesQuery->limit(10)->get(),
            'timelines' => $timelinesQuery->limit(15)->get(),
        ];
    }
}
