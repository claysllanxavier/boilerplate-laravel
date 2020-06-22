@extends('layouts.app')

@section('title', 'Atribuições')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @include('components.alerts')
            <div class="card shadow mb-4">
                <div class="card-header py-3 card-header--list">
                    <h6 class="m-0 font-weight-bold text-primary">Atribuições</h6>
                    <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">
                        Adicionar Novo</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <caption>Mostrando de {{ $roles->firstItem() ?? 0 }} até {{ $roles->lastItem() ?? 0}}
                                de {{$roles->total()}} registros</caption>
                            <thead>
                                <tr>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Alias</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $role->description }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <form action="{{ route('roles.destroy',$role->id) }}" method="POST"
                                            class="delete" id="form-delete-{{$role->id}}">
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
                                                        href="{{ route('roles.show', ['id' => $role->id]) }}">Visualizar</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('roles.edit', ['id' => $role->id]) }}">Editar</a>
                                                    <a class="dropdown-item btn-delete" href="#">Excluir</a>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" style="text-align: center; font-size: 1.1em;">
                                        Nenhum informação cadastrado.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
