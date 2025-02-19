<?php

namespace App\Http\Controllers\Perito\Chassis;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Laudo;
use App\Models\VeiculoInspecao;
use App\Models\ChassiDate\Chassi;
class MotocicletasController extends Controller
{
   public function index(Laudo $laudo){

        return view('perito.chassi.index',compact('laudo'));
   }
   public function tela2(Laudo $laudo){
      
      return view('perito.chassi.veiculos.moto.motocicleta.index',compact('laudo'));
   }
   public function tela3(Request $request){
       $laudo=Laudo::find($request->laudo_id);
       //salva os dados
       Chassi::create($request->all());
       //update dos dados
       $chassi = Chassi::where('laudo_id', $request->laudo_id)->first();
       $chassi->update($request->all());
      return view('perito.chassi.veiculos.moto.motocicleta.telaum',compact('laudo'));
   }
   public function tela4(Laudo $laudo){
      return view('perito.chassi.veiculos.moto.motocicleta.teladois',compact('laudo'));
      }
   public function exame(Request $request) {
  
   // Isso mostrará todos os dados enviados na requisição
      VeiculoInspecao::create($request->all());
      return view('perito.chassi.veiculos.moto.motocicleta.show');
  }
  
  
}