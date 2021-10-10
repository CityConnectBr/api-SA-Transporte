<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDeMoedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('moedas')->insert([
            'nome' => 'REAL',
        ]);
    }
}
