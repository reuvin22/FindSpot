<?php

namespace App\Http\Controllers\API\v1\UserData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\request\wishListRequest;
use App\Http\Resources\API\v1\wishListResource;
use App\Models\wishList;
use Illuminate\Http\Request;

class wishListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return wishList::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(wishListRequest $request)
    {
        $wishList = wishList::create($request->validated());
        return $wishList;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $wishList = wishList::find($id);
        return new wishListResource($wishList);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(wishListRequest $request, string $id)
    {
        $wishList = wishList::find($id);
        $update = $wishList->update($request->validated());
        if($update){
            return response()->json([
                'status' => 200,
                'message' => "Data Updated Successfully"
            ], 200);
        }else {
            return response()->json([
                'status' => 400,
                'message' => "Failed to Update Data"
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wishList = wishList::find($id);
        $update = $wishList->delete();
        if($update){
            return response()->json([
                'status' => 200,
                'message' => "Data Deleted Successfully"
            ], 200);
        }else {
            return response()->json([
                'status' => 400,
                'message' => "Failed to Delete Data"
            ], 400);
        }
    }
}
