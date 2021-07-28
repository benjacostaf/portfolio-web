<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model{
    protected $fillable = [
        'id',
        'nombre',
        'id_categoria',
        'id_fabricante',
        'id_propiedad',
        'id_tipo',
        'img_paths',
        'descripcion',
        'estado'
    ];
}