<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        return new ProfileResource(auth()->user());
    }

    public function createProfile(UpdateProfileRequest $request){
                
        $profile =  auth()->user()->profile()->create($request->validated());
        return $profile;
   }

   public function updateProfile(UpdateProfileRequest $request){


    $data = $request->validated();
        auth()->user()->update($data);
        return $data;
    
}
}
