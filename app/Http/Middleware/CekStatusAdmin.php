<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Closure;

class CekStatusAdmin
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

        if (Session::get('adminlogin')) {
            return $next($request);
        } else {
            return redirect('4dm1n/login');
        }
    }
}
