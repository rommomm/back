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

    public function show($post)
    {
        return Post::find($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->update($request->all());
        return $post;
    }

    public function destroy(Post $id)
    {
        $id->delete();
        return response()->noContent();
    }
}
