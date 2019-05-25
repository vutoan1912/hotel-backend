<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table="abouts";

    public $fillable = ['image', 'description', 'content', 'created_at', 'created_by'];

    public $timestamps = false;
}
