<?php

namespace App\Models;
use Illuminate\database\Eloquent\Model;

class User_login extends Model{
    protected $fillable = [
        'email',
        'password',
        'role',
        'status'
    ]
}