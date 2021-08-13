<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Tipo;
use App\Models\Prop_pastina;
use App\Models\Prop_blangino;

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

    public function obtenerFiltros($id_tipo){
        $data = array();
        switch($id_tipo){
            case '2':
                $data1 = Prop_blangino::select('dim')->distinct()->get();
                $data2 = Prop_blangino::select('peso_unitario')->distinct()->get();
                $data3 = Prop_blangino::select('peso_m2')->distinct()->get();
                $data4 = Prop_blangino::select('terminacion')->distinct()->get();
                $data5 = Prop_blangino::select('uso')->distinct()->get();
                $data6 = Prop_blangino::select('cant_m2')->distinct()->get();
                array_push($data, $data1,$data2,$data3,$data4,$data5,$data6);
            break;
            case '3':
                $data1 = Prop_pastina::select('color')->distinct()->get();
                $data2 = Prop_pastina::select('junta')->distinct()->get();
                $data3 = Prop_pastina::select('tamaño')->distinct()->get();
                array_push($data, $data1,$data2,$data3);
            break;
        }
        return response()->json(['Message'=>'OK', 'filters'=>$data],201);
    }
}
