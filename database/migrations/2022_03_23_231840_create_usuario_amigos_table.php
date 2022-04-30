<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioAmigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_amigos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('amigo_id');
        });

        Schema::table('usuario_amigos', function (Blueprint $table) {
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('amigo_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario_amigos', function (Blueprint $table) {
            $table->dropForeign('usuario_amigos_usuario_id_foreign');
            $table->dropForeign('usuario_amigos_amigo_id_foreign');
        });

        Schema::dropIfExists('usuario_amigos');
    }
}
