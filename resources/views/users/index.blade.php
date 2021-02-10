@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @include('components.alerts')
            <div class="card shadow mb-4">
                <div class="card-header py-3 card-header--list">
                    <h6 class="m-0 font-weight-bold text-primary">Usuários</h6>
                    <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">
                        Adicionar Novo</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <caption>Mostrando de {{ $users->firstItem() ?? 0 }} até {{ $users->lastItem() ?? 0}}
                                de {{$users->total()}} registros</caption>
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Atribuição</th>
                                    <th scope="col">Ativo</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ insertMask($user->phone, '(##) #####-####') }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->is_enabled ? 'Sim' : 'Não' }}</td>
                                    <td>
                                        <form action="{{ route('users.destroy',$user->id) }}" method="POST"
                                            class="delete" id="form-delete-{{$user->id}}">
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
                                                        href="{{ route('users.show', ['id' => $user->id]) }}">Visualizar</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('users.edit', ['id' => $user->id]) }}">Editar</a>
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
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
