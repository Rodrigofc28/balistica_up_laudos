<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNomeDaTabelaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_nome_da_tabela', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rep');
            $table->string('dataSoli');
            $table->string('data_solicitacao');
            $table->string('orgao');
            $table->string('cidade');
            $table->string('unidade');
            $table->string('oficio');
            $table->string('ip');
            $table->json('envolvidos');
            $table->string('nome');
            $table->string('bo',50);
            $table->string('data_designacao');
            $table->string('status')->default('Pendente');
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
        Schema::dropIfExists('_nome_da_tabela');
    }
}
