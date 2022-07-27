<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
class ProfileController extends Controller
{

    public function show(Request $request)
    {
        return new ProfileResource($request->user()->profile);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $request->user()->profile->update($request->only('first_name', 'last_name', 'user_location'));
        return new ProfileResource($request->user()->profile);
    }

    public function uploadAvatar(UpdateProfileRequest $request )
    {
        $request->user()->profile->uploadAvatar($request->file('profile_avatar'));
        return new ProfileResource($request->user()->profile);
    }
    
    public function uploadBackground(UpdateProfileRequest $request)
    {
        $request->user()->profile->uploadBackground($request->file('profile_background'));
        return new ProfileResource($request->user()->profile);
    }

    public function removeAvatar(Request $request)
    { 
        $request->user()->profile->removeAvatar();
        return new ProfileResource($request->user()->profile);
    }

    public function removeBackground(Request $request)
    { 
        $request->user()->profile->removeBackground();
        return new ProfileResource($request->user()->profile);
    }

    
}
