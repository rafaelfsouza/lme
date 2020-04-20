@extends('admin.layouts.app')

@section('content')

    <div class="p-3">
        <div class="row">
            <div class="col-12 col-md-7">
                <div class="mr-auto">
                    <h3>LME</h3>
                </div>
            </div>
            <div class="col-8 col-md-3 col-lg-4">
                <form action="{{ route('admin.lme.index') }}">
                    <input type="text" name="s" value="{{ request('s') }}" class="form-control" placeholder="Busca...">
                    @if(request('s'))
                        <a href="{{ route('admin.lme.index') }}" class="text-danger">Limpar busca <i class="fas fa-times"></i></a>
                    @endif
                </form>
            </div>
            <div class="col-4 col-md-2 col-lg-1">
                @can('auth', 'lme.inserir')
                <a href="{{ route('admin.lme.create') }}" class="btn btn-block btn-outline-primary" data-toggle="tooltip" data-placement="left" title="Inserir">
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
                                <th scope="col">Data</th>
                                <th scope="col">Cobre</th>
                                <th scope="col">Zinco</th>
                                <th scope="col">Alumínio</th>
                                <th scope="col">Chumbo</th>
                                <th scope="col">Estanho</th>
                                <th scope="col">Níquel</th>
                                <th scope="col">Dolar</th>
                                <th scope="col" class="text-right">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listagem as $row)
                                <tr>
                                    <td><a href="{{ route('admin.lme.edit', ['id' => $row->id]) }}">{{ $row->data }}</a></td>
                                    <td>{{ $row->valor_copper }}</td>
                                    <td>{{ $row->valor_zinc }}</td>
                                    <td>{{ $row->valor_aluminium }}</td>
                                    <td>{{ $row->valor_lead }}</td>
                                    <td>{{ $row->valor_tin }}</td>
                                    <td>{{ $row->valor_nickel }}</td>
                                    <td>{{ $row->valor_dolar }}</td>
                                    <td>
                                        <div class="row no-gutters justify-content-end">
                                            @can('auth', 'lme.editar')
                                            <a href="{{ route('admin.lme.edit', ['id' => $row->id]) }}" class="btn btn-link btn-sm text-primary mr-1" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('auth', 'lme.excluir')
                                            <button class="btn btn-link btn-sm text-danger btn-delete" data-label="{{ $row->data }}" data-url="{{ route('admin.lme.destroy', $row->id) }}" data-toggle="tooltip" data-placement="left" title="Deletar">
                                                <i class="far fa-trash-alt"></i></button>
                                            @endcan
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
