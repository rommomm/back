<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use App\Models\User;
 
class PostController extends Controller
{

    public function index()
    {
        return Post::all();
    }

    public function store(Request $request)
    {
        return (Post::create(['user_id' => auth()->user()->id, 'text'=>$request->text]));
    }

    public function show($post)
    {
        return Post::find($post);
    }

    public function update( Request $request,$id)
    {
        // $post = Post::find($id);
        // $post->update($request->all());
        // return $post;
        $post = Post::find($id);
        $post->user_id = auth()->user()->id;
        $post->update($request->all());
        return $post;

    }

    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return response()->noContent();
    }
}
