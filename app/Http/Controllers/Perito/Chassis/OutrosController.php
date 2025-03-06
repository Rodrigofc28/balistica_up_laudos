<?php

namespace App\Http\Controllers\Perito\Chassis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OutorsController extends Controller
{
   public function index(){
      return view('perito.chassi.veiculos.semireboque.index');
   }
   
   public function store(Request $request){

      return redirect()->route('caminhao.index');  
   }
}
