<?php

namespace App\Http\Controllers\API\V1\Rooms;

use App\Models\Rooms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Request\RoomRequest;
use App\Http\Resources\API\v1\Rooms\RoomResource;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Rooms::all()->paginate(8);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request)
    {
        $room = $request->validated();
        $rooms = Rooms::create($room);

        return new RoomResource($rooms);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rooms = Rooms::find($id);
        return new RoomResource($rooms);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, Rooms $rooms)
    {
        $update = $request->json()->all();
        $rooms->update($update);
        return response()->json([
            'status' => 200,
            'message' => 'Data Updated Successfully',
            'data' => [
                'descriptions' => $rooms->descriptions
            ]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rooms $rooms, string $id)
    {
        $delete = Rooms::find($id);
        $delete->delete($rooms);
        return response()->json([
            'status' => 200,
            'message' => 'Data Deleted Successfully'
        ], 200);
    }
}
