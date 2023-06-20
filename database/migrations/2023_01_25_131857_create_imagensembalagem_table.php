<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagensembalagemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagensembalagem', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('laudo_id')->unsigned();
            $table->foreign('laudo_id')->references('id')->on('laudos')->onDelete('cascade');
            $table->string('nome',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagensembalagem');
    }
}
