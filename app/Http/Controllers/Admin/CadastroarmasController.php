<?php

/*
 * Developed by Milena Mognon
 */

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
    public function store(cadastroarmasRequest $request)
    {
      
        Cadastroarmas::create($request->all());
        $armas = Arma::all();
        $cadastros=Cadastroarmas::all();
       
         
         return redirect()->route('cadastro_armas.index',compact('cadastros'));
        //return view('admin/cadastro_armas/index', compact('cadastros','armas'));
    }
    public function edit(Request $nameCadastro, $parametroPassado)
    {
        
        $cadastrado=$nameCadastro->only('cadastro');
        Cadastroarmas::destroy($cadastrado);
         Arma::where('id', $parametroPassado)
         
         ->update(['salva_cadastro' => 0]);;
         return redirect()->route('cadastro_armas.index');
       // return view('admin/cadastro_armas/index', with('msg','cadastro realizado com sucesso'));
    }

    
}