<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
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
    $profileInput = $request->only( 'profile_photo','profile_background', 'user_location');
    $user->profile->fill($profileInput)->save();
    $user->update($userInput);   

    return $user;
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $currentUser = \Auth::user();
            $avatar = $request->file('file');
            $filename = 'avatar.'.$avatar->getClientOriginalExtension();
            $save_path = storage_path().'/users/id/'.$currentUser->id.'/uploads/images/avatar/';
            $path = $save_path.$filename;
            $public_path = '/images/profile/'.$currentUser->id.'/avatar/'.$filename;

            // Make the user a folder and set permissions
            File::makeDirectory($save_path, $mode = 0755, true, true);

            // Save the file to the server
            Image::make($avatar)->resize(300, 300)->save($save_path.$filename);

            // Save the public image path
            $currentUser->profile->avatar = $public_path;
            $currentUser->profile->save();

            return response()->json(['path' => $path], 200);
        } else {
            return response()->json(false, 200);
        }
    }

}
