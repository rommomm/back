<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        
        return $posts;
    }

    public function store(Request $request)
    {

        $post = new Post;
        $post->text = $request->text;
        $post->save();

        return $post;
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function update(Request $request, Post $post)
    {
        $post->text = $request->text;
        $post->update();
        return $post;
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['message' => 'Post successfully deleted']);
    }
}
