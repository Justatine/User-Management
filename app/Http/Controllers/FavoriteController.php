<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FavoriteController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $favorites = auth()->user()->favorites()
            ->with('gif')  // Eager load the gif relationship
            ->latest()
            ->get();
        
        return view('pages.client.favorites', [
            'favorites' => $favorites
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'gif_id' => 'required|exists:gifs,id',
        ]);

        auth()->user()->favorites()->create([
            'gif_id' => $request->gif_id
        ]);

        return response()->json(['message' => 'Added to favorites']);
    }

    public function destroy(Favorites $favorite)
    {
        if ($favorite->user_id !== auth()->id()) {
            abort(403);
        }
        
        $favorite->delete();
        return response()->json(['message' => 'Removed from favorites']);
    }
} 