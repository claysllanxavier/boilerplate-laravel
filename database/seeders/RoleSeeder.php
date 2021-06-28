<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles();
    }

    private function createRoles()
    {

        $role = Role::firstOrCreate(
            ['name' => 'administrador'],
            ['description' => 'Administrador']
        );

        $role->permissions()->sync(Permission::all());

        $this->command->info('Admin will have full rights');

        Role::firstOrCreate(
            ['name' => 'user_app'],
            ['description' => 'Usuário APP']
        );
    }
}
