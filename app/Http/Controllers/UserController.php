<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response([
                'user' => null,
                'message' => 'Validacija neuspesna.',
                'errors' => $validator->messages(),
            ], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                "user" => null,
                "message" => "Login neuspesan.",
            ], 401);
        }

        $token = $user->createToken('token');

        return response([
            "user" => $user,
            "message" => "Login uspesan",
            'token' => $token->plainTextToken,
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        $user->tokens()->delete();

        return response([
            "user" => $user,
            "message" => "Logout.",
        ], 200);
    }
}
