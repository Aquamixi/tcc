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
        Schema::create('seguidors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('seguidor_id');
        });

        Schema::table('seguidors', function (Blueprint $table) {
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('seguidor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seguidors', function (Blueprint $table) {
            $table->dropForeign('seguidors_usuario_id_foreign');
            $table->dropForeign('seguidors_seguidor_id_foreign');
        });

        Schema::dropIfExists('seguidors');
    }
};
