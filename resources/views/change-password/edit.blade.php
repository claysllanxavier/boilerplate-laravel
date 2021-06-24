@extends('layouts.app')

@section('title', 'Alterar Senha')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @include('components.alerts')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Alterar Senha</h6>
                </div>
                <div class="card-body">
                    {!!Form::open(['route' => ['change-password.update'], 'method' => 'PUT'])!!}
                    @include('change-password._forms')
                    <div class="row">
                        <div class="col-12 text-right mt-3">
                            <button type="submit" class="btn btn-primary">Alterar</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
