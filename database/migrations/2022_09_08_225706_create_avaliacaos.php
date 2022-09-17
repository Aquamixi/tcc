<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacaos', function (Blueprint $table) {
            $table->id();
            $table->integer('qtde');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('receita_id');
        });

        Schema::table('avaliacaos', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('receita_id')->references('id')->on('receitas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('avaliacaos', function (Blueprint $table) {
            $table->dropForeign('avaliacaos_user_id_foreign');
            $table->dropForeign('avaliacaos_receita_id_foreign');
        });

        Schema::dropIfExists('avaliacaos');
    }
};
