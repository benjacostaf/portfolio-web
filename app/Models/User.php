<?php

namespace App\Models;
use Illuminate\database\Eloquent\Model;

class User extends Model{
    protected $fillable = [
        'email',
        'surname',
        'name',
        'phone',
        'dni',
        'postal_code',
        'locale',
        'address'
    ]
}