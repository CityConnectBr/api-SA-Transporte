<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTipoSolicitacaoAlteracao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipos_solicitacao_de_alteracao', function (Blueprint $table) {
            $table->string('desc_arquivo5', 60)->nullable();
            $table->string('desc_arquivo6', 60)->nullable();
            $table->string('desc_arquivo7', 60)->nullable();
            $table->string('desc_arquivo8', 60)->nullable();
            $table->string('desc_arquivo9', 60)->nullable();
            $table->string('desc_arquivo10', 60)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::alter('tipos_solicitacao_de_alteracao', function (Blueprint $table) {
            $table->dropColumn('desc_arquivo5');
            $table->dropColumn('desc_arquivo6');
            $table->dropColumn('desc_arquivo7');
            $table->dropColumn('desc_arquivo8');
            $table->dropColumn('desc_arquivo9');
            $table->dropColumn('desc_arquivo10');
        });
    }
}