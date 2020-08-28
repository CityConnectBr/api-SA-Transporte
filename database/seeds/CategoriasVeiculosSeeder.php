<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasVeiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias_veiculos')->insert([
            'id' => '1',
            'nome' => 'veículo',
        ]);
        DB::table('categorias_veiculos')->insert([
            'id' => '2',
            'nome' => 'ônibus',
        ]);
    }
}
