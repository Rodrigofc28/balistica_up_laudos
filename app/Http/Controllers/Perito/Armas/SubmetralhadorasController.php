<?php
// arquivo carabina
namespace App\Http\Controllers\Perito\Armas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Armas\SubmetralhadoraRequest;
use App\Models\Arma;
use App\Models\Calibre;
use App\Models\Marca;
use App\Models\Origem;
use App\Models\Cadastroarmas;
use Illuminate\Support\Facades\DB;
use App\Models\Armas_Gdl;
use App\Models\User;
use App\Notifications\Bellnotification;
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
    public function create(Request $request,$laudo)
    {
        //Dados vindo do GDL TABELA tabela_pecas_gdl seleciona tudo quando as rep forem iguais
        $arma_submetralhadora_gdl=Armas_Gdl::find($request->id);
        $marcas = Marca::categoria('armas'); // classes do models marca, origem, calibre
        $origens = Origem::all();
        $calibres = Calibre::whereArma('Submetralhadora'); 
        $armas = Arma::where('status', 1)->get();
        return view('perito.laudo.materiais.armas.submetralhadora.create',
            compact('laudo', 'marcas', 'origens', 'calibres','armas','arma_submetralhadora_gdl'));
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
    public function store(Request $id_arma_gdl,SubmetralhadoraRequest $request)
    {
        if($request->salva_cadastro==1){
            $admins = User::where('cargo_id', '2')->get();
            foreach ($admins as $admin) {
                $admin->notify(new Bellnotification('modelo armas'));
            }
            
        }
        $arma_submetralhadora_gdl=Armas_Gdl::find($id_arma_gdl->arma);
        if ($arma_submetralhadora_gdl) {
        
            $arma_submetralhadora_gdl->status = "CADASTRADO"; // Muda o status para Não pendente
            // tem que criar a coluna updated_at tipo TIMESTAMP
            $arma_submetralhadora_gdl->save(); // Savando no banco de dados
        
        }
        salvaImagemArm($request);
        return redirect()->route('laudos.show',
            ['laudo_id' => $request->input('laudo_id')])
            ->with('success', __('flash.create_f', ['model' => 'Submetralhadora']));
    }
    public function edit_gdl($laudo,$id_arma_gdl)
    {
        $submetralhadora=Arma::where('id_armas_gdl',$id_arma_gdl)->first();


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

}
