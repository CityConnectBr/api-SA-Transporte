<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosDoMonitorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_do_monitor', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data_emissao');
            $table->integer('monitor_id')->unsigned();
            $table->integer('tipo_do_curso_id')->unsigned();
            $table->timestamps();
            $table->foreign('monitor_id')->references('id')->on('monitores');
            $table->foreign('tipo_do_curso_id')->references('id')->on('tipos_de_curso');

            $table->softDeletes();
            $table->boolean('ativo')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos_do_monitor');
    }
}
