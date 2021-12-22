<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Validation;
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

    public function update(Request $request,$post)
    {
        $userId = auth()->user()->id;
        $updatedPost = Post::findOrFail($post);
        if($userId != $updatedPost->user_id){
            return response()->json(['error' => 'Forbidden.'],403);
            }
            $updatedPost->update($request->all());
        return $updatedPost;
    }

    public function destroy($post)
    {
        $userId = auth()->user()->id;
        $deletedPost = Post::findOrFail($post);
        if($userId != $deletedPost->user_id){
            return response()->json(['error' => 'Forbidden.'],403);
            }
            $deletedPost->delete();
        return response()->noContent();
    } 
}
