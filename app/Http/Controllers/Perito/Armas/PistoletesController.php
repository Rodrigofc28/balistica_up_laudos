<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Controllers\Perito\Armas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Armas\PistoleteRequest;
use App\Models\Arma;
use App\Models\Calibre;
use App\Models\Marca;
use App\Models\Origem;
use App\Models\Cadastroarmas;
use Illuminate\Support\Facades\DB;
use App\Models\Armas_Gdl;
class PistoletesController extends Controller
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
    public function create(Request $request,$laudo)
    {
        //Dados vindo do GDL TABELA tabela_pecas_gdl seleciona tudo quando as rep forem iguais
        $arma_pistolete_gdl=Armas_Gdl::find($request->id);
        
        $marcas = Marca::categoria('armas');
        $origens = Origem::all();
        $calibres = Calibre::whereArma('Pistolete');
        $armas = DB::select('select modelo from cadastroarmas ');
        return view('perito.laudo.materiais.armas.pistolete.create',
            compact('laudo', 'marcas', 'origens', 'calibres','armas','arma_pistolete_gdl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $id_arma_gdl, PistoleteRequest $request)
    {
        $arma_pistolete_gdl=Armas_Gdl::find($id_arma_gdl->arma);
      

        if ($arma_pistolete_gdl) {
        
            $arma_pistolete_gdl->status = "CADASTRADO"; // Muda o status para Não pendente
            // tem que criar a coluna updated_at tipo TIMESTAMP
            $arma_pistolete_gdl->save(); // Savando no banco de dados
        
        }
        Arma::create($request->all());
        return redirect()->route('laudos.show',
            ['laudo_id' => $request->input('laudo_id')])
            ->with('success', __('flash.create_f', ['model' => 'Pistolete']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arma $pistola
     * @return \Illuminate\Http\Response
     */
    public function show(Arma $pistola)
    {
//        $marcas = Marca::marcasWithTrashed('armas', $pistola->marca);
//        $origens = Origem::origensWithTrashed($pistola->origem);
//        $calibres = Calibre::calibresWithTrashed('revólver', $pistola->calibre);
        return view('perito.laudo.materiais.armas.pistolete.show',
            compact('arma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laudo $laudo
     * @param  \App\Models\Arma $pistola
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo, Arma $pistolete)
    {
        
        $marcas = Marca::marcasWithTrashed('armas', $pistolete->marca);
        $origens = Origem::origensWithTrashed($pistolete->origem);
        if($pistolete->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Pistolete', $pistolete->calibre);
        }
        $imagens = $pistolete->imagens;
        
        return view('perito.laudo.materiais.armas.pistolete.edit',
            compact('pistolete', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Arma $pistola
     * @return \Illuminate\Http\Response
     */
    public function update(PistoleteRequest $request, $laudo_id, Arma $pistolete)
    {
        $updated_arma = $request->all();
        Arma::find($pistolete->id)->fill($updated_arma)->save();
        return redirect()->route('laudos.show', ['id' => $laudo_id])
            ->with('success', __('flash.update_f', ['model' => 'Pistolete']));
    }
    public function edit_gdl($laudo,$id_arma_gdl)
    {
        $pistolete=Arma::where('id_armas_gdl',$id_arma_gdl)->first();


        $marcas = Marca::marcasWithTrashed('armas', $pistolete->marca);
        $origens = Origem::origensWithTrashed($pistolete->origem);
        if($pistolete->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Pistolete', $pistolete->calibre);
        }
        $imagens = $pistolete->imagens;
        
        return view('perito.laudo.materiais.armas.pistolete.edit',
            compact('pistolete', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));
        
    }
}