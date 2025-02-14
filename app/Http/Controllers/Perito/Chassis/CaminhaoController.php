<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


class CarroController extends Controller
{
   public function index(){
      
        return view('perito.chassi.veiculos.caminhao.index');
   }
    
}