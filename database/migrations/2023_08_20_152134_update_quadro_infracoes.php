<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateQuadroInfracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quadro_de_infracoes', function (Blueprint $table) {
            $table->string('codigo', 10)->nullable();
        });

        //passar os valores de id_integracao para codigo
        DB::table('quadro_de_infracoes')
            ->update([
                'codigo' => DB::raw('id_integracao'),
            ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quadro_de_infracoes', function (Blueprint $table) {
            $table->dropColumn('codigo');
        });

        DB::table('quadro_de_infracoes')
            ->update([
                'codigo' => null,
            ]);
    }
}