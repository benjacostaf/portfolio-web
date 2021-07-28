<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presupuestos_producto extends Model{
    protected $fillable = [
        'id',
        'id_presupuesto',
        'id_producto',
        'cantidad'
    ];
}