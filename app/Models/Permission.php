<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
    public static function defaultPermissions()
    {
        return [
            array('name' => 'permissions_view', 'description' => 'Visualiza Permissões'),
            array('name' => 'permissions_create', 'description' => 'Criar Permissão'),
            array('name' => 'permissions_edit', 'description' => 'Editar Permissão'),
            array('name' => 'permissions_delete', 'description' => 'Deleta Permissão'),
            array('name' => 'roles_view', 'description' => 'Visualiza Atribuições'),
            array('name' => 'roles_create', 'description' => 'Criar Atribuição'),
            array('name' => 'roles_edit', 'description' => 'Editar Atribuição'),
            array('name' => 'roles_delete', 'description' => 'Deleta Atribuição'),
            array('name' => 'users_view', 'description' => 'Visualiza Usuários'),
            array('name' => 'users_create', 'description' => 'Criar Usuário'),
            array('name' => 'users_edit', 'description' => 'Editar Usuário'),
            array('name' => 'users_delete', 'description' => 'Deleta Usuário'),
        ];
    }
}
