<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function index(Post $post)
    {
        return CommentResource::collection($post->comments()->orderBy('id' , 'desc')->get());
    }

    public function getAll(Comment $comment)
    {
        return CommentResource::collection($comment->orderBy('id' , 'desc')->get());
    }

    public function show(Comment $comment)
    {  
        return new CommentResource($comment);   
    }

    public function store(CommentRequest $request, Post $post)
    { 
        $comment = auth()->user()->comments()->make($request->validated());
        $post->comments()->save($comment);
        return new CommentResource($comment);  
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());
        return new CommentResource($comment);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->noContent();
    } 
}
