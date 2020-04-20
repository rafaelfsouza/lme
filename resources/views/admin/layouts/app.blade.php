<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} :: Admin</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div>

    <div class="container-fluid bg-white">
        <div class="row py-3">
            <div class="col-6">
                <a href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('images/admin/logo-admin.png') }}" class="img-fluid">
                </a>
            </div>

            <div class="col-6 text-right mt-2">
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="menu-usuario" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        Olá {{ Auth::user()->nome }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="menu-usuario">
                        <a href="{{ route('admin.senha') }}" class="dropdown-item">
                            <span class="m-nav__link-text">Alterar Senha</span>
                        </a>
                        <a href="{{ route('admin.logout') }}" class="dropdown-item"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sair</a>

                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <nav class="navbar justify-content-end text-right navbar-expand-lg navbar-dark bg-primary" id="menu-topo">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu"
                aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">Home</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.lme.index') }}" class="nav-link admin-lme">LME</a>
                </li>

                @if(Gate::check('auth', 'usuarios.visualizar') || Gate::check('auth', 'perfis.visualizar'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle admin-usuarios admin-perfis" href="#" id="menu-usuarios" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Usuários
                        </a>
                        <div class="dropdown-menu" aria-labelledby="menu-usuarios">
                            @can('auth', 'usuarios.visualizar')<a href="{{ route('admin.usuarios.index') }}" class="dropdown-item admin-usuarios">Usuários</a>@endcan
                            @can('auth', 'perfis.visualizar')<a href="{{ route('admin.perfis.index') }}" class="dropdown-item admin-perfis">Perfis de Acesso</a>@endcan
                        </div>
                    </li>
                @endif

            </ul>
        </div>
    </nav>

</div>

<div style="background: white;" class="m-3 p-3 shadow-sm">
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {

        @php
            $rota = explode('.', Route::currentRouteName());
            array_pop($rota);
            $rota = implode('-', $rota);
        @endphp

        $('.{{ $rota }}').addClass('active');
    })
</script>
@yield('scripts')
@include('admin.partials.alerts')

</body>
</html>
