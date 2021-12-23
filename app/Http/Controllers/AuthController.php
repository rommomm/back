<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Validation;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function register(Validation $request) {
        $user = $request->validated();
        $user['password'] = bcrypt($user['password']);
        User::create($user);
    }

    public function login(Validation $request)
    {
        $credentialsUsername = (['user_name' => $request->user_name, 'password' => $request->password]);
        $credentialsEmail = (['email' => $request->email, 'password' => $request->password]);
        $credentials = $credentialsUsername or $credentialsEmail;
        if((Auth::attempt($credentials)))
        {
            return response([
                'password' => 'Incorrect login or password',
                
            ], 401);
        }
        $user =  User::where('email' , $request->login)->orWhere('user_name', $request->login)->first();

        if (!$user || !Hash::check($request->password, $user->password)) 
        {
            return response([
                'password' => 'Incorrect login or password',
                
            ], 401);
        }

        $token = $user->createToken('myToken')->plainTextToken;

        $response = [
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) 
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function show(Request $request)
    {
        return auth()->user();
    }
}