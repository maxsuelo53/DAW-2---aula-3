<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosicao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jogador', function (Blueprint $table) {
            $table->unsignedBigInteger("posicao");
			$table->foreign("posicao")-> references("id")->on("posicao");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jogador', function (Blueprint $table) {
            //
        });
    }
}
