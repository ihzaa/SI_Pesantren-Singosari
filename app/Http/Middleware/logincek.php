<?php

namespace App\Http\Middleware;

use Closure;

class logincek
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
        $usr = \App\user::where('username',$request->username)->first();

        if($usr->role == 1){
            return redirect('/login');
        }
        if($usr->role == 2){
            return redirect('/login');
        }
        if($usr->role == 3){
            return redirect('/login');
        }

        return $next($request);
    }
}
