<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prop_chapa extends Model{
    protected $fillable = [
        'id',
        'forma',
        'numero',
        'tamaño'
    ];
}