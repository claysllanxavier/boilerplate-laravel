@extends('layouts.app')

@section('title', 'Atribuições')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Atribuições</h6>
                </div>
                <div class="card-body">
                    <div class="card-deck">
                        <div class="card m-1">
                            <div class="card-body">
                                <p><strong>Descrição: </strong></p>
                                <p class="card-text">
                                    {{ $role->description }}
                                </p>
                            </div>
                        </div>
                        <div class="card m-1">
                            <div class="card-body">
                                <p><strong>Alias: </strong></p>
                                <p class="card-text">
                                    {{ $role->name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-deck">
                        <div class="card m-1">
                            <div class="card-body">
                                <p><strong>Data de Criação: </strong></p>
                                <p class="card-text">
                                    {{ $role->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class="card m-1">
                            <div class="card-body">
                                <p><strong>Data de Atualizacção: </strong></p>
                                <p class="card-text">
                                    {{ $role->updated_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right mt-4">
                        <a href="{{ route('roles.index') }}" class="btn btn-primary">
                            Voltar
                        </a>
                        <a href="{{ route('roles.edit', ['id' => $role->id ]) }}" class="btn btn-warning">
                            Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
