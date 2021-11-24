<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DefenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createPermissions();
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

    private function createPermissions()
    {
        // Seed the default permissions
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission['name']
            ], [
                'description' => $permission['description']
            ]);
        }

        $this->command->info('Default Permissions added.');
    }
}
