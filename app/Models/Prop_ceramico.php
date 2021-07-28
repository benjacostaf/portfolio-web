<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prop_ceramico extends Model{
    protected $fillable = [
        'id',
        'color',
        'dim',
        'uso',
        'terminacion',
        'id_pastina'
    ];
}