<?php
namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function show(User $author) 
    {
        return new UserResource($author);
    }
}