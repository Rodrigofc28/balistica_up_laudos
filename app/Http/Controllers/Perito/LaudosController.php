<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Controllers\Perito;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\LaudoRequest;
use App\Models\Cidade;
use App\Models\Diretor;
use App\Models\Gerador\Gerar;
use App\Models\Laudo;
use App\Models\Arma;
use App\Models\OrgaoSolicitante;
use App\Models\Secao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use App\Models\Armas_Gdl;
use App\Models\MongoDb\Post;
class LaudosController extends Controller
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
    //Acessa a minhas Reps----------------------------------------------------------------------------------------------------------------
    public function index()
    {
    
        
            $userAll = User::all();
            $user = Auth::user()->cargo->id;
            $usertecnico = auth()->user();
            //Busca minhas reps
            $documents = Post::where('expert', strtoupper(Auth::user()->nome)) //strtoupper(Auth::user()->nome)
            
            ->where(function ($query) {
                $query->where('examNature', 'B602 - EXAME DE EFICIÊNCIA E PRESTABILIDADE')
                      ->orWhere('examNature', 'B601 - EXAME DE CONSTATAÇÃO')
                      ->orWhere('examNature', 'I801 - EXAME NAS NUMERAÇÕES IDENTIFICADORAS');
            })
            ->where(function ($query) {
                $query->where('status', 'LAUDO EM EXECUÇÃO')
                      ->orWhere('status', 'ABERTA E DISTRIBUÍDA');
            })
            ->get();
        
        $usuariosenhaGdl=User::where('id','=',Auth::id())->get();
        
       
        $user = Auth::id();
        $laudos = Laudo::findMyReps($user); 
        
        $reps = DB::table('_nome_da_tabela')->where('nome', $usuariosenhaGdl[0]->userGDL)->get();
       
        return view('perito.laudo.index', compact('laudos','reps','documents','userAll','usertecnico'));
    }
    //Busca pelas reps de peritos----------------------------------------------------------------------------------------------------------------
    public function repsPeritos(Request $request)
    {
    
        
            $userAll = User::all();
            $user = Auth::user()->cargo->id;
            $usertecnico = auth()->user();
            //Busca minhas reps
            $documents = Post::where('expert', strtoupper('FABIANO FERREIRA DO AMARAL SCHMIDT')) //comando para teste da função -> strtoupper(Auth::user()->nome) FABIANO FERREIRA DO AMARAL SCHMIDT $request->Perito_do_caso
            
            ->where(function ($query) {
                $query->where('examNature', 'B602 - EXAME DE EFICIÊNCIA E PRESTABILIDADE')
                      ->orWhere('examNature', 'B601 - EXAME DE CONSTATAÇÃO')
                      ->orWhere('examNature', 'I801 - EXAME NAS NUMERAÇÕES IDENTIFICADORAS');
            })
            ->where(function ($query) {
                $query->where('status', 'LAUDO EM EXECUÇÃO')
                      ->orWhere('status', 'ABERTA E DISTRIBUÍDA');
            })
            ->get();
        
        $usuariosenhaGdl=User::where('id','=',Auth::id())->get();
        
       
        $user = Auth::id();
        $laudos = Laudo::findMyReps($user); 
        
        $reps = DB::table('_nome_da_tabela')->where('nome', $usuariosenhaGdl[0]->userGDL)->get();
       
        return view('perito.laudo.index', compact('laudos','reps','documents','userAll','usertecnico'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      
        $secoes = Secao::all();
        $cidades = Cidade::all();
        $diretores = Diretor::all();
        $userAll = User::all();
        $user = Auth::user()->cargo->id;
        $usertecnico = auth()->user();
        if($request->tipo_laudo=="balistica"){
            $tipo_exame=$request->tipo_laudo;
            $reps="";
            $armasGdl="";
            return view('perito.laudo.create',
            compact('secoes', 'cidades', 'diretores','reps','tipo_exame','userAll','usertecnico'));
        }
        if($request->tipo_laudo=="chassi"){
            $tipo_exame=$request->tipo_laudo;
            $reps="";
            $armasGdl="";
            return view('perito.laudo.create',
            compact('secoes', 'cidades', 'diretores','reps','tipo_exame','userAll','usertecnico'));
        }
        if(count($request->request)>0||session('gdl')==true){
           
            //Retorna a view create-gdl
            $reps=$request;
           
            $armasGdl=DB::select('select * from tabela_pecas_gdl where rep = :id  ',['id'=>$reps->rep]);
            return view('perito.laudo.create-gdl',
            compact('secoes', 'cidades', 'diretores','reps','armasGdl'));
            
        }else{
            $reps="";
            $armasGdl="";
            return view('perito.laudo.create',
            compact('secoes', 'cidades', 'diretores','reps','armasGdl'));
        }
        

        
    }

    /*
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(LaudoRequest $request)
    {   
        
        session()->forget('municoes');//limpa a sessao de municoes criado no controller MunicoesController
        session()->forget('estojo');//limpa a sessao de municoes criado no controller MunicoesController
        session()->forget('projetil');//limpa a sessao de projetil criado no controller ComponentesController
        $arma=Arma::all();
        
        $laudo = Laudo::config_laudo_info($request);
        
        $laudo = Laudo::create($laudo);
        
        $laudo_id = $laudo->id;
        return view('perito.laudo.create_embalagem_foto', compact('laudo_id'));
     
    }

    
    public function show(Laudo $laudo,$lacre=null)
    {
        
        $id_gdl_armas=session('id_gdl');
        //$armasGdl=DB::select('select * from tabela_pecas_gdl where rep = :id  ',['id'=>$laudo->rep]);
        $armasGdl=Armas_Gdl::all()->where('rep',$laudo->rep);
        
        $cidades = Cidade::all();
        $secoes = Secao::all();
        $diretores = Diretor::allOrdered();
        $solicitantes = OrgaoSolicitante::fromCity($laudo->cidade_id);
        $armas = $laudo->armas;             //armas
        $outros = $laudo->outros;           //outros materiais
        $municoes = $laudo->municoes;       //cartucho e estojo
        $componentes = $laudo->componentes;//projetil
        
        $users_img_project = DB::select('select lacrecartucho,lacreSaida, group_concat(id) from componentes where laudo_id = ? group by lacrecartucho,lacreSaida', [$laudo->id]);
        $obj=(object) $users_img_project;

        $users_img_municoes = DB::select('select lacrecartucho,lacre_saida, group_concat(id),tipo_municao from municoes where laudo_id = ? group by lacrecartucho,lacre_saida,tipo_municao', [$laudo->id]);
        $objMuni=(object) $users_img_municoes;
        
       
         if(count($armasGdl)==0){
            return view('perito.laudo.show',
                compact('laudo', 'cidades', 'solicitantes',
                    'diretores', 'secoes', 'armas', 'municoes','outros', 'componentes','obj','objMuni'));
                }
        else{
            
            
            return view('perito.laudo.show_gdl_laudo',
                compact('laudo', 'cidades', 'solicitantes',
                    'diretores', 'secoes', 'armas', 'municoes','outros', 'componentes','obj','objMuni','armasGdl','id_gdl_armas'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Laudo $laudo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $laudo)
    {
        
        $updated_laudo = Laudo::config_laudo_info($request);
        //dd($updated_laudo,$request->data_ocorrencia);
        Laudo::find($laudo->id)->fill($updated_laudo)->save();
        $laudo_id = $laudo->id;
        return redirect()->route('laudos.show', compact('laudo_id'))
            ->with('success', __('flash.update_m', ['model' => 'Laudo']));
    }
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //acessa a meus laudos ---------------------------------------------------------------
    public function meusLaudos()
    {
        
        $laudos = Laudo::orderBy('id', 'desc')->where('perito_id','=',Auth::id())->paginate(10);

        return view('perito.laudo.meus-laudos', compact('laudos'));
    }
    public function searchLaudos($rep)
    {
        $rep = str_replace('-', '/', $rep);
        $laudo = Laudo::where('rep', $rep)->first();
        if(empty($laudo)){
            return response()->json(['fail' => 'true',
            'message' => 'Nenhum laudo encontrado em este número (' . $rep . ')']);
        } else {
            $laudo_id = $laudo->id;
            return response()->json(['url' => route('laudos.show', $laudo)]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $laudo
     * @return \Illuminate\Http\Response
     */
    public function destroy($laudo)
    {
        
        Laudo::destroy($laudo->id);
        return response()->json(['success' => 'done']);
    }

    public function materiais($laudo,Request $id)
    {
        if($id==null){

        }else{
            $outros=Armas_Gdl::find($id->id);
            if ($outros) {
        
                $outros->status = "CADASTRADO"; // Muda o status para Não pendente
                // tem que criar a coluna updated_at tipo TIMESTAMP
                $outros->save(); // Savando no banco de dados
            
            }
        }
        
        return view('perito.materiais', compact('laudo'));
    }
//Gera o laudo Balistico----------------------------------------------------------------------
    public function generate_docx(Laudo $laudo)
    {
        if ($laudo->armas->isEmpty() && $laudo->municoes->isEmpty() && $laudo->componentes->isEmpty() && $laudo->outros->isEmpty()) {
            return redirect()->route('laudos.show', compact('laudo'))
                ->with('warning', 'É preciso ter ao menos 1 (um) material cadastrado para gerar o laudo!');
        } else {
            $phpWord = new Gerar();
            $phpWord = $phpWord->create_docx($laudo);

            return $phpWord;
        }
    }

    public function search($rep)
    {
        $rep = str_replace('-', '/', $rep);
        $laudo = Laudo::where('rep', $rep)->where('perito_id', Auth::id())->first();
        if(empty($laudo)){
            return response()->json(['fail' => 'true',
            'message' => 'Nenhum laudo encontrado em este número (' . $rep . ')']);
        } else {
            $laudo_id = $laudo->id;
            return response()->json(['url' => route('laudos.show', $laudo)]);
        }
        
    }
    public function atualiza($a){
       //
        
        return redirect()->back();
    }
    
    function decryptPassword($encryptedPassword, $key) {
        $encryptedPassword = base64_decode($encryptedPassword);
        $decryptedPassword = openssl_decrypt($encryptedPassword, 'AES-128-ECB', $key);
        return $decryptedPassword;
    }
    function show_materias($laudo_id){

        return redirect()->route('laudos.materiais', compact('laudo_id'));
    }
}
