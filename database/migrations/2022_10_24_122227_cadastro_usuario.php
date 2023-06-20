<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CadastroUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadastrousuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 80);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('secao_id');
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
            Schema::dropIfExists('cadastrousuarios');
        }
    
}
