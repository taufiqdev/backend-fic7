<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
//use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
        ]);

        $user=User::where('email', $request->email)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['email incorrect']
            ]);
        }

        if (!Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'password' => ['password incorrect']
            ]);
        }

        $token=$user->createToken('api-token')->plainTextToken;
        return response()->json([
            'jwt-token' => $token,
            //'user' => $user
            'user' => new UserResource($user)


        ]);
    }

    public function logout(Request $request) {

    }
}
