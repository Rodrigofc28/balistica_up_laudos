<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('componentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('componente',40)->nullable();
            $table->integer('laudo_id')->unsigned()->nullable();
            $table->foreign('laudo_id')->references('id')->on('laudos')->onDelete('cascade');
            $table->string('tipo_raiamento',50)->nullable();
            $table->string('massa',50)->nullable();
            $table->string('altura_projetil',50)->nullable();
            $table->string('constituicao_formato',50)->nullable();
            $table->string('aderencia',50)->nullable();
            $table->string('sentido_raias',50)->nullable();
            $table->string('quantidade_raias',50)->nullable();
            $table->string('origem_projetil',50)->nullable();
            $table->longText('deformacaoAcidental')->nullable();
            $table->string('cavados',50)->nullable();
            $table->string('ressaltos',50)->nullable();
            $table->string('lacrecartucho')->nullable();
            $table->string('lacreSaida')->nullable();
            $table->smallInteger('quantidade_frascos')->nullable();
            $table->float('tamanho',8,2)->nullable();
            $table->string('material_frascos',40)->nullable();
            $table->string('tipo_projetil',40)->nullable();
            $table->string('calibreReal',40)->nullable();
            $table->string('calibreNominal',40)->nullable();
            $table->string('detalharLocalizacao',40)->nullable();
            $table->string('projetil',40)->nullable();
            $table->string('rep_materialColetado',30)->nullable();
            $table->string('origem_coletaPerito',50)->nullable();
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
        Schema::dropIfExists('componentes');
    }
}
