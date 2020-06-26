<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!app()->environment('production')) :
            // Impede que seed seja executado em ambiente de produção
            $this->createLocal();
        endif;

        if (app()->environment('production')) :
        // seeds especiais para o ambiente de produção
        endif;
    }

    private function createLocal()
    {
        $user = User::create([
            'email' => 'admin@app.com',
            'name'  => 'Usuário Administrador',
            'password' => bcrypt('admin')
        ]);

        $user->assignRole('administrador');
    }
}
