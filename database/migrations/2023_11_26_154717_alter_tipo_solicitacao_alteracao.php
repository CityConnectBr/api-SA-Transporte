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
            $table->boolean('nao_obrigatorio_arquivo1')->nullable();
            $table->boolean('nao_obrigatorio_arquivo2')->nullable();
            $table->boolean('nao_obrigatorio_arquivo3')->nullable();
            $table->boolean('nao_obrigatorio_arquivo4')->nullable();
            $table->boolean('nao_obrigatorio_arquivo5')->nullable();
            $table->boolean('nao_obrigatorio_arquivo6')->nullable();
            $table->boolean('nao_obrigatorio_arquivo7')->nullable();
            $table->boolean('nao_obrigatorio_arquivo8')->nullable();
            $table->boolean('nao_obrigatorio_arquivo9')->nullable();
            $table->boolean('nao_obrigatorio_arquivo10')->nullable();
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
            $table->dropColumn('nao_obrigatorio_arquivo1');
            $table->dropColumn('nao_obrigatorio_arquivo2');
            $table->dropColumn('nao_obrigatorio_arquivo3');
            $table->dropColumn('nao_obrigatorio_arquivo4');
            $table->dropColumn('nao_obrigatorio_arquivo5');
            $table->dropColumn('nao_obrigatorio_arquivo6');
            $table->dropColumn('nao_obrigatorio_arquivo7');
            $table->dropColumn('nao_obrigatorio_arquivo8');
            $table->dropColumn('nao_obrigatorio_arquivo9');
            $table->dropColumn('nao_obrigatorio_arquivo10');
        });
    }
}