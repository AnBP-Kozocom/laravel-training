<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('authToken')->plainTextToken;
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => "register failed",
            ], 401);
        }


        return response()->json([
            'status' => 'success',
            'message' => "register successfully",
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'token' => $token
            ]
        ]);
    }

    public function login(Request $req)
    {
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            dd("login successful");
        } else {
            dd("login failed");
        };
    }

    private function getToken()
    {
    }
}
