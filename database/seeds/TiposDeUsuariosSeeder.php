<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposDeUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_de_usuarios')->insert([
            'id' => '1',
            'nome' => 'permissionário',
        ]);
        DB::table('tipos_de_usuarios')->insert([
            'id' => '2',
            'nome' => 'condutor',
        ]);
        DB::table('tipos_de_usuarios')->insert([
            'id' => '3',
            'nome' => 'fiscal',
        ]);
        DB::table('tipos_de_usuarios')->insert([
            'id' => '4',
            'nome' => 'responável',
        ]);
    }
}
