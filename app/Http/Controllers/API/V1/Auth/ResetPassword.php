<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\EmailForgotPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\API\v1\Auth\ResetPasswordRequest;

class ResetPassword extends Controller
{
    public function emailForgotPassword(ResetPasswordRequest $request)
    {
        $validation = Validator::make($request->validated());

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validation->errors()
            ], 400);
        }

        $email = $validation['email'];
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
