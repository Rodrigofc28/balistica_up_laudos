<?php

namespace App\Http\Controllers\Perito\Chassis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OnibusController extends Controller
{
   public function index(){
      return view('perito.chassi.veiculos.onibus.index');
   }
   
   public function store(Request $request){

      return redirect()->route('onibus.index'); 
   }
}
