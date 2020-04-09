<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Adminmiddleware
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
      //  dd(Auth::user()->is_admin == 1);
        if(Auth::user()->is_admin == 1){
           return $next($request); 
        }else{
            return redirect('404');
        }
        
    }
}
