<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table="users";

    public $fillable = ['name', 'email', 'password', 'created_at', 'updated_at', 'phone'];

    public $timestamps = false;
}
