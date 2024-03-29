<?php

namespace App\Http\Middleware;

use Closure;

class PreflightResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $headers = [
           'Access-Control-Allow-Origin'  => '*',
           'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
           'Access-Control-Allow-Credentials'=> 'true',
           'Access-Control-Max-Age'          => '86400',
           'Access-Control-Allow-Headers'=> 'AccountKey,X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Host, Date, Cookie, Cookie2, Access-Control-Allow-Origin'];
        if ($request->isMethod('OPTIONS'))
        {
            return response()->json('OK', 200, $headers);
        }    
        $response = $next($request);
        foreach($headers as $key => $value)
        {
            $response->header($key, $value);
        }    
        return $response;
    }
}