<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use Illuminate\View\View;

class TimelineController extends Controller
{
    /**
     * Display the historical timeline.
     */
    public function index(): View
    {
        $events = Timeline::with(['kingdom', 'king'])
            ->orderBy('event_year', 'asc')
            ->get();

        return view('timeline.index', compact('events'));
    }
}
