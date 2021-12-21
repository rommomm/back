<?php
namespace App\Http\Controllers;

use App\Models\User;



class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    // public function show(User $user) {

    //     return $user->posts()->get()->sortByDesc('created_at')->values();
    // }

    public function show($user_name) {
        $user = User::where('user_name', $user_name)->first();
        return $user;
    }
}