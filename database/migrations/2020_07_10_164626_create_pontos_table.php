<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePontosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pontos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_integracao')->nullable()->unique();
            $table->string('descricao', 40);
            $table->string('base_legal', 40);
            $table->string('capacidade_legal', 40);

            $table->string('telefone', 11)->nullable();
            $table->date('data_criacao')->nullable();
            $table->date('data_extincao')->nullable();
            $table->string('ocupacao_atual', 40)->nullable();
            $table->string('observacao', 500)->nullable();
            $table->string('modalidade_transporte', 1)->nullable();

            $table->integer('endereco_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pontos');
    }
}
