<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposDeCertidaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_de_certidao')->insert([
            'descricao' => 'IPI',
        ]);
        DB::table('tipos_de_certidao')->insert([
            'descricao' => 'ICMS',
        ]);
        DB::table('tipos_de_certidao')->insert([
            'descricao' => 'PADRÃO',
        ]);
    }
}
