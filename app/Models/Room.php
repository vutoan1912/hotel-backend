<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table="rooms";

    public $fillable = ['name', 'image', 'description', 'content', 'rate', 'point', 'cost', 'link', 'reviews', 'created_at', 'created_by'];

    public $timestamps = false;

    public function roomImages()
    {
        return $this->hasMany('App\Models\RoomImages', 'room_id', 'id');
    }
}
