<?php

namespace App\Http\Controllers\Hotel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    protected $table="news";

    public $fillable = ['sender', 'phone', 'sms', 'otp', 'expire_time'];

    public $timestamps = false;
}
