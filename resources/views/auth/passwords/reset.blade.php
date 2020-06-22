@extends('layouts.app')

@section('title', 'Resetar Senha')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                @include('components.alerts')
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Resetar Senha</h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group">
                                        <input type="email" name="email"
                                            class="form-control form-control-user @error('email') is-invalid @enderror"
                                            placeholder="Email" value="{{ $email ?? old('email') }}" required
                                            autocomplete="email" autofocus>
                                        @include('errors.input', ['field' => 'email'])
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            name="password" required placeholder="Nova Senha">
                                        @include('errors.input', ['field' => 'password'])
                                    </div>
                                    <div class="form-group">
                                        <input id="password_confirmation" type="password"
                                            class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" required placeholder="Confirmar Senha">
                                        @include('errors.input', ['field' => 'password_confirmation'])
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Resetar Senha
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
