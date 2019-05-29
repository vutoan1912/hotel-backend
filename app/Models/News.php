<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table="news";

    public $fillable = ['title', 'image', 'description', 'content', 'created_at', 'created_by'];

    public $timestamps = false;
}
