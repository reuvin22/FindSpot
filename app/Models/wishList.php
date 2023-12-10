<?php

namespace App\Models;

use App\Models\Rooms;
use App\Models\RoomImages;
use App\Models\RoomReview;
use App\Models\RoomPricing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class wishList extends Model
{
    use HasFactory;

    protected $fillable = [
        'roomId'
    ];

    /**
     * Get all of the comments for the wishList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms()
    {
        return $this->hasMany(Rooms::class, 'id');
    }
    public function roomImages()
    {
        return $this->hasMany(RoomImages::class, 'roomId');
    }
    public function roomPricing()
    {
        return $this->hasMany(RoomPricing::class, 'roomId');
    }
    public function roomReview()
    {
        return $this->hasMany(RoomReview::class, 'roomId');
    }
}
