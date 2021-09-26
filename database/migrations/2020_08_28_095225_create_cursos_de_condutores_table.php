<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosDeCondutoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_de_condutores', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data_emissao');
            $table->integer('condutor_id')->unsigned();
            $table->integer('tipo_do_curso_id')->unsigned();
            $table->timestamps();
            $table->foreign('condutor_id')->references('id')->on('condutores');
            $table->foreign('tipo_do_curso_id')->references('id')->on('tipos_de_curso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos_de_condutores');
    }
}
