<div class="row">
    <div class="form-group col-12">
        <label>*Perfil</label>
        {{ Form::text('perfil', null, ['class'=>'form-control']) }}
    </div>
    <div class="col-12 col-sm-2 custom-control custom-checkbox">
        <label for="ativo">Ativo</label>
        <div class="form-check">
            {{ Form::hidden('ativo', 0) }}
            @if(isset($perfil))
                {{ Form::checkbox('ativo', 1, null, ['id' => 'ativo', 'class' => 'custom-control-input']) }}
            @else
                {{ Form::checkbox('ativo', 1, true, ['id' => 'ativo', 'class' => 'custom-control-input']) }}
            @endif
            <label class="custom-control-label" for="ativo">
                Sim
            </label>
        </div>
    </div>
</div>

@foreach($modulos as $modulo)

    <div class="row">
        <div class="col-8 card mb-3 p-2 offset-1">
            {{ $modulo->modulo }}
            <div class="row justify-content-around">
                <div class="col-auto">
                    <i class="fas fa-check-double check-modulo" data-target="{{ \Illuminate\Support\Str::slug($modulo->modulo) }}" data-toggle="tooltip" data-placement="left" title="Marcar Todos"></i>
                </div>
                @foreach($modulo->acoes as $acao)
                    <div class="col-auto">
                        <div class="custom-control custom-checkbox">
                            {{ Form::checkbox('permissoes[]', $acao->id, null, ['id' => 'acao'.$acao->id, 'class' => ['custom-control-input', \Illuminate\Support\Str::slug($modulo->modulo)]]) }}
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

<div class="row justify-content-end">
    <div class="form-group col-auto">
        <button class="btn btn-outline-primary">Salvar</button>
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.check-modulo').click(function () {
                let target = $(this).data('target')
                $(`.${target}`).prop('checked', function(_, checked) {
                    return !checked
                })
            })


            let $validation = $("#form-crud").validate({
                rules: {
                    perfil: {
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
