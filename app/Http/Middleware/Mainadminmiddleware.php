<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Mainadminmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if(count(Auth::user()->category) == 0){
            return $next($request); 
        }else{
            return redirect('/');
        }
         
    }
}
