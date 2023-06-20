<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagensprojetilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagensprojetil', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('projetil_id')->unsigned();
            $table->foreign('projetil_id')->references('id')->on('componentes')->onDelete('cascade');
            $table->string('nome',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagensprojetil');
    }
}
