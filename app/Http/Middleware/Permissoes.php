<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Impacto\Usuarios\PerfilRepository;

class Permissoes
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
        $rota = Route::current()->getAction()['as'];
        $user = auth()->user();

        if (!$user){
            return abort(401);
        }

        $perfil = new PerfilRepository();
        $acao = $perfil->checkPermissao($user->perfil_id, $rota);

        if($acao){
            return $next($request);
        }

        session()->flash('warning', 'Seu usuário não tem permissão para acessar esse recurso.');

        return redirect()->route('admin.dashboard');

    }
}
