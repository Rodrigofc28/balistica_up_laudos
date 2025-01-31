<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arma;
use App\Models\Cadastroarmas;
use App\Http\Requests\cadastroarmasRequest;

class CadastroarmasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $cadastros=Cadastroarmas::all();
        $armas = Arma::all();
        return view('admin/cadastro_armas/index', compact('armas','cadastros'));
    }
    public function store(Request $request)
    {
        //ajusta para ver se foi cadastrado
        Arma::where('id', $request->arma_id)->update($request->except('arma_id'));
         
        
       
        return response()->json(['message' => 'Arma cadastrada com sucesso!']);
        
    }
    public function delete($arma)
    {
       
         Arma::where('id', $arma)->update(['salva_cadastro' => 0]);
         
         
         return response()->json(['message' => 'Arma deletada com sucesso!']);
       
    }

    
}