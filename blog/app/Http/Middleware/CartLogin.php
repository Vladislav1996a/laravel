<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CartLogin
{
    
    public function handle($request, Closure $next)
    {
       if(Auth::check()){
            return back()->withInput();
       }
    }
}
