<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCertidoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certidoes', function (Blueprint $table) {
            $table->integer('certidao_anterior_id')->unsigned()->nullable();
            $table->foreign('certidao_anterior_id')->references('id')->on('certidoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::alter('certidoes', function (Blueprint $table) {
            $table->dropForeign('certidoes_certidao_anterior_id_foreign');
            $table->dropColumn('certidao_anterior_id');
        });
    }
}