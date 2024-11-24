<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Vulnerability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookmarkController extends Controller
{
    public function toggleBookmark(Request $request, $vulnerabilityId)
    {
        // Pastikan pengguna sudah login
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth()->user();
        $bookmark = $user->bookmarks()->where('vulnerability_id', $vulnerabilityId)->first();

        if ($bookmark) {
            // Jika sudah ada, hapus bookmark
            $bookmark->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // Jika belum ada, tambahkan bookmark
            $newBookmark = new Bookmark();
            $newBookmark->user_id = Auth::id();
            $newBookmark->vulnerability_id = $vulnerabilityId;
            $newBookmark->save();

            return response()->json(['status' => 'added']);
        }
    }   

    public function showBookmarks()
    {
        $userId = Auth::id();
        $bookmarks = Bookmark::where('user_id', $userId)->with('vulnerability')->get();

        return view('bookmark', compact('bookmarks'));
    }
}