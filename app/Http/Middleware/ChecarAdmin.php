<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ChecarAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) //Closure vai dizer se a autentificação será permitida ou não
    {   
        $user= Auth::user();
            if($user == null || $user->nivel_user != 0){
                return redirect('/home');
            }
        return $next($request); //deixa continuar
    }
}
