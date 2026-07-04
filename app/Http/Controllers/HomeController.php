<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\GalleryImage;
use App\Models\King;
use App\Models\Kingdom;
use App\Models\Timeline;
use App\Models\Video;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the platform's landing page.
     */
    public function index(): View
    {
        $featuredKing = King::where('status', 'published')
            ->where('featured', true)
            ->first() ?? King::where('status', 'published')->first();

        $featuredKingdom = Kingdom::where('status', 'published')
            ->first();

        $latestArticles = Article::where('status', 'published')
            ->with(['category', 'kingdom'])
            ->latest('published_at')
            ->take(3)
            ->get();

        $timelineEvents = Timeline::orderBy('event_year', 'asc')
            ->take(5)
            ->get();

        $galleryImages = GalleryImage::latest()
            ->take(6)
            ->get();

        $videos = Video::latest()
            ->take(3)
            ->get();

        return view('welcome', compact(
            'featuredKing',
            'featuredKingdom',
            'latestArticles',
            'timelineEvents',
            'galleryImages',
            'videos'
        ));
    }
}
