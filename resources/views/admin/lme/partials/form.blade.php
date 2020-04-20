<div class="row">
    <div class="form-group col-12 col-sm-3">
        <label>*Data</label>
        {{ Form::text('data', null, ['class'=>'form-control datepicker']) }}
    </div>
</div>

<div class="row">
    <div class="form-group col-12 col-sm-3">
        <label>Cobre</label>
        {{ Form::number('valor_copper', null, ['class'=>'form-control', 'step' => '0.01']) }}
    </div>
    <div class="form-group col-12 col-sm-3">
        <label>Zinco</label>
        {{ Form::number('valor_zinc', null, ['class'=>'form-control', 'step' => '0.01']) }}
    </div>
    <div class="form-group col-12 col-sm-3">
        <label>Alumínio</label>
        {{ Form::number('valor_aluminium', null, ['class'=>'form-control', 'step' => '0.01']) }}
    </div>
    <div class="form-group col-12 col-sm-3">
        <label>Chumbo</label>
        {{ Form::number('valor_lead', null, ['class'=>'form-control', 'step' => '0.01']) }}
    </div>
</div>
<div class="row">
    <div class="form-group col-12 col-sm-3">
        <label>Estanho</label>
        {{ Form::number('valor_tin', null, ['class'=>'form-control', 'step' => '0.01']) }}
    </div>
    <div class="form-group col-12 col-sm-3">
        <label>Níquel</label>
        {{ Form::number('valor_nickel', null, ['class'=>'form-control', 'step' => '0.01']) }}
    </div>
    <div class="form-group col-12 col-sm-3">
        <label>Dólar</label>
        {{ Form::number('valor_dolar', null, ['class'=>'form-control', 'step' => '0.0001']) }}
    </div>
</div>

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
                    data: {
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
