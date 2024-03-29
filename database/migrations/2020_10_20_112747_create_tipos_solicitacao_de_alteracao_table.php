<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposSolicitacaoDeAlteracaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_solicitacao_de_alteracao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 40)->unique();
            $table->string('nome_campo1', 40)->nullable();
            $table->string('nome_campo2', 40)->nullable();
            $table->string('nome_campo3', 40)->nullable();
            $table->string('nome_campo4', 40)->nullable();
            $table->string('nome_campo5', 40)->nullable();
            $table->string('nome_campo6', 40)->nullable();
            $table->string('nome_campo7', 40)->nullable();
            $table->string('nome_campo8', 40)->nullable();
            $table->string('nome_campo9', 40)->nullable();
            $table->string('nome_campo10', 40)->nullable();
            $table->string('nome_campo11', 40)->nullable();
            $table->string('nome_campo12', 40)->nullable();
            $table->string('nome_campo13', 40)->nullable();
            $table->string('nome_campo14', 40)->nullable();
            $table->string('nome_campo15', 40)->nullable();
            $table->string('nome_campo16', 40)->nullable();
            $table->string('nome_campo17', 40)->nullable();
            $table->string('nome_campo18', 40)->nullable();
            $table->string('nome_campo19', 40)->nullable();
            $table->string('nome_campo20', 40)->nullable();
            $table->string('desc_campo1', 40)->nullable();
            $table->string('desc_campo2', 40)->nullable();
            $table->string('desc_campo3', 40)->nullable();
            $table->string('desc_campo4', 40)->nullable();
            $table->string('desc_campo5', 40)->nullable();
            $table->string('desc_campo6', 40)->nullable();
            $table->string('desc_campo7', 40)->nullable();
            $table->string('desc_campo8', 40)->nullable();
            $table->string('desc_campo9', 40)->nullable();
            $table->string('desc_campo10', 40)->nullable();
            $table->string('desc_campo11', 40)->nullable();
            $table->string('desc_campo12', 40)->nullable();
            $table->string('desc_campo13', 40)->nullable();
            $table->string('desc_campo14', 40)->nullable();
            $table->string('desc_campo15', 40)->nullable();
            $table->string('desc_campo16', 40)->nullable();
            $table->string('desc_campo17', 40)->nullable();
            $table->string('desc_campo18', 40)->nullable();
            $table->string('desc_campo19', 40)->nullable();
            $table->string('desc_campo20', 40)->nullable();
            $table->string('regex_campo1', 60)->nullable();
            $table->string('regex_campo2', 60)->nullable();
            $table->string('regex_campo3', 60)->nullable();
            $table->string('regex_campo4', 60)->nullable();
            $table->string('regex_campo5', 60)->nullable();
            $table->string('regex_campo6', 60)->nullable();
            $table->string('regex_campo7', 60)->nullable();
            $table->string('regex_campo8', 60)->nullable();
            $table->string('regex_campo9', 60)->nullable();
            $table->string('regex_campo10', 60)->nullable();
            $table->string('regex_campo11', 60)->nullable();
            $table->string('regex_campo12', 60)->nullable();
            $table->string('regex_campo13', 60)->nullable();
            $table->string('regex_campo14', 60)->nullable();
            $table->string('regex_campo15', 60)->nullable();
            $table->string('regex_campo16', 60)->nullable();
            $table->string('regex_campo17', 60)->nullable();
            $table->string('regex_campo18', 60)->nullable();
            $table->string('regex_campo19', 60)->nullable();
            $table->string('regex_campo20', 60)->nullable();
            $table->string('regex_campo21', 60)->nullable();
            $table->string('regex_campo22', 60)->nullable();
            $table->string('regex_campo23', 60)->nullable();
            $table->string('regex_campo24', 60)->nullable();
            $table->string('regex_campo25', 60)->nullable();
            $table->string('desc_arquivo1', 60)->nullable();
            $table->string('desc_arquivo2', 60)->nullable();
            $table->string('desc_arquivo3', 60)->nullable();
            $table->string('desc_arquivo4', 60)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_solicitacao_de_alteracao');
    }
}
