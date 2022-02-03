<?php
namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Http\Resources\ProfileUserResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return ProfileUserResource::collection(User::paginate(10));
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