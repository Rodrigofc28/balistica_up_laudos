<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Controllers\Perito\Armas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Armas\GarruchaRequest;
use App\Models\Arma;
use App\Models\Cadastroarmas;
use App\Models\Calibre;
use App\Models\Marca;
use App\Models\Origem;
use App\Models\Armas_Gdl;
use App\Models\Imagem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Notifications\Bellnotification;
class GarruchasController extends Controller
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
        $arma_garrucha_gdl=Armas_Gdl::find($request->id);
        $marcas = Marca::categoria('armas');
        
        $armas = Cadastroarmas::all();
       
        $origens = Origem::all();
        $calibres = Calibre::whereArma('Garrucha');
        return view('perito.laudo.materiais.armas.garrucha.create',
            compact('laudo', 'marcas', 'origens', 'calibres','armas','arma_garrucha_gdl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $id_arma_gdl,GarruchaRequest $request)
    {
        if($request->salva_cadastro==1){
            $admins = User::where('cargo_id', '2')->get();
            foreach ($admins as $admin) {
                $admin->notify(new Bellnotification('modelo armas'));
            }
            
        }
        $arma_garrucha_gdl=Armas_Gdl::find($id_arma_gdl->arma);
        if ($arma_garrucha_gdl) {
        
            $arma_garrucha_gdl->status = "CADASTRADO"; // Muda o status para Não pendente
            // tem que criar a coluna updated_at tipo TIMESTAMP
            $arma_garrucha_gdl->save(); // Savando no banco de dados
        
        }
        //salvando a imagem no banco como base64 na função salvaImagemArm dentro da pasta Helpers
        
        salvaImagemArm($request);

       
         
        return redirect()->route('laudos.show',
            ['laudo_id' => $request->input('laudo_id')])
            ->with('success', __('flash.create_f', ['model' => 'Garrucha']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arma $garrucha
     * @return \Illuminate\Http\Response
     */
    public function show(Arma $garrucha)
    {
//        $marcas = Marca::marcasWithTrashed('armas', $garrucha->marca);
//        $origens = Origem::origensWithTrashed($garrucha->origem);
//        $calibres = Calibre::calibresWithTrashed('revólver', $garrucha->calibre);
        return view('perito.laudo.materiais.armas.garrucha.show',
            compact('arma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laudo $laudo
     * @param  \App\Models\Arma $garrucha
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo, Arma $garrucha)
    {
        $marcas = Marca::marcasWithTrashed('armas', $garrucha->marca);
        $origens = Origem::origensWithTrashed($garrucha->origem);
        if($garrucha->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Garrucha', $garrucha->calibre);
        }
        $imagens = $garrucha->imagens;
        return view('perito.laudo.materiais.armas.garrucha.edit',
            compact('garrucha', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Arma $garrucha
     * @return \Illuminate\Http\Response
     */
    public function update(GarruchaRequest $request, $laudo_id, Arma $garrucha)
    {
        $updated_arma = $request->all();
        Arma::find($garrucha->id)->fill($updated_arma)->save();
        return redirect()->route('laudos.show', ['id' => $laudo_id])
            ->with('success', __('flash.update_f', ['model' => 'Garrucha']));
    }
    public function edit_gdl($laudo,$id_arma_gdl)
    {
        $garrucha=Arma::where('id_armas_gdl',$id_arma_gdl)->first();


        $marcas = Marca::marcasWithTrashed('armas', $garrucha->marca);
        $origens = Origem::origensWithTrashed($garrucha->origem);
        if($garrucha->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Garrucha', $garrucha->calibre);
        }
        $imagens = $garrucha->imagens;
        
        return view('perito.laudo.materiais.armas.garrucha.edit',
            compact('garrucha', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));
        
    }
}
