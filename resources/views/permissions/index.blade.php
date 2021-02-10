@extends('layouts.app')

@section('title', 'Permissões')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @include('components.alerts')
            <div class="card shadow mb-4">
                <div class="card-header py-3 card-header--list">
                    <h6 class="m-0 font-weight-bold text-primary">Permissões</h6>
                    <a class="btn btn-primary btn-sm" href="{{ route('permissions.create') }}">
                        Adicionar Novo</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <caption>Mostrando de {{ $permissions->firstItem() ?? 0 }} até
                                {{ $permissions->lastItem() ?? 0}}
                                de {{$permissions->total()}} registros</caption>
                            <thead>
                                <tr>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Alias</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->description }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <form action="{{ route('permissions.destroy',$permission->id) }}" method="POST"
                                            class="delete" id="form-delete-{{$permission->id}}">
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
                                                        href="{{ route('permissions.show', ['id' => $permission->id]) }}">Visualizar</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('permissions.edit', ['id' => $permission->id]) }}">Editar</a>
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
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
