<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Tipo;

class TipoController extends Controller{
    public function register(Request $request){
        $this->validate($request, [
            'nombre'=>'required'
        ]);

        $data = $request->all();
        try{
            $t = new Tipo;
            $t->nombre = $data['nombre'];
            $t->save();
            return response()->json(['Message'=>'Tipo de producto creado correctamente'],201);
        }catch(\Exception $e){
            return response()->json(['Message'=>'Error al crear tipo de producto','Error'=>$e],409);
        }
    }

    public function obtenerTipos(){
        $t = Tipo::all();
        return response()->json(['Tipos'=>$t],200);
    }

    public function obtenerTipoId($id_tipo){
        $t = Tipo::findOrFail($id_tipo);
        return response()->json(['Tipo'=>$t],200);
    }
}
