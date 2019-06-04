<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table="comments";

    public $fillable = ['room_id', 'user_id', 'title', 'comment', 'created_at', 'created_by'];

    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo('App\Models\Room', 'room_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
