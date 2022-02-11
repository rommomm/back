<?php
namespace App\Http\Controllers;

use App\Http\Resources\ProfileUserResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index(Request $request)
    {
        $users = User::whereUsername($request->query('user_name'))->withCount('followings','followers')->paginate(10);
        return ProfileUserResource::collection($users);
    }

    public function show(User $user) 
    {
        return new ProfileUserResource($user->loadCount('followings','followers'));
    }

    public function search($query)
    {
        return ProfileUserResource::collection(User::WhereUsername($query)->withCount('followings','followers')->get());
    }

    public function followings(User $user)
    {
        return UserResource::collection($user->followings()->paginate(10));
    }

    public function followers(User $user)
    {
        return UserResource::collection($user->followers()->paginate(10));
    }

    public function follow(Request $request, User $user)
    {
        $request->user()->followings()->syncWithoutDetaching($user->id);
        return new UserResource($user);
    }

    public function unfollow(Request $request, User $user)
    {
        $request->user()->followings()->detach($user->id);
        return response()->noContent();
    }
    
}