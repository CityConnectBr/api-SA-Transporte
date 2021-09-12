<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AplicativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aplicativos')->insert([
            'descricao' => '99Taxis',
        ]);
        DB::table('aplicativos')->insert([
            'descricao' => 'ABCRADIOTAXI',
        ]);
        DB::table('aplicativos')->insert([
            'descricao' => 'EASY',
        ]);
        DB::table('aplicativos')->insert([
            'descricao' => 'WAPPA',
        ]);
    }
}
