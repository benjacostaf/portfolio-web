<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Fabricante;

class FabricanteController extends Controller{
    public function register(Request $request){
        $this->validate($request, [
            'nombre'=>'required'
        ]);

        $data = $request->all();
        try{
            $t = new Fabricante;
            $t->nombre = $data['nombre'];
            $t->save();
            return response()->json(['Message'=>'Fabricante de producto creado correctamente'],201);
        }catch(\Exception $e){
            return respoonse()->json(['Message'=>'Error al crear Fabricante de producto','Error'=>$e],409);
        }
    }

    public function obtenerFabricantes(){
        $t = Fabricante::all();
        return response()->json(['Fabricantes'=>$t],200);
    }

    public function obtenerFabricanteId($id_fabricante){
        $t = Fabricante::findOrFail($id_fabricante);
        return response()->json(['Fabricante'=>$t],200);
    }
}
