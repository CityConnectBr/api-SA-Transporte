<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntidadeAssociativaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entidades_associativa')->insert([
            'descricao' => 'SINDTAXI',
            'id_integracao' => 1,
        ]);

        DB::table('entidades_associativa')->insert([
            'descricao' => 'SITEM',
            'id_integracao' => 2,
        ]);
    }
}
