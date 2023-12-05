<?php

namespace App\Http\Resources\API\v1\Rooms;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\v1\Rooms\RoomImagesResource;
use App\Http\Resources\API\v1\Rooms\RoomReviewResource;

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
            'roomImages' => new RoomImagesResource($this->roomImages),
            'roomReviews' => new RoomReviewResource($this->roomReviews)
        ];
    }
}
