@extends('admin.layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            @can('auth', 'lme.visualizar')
                <div class="col-6 col-sm-4 col-md-3 text-center">
                    <a href="{{ route('admin.lme.index') }}" class="card m-2 py-3" style="text-decoration: none">
                        <i class="fas fa-6x fa-layer-group"></i>
                        <br>
                        LME
                    </a>
                </div>
            @endcan

            @can('auth', 'usuarios.visualizar')
                <div class="col-6 col-sm-4 col-md-3 text-center">
                    <a href="{{ route('admin.usuarios.index') }}" class="card m-2 py-3" style="text-decoration: none">
                        <i class="fas fa-6x fa-user"></i>
                        <br>
                        Usuários
                    </a>
                </div>
            @endcan

        </div>

    </div>
@endsection
@section('scripts')

@endsection
