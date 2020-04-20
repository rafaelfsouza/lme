<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $this->registerPolicies();

        Gate::define('auth', function ($user, $permissao) use ($request) {

            if(!$request || !$request->session()->exists('permissoes')){
                auth()->logout();
            }

            if(in_array($permissao, $request->session()->get('permissoes'))){
                return true;
            }

            return false;

        });
    }
}
