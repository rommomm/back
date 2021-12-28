<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::orderBy('id', 'desc')->with('author')->get());
    }

    public function store(CreatePostRequest $request)
    {
        $post = auth()->user()->posts()->create($request->validated()) ;
        return new PostResource($post);
    }

    public function show(Post $post)
    {  
        return new PostResource($post);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->noContent();
    } 

    public function getAllbyPosts(User $author) 
    {
        return $author->posts()->get()->sortByDesc('created_at')->values();
    }
}
