@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Usuários</h6>
                </div>
                <div class="card-body">
                    <div class="card-deck">
                        <div class="card m-1">
                            <div class="card-body">
                                <p><strong>Nome: </strong></p>
                                <p class="card-text">
                                    {{ $user->name }}
                                </p>
                            </div>
                        </div>
                        <div class="card m-1">
                            <div class="card-body">
                                <p><strong>CPF: </strong></p>
                                <p class="card-text">
                                    {{ insertMask($user->cpf, '###.###.###-##') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-deck">
                        <div class="card m-1">
                            <div class="card-body">
                                <p><strong>Email: </strong></p>
                                <p class="card-text">
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>
                        <div class="card m-1">
                            <div class="card-body">
                                <p><strong>Telefone: </strong></p>
                                <p class="card-text">
                                    {{ insertMask($user->phone, '(##) #####-####') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-deck">
                        <div class="card m-1">
                            <div class="card-body">
                                <p><strong>Atribuição: </strong></p>
                                <p class="card-text">
                                    {{ $user->role }}
                                </p>
                            </div>
                        </div>
                        <div class="card m-1">
                            <div class="card-body">
                                <p><strong>Ativo: </strong></p>
                                <p class="card-text">
                                    {{ $user->is_enabled ? 'Sim' : 'Não' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-deck">
                        <div class="card m-1">
                            <div class="card-body">
                                <p><strong>Data de Criação: </strong></p>
                                <p class="card-text">
                                    {{ $user->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class="card m-1">
                            <div class="card-body">
                                <p><strong>Data de Atualizacção: </strong></p>
                                <p class="card-text">
                                    {{ $user->updated_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right mt-4">
                        <a href="{{ route('users.index') }}" class="btn btn-primary">
                            Voltar
                        </a>
                        <a href="{{ route('users.edit', ['id' => $user->id ]) }}" class="btn btn-warning">
                            Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
