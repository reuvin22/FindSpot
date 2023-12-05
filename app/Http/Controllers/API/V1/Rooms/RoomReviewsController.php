<?php

namespace App\Http\Controllers\API\V1\Rooms;

use App\Models\RoomReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\v1\Rooms\RoomReviewResource;
use App\Http\Requests\API\v1\Request\RoomReviewsRequest;

class RoomReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RoomReview::all()->paginate(8);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomReviewsRequest $request)
    {
        $data = $request->validated();
        $review = RoomReview::create($data);
        return new RoomReviewResource($review);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = RoomReview::find($id);
        return new RoomReviewResource($review);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomReviewsRequest $request, string $id)
    {
        $review = RoomReview::find($id);
        $rooms = $review->update($request->validated());

        return response()->json([
            'status' => 200,
            'message' => 'Data Updated Successfully',
            'data' => $review
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = RoomReview::find($id);
        $delete = $review->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Deleted Successfully'
        ], 200);
    }
}
