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
        Schema::create('curtida_comentarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('comentario_id');
        });

        Schema::table('curtida_comentarios', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('comentario_id')->references('id')->on('comentarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('curtida_comentarios', function (Blueprint $table) {
            $table->dropForeign('curtida_comentarios_user_id_foreign');
            $table->dropForeign('curtida_comentarios_comentario_id_foreign');
        });

        Schema::dropIfExists('curtida_comentarios');
    }
};
