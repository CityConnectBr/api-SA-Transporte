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
            'cadastro_usuario' => true,
            'cadastro_perfil' => true,
            'cadastro_principais' => true,
            'cadastro_tabelas_base' => true,
            'lancamentos' => true,
            'impressos' => true,
            'relatorios' => true,
            'mensagens' => true,
        ]);

        DB::table('usuarios')->insert([
            //'id' => '1',
            'nome' => 'Admin',
            'email' => 'admin@admin.com',
            'perfil_web_id' => 1,
            'tipo_id' => 4,
            'password' => bcrypt('123456'),
        ]);
    }
}