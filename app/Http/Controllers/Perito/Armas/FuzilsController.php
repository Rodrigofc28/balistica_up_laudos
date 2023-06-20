<?php
// arquivo carabina
namespace App\Http\Controllers\Perito\Armas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Armas\FuzilRequest;
use App\Models\Arma;
use App\Models\Calibre;
use App\Models\Marca;
use App\Models\Origem;
use App\Models\Cadastroarmas;
use Illuminate\Support\Facades\DB;
class FuzilsController extends Controller
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
            if($armagdl->tipo_item=="FUZIL(IS)"){
                array_push($array_gdl_armas,$armagdl);
            }
        }
        
        $marcas = Marca::categoria('armas'); // classes do models marca, origem, calibre
        $origens = Origem::all();
        $calibres = Calibre::whereArma('Fuzil'); 
        $armas = DB::select('select modelo from cadastroarmas ');
        return view('perito.laudo.materiais.armas.fuzil.create',
            compact('laudo', 'marcas', 'origens', 'calibres','armas','array_gdl_armas'));
    }
        public function show(Arma $fuzil)
        {
    //        $marcas = Marca::marcasWithTrashed('armas', $espingarda->marca);
    //        $origens = Origem::origensWithTrashed($espingarda->origem);
    //        $calibres = Calibre::calibresWithTrashed('revólver', $espingarda->calibre);
            return view('perito.laudo.materiais.armas.fuzil.show',
                compact('arma'));
        }

  /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laudo $laudo
     * @param  \App\Models\Arma $espingarda
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo, Arma $fuzil)
    {
        $marcas = Marca::marcasWithTrashed('armas', $fuzil->marca);
        $origens = Origem::origensWithTrashed($fuzil->origem);
        if($fuzil->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Fuzil', $fuzil->calibre);
        }
        $imagens = $fuzil->imagens;
        return view('perito.laudo.materiais.armas.fuzil.edit',
            compact('fuzil', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Arma $revolver
     * @return \Illuminate\Http\Response
     */
    public function update(FuzilRequest $request, $laudo_id, Arma $fuzil)
    {
        $updated_arma = $request->all();
        Arma::find($fuzil->id)->fill($updated_arma)->save();
        return redirect()->route('laudos.show', ['id' => $laudo_id])
            ->with('success', __('flash.update_f', ['model' => 'Fuzil']));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FuzilRequest $request)
    {   
        
        Arma::create($request->all());
        
        return redirect()->route('laudos.show',
            ['laudo_id' => $request->input('laudo_id')])
            ->with('success', __('flash.create_f', ['model' => 'Fuzil']));
    }

}