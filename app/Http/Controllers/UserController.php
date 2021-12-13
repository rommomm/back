<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class UserController extends Controller
{
    public function register(Request $request) {

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'user_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => ['required','confirmed', Password::min(8)],
        ]);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => ($request->password),
        ]);

    $token = $user->createToken('myToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email',  $request->email)->first();

        if(!$user || Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Bad'
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

    public function getAllUser()
    {
        return User::all();
    }

    public function getUserProfile($user_name) {
        $user = User::where('user_name', $user_name)->first();
        return $user;
    }

    public function getUserPosts($id) {
        return User::find($id)->posts->sortByDesc('created_at')->values();
    }
}