<?php

namespace App\Services;

use App\Models\Bookmark;
use App\Models\User;
use App\Models\Article;
use App\Models\King;
use App\Models\Kingdom;
use Illuminate\Database\Eloquent\Model;

class BookmarkService
{
    /**
     * Map string types to actual model class names.
     */
    public function getModelClass(string $type): ?string
    {
        return match (strtolower($type)) {
            'article' => Article::class,
            'king' => King::class,
            'kingdom' => Kingdom::class,
            default => null,
        };
    }

    /**
     * Check if a model is bookmarked by a user.
     */
    public function isBookmarked(User $user, string $type, int $id): bool
    {
        $modelClass = $this->getModelClass($type);
        if (!$modelClass) {
            return false;
        }

        return Bookmark::where('user_id', $user->id)
            ->where('bookmarkable_type', $modelClass)
            ->where('bookmarkable_id', $id)
            ->exists();
    }

    /**
     * Toggle the bookmark status of a model for a user.
     * Returns true if bookmarked, false if unbookmarked.
     */
    public function toggle(User $user, string $type, int $id): bool
    {
        $modelClass = $this->getModelClass($type);
        if (!$modelClass) {
            throw new \InvalidArgumentException("Invalid bookmark type: {$type}");
        }

        // Find model to verify it exists
        $model = $modelClass::findOrFail($id);

        $existing = Bookmark::where('user_id', $user->id)
            ->where('bookmarkable_type', $modelClass)
            ->where('bookmarkable_id', $id)
            ->first();

        if ($existing) {
            $existing->delete();
            return false;
        }

        Bookmark::create([
            'user_id' => $user->id,
            'bookmarkable_type' => $modelClass,
            'bookmarkable_id' => $id,
        ]);

        return true;
    }
}
