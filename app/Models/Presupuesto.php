<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model{
    protected $fillable = [
        'id',
        'nombre',
        'apellido',
        'email',
        'phone',
        'localidad',
        'direccion'
    ];
}