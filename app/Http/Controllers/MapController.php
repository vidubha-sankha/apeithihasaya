<?php

namespace App\Http\Controllers;

use App\Models\HistoricalMap;
use Illuminate\View\View;

class MapController extends Controller
{
    /**
     * Display historical maps page.
     */
    public function index(): View
    {
        $maps = HistoricalMap::where('status', 'published')->paginate(6);

        return view('maps.index', compact('maps'));
    }
}
