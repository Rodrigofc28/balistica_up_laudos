<?php

namespace App\Http\Controllers\Perito\Chassis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CaminhaoController extends Controller
{
   public function index(){
      // Você pode adicionar a lógica para passar dados para a view, se necessário
      return view('perito.chassi.veiculos.caminhao.index');
   }
   
   public function store(Request $request){
      // Lógica para armazenar os dados do caminhão, se necessário
      // Por exemplo:
      // $request->validate([
      //     'campo1' => 'required',
      //     'campo2' => 'nullable',
      //     // Outros campos de validação...
      // ]);

      // Lógica de armazenamento
      // Caminhao::create($request->all());

      // Redireciona ou retorna uma resposta conforme a lógica desejada
      return redirect()->route('caminhao.index');  // Exemplo de redirecionamento
   }
}
