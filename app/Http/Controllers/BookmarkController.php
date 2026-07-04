<?php

namespace App\Http\Controllers;

use App\Services\BookmarkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    public function __construct(protected BookmarkService $bookmarkService) {}

    /**
     * Display a listing of user bookmarks.
     */
    public function index(): View
    {
        $user = Auth::user();
        $bookmarks = $user->bookmarks()->with('bookmarkable')->latest()->get();

        return view('bookmarks.index', compact('bookmarks'));
    }

    /**
     * Toggle bookmark state for a given model type and ID.
     */
    public function toggle(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'required|string',
            'id' => 'required|integer',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        $isBookmarked = $this->bookmarkService->toggle(
            $user,
            $request->input('type'),
            $request->input('id')
        );

        return response()->json([
            'status' => 'success',
            'bookmarked' => $isBookmarked,
            'message' => $isBookmarked ? 'Bookmarked successfully.' : 'Bookmark removed successfully.',
        ]);
    }
}
