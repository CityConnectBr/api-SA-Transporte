<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissionarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_permissionario_integracao')->unique();
            $table->string('nome', 40);
            $table->string('tipo', 1)->nullable();//J/F
            $table->string('CNPJ', 14)->nullable();
            $table->string('RG', 15)->nullable();
            $table->string('inscricao_municipal', 15)->nullable();
            $table->string('DDD', 2)->nullable();
            $table->string('telefone', 8)->nullable();
            $table->string('telefone2', 9)->nullable();
            $table->string('celular', 9)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('modalidade_transporte', 1)->nullable();
            $table->date('data_nascimento', 100)->nullable();
            $table->string('naturalidade', 15)->nullable();
            $table->string('nacionalidade', 15)->nullable();
            $table->string('CNH', 15)->nullable();
            $table->string('categoria_CNH', 2)->nullable();
            $table->date('vencimento_CNH', 100)->nullable();
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
        Schema::dropIfExists('permissionarios');
    }
}
