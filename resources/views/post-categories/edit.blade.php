@extends('layouts.app')

@section('title', 'Categoria de Notícias')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Categoria de Notícias</h6>
                </div>
                <div class="card-body">
                    {!!Form::model($postCategory, ['route' => ['post_categories.update', $postCategory->id], 'method' => 'PUT'])!!}
                    @include('post-categories._form')
                    <div class="row">
                        <div class="col-12 text-right mt-3">
                            <a href="{{ route('post_categories.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
