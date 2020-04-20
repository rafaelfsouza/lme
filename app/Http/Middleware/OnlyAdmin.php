<?php

namespace App\Http\Middleware;

use Closure;

class OnlyAdmin
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

//        if (auth()->user()->empresa_id){
//
//            session()->flash('warning', 'Seu usuário não tem permissão para acessar esse recurso.');
//
//            return redirect()->route('admin.dashboard');
//        }

        return $next($request);

    }

}
