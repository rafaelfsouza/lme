@extends('admin.layouts.app')

@section('content')

    <div class="p-3">
        <div class="row">
            <div class="col-8 col-md-10 col-lg-11">
                <div class="mr-auto">
                    <h3>Perfis de Acesso :: Visualizar</h3>
                </div>
            </div>
            <div class="col-4 col-md-2 col-lg-1">
                <a href="{{ route('back') }}" class="btn btn-block btn-outline-danger" data-toggle="tooltip" data-placement="left" title="Voltar">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>

        {{ Form::model($perfil, ['route' => ['admin.perfis.show', $perfil->id], 'method' => 'PUT','id' => 'form-crud']) }}
            <div class="row justify-content-center mt-5">
                <div class="col-10">
                    <div class="row">
                        <div class="form-group col-12 col-md-10">
                            <label>Perfil</label>
                            {{ Form::text('perfil', null, ['class'=>'form-control', 'disabled']) }}
                        </div>
                        <div class="form-group col col-md-2">
                            <label for="ativo">Ativo</label>
                            {{ Form::text('ativo', $perfil->ativo ? 'Sim' : 'Não', ['class'=>'form-control', 'disabled']) }}
                        </div>
                    </div>
                    @foreach($modulos as $modulo)

                        <div class="row">
                            <div class="col-8 card mb-3 p-2 offset-1">
                                {{ $modulo->modulo }}
                                <div class="row">
                                    @foreach($modulo->acoes as $acao)
                                        <div class="col-3">
                                            <div class="custom-control custom-checkbox">
                                                {{ Form::checkbox('permissoes[]', $acao->id, null, ['id' => 'acao'.$acao->id, 'class' => ['custom-control-input', \Illuminate\Support\Str::slug($modulo->modulo)],'disabled']) }}
                                                <label class="custom-control-label" for="acao{{ $acao->id }}">
                                                    {{ $acao->acao }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-10">
                    <div class="row no-gutters justify-content-end">
                        @can('auth', 'perfis.editar')<a href="{{ route('admin.perfis.edit', ['id' => $perfil->id]) }}" class="btn btn-outline-primary mr-2">Editar <i class="fas fa-pencil-alt"></i></a>@endcan
                        @can('auth', 'perfis.excluir')<button type="button" data-label="{{ $perfil->perfil }}" data-url="{{ route('admin.perfis.destroy', $perfil->id) }}" class="btn btn-outline-danger btn-delete">Excluir <i class="far fa-trash-alt"></i></button>@endcan
                    </div>
                </div>
            </div>

        {{ Form::close() }}
    </div>
@endsection
