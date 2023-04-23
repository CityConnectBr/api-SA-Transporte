<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInfracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::table('infracoes', function (Blueprint $table) {
            $table->string('tipo_pagamento', 20)->nullable();
            $table->string('chave_pix', 200)->nullable();
            $table->string('codigo_pix', 200)->nullable();
            $table->date('data_pagamento')->nullable();
            $table->string('status', 20);//(pendente, pago, cancelado, aguardando_confirmacao)
            $table->string('arquivo_comprovante_uid')->nullable();
            $table->string('data_envio_comprovante')->nullable();         
            $table->double('valor_fmp_atual')->nullable();
            $table->integer('fmp_id')->nullable();
            $table->integer('qtd_fmp')->nullable();
            $table->double('valor_fmp')->nullable();
            $table->double('valor_final')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('infracoes', function (Blueprint $table) {
            $table->dropColumn('tipo_pagamento');
            $table->dropColumn('chave_pix');
            $table->dropColumn('codigo_pix');
            $table->dropColumn('data_pagamento');
            $table->dropColumn('status');
            $table->dropColumn('arquivo_comprovante_uid');
            $table->dropColumn('data_envio_comprovante');
            $table->dropColumn('valor_fmp_atual');
            $table->dropColumn('fmp_id');
            $table->dropColumn('qtd_fmp');
            $table->dropColumn('valor_fmp');
            $table->dropColumn('valor_final');
        });
    }
}
