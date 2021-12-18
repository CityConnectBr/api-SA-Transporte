<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnexosDoCondutorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anexos_do_condutor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao')->nullable()->unique();
            $table->string('descricao', 60);
            $table->string('original_file_name', 200);
            $table->string('file_name', 60);
            $table->integer('condutor_id')->unsigned();
            $table->timestamps();
            $table->foreign('condutor_id')->references('id')->on('condutores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anexos_do_condutor');
    }
}
