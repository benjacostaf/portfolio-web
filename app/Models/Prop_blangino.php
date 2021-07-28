<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prop_blangino extends Model{
    protected $fillable = [
        'id',
        'dim',
        'peso_unitario',
        'peso_m2',
        'terminacion',
        'uso',
        'cant_m2',
        'id_pastina'
    ];
}