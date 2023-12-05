<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPassword extends Controller
{
    public function emailForgotPassword(Request $request)
    {
        $data = $request->json()->all();

        $validation = Validator::make($data, [
            'email' => 'required|email',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validation->errors()
            ], 400);
        }

        $email = $data['email'];
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => "Email doesn't Exist"
            ], 400);
        }
        $token = Str::random(30);
        $url = 'https://127.0.0.1:8000/reset-password/'. $token;
        Mail::to($email)->send(new EmailForgotPassword($url));
        $user->update(['forgot_password_token' => $token]);

        return response()->json([
            'status' => 200,
            'message' => 'Email Sent'
        ], 200);
    }
}
