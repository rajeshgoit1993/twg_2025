<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use App\User;
class LoginMiddleware
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
           
           
             if(Sentinel::getUser()->roles()->first()->slug == 'super_admin' || Sentinel::getUser()->roles()->first()->slug == 'administrator' || Sentinel::getUser()->roles()->first()->slug == 'supervisor' || Sentinel::getUser()->roles()->first()->slug == 'agent'){
                
                 return $next($request);
             }else if(Sentinel::getUser()->roles()->first()->slug == 'customer'){
                  return $next($request);
            }else if(Sentinel::getUser()->roles()->first()->slug == 'employee'){
                  return $next($request);
            }
            else{

                 return redirect('/');
            }
        }
        else{
        return redirect('/');
        }
        
    }
}
