<?php
namespace App\Http\Controllers;

use App\Models\User;



class UserController extends Controller
{

    public function allUser()
    {
        return User::all();
    }

    public function getUserPosts(User $user) {

        return $user->posts()->get()->sortByDesc('created_at')->values();
    }
}