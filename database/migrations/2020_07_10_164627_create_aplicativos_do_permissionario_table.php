<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAplicativosDoPermissionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicativos_do_permissionario', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('permissionario_id')->unsigned()->nullable();
            $table->integer('aplicativo_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('permissionario_id')->references('id')->on('permissionarios')->onDelete('cascade');
            $table->foreign('aplicativo_id')->references('id')->on('aplicativos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aplicativos_do_permissionario');
    }
}
