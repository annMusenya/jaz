<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Writer as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure; use App\User;

class Writer
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
        if(!Auth::check()){
            return redirect('/writer/login');
        }else{
            $userId = Auth::id();
            $userRole = User::where('id',$userId)->value('category');
            $result = str_replace(array('[',']'),' ',$userRole);
            if($result == 2){
                return $next($request);
            }else{
                auth()->logout(); 
                return redirect('/writer/login');
            }  
        }
    }
}
