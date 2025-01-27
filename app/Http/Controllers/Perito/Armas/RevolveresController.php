<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Controllers\Perito\Armas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Armas\RevolverRequest;
use Illuminate\Http\Request;
use App\Models\Arma;
use App\Models\Calibre;
use App\Models\Marca;
use App\Models\Origem;
use App\Models\Cadastroarmas;
use Illuminate\Support\Facades\DB;
use App\Models\Armas_Gdl;
use App\Notifications\Bellnotification;
use App\Models\User;
class RevolveresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request, $laudo)
    {
        //Dados vindo do GDL TABELA tabela_pecas_gdl seleciona tudo quando as rep forem iguais
        $arma_revolver_gdl=Armas_Gdl::find($request->id);
        
        
        $marcas = Marca::categoria('armas');
        $origens = Origem::all();
        $calibres =Calibre::whereArma('Revólver');
        
        $armas = DB::select('select modelo from cadastroarmas ');
        return view('perito.laudo.materiais.armas.revolver.create',
            compact('laudo', 'marcas', 'origens', 'calibres','armas','arma_revolver_gdl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $id_arma_gdl,RevolverRequest $request)
    {
       //mudando o status para cadastrado
       if($request->salva_cadastro==1){
        $admins = User::where('cargo_id', '2')->get();
        foreach ($admins as $admin) {
            $admin->notify(new Bellnotification('modelo armas'));
        }
        
    }
        $arma_revolver_gdl=Armas_Gdl::find($id_arma_gdl->arma);
        if ($arma_revolver_gdl!=null) {
        
            $arma_revolver_gdl->status = "CADASTRADO"; // Muda o status para Não pendente
            // tem que criar a coluna updated_at tipo TIMESTAMP
            $arma_revolver_gdl->save(); // Savando no banco de dados
            
        }

        salvaImagemArm($request);
        
        return redirect()->route('laudos.show',
            ['laudo_id' => $request->input('laudo_id')])
            ->with('success', __('flash.create_m', ['model' => 'Revólver']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arma $revolver
     * @return \Illuminate\Http\Response
     */
    public function show(Arma $revolver)
    {
//        $marcas = Marca::marcasWithTrashed('armas', $revolver->marca);
//        $origens = Origem::origensWithTrashed($revolver->origem);
//        $calibres = Calibre::calibresWithTrashed('revólver', $revolver->calibre);
        return view('perito.laudo.materiais.armas.revolver.show',
            compact('arma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laudo $laudo
     * @param  \App\Models\Arma $revolver
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo, Arma $revolver)
    {
        $marcas = Marca::marcasWithTrashed('armas', $revolver->marca);
        $origens = Origem::origensWithTrashed($revolver->origem);

        
        if($revolver->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Revólver', $revolver->calibre);
        }
        $imagens = $revolver->imagens;
        return view('perito.laudo.materiais.armas.revolver.edit',
            compact('revolver', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Arma $revolver
     * @return \Illuminate\Http\Response
     */
    public function update(RevolverRequest $request, $laudo_id, Arma $revolver)
    {
        $updated_arma = $request->all();
        Arma::find($revolver->id)->fill($updated_arma)->save();
        return redirect()->route('laudos.show', ['id' => $laudo_id])
            ->with('success', __('flash.update_m', ['model' => 'Revólver']));
    }
    
    /**
     * Show the form for editing the specified resource.
     *Editando arma tipo espingarda vindo do GDL
     * @param  \App\Models\Laudo $laudo
     * @param  $id_arma_gdl
     * @return \Illuminate\Http\Response
     */
    public function edit_gdl($laudo,$id_arma_gdl)
    {
        $revolver=Arma::where('id_armas_gdl',$id_arma_gdl)->first();


        $marcas = Marca::marcasWithTrashed('armas', $revolver->marca);
        $origens = Origem::origensWithTrashed($revolver->origem);
        if($revolver->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Revolver', $revolver->calibre);
        }
        $imagens = $revolver->imagens;
        
        return view('perito.laudo.materiais.armas.revolver.edit',
            compact('revolver', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));
        
    }
}
