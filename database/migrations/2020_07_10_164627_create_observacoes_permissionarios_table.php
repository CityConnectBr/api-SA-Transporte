<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservacoesPermissionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacoes_permissionarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_integracao')->nullable()->unique();
            $table->string('titulo', 40);
            $table->string('observacao', 500);
            $table->integer('permissionario_id')->unsigned();
            $table->timestamps();
            $table->foreign('permissionario_id')->references('id')->on('permissionarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observacoes_permissionarios');
    }
}
