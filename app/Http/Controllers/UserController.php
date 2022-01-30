<?php
namespace App\Http\Controllers;

use App\Http\Resources\ProfileUserResource;
use App\Models\User;
class UserController extends Controller
{
    public function show(User $user) 
    {
        return new ProfileUserResource($user);
    }

    public function search($query)
    {
        return ProfileUserResource::collection(User::where('user_name', 'Like', "%$query%")->get());
    }
}