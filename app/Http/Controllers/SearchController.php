<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __construct(protected SearchService $searchService) {}

    /**
     * Display global search results.
     */
    public function index(Request $request): View
    {
        $query = $request->input('query', '');
        $results = $this->searchService->search($query);

        return view('search.index', [
            'query' => $query,
            'results' => $results,
        ]);
    }
}
