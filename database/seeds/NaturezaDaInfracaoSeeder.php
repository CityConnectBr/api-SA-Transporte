<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NaturezaDaInfracaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('naturezas_da_infracao')->insert([
            'id' => '1',
            'descricao' => "Advertência",
        ]);
        DB::table('naturezas_da_infracao')->insert([
            'id' => '2',
            'descricao' => "Multa Leve",
        ]);
        DB::table('naturezas_da_infracao')->insert([
            'id' => '3',
            'descricao' => "Multa Média",
        ]);
        DB::table('naturezas_da_infracao')->insert([
            'id' => '4',
            'descricao' => "Multa Grave",
        ]);
        DB::table('naturezas_da_infracao')->insert([
            'id' => '5',
            'descricao' => "Multa Gravíssima",
        ]);
        DB::table('naturezas_da_infracao')->insert([
            'id' => '6',
            'descricao' => "Cassação Permanente",
        ]);
    }
}
