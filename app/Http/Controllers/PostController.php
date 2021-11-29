<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
 
class PostController extends Controller
{

    public function index()
    {
        return Post::all();
    }

    public function store(Request $request)
    {
        return (Post::create(['text' => $request->text]));
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function update(Request $request, Post $post)
    {
        $post->update(['text' => $request->text]);
        return $post;
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->noContent();
    }
}
