<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use App\User;
class UserMiddleware
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
        if (Sentinel::check()){
           
           
             if(Sentinel::getUser()->roles()->first()->slug == 'customer' ){
                
                 return $next($request);
            
            }
            else{
                $user=Sentinel::getUser();
                 Sentinel::logout($user,true);
                 return redirect('/');
            }
        }
        else{
        return redirect('/');
        }
        
    }
}
