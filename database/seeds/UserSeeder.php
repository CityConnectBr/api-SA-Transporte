<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfis')->insert([
            //'id' => '1',
            'nome' => 'admin',
            'incluir' => true,
            'alterar' => true,
            'excluir' => true,
            'consultar' => true,
            'imprimir' => true,
        ]);

        DB::table('usuarios')->insert([
            //'id' => '1',
            'nome' => 'Admin',
            'email' => 'admin@admin.com',
            'perfil_web_id' => 1,
            'password' => bcrypt('123456'),
        ]);
    }
}
