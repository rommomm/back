<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\Profile;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(SignUpRequest $request) 
    {
       $user =  User::create($request->validated());
        $profile = new Profile();
        $user->profile()->save($profile);
        $user->save();
        return response()->noContent(201);
    }

    public function login(SignInRequest $request)
    {
        $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL)
        ? 'email'
        : 'user_name';
        $request->merge([$loginType => $request->input('login')]);
        $credentials = $request->only($loginType, 'password');
        if(!Auth::attempt($credentials))
        {
            throw ValidationException::withMessages(['password' => 'incorrect login or password'], 401);
        }

        $token = auth()->user()->createToken('')->plainTextToken;
        return response([
            'token' => $token
        ], 201);
    }

    public function logout() 
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}