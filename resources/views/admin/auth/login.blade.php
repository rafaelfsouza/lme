@extends('admin.layouts.auth')

@section('content')

        <div class="text-center mb-4">
            <img class="mb-4 img-fluid" src="{{ asset('images/admin/logo-login.png') }}">
        </div>

        <form action="{{ route('admin.login') }}" method="POST" aria-label="{{ __('Login') }}">
            {{ csrf_field() }}

            <div class="form-label-group">
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="E-mail" required autofocus">
                <label for="email">E-mail</label>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                @endif
            </div>

            <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Senha" required>
                <label for="password">Senha</label>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                @endif
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" aria-label="Lembrar de mim" name="remember" class="custom-control-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Lembrar de mim</label>
                    </div>
                </div>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>

            {{--@if (Route::has('admin.password.request'))--}}
                {{--<a class="btn btn-link" href="{{ route('admin.password.request') }}">--}}
                    {{--{{ __('Forgot Your Password?') }}--}}
                {{--</a>--}}
            {{--@endif--}}

        </form>

@endsection
