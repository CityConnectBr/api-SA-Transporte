<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlvaraDoPermissionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alvara_do_permissionario', function (Blueprint $table) {
            $table->increments('id');

            $table->date('data_emissao')->nullable();
            $table->date('data_vencimento')->nullable();
            $table->date('data_retorno')->nullable();
            $table->string('observacao_retorno', 15)->nullable();

            $table->integer('permissionario_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('permissionario_id')->references('id')->on('permissionarios');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alvara_do_permissionario');
    }
}
