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
        Schema::create('visualizacaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('receita_id');
        });

        Schema::table('visualizacaos', function (Blueprint $table) {
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
        Schema::table('visualizacaos', function (Blueprint $table) {
            $table->dropForeign('visualizacaos_user_id_foreign');
            $table->dropForeign('visualizacaos_receita_id_foreign');
        });

        Schema::dropIfExists('visualizacaos');
    }
};
