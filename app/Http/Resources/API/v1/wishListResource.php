<?php

namespace App\Http\Resources\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\v1\Rooms\RoomResource;
use App\Models\RoomImages;
use App\Models\RoomPricing;
use App\Models\RoomReview;

class wishListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "userId" => $this->userId,
            "roomId" => $this->roomId,
            "roomDescriptions" => new RoomResource($this->room),
            "roomImages" => RoomImages::collection($this->roomImages),
            "roomReview" => RoomReview::collection($this->roomReviews),
            "roomPricing" => new RoomPricing($this->roomPricing)
        ];
    }
}
