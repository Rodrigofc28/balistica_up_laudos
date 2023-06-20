<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagensmunicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagensmunicoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municao_id')->unsigned();
            $table->foreign('municao_id')->references('id')->on('municoes')->onDelete('cascade');
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
        Schema::dropIfExists('imagensmunicoes');
    }
}
