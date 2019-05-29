<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table="slides";

    public $fillable = ['name', 'image', 'status', 'created_at', 'created_by', 'updated_at'];

    public $timestamps = false;
}
