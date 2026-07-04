<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a new comment.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|integer',
            'body' => 'required|string|max:1000',
        ]);

        $modelClass = match (strtolower($request->input('commentable_type'))) {
            'article' => \App\Models\Article::class,
            'king' => \App\Models\King::class,
            'kingdom' => \App\Models\Kingdom::class,
            default => null,
        };

        if (!$modelClass) {
            return back()->with('error', 'Invalid comment target.');
        }

        // Verify if target exists
        $modelClass::findOrFail($request->input('commentable_id'));

        Comment::create([
            'user_id' => Auth::id(),
            'commentable_type' => $modelClass,
            'commentable_id' => $request->input('commentable_id'),
            'body' => trim($request->input('body')),
        ]);

        return back()->with('success', 'Comment added successfully.');
    }
}
