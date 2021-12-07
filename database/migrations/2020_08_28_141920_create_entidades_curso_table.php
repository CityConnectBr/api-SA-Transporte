<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntidadesCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidades_curso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao',11)->nullable()->unique();
            $table->string('descricao',40);
            $table->string('base_legal',40)->nullable();

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
        Schema::dropIfExists('entidades_curso');
    }
}
