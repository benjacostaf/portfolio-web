<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class EmailController extends Controller{
    public function register(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'subject'=> 'required',
            'content'=>'required'
        ]);

        $data = $request->all();
        try{
            Mail::to($data['email'])->send($data['content'])->subject($data['subject']);
            return response()->json(['Message'=>'OK'],200);
        }catch(\Exception $e){
            return response()->json(['Message'=>'Error al crear categoria', 'Error'=>$e],409);
        }
    }
}