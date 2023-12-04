<?php

namespace App\Http\Controllers\API\V1\UserData;

use App\Models\User;
use Illuminate\Http\Request;
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
            'fullName' => $data['fullName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        return new UserInfoResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
