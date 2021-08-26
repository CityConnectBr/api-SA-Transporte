<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ModalidadeSeeder::class);
        $this->call(TiposDeUsuariosSeeder::class);
        $this->call(CategoriasVeiculosSeeder::class);
        $this->call(TiposSolicitacaoDeAlteracaoSeeder::class);
        $this->call(UserSeeder::class);

        //$this->call(UserSeeder::class);
        /*DB::table('users')->insert([
            'nome' => 'teste',
            'cpf_cnpj' => '000',
            'cnh' => '123',
            'email' => 'teste@teste.com',
            'password' => Hash::make('123456'),
        ]);*/

        for($i = 0;$i < 100;$i++){
            DB::table('municipios')->insert([
                'nome' => "Municipio RJ $i",
                'uf' => 'RJ',
            ]);
        }

        for($i = 0;$i < 100;$i++){
            DB::table('municipios')->insert([
                'nome' => "Municipio MG $i",
                'uf' => 'MG',
            ]);
        }

    }
}
