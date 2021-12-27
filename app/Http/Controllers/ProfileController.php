<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
    public function show()
    {
        return new ProfileResource(auth()->user());
    }
}
