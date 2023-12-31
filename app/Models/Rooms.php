<?php

namespace App\Models;

use App\Models\RoomImages;
use App\Models\RoomReview;
use App\Models\RoomPricing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'descriptions'
    ];

    /**
     * Get all of the comments for the Rooms
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roomReviews()
    {
        return $this->hasMany(RoomReview::class, 'roomId');
    }

    public function roomImages()
    {
        return $this->hasMany(RoomImages::class, 'roomId');
    }

    public function roomPricing()
    {
        return $this->hasMany(RoomPricing::class, 'roomId');
    }

    public function wishList()
    {
        return $this->belongsTo(wishList::class, 'roomId');
    }
}
