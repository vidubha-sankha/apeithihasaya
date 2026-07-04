<?php

namespace App\Http\Controllers;

use App\Models\HistoricalPlace;
use Illuminate\View\View;

class PlaceController extends Controller
{
    /**
     * Display a listing of historical places.
     */
    public function index(): View
    {
        $places = HistoricalPlace::where('status', 'published')->paginate(9);

        return view('places.index', compact('places'));
    }

    /**
     * Display the specified historical place.
     */
    public function show(string $slug): View
    {
        $place = HistoricalPlace::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('places.show', compact('place'));
    }
}
