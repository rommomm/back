<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
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
        $user->profile->profile_photo = URL::asset('storage/'.$user->user_name.'/images/avatar/'.'avatar.png');
        $user->profile->save();
        return new ProfileResource($user);
        // $user = auth()->user();
        // $file=$request->file('profile_photo');
        // $extension = $file->getClientOriginalExtension();
        // $filename= 'avatar'.'.'.$extension;
        // $file->move('uploads/'.$user->user_name.'/images/avatar/',$filename);
        // $user->profile->profile_photo = URL::asset('/uploads/'.$user->user_name.'/images/avatar/'.$filename);
        // $user->profile->save();
        // return new ProfileResource($user);
    }

    public function uploadBackground(UpdateProfileRequest $request )
    {
        $user = auth()->user();
        $request->file('profile_background')->storeAs('public/'.$user->user_name.'/images/background/', 'background.png');
        $user->profile->profile_background = URL::asset('storage/'.$user->user_name.'/images/background/'.'background.png');
        $user->profile->save();
        return new ProfileResource($user);
        // $user = auth()->user();
        // $file=$request->file('profile_background');
        // $extension = $file->getClientOriginalExtension();
        // $filename= 'background'.'.'.$extension;
        // $file->move('uploads/'.$user->user_name.'/images/background/',$filename);
        // $user->profile->profile_background = URL::asset('/uploads/'.$user->user_name.'/images/background/'.$filename);
        // $user->profile->save();
        // return new ProfileResource($user);
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
        $user->profile->update(['profile_photo' => null]);
        return response()->noContent();
    }
}
