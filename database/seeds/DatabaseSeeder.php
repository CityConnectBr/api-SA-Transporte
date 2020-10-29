<?php

use Illuminate\Database\Seeder;



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

        //$this->call(UserSeeder::class);
        /*DB::table('users')->insert([
            'nome' => 'teste',
            'cpf_cnpj' => '000',
            'cnh' => '123',
            'email' => 'teste@teste.com',
            'password' => Hash::make('123456'),
        ]);*/

    }
}
