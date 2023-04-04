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
            $table->double('status');//(pendente, pago, cancelado, aguardando_confirmacao)
            $table->string('arquivo_comprovante_uid')->nullable();
            $table->string('data_envio_comprovante')->nullable();
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
        });
    }
}
