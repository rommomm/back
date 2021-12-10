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
        return Post::with('user')->get();
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
            $userId = auth()->user()->id;
            $post = Post::findOrFail($id);
            if($userId != $post->user_id){
                return response()->json(['error' => 'Forbidden.'],403);}
                $post->update($request->all());
            return $post;

    }

    public function destroy($id)
    {
        $userId = auth()->user()->id;
        $post  = Post::findOrFail($id);
        if($userId != $post->user_id){
            return response()->json(['error' => 'Forbidden.'],403);
        }
            $post->delete();
        return response()->noContent();
    }

    

}
