<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KingController;
use App\Http\Controllers\KingdomController;
use App\Http\Controllers\DynastyController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Historical Portal Routes
Route::get('/kings', [KingController::class, 'index'])->name('kings.index');
Route::get('/kings/{slug}', [KingController::class, 'show'])->name('kings.show');

Route::get('/kingdoms', [KingdomController::class, 'index'])->name('kingdoms.index');
Route::get('/kingdoms/{slug}', [KingdomController::class, 'show'])->name('kingdoms.show');

Route::get('/dynasties', [DynastyController::class, 'index'])->name('dynasties.index');
Route::get('/dynasties/{slug}', [DynastyController::class, 'show'])->name('dynasties.show');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/timeline', [TimelineController::class, 'index'])->name('timeline.index');

Route::get('/places', [PlaceController::class, 'index'])->name('places.index');
Route::get('/places/{slug}', [PlaceController::class, 'show'])->name('places.show');

Route::get('/maps', [MapController::class, 'index'])->name('maps.index');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::view('/about', 'about')->name('about');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Protected actions
Route::post('/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

Route::middleware('auth')->group(function () {
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/toggle', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
