<?php

namespace App\Http\Controllers\API\v1\Rooms;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomImages;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class RoomImagesController extends Controller
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
        $roomId = $data['roomId'];
        $roomImages = $data['roomImages'];

        $uploadedImages = [];

        foreach ($roomImages as $base64Image) {
            $decodedImage = base64_decode($base64Image);
            $filename = 'localImages/' . Str::uuid() . '.png';
            Storage::disk('local')->put($filename, $decodedImage);
            RoomImages::create([
                'roomId' => $roomId,
                'roomImages' => $filename,
            ]);
            $uploadedImages[] = [
                'roomImages' => $filename,
            ];
        }

        return response()->json([
            'message' => 'Room Images Uploaded Successfully',
            'roomId' => $roomId,
            'images' => $uploadedImages,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $roomImages = $data['roomImages'];

        $uploadedImages = [];

        foreach ($roomImages as $base64Image) {
            $decodedImage = base64_decode($base64Image);
            $filename = 'localImages/' . Str::uuid() . '.png';
            Storage::disk('local')->put($filename, $decodedImage);

            $roomImage = RoomImages::find($id);
            $roomImage->roomImages = $filename;
            $roomImage->save();

            $uploadedImages[] = [
                'roomImages' => $filename,
            ];
        }

        return response()->json([
            'message' => 'Room Images Updated Successfully',
            'roomImages' => $uploadedImages,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roomId, $imageId)
    {
        $roomImage = RoomImages::find($imageId);
        Storage::disk('local')->delete($roomImage->filename);
        $roomImage->delete();

        return response()->json([
            'message' => 'Room Image Deleted Successfully',
            'roomId' => $roomId,
            'imageId' => $imageId,
        ]);
    }
}
