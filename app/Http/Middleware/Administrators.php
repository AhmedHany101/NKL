<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Administrators
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   //main admin=>1!_1$
        //support (answer the qution)=>@1$0S
        //support (update tracking data)=>%2_1@s
        if (Auth::check()) 
        {
            $admin=env('admin');
            $admin2=env('admin2');
            $admin3=env('admin3');

            if(Auth::user()->role_as == $admin || Auth::user()->role_as == $admin2 || Auth::user()->role_as == $admin3)
            {
                return $next($request);
            }else{
                return response(view('users_pages/errors-404'), 404);

            }
            
        } else {
            // User is not authenticated or does not have the appropriate role
            return response(view('users_pages/errors-404'), 404);
        }
    }
}
