<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Login_user;
use App\Models\User;

class AuthController extends Controller{
    /**
     * Store a new user-credentials
     * 
     * @param Request $request
     * @return Response
     */
    public function register(Request $request){
        //validate incoming request
        $this->validate($request, [
            'username' => 'required|string|unique:login_users',
            'password' => 'required',
            'role' => 'required',
            'surname' => 'required',
            'name' => 'required',
            'phone' => 'required'
        ]);


                try{
                    $user_login = new Login_user;
                    $user_login->username = $request->input('username');
                    $plainPassword = $request->input('password');
                    $user_login->password = app('hash')->make($plainPassword);
                    $user_login->role = $request->input('role');
                    $user_login->status = 1;
                    $user_login->save();

                    $user = new User;
                    $user->id_login_user = $user_login['id'];
                    $user->surname = $request->input('surname');
                    $user->name = $request->input('name');
                    $user->phone = $request->input('phone');
                    $user->save();
                    //return successful response
                    return response()->json(['user_login' => $user_login,'user' => $user, 'message' => 'CREATED'],201);
                } catch(\Exception $e){
                    //return error message
                    return response()->json(['message' => 'User Credentials Registration Failed!'], 409);
                }        
    }

    public function userRegister(Request $request){
        //Validate incoming request
        $this->validate($request, [
            'username' => 'required|string|unique:login_users',
            'password' => 'required',
            'surname' => 'required',
            'role' => 'required',
            'name' => 'required',
            'phone' => 'required|unique:users'
        ]);              
          $data = $request->all();

        try{
            $user_login = new Login_user;
            $user_login->username = $data['username'];
            $plainPassword = $data['password'];
            $user_login->password = app('hash')->make($plainPassword);
            $user_login->role = $data['role'];
            $user_login->status = 1;
            $user_login->save();
            $user = new User;
            $user->id_login_user = $user_login['id'];
            $user->surname = $data['surname'];
            $user->name = $data['name'];
            $user->phone = $data['phone'];
            $user->score = 0;
            $user->img_path = 'default.jpg';
            $user->save();

            return response()->json(['message' => 'CREATED'], 201);
        } catch(\exception $e){
            return response()->json(['message'=>'User registration failed', 'error'=>$e], 409);
        }
    }

    /**
     * Get a JWT via given credentials.
     * 
     * @param Request $request
     * @return Response
     */
    public function login(Request $request){
        //validate incoming Request
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $data = $request->all();
        $credentials = $request->only(['username','password']);
        $u = Login_user::where('username',$data['username'])->first();
        if(! $token = Auth::attempt($credentials) OR $u->status == 0 ){
            return response()->json(['message' => 'Unauthorized'],401);
        }
        return response()->json(['Message'=>$data['username'],'token'=> $this->respondWithToken($token), 'id_login'=>$u->id, 'role'=>$u->role],201);
        /* $this->respondWithToken($token,$request->username,$u->id); */
    }

    public function forgotPassword(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ]);

        $data = $request->all();

        try{
            $me = 'Error';
            $log_user = Login_user::select('id')->where('username',$data['username'])->first();
            $phone = User::select('phone')->where('id_login_user',$log_user->id)->first();
            if($phone->phone == $data['phone']){
                $password = app('hash')->make($data['password']);
                $upd = Login_user::where('username',$data['username'])->update(['password'=>$password]);
                $me = 'OK';
            }
            return response()->json(['Message'=>$me],201);
        }catch(\Exception $e){
            return response()->json(['Message'=>'Error al cambiar contraseña','Error'=>$e],409);
        }
    }

    /* public function lastUser(){
        try{
            $lastUser = User_login::latest()->first();
            return response()->json(['Last UserLogin' => $lastUser], 200);
        }catch(\Exception $e){
            return response()->json(['Error' => $e],409);
        }
    } */
}
