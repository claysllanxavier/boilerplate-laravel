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
                    {!! Form::open(['route' => 'users.store']) !!}
                    @include('users._form')
                    <div class="row">
                        <div class="col-12 text-right mt-3">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
