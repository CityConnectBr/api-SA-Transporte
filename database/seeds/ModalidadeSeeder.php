<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modalidades')->insert([
            'id' => '1',
            'identificador' => 'e',
            'descricao' => 'Escolar Privado',
            'tipo'=>'e',
            'limite'=>3
        ]);
        DB::table('modalidades')->insert([
            'id' => '2',
            'identificador' => 'g',
            'descricao' => 'Gratuito (Escolar)',
            'tipo'=>'e',
            'limite'=>3
        ]);
        DB::table('modalidades')->insert([
            'id' => '3',
            'identificador' => 't',
            'descricao' => 'Taxi',
            'tipo'=>'t',
            'limite'=>5
        ]);
    }
}
