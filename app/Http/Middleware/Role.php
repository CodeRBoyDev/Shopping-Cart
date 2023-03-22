<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        
        $user = Auth::user();
        // if( $user->isAdmin){
        //         return $next($request);
        //     }
        // dd($user->role);
        // dd($roles);
        foreach($roles as $role) {
              // dd($user->hasRole($role));
            if($user->role == $role){
                return $next($request);
             }
        }
        return redirect()->back(); 
    }
}
