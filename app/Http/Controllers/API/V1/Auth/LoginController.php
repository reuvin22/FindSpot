<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->json()->all();

        $user = User::where('email', $data['email'])->first();

        if(!$user || !Hash::check($data['password'], $user->password)){
            return response()->json([
                'status' => 400,
                'message' => 'Wrong Username or Password'
            ], 400);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'email' => $user->email,
            'fullName' => $user->fullName,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $userToken = $request->user();
        $userToken->token()->revoke();

        return response()->json([
            'status' => 200,
            'message' => 'Logout Successfully'
        ], 200);
    }
}
