<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomImages extends Model
{
    protected $table="room_images";

    public $fillable = ['sender', 'phone', 'sms', 'otp', 'expire_time'];

    public $timestamps = false;
}
