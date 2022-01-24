<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{

    public function show()
    {
        return new ProfileResource(auth()->user());
    }

    public function updateProfile(UpdateProfileRequest $request )
    {
        $user = auth()->user();
        $userInput = $request->only('first_name', 'last_name');
        $profileInput = $request->only('user_location');
        $user->profile->fill($profileInput)->save();
        $user->update($userInput);   
        return new ProfileResource($user);
    }

    public function uploadAvatar(UpdateProfileRequest $request )
    {
        $user = auth()->user();
        $request->file('profile_photo')->storeAs('public/'.$user->user_name.'/images/avatar/', 'avatar.png');
        $user->profile->profile_photo = Storage::url(''.$user->user_name.'/images/avatar/'.'avatar.png');
        $user->profile->save();
        return new ProfileResource($user);
    }

    public function uploadBackground(UpdateProfileRequest $request )
    {
        $user = auth()->user();
        $request->file('profile_background')->storeAs('public/'.$user->user_name.'/images/background/', 'background.png');
        $user->profile->profile_background = Storage::url(''.$user->user_name.'/images/background/'.'background.png');
        $user->profile->save();
        return new ProfileResource($user);
    }

    public function removeAvatar()
    { 
        $user = auth()->user();
        File::delete('storage/'.$user->user_name.'/images/avatar/avatar.png');
        $user->profile->update(['profile_photo' => null]);
        return response()->noContent();
    }

    public function removeBackground()
    { 
        $user = auth()->user();
        File::delete('storage/'.$user->user_name.'/images/background/background.png');
        $user->profile->update(['profile_background' => null]);
        return response()->noContent();
    }
}
