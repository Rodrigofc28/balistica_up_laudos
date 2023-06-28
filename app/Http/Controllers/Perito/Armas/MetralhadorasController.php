<?php
// arquivo carabina
namespace App\Http\Controllers\Perito\Armas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Armas\MetralhadoraRequest;
use App\Models\Arma;
use App\Models\Calibre;
use App\Models\Marca;
use App\Models\Origem;
use App\Models\Cadastroarmas;
use Illuminate\Support\Facades\DB;
use App\Models\Armas_Gdl;
class MetralhadorasController extends Controller
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
        $arma_metralhadora_gdl=Armas_Gdl::find($request->id);
        //Dados vindo do GDL TABELA tabela_pecas_gdl seleciona tudo quando as rep forem iguais
        
        $marcas = Marca::categoria('armas'); // classes do models marca, origem, calibre
        $origens = Origem::all();
        $calibres = Calibre::whereArma('Metralhadora');
        $armas = DB::select('select modelo from cadastroarmas '); 
        return view('perito.laudo.materiais.armas.metralhadora.create',
            compact('laudo', 'marcas', 'origens', 'calibres','armas','arma_metralhadora_gdl'));
    }
        public function show(Arma $metralhadora)
        {
    //        $marcas = Marca::marcasWithTrashed('armas', $espingarda->marca);
    //        $origens = Origem::origensWithTrashed($espingarda->origem);
    //        $calibres = Calibre::calibresWithTrashed('revólver', $espingarda->calibre);
            return view('perito.laudo.materiais.armas.metralhadora.show',
                compact('arma'));
        }

  /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laudo $laudo
     * @param  \App\Models\Arma $espingarda
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo, Arma $metralhadora)
    {
        $marcas = Marca::marcasWithTrashed('armas', $metralhadora->marca);
        $origens = Origem::origensWithTrashed($metralhadora->origem);
        if($metralhadora->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Metralhadora', $metralhadora->calibre);
        }
        $imagens = $metralhadora->imagens;
        return view('perito.laudo.materiais.armas.metralhadora.edit',
            compact('metralhadora', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Arma $revolver
     * @return \Illuminate\Http\Response
     */
    public function update(MetralhadoraRequest $request, $laudo_id, Arma $metralhadora)
    {
        $updated_arma = $request->all();
        Arma::find($metralhadora->id)->fill($updated_arma)->save();
        return redirect()->route('laudos.show', ['id' => $laudo_id])
            ->with('success', __('flash.update_f', ['model' => 'Metralhadora']));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $id_arma_gdl,MetralhadoraRequest $request)
    {
        $arma_metralhadora_gdl=Armas_Gdl::find($id_arma_gdl->arma);
      

        if ($arma_metralhadora_gdl) {
        
            $arma_metralhadora_gdl->status = "CADASTRADO"; // Muda o status para Não pendente
            // tem que criar a coluna updated_at tipo TIMESTAMP
            $arma_metralhadora_gdl->save(); // Savando no banco de dados
        
        }
        Arma::create($request->all());
        return redirect()->route('laudos.show',
            ['laudo_id' => $request->input('laudo_id')])
            ->with('success', __('flash.create_f', ['model' => 'Metralhadora']));
    }
    public function edit_gdl($laudo,$id_arma_gdl)
    {
        $metralhadora=Arma::where('id_armas_gdl',$id_arma_gdl)->first();


        $marcas = Marca::marcasWithTrashed('armas', $metralhadora->marca);
        $origens = Origem::origensWithTrashed($metralhadora->origem);
        if($metralhadora->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Metralhadora', $metralhadora->calibre);
        }
        $imagens = $metralhadora->imagens;
        
        return view('perito.laudo.materiais.armas.metralhadora.edit',
            compact('metralhadora', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));
        
    }

}