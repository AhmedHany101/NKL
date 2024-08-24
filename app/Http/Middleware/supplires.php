<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class supplires
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) 
        {
            if(Auth::user()->role_as == 'Supplier$012!_1$')
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
