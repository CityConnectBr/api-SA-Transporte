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

        //$this->call(UserSeeder::class);
        DB::table('users')->insert([
            'CNH' => '123456',
            'password' => Hash::make('123456'),
        ]);

    }
}
