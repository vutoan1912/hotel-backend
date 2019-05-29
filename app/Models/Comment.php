<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table="comments";

    public $fillable = ['room_id', 'user_id', 'title', 'comment', 'created_at', 'created_by'];

    public $timestamps = false;
}
