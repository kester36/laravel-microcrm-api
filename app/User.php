<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $hidden = ['password'];

    protected $fillable = ['first_name', 'last_name', 'email', 'password'];
}
