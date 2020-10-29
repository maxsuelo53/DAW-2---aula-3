<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClube extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jogador', function (Blueprint $table) {
            $table->unsignedBigInteger("clube");
			$table->foreign("clube")-> references("id")->on("clube");
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
