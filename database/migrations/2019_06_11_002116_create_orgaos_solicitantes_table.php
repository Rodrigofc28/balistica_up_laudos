<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgaosSolicitantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orgaos_solicitantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 130);
            $table->string('cidade_id');
            $table->foreign('cidade_id')->references('nome')->on('cidades');
            $table->softDeletes();
            $table->index('nome');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orgao_solicitantes');
    }
}
