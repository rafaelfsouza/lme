@extends('admin.layouts.app')

@section('content')

    <div class="p-3">
        <div class="row">
            <div class="col-12 col-md-7">
                <div class="mr-auto">
                    <h3>Usuários</h3>
                </div>
            </div>
            <div class="col-8 col-md-3 col-lg-4">
                <form action="{{ route('admin.usuarios.index') }}">
                    <input type="text" name="s" value="{{ request('s') }}" class="form-control" placeholder="Busca...">
                    @if(request('s'))
                        <a href="{{ route('admin.usuarios.index') }}" class="text-danger">Limpar busca <i class="fas fa-times"></i></a>
                    @endif
                </form>
            </div>
            <div class="col-4 col-md-2 col-lg-1">
                @can('auth', 'usuarios.inserir')
                <a href="{{ route('admin.usuarios.create') }}" class="btn btn-block btn-outline-primary" data-toggle="tooltip" data-placement="left" title="Inserir">
                    <i class="fas fa-plus"></i>
                </a>
                @endcan
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                @if(count($listagem))
                    <div class="table-responsive">
                        <table class="table table-hover shadow-sm">
                            <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Perfil</th>
                                <th scope="col" class="text-right">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listagem as $row)
                                <tr {{ $row->ativo ? '' : 'class=table-danger' }}>
                                    <td><a href="{{ route('admin.usuarios.show', ['id' => $row->id]) }}">{{ $row->nome }}</a></td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->perfil ? $row->perfil->perfil : '-' }}</td>
                                    <td>
                                        <div class="row no-gutters justify-content-end">
                                            <a href="{{ route('admin.usuarios.show', ['id' => $row->id]) }}" class="btn btn-link btn-sm text-success mr-1" data-toggle="tooltip" data-placement="left" title="Informações">
                                                <i class="fas fa-search"></i>
                                            </a>
                                            @can('auth', 'usuarios.editar')
                                            <a href="{{ route('admin.usuarios.edit', ['id' => $row->id]) }}" class="btn btn-link btn-sm text-primary mr-1" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @if($row->id_raw != auth()->id())
                                                @can('auth', 'usuarios.excluir')
                                                <button class="btn btn-link btn-sm text-danger btn-delete" data-label="{{ $row->nome }}" data-url="{{ route('admin.usuarios.destroy', $row->id) }}" data-toggle="tooltip" data-placement="left" title="Deletar">
                                                    <i class="far fa-trash-alt"></i></button>
                                                @endcan
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center">Nenhum registro encontrado!</p>
                @endif
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-auto">
                {{ $listagem->appends(['s' => request('s')])->links() }}
            </div>
        </div>
    </div>
@endsection
