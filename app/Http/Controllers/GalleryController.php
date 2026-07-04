<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\Kingdom;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display historical gallery image items.
     */
    public function index(Request $request): View
    {
        $query = GalleryImage::query()->with(['kingdom', 'dynasty', 'king']);

        if ($request->has('kingdom')) {
            $query->whereHas('kingdom', function ($q) use ($request) {
                $q->where('slug', $request->input('kingdom'));
            });
        }

        $images = $query->latest()->paginate(16);
        $kingdoms = Kingdom::all();

        return view('gallery.index', compact('images', 'kingdoms'));
    }
}
