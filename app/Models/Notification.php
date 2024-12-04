<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'receiver_id', 'type', 'message', 'is_read'];

    // Relationship: Sender of the notification
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relationship: Receiver of the notification
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
