<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table="comments";

    public $fillable = ['sender', 'phone', 'sms', 'otp', 'expire_time'];

    public $timestamps = false;
}
