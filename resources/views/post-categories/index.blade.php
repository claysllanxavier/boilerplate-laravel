@extends('layouts.app')

@section('title', 'Categoria de Notícias')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @include('components.alerts')
            <div class="card shadow mb-4">
                <div class="card-header py-3 card-header--list">
                    <h6 class="m-0 font-weight-bold text-primary">Categoria de Notícias</h6>
                    <a class="btn btn-primary btn-sm" href="{{ route('post_categories.create') }}">
                        Adicionar Novo</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <caption>Mostrando de {{ $categories->firstItem() ?? 0 }} até
                                {{ $categories->lastItem() ?? 0}}
                                de {{$categories->total()}} registros</caption>
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <form action="{{ route('post_categories.destroy',$category->id) }}"
                                            method="POST" class="delete" id="form-delete-{{$category->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-primary"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                    aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item"
                                                        href="{{ route('post_categories.show', ['id' => $category->id]) }}">Visualizar</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('post_categories.edit', ['id' => $category->id]) }}">Editar</a>
                                                    <a class="dropdown-item btn-delete" href="#">Excluir</a>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                @include('components.list-empty')
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
