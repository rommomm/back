<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Image;
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
        return $user;
    }

    public function uploadAvatar(UpdateProfileRequest $request )
    {
        $user = auth()->user();
        $file=$request->file('profile_photo');
        $extension = $file->getClientOriginalExtension();
        $filename= 'avatar'.'.'.$extension;
        $file->move('uploads/'.$user->user_name.'/images/avatar/',$filename);
        $user->profile->profile_photo = URL::asset('/uploads/'.$user->user_name.'/images/avatar/'.$filename);
        $user->profile->save();
        return $user;
    }

    public function uploadBackground(UpdateProfileRequest $request )
    {
        $user = auth()->user();
        $file=$request->file('profile_background');
        $extension = $file->getClientOriginalExtension();
        $filename= 'background'.'.'.$extension;
        $file->move('uploads/'.$user->user_name.'/images/background/',$filename);
        $user->profile->profile_background = URL::asset('/uploads/'.$user->user_name.'/images/background/'.$filename);
        $user->profile->save();
        return $user;
    }

    public function removeAvatar()
    { 
        auth()->user()->profile->update(['profile_photo' => URL::asset('/default/avatar.png')]); 
        return response()->json(['profile_photo' => URL::asset('/default/avatar.png')]);
    }
    
    public function removeBackground()
    { 
        auth()->user()->profile->update(['profile_background' => URL::asset('/default/background.png')]); 
        return response()->json(['profile_background' => URL::asset('/default/avatar.png')]);
    }

        // $user = auth()->user();
        // $fileName = time().'.'.$request->file('profile_photo')->getClientOriginalExtension();
        // $request->profile_photo->move(storage_path('users/'.$user->user_name.'/images/avatar/'),$fileName);
        // $path = "storage/images/$fileName";
        // $user->profile->profile_photo = URL::asset($path);
        // $user->profile->save();
        // return $user;

        // $user = auth()->user();
        // $filename=$request->file('profile_photo')->store('posts','public');
        // $user->profile->profile_photo = URL::asset($filename);
        // $user->profile->save();
        // return $user;


        // $currentUser = auth()->user();
        // $avatar = $request->file('profile_photo');
        // $filename = 'avatar.'.$avatar->getClientOriginalExtension();
        // $save_path = $avatar->move(storage_path().'/users/'.$currentUser->user_name.'/images/avatar/');
        // $path = $save_path.$filename;
        // $public_path = '/images/profile/'.$currentUser->user_name.'/avatar/'.$filename;
        // $currentUser->profile->profile_photo =  URL::asset($public_path);
        // $currentUser->profile->save();
        // return $currentUser;

        //     $images = $request->file('profile_photo','profile_background');
    //     $imageName ='';
    //     foreach($images as $image)
    //     {
    //         $new_name = rand().'.'.$image->getClientOriginalExtension();
    //         $image->move(public_path('storage/images'),$new_name);
    //         $imageName=$imageName.$new_name.",";
    //     }
    //     $imagedb=$imageName;
    //  return $imagedb;
    

}
