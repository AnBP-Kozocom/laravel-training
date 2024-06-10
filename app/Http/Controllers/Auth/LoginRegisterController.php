<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // create a new user 
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // generate a plan text token 
        $token = $this->createToken($user);

        // create the response array
        $response = [
            'status' => 'success',
            'message' => "register successfully",
            'data' => [
                'user' => $user->makeHidden(['created_at', 'updated_at']),
                'token' => $token,
            ]
        ];

        return response()->json($response);
    }

    public function login(LoginRequest $request)
    {
        // find the user
        $user = User::where('email', $request->email)->first();

        // check if user exists
        if (!$user) {
            return response()->json([
                'status' => 'failed',
                'message' => "User does not exist",
            ], 404);
        }

        // check if password is correct
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => "Password is incorrect",
            ]);
        }

        // generate a plan text token 
        $token = $this->createToken($user);

        // create the response array
        $response = [
            'status' => 'success',
            'message' => "Login successfully",
            'data' => [
                'token' => $token,
                'user' => $user->makeHidden(['email_verified_at', 'created_at', 'updated_at']),
            ]
        ];

        return response()->json($response);
    }


    private function createToken(User $user): string
    {
        return $user->createToken($user->email)->plainTextToken;
    }
}
