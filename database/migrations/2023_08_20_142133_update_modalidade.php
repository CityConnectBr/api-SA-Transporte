<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateModalidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modalidades', function (Blueprint $table) {
            $table->string('tipo', 1)->nullable();
        });

        //Adicionando valores faltantes
        DB::table('modalidades')
            ->where('id', 3)
            ->update([
                'tipo' => 't',
            ]);

        DB::table('modalidades')
            ->where('id', 2)
            ->update([
                'tipo' => 'e',
            ]);

        DB::table('modalidades')
            ->where('id', 1)
            ->update([
                'tipo' => 'e',
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modalidades', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });

        //Removendo valores faltantes
        DB::table('modalidades')
            ->update([
                'tipo' => null,
            ]);
    }
}