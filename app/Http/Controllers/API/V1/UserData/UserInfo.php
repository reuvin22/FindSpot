<?php

namespace App\Http\Controllers\API\V1\UserData;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserInfoRequest;
use App\Http\Resources\UserInfoResource;

class UserInfo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserInfoRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'fullName' => Str::title($data['fullName']),
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        Mail::send(new EmailVerification())->to($user->email);
        return new UserInfoResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserInfoResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserInfoRequest $request, User $user)
    {
        $data = $user->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Data Updated Successfully',
            'data' => [
                'fullName' => $user->fullName,
                'email' => $user->email
            ]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Deleted Successfully'
        ], 200);
    }
}
