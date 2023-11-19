<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSolicitacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacoes_de_alteracao', function (Blueprint $table) {
            $table->string('arquivo5_uid')->nullable();
            $table->string('arquivo6_uid')->nullable();
            $table->string('arquivo7_uid')->nullable();
            $table->string('arquivo8_uid')->nullable();
            $table->string('arquivo9_uid')->nullable();
            $table->string('arquivo10_uid')->nullable();

            $table->foreign('arquivo5_uid')->references('id')->on('arquivos');
            $table->foreign('arquivo6_uid')->references('id')->on('arquivos');
            $table->foreign('arquivo7_uid')->references('id')->on('arquivos');
            $table->foreign('arquivo8_uid')->references('id')->on('arquivos');
            $table->foreign('arquivo9_uid')->references('id')->on('arquivos');
            $table->foreign('arquivo10_uid')->references('id')->on('arquivos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::alter('solicitacoes_de_alteracao', function (Blueprint $table) {
            $table->dropColumn('arquivo5_uid');
            $table->dropColumn('arquivo6_uid');
            $table->dropColumn('arquivo7_uid');
            $table->dropColumn('arquivo8_uid');
            $table->dropColumn('arquivo9_uid');
            $table->dropColumn('arquivo10_uid');

            $table->dropForeign('arquivo5_uid');
            $table->dropForeign('arquivo6_uid');
            $table->dropForeign('arquivo7_uid');
            $table->dropForeign('arquivo8_uid');
            $table->dropForeign('arquivo9_uid');
            $table->dropForeign('arquivo10_uid');
        });
    }
}