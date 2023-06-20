<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColunasToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('_nome_da_tabela', function (Blueprint $table) {
            $table->string('ipOn');
            $table->string('ipPm');
            $table->string('boc');
            $table->longText('ipOnOrgao');
            $table->longText('ipPmOrgao');
            $table->longText('bocOrgao');
            $table->longText('ipOnCidade');
            $table->longText('ipPmCidade');
            $table->longText('bocCidade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('_nome_da_tabela', function (Blueprint $table) {
            //
        });
    }
}
