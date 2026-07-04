<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Kingdom;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VideoController extends Controller
{
    /**
     * Display a listing of historical videos.
     */
    public function index(Request $request): View
    {
        $query = Video::query()->with(['kingdom', 'dynasty', 'king']);

        if ($request->has('kingdom')) {
            $query->whereHas('kingdom', function ($q) use ($request) {
                $q->where('slug', $request->input('kingdom'));
            });
        }

        $videos = $query->latest()->paginate(9);
        $kingdoms = Kingdom::all();

        return view('videos.index', compact('videos', 'kingdoms'));
    }
}
