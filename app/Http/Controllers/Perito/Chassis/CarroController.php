<?php

namespace App\Http\Controllers\Perito\Chassis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Laudo;
use App\Models\VeiculoInspecao;
use App\Models\ChassiDate\Chassi;
use App\Models\Veiculo;
use App\Models\Marca;

class CarroController extends Controller
{
   public function index(Laudo $laudo){

        return view('perito.chassi.veiculos.carro.index', compact('laudo'));
   }
   public function store(){
      //
   }
   public function tela1()
   {
      return view('perito.chassi.veiculos.carro.tela1');
   }

}
