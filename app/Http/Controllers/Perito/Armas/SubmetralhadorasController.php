<?php
// arquivo carabina
namespace App\Http\Controllers\Perito\Armas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Armas\SubmetralhadoraRequest;
use App\Models\Arma;
use App\Models\Calibre;
use App\Models\Marca;
use App\Models\Origem;
use App\Models\Cadastroarmas;
use Illuminate\Support\Facades\DB;
class SubmetralhadorasController extends Controller
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
    public function create($laudo)
    {
        //Dados vindo do GDL TABELA tabela_pecas_gdl seleciona tudo quando as rep forem iguais
        $armasGdl=DB::select('select * from tabela_pecas_gdl where rep = :id  ',['id'=>$laudo->rep]);
        $array_gdl_armas=[];
        foreach($armasGdl as $armagdl){
            if($armagdl->tipo_item=="SUBMETRALHADORA(S)"){
                array_push($array_gdl_armas,$armagdl);
            }
        }
        $marcas = Marca::categoria('armas'); // classes do models marca, origem, calibre
        $origens = Origem::all();
        $calibres = Calibre::whereArma('Submetralhadora'); 
        $armas = DB::select('select modelo from cadastroarmas ');
        return view('perito.laudo.materiais.armas.submetralhadora.create',
            compact('laudo', 'marcas', 'origens', 'calibres','armas','array_gdl_armas'));
    }
        public function show(Arma $submetralhadora)
        {
    //        $marcas = Marca::marcasWithTrashed('armas', $espingarda->marca);
    //        $origens = Origem::origensWithTrashed($espingarda->origem);
    //        $calibres = Calibre::calibresWithTrashed('revólver', $espingarda->calibre);
            return view('perito.laudo.materiais.armas.submetralhadora.show',
                compact('arma'));
        }

  /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laudo $laudo
     * @param  \App\Models\Arma $espingarda
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo, Arma $submetralhadora)
    {   
        
        $marcas = Marca::marcasWithTrashed('armas', $submetralhadora->marca);
        $origens = Origem::origensWithTrashed($submetralhadora->origem);
        if($submetralhadora->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Submetralhadora', $submetralhadora->calibre);
        }
        $imagens = $submetralhadora->imagens;
        return view('perito.laudo.materiais.armas.submetralhadora.edit',
            compact('submetralhadora', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Arma $revolver
     * @return \Illuminate\Http\Response
     */
    public function update(SubmetralhadoraRequest $request, $laudo_id, Arma $submetralhadora)
    {
        $updated_arma = $request->all();
        Arma::find($submetralhadora->id)->fill($updated_arma)->save();
        return redirect()->route('laudos.show', ['id' => $laudo_id])
            ->with('success', __('flash.update_f', ['model' => 'Submetralhadora']));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubmetralhadoraRequest $request)
    {
        
        Arma::create($request->all());
        return redirect()->route('laudos.show',
            ['laudo_id' => $request->input('laudo_id')])
            ->with('success', __('flash.create_f', ['model' => 'Submetralhadora']));
    }

}
