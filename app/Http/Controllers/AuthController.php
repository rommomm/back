<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class AuthController extends Controller
{
    public function register(Request $request) {

        $fields = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'user_name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => ['required','confirmed', Password::min(8)],
        ]);
        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($fields['password']),
        ]);

    $token = $user->createToken('myToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();


        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'email' => 'Incorrect email',
                'password' => 'Incorrect password',
                
            ], 401);
        }

        $token = $user->createToken('myToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function AuthMe($user_name) {
        $user = User::where('user_name', $user_name)->first();
        return $user;
    }
}