<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



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
        $this->call(UserTypeSeeder::class);

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
