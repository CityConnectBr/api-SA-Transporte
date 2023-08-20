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
            $table->string('modalidade', 1)->nullable();
        });

        //Adicionando valores faltantes
        DB::table('quadro_de_infracoes')
            ->where('modalidade_id', 3)
            ->update([
                'modalidade' => 't',
            ]);

        DB::table('quadro_de_infracoes')
            ->where('modalidade_id', 2)
            ->update([
                'modalidade' => 'e',
            ]);

        DB::table('quadro_de_infracoes')
            ->where('modalidade_id', 1)
            ->update([
                'modalidade' => 'e',
            ]);

        Schema::table('quadro_de_infracoes', function (Blueprint $table) {
            $table->dropForeign('quadro_de_infracoes_modalidade_id_foreign');
            $table->dropColumn('modalidade_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quadro_de_infracoes', function (Blueprint $table) {
            $table->dropColumn('modalidade');
        });

        //Removendo valores faltantes
        DB::table('quadro_de_infracoes')
            ->update([
                'modalidade' => null,
            ]);

        Schema::table('quadro_de_infracoes', function (Blueprint $table) {
            $table->integer('modalidade_id')->unsigned()->nullable();
            $table->foreign('modalidade_id')->references('id')->on('modalidades');
        });
    }
}