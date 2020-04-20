@extends('admin.layouts.app')

@section('content')

    <div class="p-3">
        <div class="row">
            <div class="col-8 col-md-10 col-lg-11">
                <div class="mr-auto">
                    <h3>Usuários :: Visualizar</h3>
                </div>
            </div>
            <div class="col-4 col-md-2 col-lg-1">
                <a href="{{ route('back') }}" class="btn btn-block btn-outline-danger" data-toggle="tooltip" data-placement="left" title="Voltar">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-10">
                {{ Form::model($usuario, ['route' => ['admin.usuarios.show', $usuario->id], 'method' => 'PUT','id' => 'form-crud']) }}
                <div class="row">
                    <div class="form-group col-12 col-sm-6">
                        <label>Nome</label>
                        {{ Form::text('nome', null, ['class'=>'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-12 col-sm-6">
                        <label for="email">E-mail</label>
                        {{ Form::email('email', null, ['class'=>'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-12 col-sm-6">
                        <label for="perfil_id">Perfil</label>
                        {{ Form::text('perfil_id', $usuario->perfil ? $usuario->perfil->perfil : '-', ['class'=>'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-12 col-sm-6">
                        <label for="ativo">Ativo</label>
                        {{ Form::text('ativo', $usuario->ativo ? 'Sim' : 'Não', ['class'=>'form-control', 'disabled']) }}
                    </div>
                </div>
                <div class="row no-gutters justify-content-end">
                    @can('auth', 'usuarios.editar')<a href="{{ route('admin.usuarios.edit', ['id' => $usuario->id]) }}" class="btn btn-outline-primary mr-2">Editar <i class="fas fa-pencil-alt"></i></a>@endcan
                    @can('auth', 'usuarios.excluir') <button type="button" data-label="{{ $usuario->nome }}" data-url="{{ route('admin.usuarios.destroy', $usuario->id) }}" class="btn btn-outline-danger btn-delete">Excluir <i class="far fa-trash-alt"></i></button>@endcan
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
