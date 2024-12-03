<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Gifs;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($gifId)
    {
        $comments = Comment::where('gif_id', $gifId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['comments' => $comments]);
    }

    public function store(Request $request, Gifs $gif)
    {
        $request->validate(['content' => 'required|string']);
        $gif->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
        return redirect()->route('gif.comments', $gif->id);
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id === auth()->id()) {
            $comment->delete();
        }
        return back();
    }
} 