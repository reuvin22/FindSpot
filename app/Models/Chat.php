<?php

namespace App\Models;

use App\Models\User;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'chat';
    protected $fillable = [
        'conversationId',
        'userId',
        'fullName',
        'message',
        'receiverId'
    ];

    /**
     * Get the user that owns the Chat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
