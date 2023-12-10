<?php

namespace App\Models;

use App\Models\Rooms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomPricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'roomId',
        'roomPrice'
    ];

    /**
     * Get the user that owns the RoomPricing
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(Rooms::class, 'id');
    }
    public function wishList()
    {
        return $this->belongsTo(wishList::class, 'roomId');
    }
}
