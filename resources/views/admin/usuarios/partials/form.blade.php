<div class="row">
    <div class="form-group col-12 col-sm-12 col-lg-4">
        <label for="email">*Perfil</label>
        {{ Form::select('perfil_id', $perfis, null, ['class'=>'form-control', 'placeholder' => 'Selecione']) }}
    </div>
    <div class="form-group col-12 col-sm-6 col-lg-4">
        <label>*Nome</label>
        {{ Form::text('nome', null, ['class'=>'form-control']) }}
    </div>
    <div class="form-group col-12 col-sm-6 col-lg-4">
        <label for="email">*E-mail</label>
        {{ Form::email('email', null, ['class'=>'form-control']) }}
    </div>
</div>
<div class="row">
    <div class="form-group col-12 col-sm-5">
        <label for="password">Senha</label>
        {{ Form::password('password', ['class'=>'form-control', 'id'=>'password']) }}
    </div>
    <div class="form-group col-12 col-sm-5">
        <label for="password_confirm">Confirmar Senha</label>
        {{ Form::password('password_confirmation', ['class'=>'form-control', 'id'=>'password_confirmation']) }}
    </div>
    <div class="col-12 col-sm-2 custom-control custom-checkbox">
        <label for="ativo">Ativo</label>
        <div class="form-check">
            {{ Form::hidden('ativo', 0) }}
            @if(isset($usuario))
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
<div class="row">
    <div class="form-group col-12">
        <button class="btn btn-outline-primary">Salvar</button>
    </div>
</div>
@section('scripts')
    <script>
        $(document).ready(function () {
            let $validation = $("#form-crud").validate({
                rules: {
                    nome: {
                        required: true
                    },
                    email: {
                        required: true, email: true
                    },
                    perfil_id: {
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
