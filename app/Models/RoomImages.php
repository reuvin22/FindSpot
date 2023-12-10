<?php

namespace App\Models;

use App\Models\Rooms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'roomId',
        'roomImages'
    ];

    /**
     * Get the user that owns the RoomImages
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rooms()
    {
        return $this->belongsTo(Rooms::class, 'id');
    }
    public function wishList()
    {
        return $this->belongsTo(wishList::class, 'roomId');
    }
}
