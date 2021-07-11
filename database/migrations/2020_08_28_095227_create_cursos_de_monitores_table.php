<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosDeMonitoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_de_monitores', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data_emissao');
            $table->integer('monitor_id')->unsigned();
            $table->integer('tipo_do_curso_id')->unsigned();
            $table->timestamps();
            $table->foreign('monitor_id')->references('id')->on('monitores')->onDelete('cascade');
            $table->foreign('tipo_do_curso_id')->references('id')->on('tipos_de_curso')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos_de_monitores');
    }
}
