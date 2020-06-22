@extends('layouts.app')

@section('title', 'Esqueci minha senha')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            @include('components.alerts')
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Esqueceu sua senha?</h1>
                                    <p class="mb-4">
                                        Entendemos, as coisas acontecem. Basta digitar seu endereço de e-mail abaixo e
                                        nós lhe enviaremos um link para redefinir sua senha!</p>
                                </div>
                                <form class="user" method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email"
                                            class="form-control form-control-user @error('email') is-invalid @enderror"
                                            placeholder="Email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus>
                                        @include('errors.input', ['field' => 'email'])
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Enviar link de redefinição de senha
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">Já tem uma conta? Conecte-se!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
