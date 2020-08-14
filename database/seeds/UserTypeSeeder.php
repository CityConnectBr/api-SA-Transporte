<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            'id' => '1',
            'nome' => 'permissionário',
        ]);
        DB::table('user_types')->insert([
            'id' => '2',
            'nome' => 'condutor',
        ]);
        DB::table('user_types')->insert([
            'id' => '3',
            'nome' => 'fiscal',
        ]);
        DB::table('user_types')->insert([
            'id' => '4',
            'nome' => 'responável',
        ]);
    }
}
