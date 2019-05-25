<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table="news";

    public $fillable = ['sender', 'phone', 'sms', 'otp', 'expire_time'];

    public $timestamps = false;
}
