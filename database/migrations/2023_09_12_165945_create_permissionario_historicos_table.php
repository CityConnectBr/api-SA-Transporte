<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionarioHistoricosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissionario_historicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('permissionario_id');
            $table->foreign('permissionario_id')
                ->references('id')->on('permissionarios');
            $table->string('campo');
            $table->string('valor_antigo');
            $table->string('valor_novo');
            $table->timestamps();
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
        Schema::dropIfExists('permissionario_historicos');
    }
}
