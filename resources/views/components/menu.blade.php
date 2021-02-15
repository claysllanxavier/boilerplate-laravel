@canany(['post_categories_view'])
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNews" aria-expanded="true"
        aria-controls="collapseNews">
        <i class="fas fa-fw fa-newspaper"></i>
        <span>Notícias</span>
    </a>
    <div id="collapseNews" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @can('post_categories_view')
            <a class="collapse-item" href="{{ route('post_categories.index') }}">Categorias</a>
            @endcan
        </div>
    </div>
</li>
@endcanany
@canany(['users_view', 'roles_view', 'permissions_view'])
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true"
        aria-controls="collapseSix">
        <i class="fas fa-fw fa-user-lock"></i>
        <span>Gerenciamento</span>
    </a>
    <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @can('users_view')
            <a class="collapse-item" href="{{ route('users.index') }}">Usuários</a>
            @endcan
            @can('roles_view')
            <a class="collapse-item" href="{{ route('roles.index') }}">Atribuições</a>
            @endcan
            @can('permissions_view')
            <a class="collapse-item" href="{{ route('permissions.index') }}">Permissões</a>
            @endcan
        </div>
    </div>
</li>
@endcanany
