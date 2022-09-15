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
        Schema::create('curtida_respostas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('resposta_id');
        });

        Schema::table('curtida_respostas', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('resposta_id')->references('id')->on('respostas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('curtida_respostas', function (Blueprint $table) {
            $table->dropForeign('curtida_respostas_user_id_foreign');
            $table->dropForeign('curtida_respostas_resposta_id_foreign');
        });

        Schema::dropIfExists('curtida_respostas');
    }
};
