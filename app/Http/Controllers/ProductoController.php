<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Prop_ceramico;
use App\Models\Prop_blangino;
use App\Models\Prop_pastina;
use App\Models\Prop_chapa;
use App\Models\Prop_hierro;
use App\Models\Prop_otro;


class ProductoController extends Controller{


    public function register(Request $request){
        $this->validate($request,[
            'id_categoria'=>'required',
            'id_tipo'=>'required',
            'id_fabricante'=>'required'
        ]);

        $data = $request->all();

        try{
            $p = new Producto;
            $p->name = $data['nombre'];
            $p->id_categoria = $data['id_categoria'];
            $p->id_fabricante = $data['id_fabricante'];
            $p->id_tipo = $data['id_tipo'];
            switch ($data['id_tipo']) {
                case '1':
                    #Ceramicos
                    $prop = new Prop_ceramico;
                    $prop->color = $data['color'];
                    $prop->dim = $data['dim'];
                    $prop->uso = $data['uso'];
                    $prop->terminacion = $data['terminacion'];
                    $prop->id_pastina = $data['id_pastina'];
                    $prop->save();
                    $p->id_propiedad = $prop->id;
                    break;
                case '2':
                    #Blangino
                    $prop = new Prop_blangino;
                    $prop->dim  = $data['dim'];
                    $prop->peso_unitario = $data['peso_unitario'];
                    $prop->peso_m2 = $data['peso_m2'];
                    $prop->terminacion = $data['terminacion'];
                    $prop->uso = $data['uso'];
                    $prop->cant_m2 = $data['cant_m2'];
                    $prop->id_pastina = $data['id_pastina'];
                    $prop->save();
                    $p->id_propiedad = $prop->id;
                    break;
                case '3':
                    #Pastina
                    $prop = new Prop_pastina;
                    $prop->color = $data['color'];
                    $prop->junta = $data['junta'];
                    $prop->tamaño = $data['tamaño'];
                    $prop->save();
                    $p->id_propiedad = $prop->id;
                    break;
                case '4':
                    #chapas
                    $prop = new Prop_chapa;
                    $prop->forma = $data['forma'];
                    $prop->numero = $data['numero'];
                    $prop->tamaño = $data['tamaño'];
                    $prop->save();
                    $p->id_propiedad = $prop->id;
                    break;
                case '5':
                    #Hierros
                    $prop = new Prop_hierro;
                    $prop->tamaño = $data['tamaño'];
                    $prop->save();
                    $p->id_propiedad = $prop->id;
                default:
                    # prop otro
                    $prop = new Prop_otro;
                    $prop->dim = $data['dim'];
                    $prop->peso = $data['peso'];
                    $prop->save();
                    $p->id_propiedad = $prop->id;
                    break;
            }
            $p->descripcion = $data['descripcion'];
            $p->img_paths = $data['img_paths'];
            $p->estado = 1;
            $p->save();
            return response()->json(['Message'=>'Producto creado correctamente'],201);
        }catch(\Exception $e){
            return response()->json(['Message'=>'Error al crear producto', 'Error'=>$e],409);
        }
    }

    public function obtenerProductos(){
        $p = Producto::all();
        return response()->json(['Productos'=>$p],200);
    }

    public function obtenerProductoId($id){
        $p = Producto::findOrFail($id);
        return response()->json(['Producto'=>$p],200);
    }

    public function obtenerFullProducto($id){
        try{
            $p = Producto::findOrFail($id);
            switch ($p->id_tipo) {
                case '1':
                    #Ceramicos
                    $prop = Prop_ceramico::findOrFail($p->id_propiedad);
                    break;
                case '2':
                    #Blangino
                    $prop = Prop_blangino::findOrFail($p->id_propiedad);
                    break;
                case '3':
                    #Pastina
                    $prop = Prop_pastina::findOrFail($p->id_propiedad);
                    break;
                case '4':
                    #chapas
                    $prop = Prop_chapa::findOrFail($p->id_propiedad);
                    break;
                case '5':
                    #Hierros
                    $prop = Prop_hierro::findOrFail($p->id_propiedad);
                default:
                    # prop otro
                    $prop = Prop_otro::findOrFail($p->id_propiedad);
                    break;
            }
            return response()->json(['Producto'=>$p,'Propiedades'=>$prop],200);
        }catch(\Exception $e){
            return response()->json(['Message'=>'Error al obtener producto','Error'=>$e],409);
        }
    }
      
  /*   public function obtenerProductoCategoria($id_categoria){
        $p = Producto::where('id_categoria',$id_categoria)->paginate(12);
        return response()->json(['Productos'=>$p],200);
    }
 */


    public function obtenerProductoCategoria($id_categoria){
        switch ($id_categoria) {
            case '1':
                #Ceramicos
                /* $prop = Prop_ceramico::findOrFail($p->id_propiedad); */
                break;
            case '2':
                #Blangino
                /* $prop = Prop_blangino::findOrFail($p->id_propiedad); */
                $prop = Producto::where('productos.id_categoria', $id_categoria)->select('productos.*', 'prop_blanginos.dim','prop_blanginos.peso_unitario','prop_blanginos.peso_m2','prop_blanginos.terminacion','prop_blanginos.uso','prop_blanginos.cant_m2')->join('prop_blanginos', 'prop_blanginos.id','=','productos.id_propiedad')->get();
                break;
            case '3':
                #Pastina
                /* $prop = Prop_pastina::findOrFail($p->id_propiedad); */
                $prop = Producto::where('productos.id_categoria', $id_categoria)->select('productos.id','productos.*', 'prop_pastinas.color','prop_pastinas.junta','prop_pastinas.tamaño')->join('prop_pastinas', 'productos.id_propiedad', '=', 'prop_pastinas.id')->get();
                break;
            case '4':
                #chapas
                /* $prop = Prop_chapa::findOrFail($p->id_propiedad); */
                break;
            case '5':
                #Hierros
                /* $prop = Prop_hierro::findOrFail($p->id_propiedad); */
            default:
                # prop otro
                /* $prop = Prop_otro::findOrFail($p->id_propiedad); */
                break;
        }
        return response()->json(['Message'=>'OK','Productos'=>$prop],201);
    }



    public function obtenerProductoActivos(){
        $p = Producto::where('estado',1)->get();
        return response()->json(['Productos'=>$p],200);
    }

        
}