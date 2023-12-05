<?php

namespace App\Http\Controllers\API\v1\UserData;

use App\Models\Chat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ChatRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $user = Auth::user();
        $chat = Chat::create([
            'conversationId' => Str::random(10),
            'userId' => $user->id,
            'fullName' => $user->fullName,
            'message' => $data['message'],
            'receiverId' => $data['receiverId']
        ]);

        return new ChatResource($chat);
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
