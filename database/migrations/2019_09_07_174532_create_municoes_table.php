<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_municao', 30)->nullable();
            $table->integer('laudo_id')->unsigned()->nullable();
            $table->foreign('laudo_id')->references('id')->on('laudos')->onDelete('cascade');
            $table->integer('marca_id')->unsigned()->nullable();
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->integer('calibre_id')->unsigned()->nullable();
            $table->foreign('calibre_id')->references('id')->on('calibres');
            $table->integer('quantidade')->nullable();
            $table->string('estojo', 40)->nullable();
            $table->string('projetil', 40)->nullable();
            $table->string('funcionamento', 40)->nullable();
            $table->string('tipo_projetil',40)->nullable();
            $table->string('nao_deflagrado',40)->nullable();
            $table->string('municao_de', 40)->nullable();
            $table->string('observacao',50)->nullable();
            $table->string('institutoArma',200)->nullable();
            $table->string('coleta',200)->nullable();
            $table->string('lacre_saida',50)->nullable();
            $table->string('rep_materialColetado',30)->nullable();
            $table->string('origem_coletaPerito',50)->nullable();
            $table->string('lote',20)->nullable();
            $table->string('funcionamentoCartucho',30)->nullable();
            $table->integer('origem_id')->unsigned()->nullable();
            $table->integer('qtEficiente')->nullable();
            $table->integer('qtIneficiente')->nullable();
            
            $table->softDeletes();
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
        Schema::dropIfExists('municoes');
    }
}
