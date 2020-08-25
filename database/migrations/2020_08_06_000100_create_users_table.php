<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('email')->unique();
            $table->string('cpf_cnpj', 14);
            $table->string('cnh', 11)->nullable();
            $table->string('codigo_de_recuperacao', 6)->nullable();
            $table->timestamp('data_hora_ultimo_codigo_de_recuperacao')->nullable();
            $table->string('password');
            $table->integer('tipo_id');
            $table->integer('permissionario_id')->nullable()->unsigned();
            //$table->integer('condutor_auxiliar_id')->unsigned();
            //$table->integer('fiscal_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('tipo_id')->references('id')->on('tipos_de_usuarios');
            $table->foreign('permissionario_id')->references('id')->on('permissionarios');
            //$table->foreign('condutor_auxiliar_id')->references('id')->on('condutores_auxiliares');
            //$table->foreign('fiscal_id')->references('id')->on('fiscais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
