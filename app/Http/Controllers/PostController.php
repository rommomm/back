<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\AuthorPostResource;
use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Resources\ProfileUserResource;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::orderBy('id', 'desc')
            ->withCount('comments')->cursorPaginate(10));
    }

    public function store(CreatePostRequest $request)
    {
        $post = auth()->user()->posts()->create($request->validated());
        return new PostResource($post);
    }

    public function show(Post $post)
    {  
        return new PostResource(($post)->loadCount('comments'));
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

    public function getAllByUser(User $author) 
    {    
        $post = $author->posts()->orderBy('id' , 'desc')->withCount('comments')->cursorPaginate(10);
        return AuthorPostResource::collection($post);
    }

    public function getPostFeed()
    {
        return PostResource::collection(Post::postsFeed(auth()->id())->cursorPaginate(10));
    }

}
