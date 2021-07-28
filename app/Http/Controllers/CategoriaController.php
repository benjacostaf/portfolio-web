<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller{
    public function register(Request $request){
        $this->validate($request,[
            'nombre'=>'required'
        ]);

        $data = $request->all();
        try{
            $cat = new Categoria;
            $cat->nombre = $data['nombre'];
            $cat->save();
            return response()->json(['Message'=>'Categoria creada correctamente'],201);
        }catch(\Exception $e){
            return response()->json(['Message'=>'Error al crear categoria', 'Error'=>$e],409);
        }
    }

    public function obtenerCategorias(){
        $cat = Categoria::all();
        return response()->json(['Categorias'=>$cat],200);
    }

    public function obtenerCategoriaId($id_categoria){
        try{
            $cat = Categoria::findOrFail($id_categoria);
            return response()->json(['Categoria'=>$cat],200);
        }catch(\Exception $e){
            return response()->json(['Message'=>'Error al obtener categoria','Error'=>$e],409);
        }
    }
}