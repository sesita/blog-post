<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function index(Request $request){
        $limit = $request->limit ?? 10;
        $comments = Comment::latest()->paginate($limit);
        return response($comments);
    }
    public function store($id, Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:255',
        ]);

        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $id,
            'body' => $request->body
        ]);

        return response(['status'=>'success', 'message' => 'წარმატებით დაემატა'], 201);
    }
    public function destroy($postId, $commentId){
        Comment::where('id', $commentId)->delete();
        return response(['status'=>'success', 'message' => 'წარმატებით წაიშალა']);
    }
}
