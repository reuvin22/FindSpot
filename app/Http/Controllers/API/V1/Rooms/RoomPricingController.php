<?php

namespace App\Http\Controllers\API\v1\Rooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Request\RoomPricingRequest;
use App\Http\Resources\API\v1\Rooms\RoomPricingResource;
use App\Models\RoomPricing;
use Illuminate\Http\Request;

class RoomPricingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoomPricing $roomPricing)
    {
        return new RoomPricingResource($roomPricing);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomPricingRequest $request)
    {
        $pricing = RoomPricing::create($request->validated());
        if($pricing){
            return response()->json([
                'status' => 200,
                'message' => "Data Inserted Successfully"
            ], 200);
        }else {
            return response()->json([
                'status' => 400,
                'message' => "Failed to insert data"
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomPricingResource $roomPricing, string $id)
    {
        $price = RoomPricing::find($id);
        return new RoomPricingResource($price);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomPricingRequest $request, string $id)
    {
        $pricing = RoomPricing::find($id);
        $updatePricing = $pricing->update($request->validated());
        if($updatePricing){
            return response()->json([
                'status' => 200,
                'message' => 'Data Inserted Successfully'
            ], 200);
        }else {
            return response()->json([
                'status' => 400,
                'message' => 'Failed to Insert Data'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roomPricing = RoomPricing::find($id);
        $delete = $roomPricing->delete();
        if($delete){
            return response()->json([
                'status' => 400,
                'message' => "Data Deleted Successfully"
            ], 400);
        }else {
            return response()->json([
                'status' => 400,
                'message' => "Failed to Delete Data"
            ], 400);
        }
    }

    public function selectedPrice($roomId, $roomReview, $roomPrice)
    {
        $selectedRoom = [
            'roomId' => $roomId,
            'roomReview' => $roomReview,
            'roomPrice' => $roomPrice
        ];

        return $selectedRoom;
    }
}
