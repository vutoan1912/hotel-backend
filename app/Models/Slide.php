<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table="slides";

    public $fillable = ['sender', 'phone', 'sms', 'otp', 'expire_time'];

    public $timestamps = false;
}
