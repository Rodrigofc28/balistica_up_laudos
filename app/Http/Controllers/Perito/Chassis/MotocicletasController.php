<?php

namespace App\Http\Controllers\Perito\Chassis;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MotocicletasController extends Controller
{
   public function index(){
        return view('perito.chassi.veiculos.moto.motocicleta.index');
   }
   public function store(){
      //
   }
    
}