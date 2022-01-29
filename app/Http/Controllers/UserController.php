<?php
namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Http\Resources\ProfileUserResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user) 
    {
        return new ProfileUserResource($user);
    }
}