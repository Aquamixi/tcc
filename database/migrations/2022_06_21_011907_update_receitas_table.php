<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateReceitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receitas', function (Blueprint $table) {
            $table->boolean('mais_dezoito');
            $table->boolean('escondida');
            $table->unsignedBigInteger('nacionalidade_id');
            $table->text('descricao');
            $table->foreign('nacionalidade_id')->references('id')->on('nacionalidades');
            $table->string('token_acesso')->nullable();
            $table->datetime('data_token_validade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receitas', function (Blueprint $table) {
            $table->dropForeign('receitas_nacionalidade_id_foreign');
            $table->dropColumn('nacionalidade_id');
        });
    }
};
