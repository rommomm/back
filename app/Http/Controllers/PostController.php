<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Get list of posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $posts = Post::all();
        return response()->json(['posts'=>$posts], 200);
    }

    /**
     * Create new post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try{
            $request->validate([
                'text'=>'required|min:5',
            ]);

            $post = new Post;
            $post->text = $request->text;
            $post->save();
            
            return response()->json(['message'=>'Post added'], 201);
        }   
        catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Get post by id.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function getByID(Post $post)
    {
        if(!$post){
            return response()->json(['error'=>'Post not found'], 404);
        }
        return response()->json(['post'=>$post], 200);
    }

    /**
     * Update post by id.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'text'=>'required|min:5',
        ]);
        $post = Post::find($id);
        if(!$post){
            return response()->json(['error'=>'Post not found'], 404);
        }
        else{
            $post->text = $request->text;
            $post->update();
            return response()->json(['post'=>$post], 200);
        }
    }
    
    /**
     * Delete post by id.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {   
        try{
            $post = Post::find($id);
            if(!$post){
                return response()->json(['error'=>'Post not found'], 404);
            }
            $post->delete();
            return response()->json(['message'=>'Post successfully deleted'], 200);
        }
        catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
