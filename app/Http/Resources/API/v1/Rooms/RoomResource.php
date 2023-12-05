<?php

namespace App\Http\Resources\API\v1\Rooms;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'roomId' => $this->roomId,
            'descriptions' => $this->descriptions,
            'roomImages' => new RoomImagesResource($roomImages),
            'roomReviews' => new RoomReviewsResource($roomReviews)
        ];
    }
}
