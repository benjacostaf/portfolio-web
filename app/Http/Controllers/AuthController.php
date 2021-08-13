<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User_login;
use App\Models\User;

class AuthController extends Controller{
    /**
     * Store a new user admin
     *  */

     public function registerAdmin(Request $request){
         //Validate incoming request
         $this->validate($request,[
             'email' => 'required|unique:user_logins',
             'password' => 'required'
         ]);

         $data = $request->all();

         try{
             $user_login = new User_login;
             $user_login->email = $data['email'];
             $plainPassword = $data['password'];
             $user_login->password = app('hash')->make($plainPassword);
             $user_login->role = 1;
             $user_login->status = 1;

             $user_login->save();
             return response()->json(['Message'=>'OK'],201);
         }catch(\Exception $e){
             return response()->json(['Message'=>'Error', 'Error'=>$e],409);
         }
     }


     public function registerCustomer(Request $request){
         $this->validate($request, [
            'email' => 'required|unique:users',
            'surname' => 'required',
            'name'=> 'required',
            'phone'=> 'required',
            'dni'=> 'required',
            'postal_code'=> 'required',
            'address'=> 'required',
            'locale'=> 'required'
         ]);

         $data = $request->all();
         try{
             $user = new User;
             $user->email = $data['email'];
             $user->surname = $data['surname'];
             $user->name = $data['name'];
             $user->phone = $data['phone'];
             $user->dni = $data['dni'];
             $user->postal_code = $data['postal_code'];
             $user->address = $data['address'];
             $user->locale = $data['locale'];
             $user->status = 1;
             $user->save();

             return response()->json(['Message'=>'OK'],201);
         }catch(\Exception $e){
             return response()->json(['Message'=>'Error', 'Error'=>$e],409)
         }
     }

     //admin login

     public function adminLogin(Request $request){
         $this->validate($request, [
             'email' => 'required',
             'password' => 'required'
         ]);

         $data = $request->all();
         $credentials = $request->only(['email', 'password']);
         $u = User_login::where('email', $data['email'])->first();
         if(! $token = Auth::attempt($credentials) OR $u->status == 0){
             return response()->json(['Message'=>'No Autorizado'],401);
         }else{
             return response()->json(['Message'=>$data['email'], 'token' => $this->respondWithToken($token), 'id_login'=>])
         }
     }
}