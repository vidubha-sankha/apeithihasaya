<?php

namespace App\Http\Controllers;

use App\Models\Kingdom;
use Illuminate\View\View;

class KingdomController extends Controller
{
    /**
     * Display a listing of kingdoms.
     */
    public function index(): View
    {
        $kingdoms = Kingdom::where('status', 'published')->paginate(12);

        return view('kingdoms.index', compact('kingdoms'));
    }

    /**
     * Display the specified kingdom.
     */
    public function show(string $slug): View
    {
        $kingdom = Kingdom::where('slug', $slug)
            ->where('status', 'published')
            ->with(['kings', 'dynasties', 'articles', 'comments.user'])
            ->firstOrFail();

        return view('kingdoms.show', compact('kingdom'));
    }
}
