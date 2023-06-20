<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaudosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laudos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('oficio', 30)->nullable();
            $table->string('rep', 20);
            $table->string('laudoEfetConst',20)->nullable();
            $table->date('data_solicitacao');
            $table->string('nomeIncluir',250)->nullable();
            $table->date('data_designacao');
            $table->integer('secao_id')->unsigned()->nullable();
            $table->foreign('secao_id')->references('id')->on('secoes');
            $table->string('cidade_id')->nullable();
            $table->foreign('cidade_id')->references('nome')->on('cidades');
            $table->integer('solicitante_id')->unsigned()->nullable();
            $table->foreign('solicitante_id')->references('id')->on('orgaos_solicitantes');
            $table->integer('perito_id')->unsigned();
            $table->foreign('perito_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nome_vitima',50)->nullable();
            $table->string('perfil_envolvido',30)->nullable();
            $table->string('material_coletado',15)->nullable();
            $table->string('indiciado', 80)->nullable();
            $table->string('inquerito', 20)->nullable();
            $table->string('tipo_inquerito', 60)->nullable();
            $table->string('sinab')->nullable();
            $table->string('num_ip',15)->nullable();
            $table->string('bairro',15)->nullable();
            $table->date('data_ocorrencia');
            $table->string('boletim_ocorrencia',40)->nullable();

            $table->longText('envolvidoGdl')->nullable();
            $table->string('cidadeGdl')->nullable();
            $table->string('orgaoGdl')->nullable();
            $table->string('unidadeGdl')->nullable();
            
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
        Schema::dropIfExists('laudos');
    }
}
