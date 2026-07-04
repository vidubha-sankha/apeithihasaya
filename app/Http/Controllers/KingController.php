<?php

namespace App\Http\Controllers;

use App\Models\King;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KingController extends Controller
{
    /**
     * Display a listing of published kings.
     */
    public function index(Request $request): View
    {
        $query = King::where('status', 'published')->with('kingdom');

        if ($request->has('search')) {
            $search = '%' . $request->input('search') . '%';
            $query->where('name', 'ilike', $search)
                  ->orWhere('title', 'ilike', $search);
        }

        $kings = $query->paginate(12);

        return view('kings.index', compact('kings'));
    }

    /**
     * Display the specified king biography.
     */
    public function show(string $slug): View
    {
        $king = King::where('slug', $slug)
            ->where('status', 'published')
            ->with(['kingdom', 'dynasty', 'articles', 'comments.user', 'timelines'])
            ->firstOrFail();

        return view('kings.show', compact('king'));
    }
}
