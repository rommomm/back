<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Validation;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        return Post::orderBy('created_at', 'desc')->with('user')->get();
    }

    public function store(Validation $request)
    {
        $request->safe()->only(['text']);
        return auth()->user()->posts()->create(['text' => $request->text]) ;
    }

    public function show($post)
    {  
        return Post::find($post);
    }

    public function update(Validation $request, Post $post)
    {
        $post->update($request->validated());
        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->noContent();
    } 
}
