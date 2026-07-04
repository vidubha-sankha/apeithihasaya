<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a list of published historical articles.
     */
    public function index(Request $request): View
    {
        $query = Article::where('status', 'published')
            ->with(['category', 'kingdom', 'author']);

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->input('category'));
            });
        }

        if ($request->has('kingdom')) {
            $query->whereHas('kingdom', function ($q) use ($request) {
                $q->where('slug', $request->input('kingdom'));
            });
        }

        if ($request->has('search')) {
            $search = '%' . $request->input('search') . '%';
            $query->where(function ($q) use ($search) {
                $q->where('title', 'ilike', $search)
                  ->orWhere('excerpt', 'ilike', $search);
            });
        }

        $articles = $query->latest('published_at')->paginate(9);
        $categories = Category::all();

        return view('articles.index', compact('articles', 'categories'));
    }

    /**
     * Display a detailed historical article view.
     */
    public function show(string $slug): View
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'kingdom', 'dynasty', 'king', 'author', 'tags', 'comments.user'])
            ->firstOrFail();

        // Load some related articles
        $relatedArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->where(function ($q) use ($article) {
                $q->where('category_id', $article->category_id)
                  ->orWhere('kingdom_id', $article->kingdom_id);
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
