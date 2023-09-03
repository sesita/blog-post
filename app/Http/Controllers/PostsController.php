<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 8;
        $posts = Post::latest()->paginate($limit);
        return response($posts);
    }

    public function show($id)
    {
        $post = Post::with('comments')->find($id);
        return response($post);
    }

    public function store(Request $request)
    {
        $request->merge(['author_id' => Auth::user()->id]);
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'author_id' => 'required|exists:users,id',
            'publish_date' => 'required|date',
        ]);

        $post = Post::create($request->all());

        return response(['status' => 'success', 'message' => 'წარმატებით დაემატა'], 201);
    }

    public function update(Request $request, $id)
    {
        $request->merge(['author_id' => Auth::user()->id]);
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'author_id' => 'required|exists:users,id',
            'publish_date' => 'required|date',
        ]);

        $post = Post::find($id)->update($request->all());
        return response(['status' => 'success', 'message' => 'წარმატებით განახლდა'], 201);
    }

    public function destroy($id){
        Post::where('id', $id)->delete();
        return response(['status'=>'success', 'message' => 'წარმატებით წაიშალა']);
    }

}