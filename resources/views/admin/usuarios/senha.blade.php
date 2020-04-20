@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-8 col-md-10 col-lg-11">
                <div class="mr-auto">
                    <h3>Usuários :: Atualizar Senha</h3>
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
                {{ Form::model($usuario, ['route' => ['admin.senha.update', $usuario->id], 'method' => 'PUT','id' => 'form-crud']) }}
                <div class="row">
                    <div class="form-group col-12 col-sm-6">
                        <label>Nome</label>
                        {{ Form::text('nome', null, ['class'=>'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-12 col-sm-6">
                        <label for="email">E-mail</label>
                        {{ Form::email('email', null, ['class'=>'form-control', 'disabled']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-sm-6">
                        <label for="password">*Senha</label>
                        {{ Form::password('password', ['class'=>'form-control', 'id'=>'password']) }}
                    </div>
                    <div class="form-group col-12 col-sm-6">
                        <label for="password_confirm">*Confirmar Senha</label>
                        {{ Form::password('password_confirmation', ['class'=>'form-control', 'id'=>'password_confirmation']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <button class="btn btn-outline-primary">Salvar</button>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            let $validation = $("#form-crud").validate({
                rules: {
                    password: {
                        required: true
                    }, password_confirmation: {
                        required: true
                    }
                }
            });
            @if(isset($errors))
            $validation.showErrors({!! $errors !!})
            @endif

        });
    </script>


@endsection
