<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaudoRequest;
use Illuminate\Http\Request;
use App\Models\OrgaoSolicitante;
use App\Models\Laudo;
use App\Models\Secao;

class ChassiController extends Controller
{
   public function store(LaudoRequest $request){
         
         $laudo = Laudo::config_laudo_info($request);
        
         $laudo = Laudo::create($laudo);
        
         $laudo_id = $laudo->id;
        return view('perito.chassi.index');
   }
    
}