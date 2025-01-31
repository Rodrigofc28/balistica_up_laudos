<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Controllers\Perito\Armas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Armas\EspingardaRequest;
use App\Models\Arma;
use App\Models\Calibre;
use App\Models\Marca;
use App\Models\Secao;
use App\Models\Cidade;
use App\Models\Origem;
use App\Models\Cadastroarmas;
use App\Models\Armas_Gdl;
use App\Models\User;
use App\Notifications\Bellnotification;
use Illuminate\Support\Facades\DB;
class EspingardasController extends Controller
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
      //busca a valor do id correspondente

      $arma_espingarda_gdl=Armas_Gdl::find($request->id);
      

       
        /*  */
        $marcas = Marca::categoria('armas');
        $origens = Origem::all();
        $calibres = Calibre::whereArma('Espingarda');
        $armas = Arma::where('status', 1)->get();
        return view('perito.laudo.materiais.armas.espingarda.create',
            compact('laudo', 'marcas', 'origens', 'calibres','armas','arma_espingarda_gdl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $id_arma_gdl, EspingardaRequest $request)
    {
        if($request->salva_cadastro==1){
            $admins = User::where('cargo_id', '2')->get();
            foreach ($admins as $admin) {
                $admin->notify(new Bellnotification('modelo armas'));
            }
            
        }
        $arma_espingarda_gdl=Armas_Gdl::find($id_arma_gdl->arma);
      

        if ($arma_espingarda_gdl) {
        
            $arma_espingarda_gdl->status = "CADASTRADO"; // Muda o status para Não pendente
            // tem que criar a coluna updated_at tipo TIMESTAMP
            $arma_espingarda_gdl->save(); // Savando no banco de dados
        
        }

        $secoes = Secao::all();
        $cidades = Cidade::all();
        if(!empty($request->Arma_Gdl)&&$request->Arma_Gdl=="sim"){
           
            $id_armas_gdl=$request->id_armas_gdl;
            Arma::create($request->all());
           
           
           
            return redirect()->route('laudos.show',
            ['laudo_id' => $request->input('laudo_id')])
            ->with('success', __('flash.create_f', ['model' => 'Espingarda']))
            ->with('id_gdl',$id_armas_gdl);
        }
        salvaImagemArm($request);
        return redirect()->route('laudos.show',
            ['laudo_id' => $request->input('laudo_id')])
            ->with('success', __('flash.create_f', ['model' => 'Espingarda']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arma $espingarda
     * @return \Illuminate\Http\Response
     */
    public function show(Arma $espingarda)
    {
//        $marcas = Marca::marcasWithTrashed('armas', $espingarda->marca);
//        $origens = Origem::origensWithTrashed($espingarda->origem);
//        $calibres = Calibre::calibresWithTrashed('revólver', $espingarda->calibre);
        return view('perito.laudo.materiais.armas.espingarda.show',
            compact('arma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laudo $laudo
     * @param  \App\Models\Arma $espingarda
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo, Arma $espingarda)
    {
        $marcas = Marca::marcasWithTrashed('armas', $espingarda->marca);
        $origens = Origem::origensWithTrashed($espingarda->origem);
        if($espingarda->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Espingarda', $espingarda->calibre);
        }
        $imagens = $espingarda->imagens;
        return view('perito.laudo.materiais.armas.espingarda.edit',
            compact('espingarda', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Arma $revolver
     * @return \Illuminate\Http\Response
     */
    public function update(EspingardaRequest $request, $laudo_id, Arma $espingarda)
    {
        
        $updated_arma = $request->all();
        Arma::find($espingarda->id)->fill($updated_arma)->save();
        return redirect()->route('laudos.show', ['id' => $laudo_id])
            ->with('success', __('flash.update_f', ['model' => 'Espingarda']));
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
        $espingarda=Arma::where('id_armas_gdl',$id_arma_gdl)->first();


        $marcas = Marca::marcasWithTrashed('armas', $espingarda->marca);
        $origens = Origem::origensWithTrashed($espingarda->origem);
        if($espingarda->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Espingarda', $espingarda->calibre);
        }
        $imagens = $espingarda->imagens;
        
        return view('perito.laudo.materiais.armas.espingarda.edit',
            compact('espingarda', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));
        
    }
}
