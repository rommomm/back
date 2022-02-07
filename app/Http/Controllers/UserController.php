<?php
namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Http\Resources\ProfileUserResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index(Request $request)
    {
        $users = User::whereUsername($request->query('username'))->paginate($request->query('limit'));

        return ProfileUserResource::collection($users);
    }

    public function show(User $user) 
    {
        return new ProfileUserResource($user);
    }

    public function search($query)
    {
        return ProfileUserResource::collection(User::where('user_name', 'Like', "%$query%")->get());
    }
}