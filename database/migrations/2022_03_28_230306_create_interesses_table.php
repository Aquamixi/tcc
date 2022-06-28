<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('receita_interesse_id');
            $table->unsignedBigInteger('receita_desinteresse_id');
        });
        
        Schema::table('interesses', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('receita_interesse_id')->references('id')->on('receitas')->nullable();
            $table->foreign('receita_desinteresse_id')->references('id')->on('receitas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interesses', function (Blueprint $table) {
            $table->dropForeign('interesses_user_id_foreign');
            $table->dropForeign('interesses_receita_interesse_id_foreign');
            $table->dropForeign('interesses_receita_desinteresse_id_foreign');
        });
        Schema::dropIfExists('interesses');
    }
}
