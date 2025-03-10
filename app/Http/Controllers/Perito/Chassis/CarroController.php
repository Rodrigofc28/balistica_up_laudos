<?php

namespace App\Http\Controllers\Perito\Chassis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarroController extends Controller
{
   public function index(){
      
        return view('perito.chassi.veiculos.carro.index');
   }
   public function store(){
      //
   }
   public function tela1()
   {
      return view('perito.chassi.veiculos.carro.tela1');
   }

}
