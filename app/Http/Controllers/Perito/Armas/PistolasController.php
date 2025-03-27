<?php



namespace App\Http\Controllers\Perito\Armas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Armas\PistolaRequest;
use App\Models\Arma;
use App\Models\Calibre;
use App\Models\Marca;
use App\Models\Origem;
use App\Models\Cadastroarmas;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Notifications\Bellnotification;
use Intervention\Image\Facades\Image;
use App\Models\Armas_Gdl;
class PistolasController extends Controller
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
        $arma_pistola_gdl=Armas_Gdl::find($request->id);
        
        $marcas = Marca::categoria('armas');
        $origens = Origem::all();
        $calibres = Calibre::whereArma('Pistola');
        
        $armas = Arma::where('status', 1)->get();
        return view('perito.laudo.materiais.armas.pistola.create',
            compact('laudo', 'marcas', 'origens', 'calibres','armas','arma_pistola_gdl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $id_arma_gdl,PistolaRequest $request)
    {
        
        if($request->salva_cadastro==1){
            $admins = User::where('cargo_id', '2')->get();
            foreach ($admins as $admin) {
                $admin->notify(new Bellnotification('modelo armas'));
            }
            
        }
        $arma_pistola_gdl=Armas_Gdl::find($id_arma_gdl->arma);
      

        if ($arma_pistola_gdl) {
        
            $arma_pistola_gdl->status = "CADASTRADO"; // Muda o status para Não pendente
            // tem que criar a coluna updated_at tipo TIMESTAMP
            $arma_pistola_gdl->save(); // Savando no banco de dados
        
        }


        salvaImagemArm($request);
        return redirect()->route('laudos.show',
            ['laudo_id' => $request->input('laudo_id')])
            ->with('success', __('flash.create_f', ['model' => 'Pistola']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arma $pistola
     * @return \Illuminate\Http\Response
     */
    public function show(Arma $pistola)
    {
        
        return view('perito.laudo.materiais.armas.pistola.show',
            compact('arma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laudo $laudo
     * @param  \App\Models\Arma $pistola
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo, Arma $pistola)
    {
        
        $marcas = Marca::marcasWithTrashed('armas', $pistola->marca);
        $origens = Origem::origensWithTrashed($pistola->origem);
        if($pistola->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Pistola', $pistola->calibre);
        }
        $imagens = $pistola->imagens;
        return view('perito.laudo.materiais.armas.pistola.edit',
            compact('pistola', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Arma $pistola
     * @return \Illuminate\Http\Response
     */
    public function update(PistolaRequest $request, $laudo_id, Arma $pistola)
    {
        
        atualizaImagemArm($request, $pistola->id);
        return redirect()->route('laudos.show', ['id' => $laudo_id])
            ->with('success', __('flash.update_f', ['model' => 'Pistola']));
    }

    
    public function edit_gdl($laudo,$id_arma_gdl)
    {
        $pistola=Arma::where('id_armas_gdl',$id_arma_gdl)->first();


        $marcas = Marca::marcasWithTrashed('armas', $pistola->marca);
        $origens = Origem::origensWithTrashed($pistola->origem);
        if($pistola->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Pistola', $pistola->calibre);
        }
        $imagens = $pistola->imagens;
        
        return view('perito.laudo.materiais.armas.pistola.edit',
            compact('pistola', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));
        
    }
}
