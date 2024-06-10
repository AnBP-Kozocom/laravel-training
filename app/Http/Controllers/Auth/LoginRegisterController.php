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

        $token = $user->createToken($user->email)->plainTextToken;
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => "register failed",
            ], 401);
        }

        // set response
        $data['user']= $user->makeHidden(['created_at', 'updated_at']);
        $data['token'] = $token;

        return response()->json([
            'status' => 'success',
            'message' => "register successfully",
            'data' => $data
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
}
