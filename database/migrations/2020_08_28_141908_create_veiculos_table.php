<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao',11)->nullable()->unique();
            $table->string('placa', 7)->nullable()->default('');
            $table->string('cod_renavam', 11)->nullable();
            $table->string('chassi', 25)->nullable();
            $table->integer('ano_fabricacao')->nullable();
            $table->integer('ano_modelo')->nullable();
            $table->string('capacidade', 15)->nullable();
            $table->string('tipo_capacidade', 1)->nullable();
            $table->string('observacao_capacidade', 40)->nullable();
            $table->integer('anos_vida_util_veiculo')->nullable();

            //exclusivo para onibus
            $table->string('prefixo', 15)->nullable();
            $table->integer('marca_modelo_carroceria_id')->nullable()->unsigned();
            $table->integer('marca_modelo_chassi_id')->nullable()->unsigned();

            //
            $table->integer('marca_modelo_veiculo_id')->nullable()->unsigned();
            $table->integer('tipo_combustivel_id')->nullable()->unsigned();
            $table->integer('cor_id')->nullable()->unsigned();
            $table->integer('tipo_veiculo_id')->nullable()->unsigned();
            $table->integer('permissionario_id')->nullable()->unsigned();
            $table->integer('categoria_id');

            $table->timestamps();
            $table->foreign('marca_modelo_carroceria_id')->references('id')->on('marcas_modelos_carrocerias');
            $table->foreign('marca_modelo_chassi_id')->references('id')->on('marcas_modelos_chassis');
            $table->foreign('marca_modelo_veiculo_id')->references('id')->on('marcas_modelos_veiculos');
            $table->foreign('tipo_combustivel_id')->references('id')->on('tipos_combustiveis');
            $table->foreign('cor_id')->references('id')->on('cores_veiculos');
            $table->foreign('tipo_veiculo_id')->references('id')->on('tipos_veiculos');
            $table->foreign('permissionario_id')->references('id')->on('permissionarios');
            $table->foreign('categoria_id')->references('id')->on('categorias_veiculos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veiculos');
    }
}
