<?php

namespace App\Http\Controllers;

use App\Models\Dynasty;
use Illuminate\View\View;

class DynastyController extends Controller
{
    /**
     * Display a listing of dynasties.
     */
    public function index(): View
    {
        $dynasties = Dynasty::where('status', 'published')->with('kingdom')->paginate(12);

        return view('dynasties.index', compact('dynasties'));
    }

    /**
     * Display the specified dynasty.
     */
    public function show(string $slug): View
    {
        $dynasty = Dynasty::where('slug', $slug)
            ->where('status', 'published')
            ->with(['kingdom', 'kings', 'articles'])
            ->firstOrFail();

        return view('dynasties.show', compact('dynasty'));
    }
}
