<?php

namespace App\Http\Controllers\API\v1\UserData;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Contract\Database;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Database $database)
    {
        $chat = $database->getReference('chat')->getValue();
        return $chat;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Database $database)
    {
        $data = $request->json()->all();
        $user = Auth::user();

        $chats = [
            'conversationId' => Str::random(10),
            'fullName' => "Reuvin Hernandez",
            'message' => $data['message'],
            'receiverId' => $data['receiverId']
        ];

        $store = $database->getReference('chat')->push($chats);
        if($store){
            return response()->json([
                "message" => 'Message sent Successfully'
            ], 200);
        }else {
            return response()->json([
                "message" => 'Failed to send message'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Database $database, string $id)
    {

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
    public function destroy(Database $database, string $id)
    {
        $delete = $database->getReference('chat/'.$id);
        return response()->json([
            'message' => 'Data Deleted Successfully'
        ], 200);
    }
}
