<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosDePermissionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_de_permissionarios', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data_emissao');
            $table->integer('permissionarios_id')->unsigned();
            $table->integer('tipo_do_curso_id')->unsigned();
            $table->timestamps();
            $table->foreign('permissionarios_id')->references('id')->on('permissionarios')->onDelete('cascade');
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
        Schema::dropIfExists('cursos_de_permissionarios');
    }
}