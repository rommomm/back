<?php
namespace App\Http\Controllers;

use App\Models\User;



class UserController extends Controller
{

    public function allUser()
    {
        return User::all();
    }
    
    public function getUserPosts($id) {
        return User::find($id)->posts->sortByDesc('created_at')->values();
    }
}