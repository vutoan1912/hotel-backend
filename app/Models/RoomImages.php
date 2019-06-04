<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomImages extends Model
{
    protected $table="room_images";

    public $fillable = ['room_id', 'link', 'description', 'created_at', 'created_by'];

    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo('App\Models\Room', 'room_id');
    }
}
