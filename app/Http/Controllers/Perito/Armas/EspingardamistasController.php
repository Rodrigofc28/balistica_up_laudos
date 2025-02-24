<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Controllers\Perito\Armas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Armas\EspingardamistaRequest;
use App\Models\Arma;
use App\Models\Calibre;
use App\Models\Marca;
use App\Models\User;
use App\Models\Origem;
use App\Models\Cadastroarmas;
use App\Notifications\Bellnotification;
use Illuminate\Support\Facades\DB;
class EspingardamistasController extends Controller
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
        
        $marcas = Marca::categoria('armas');
        $origens = Origem::all();
        $calibres = Calibre::whereArma('Espingarda mista');
        $armas = Arma::where('status', 1)->get();
        return view('perito.laudo.materiais.armas.espingardamista.create',
            compact('laudo', 'marcas', 'origens', 'calibres','armas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EspingardamistaRequest $request)
    {
        if($request->salva_cadastro==1){
            $admins = User::where('cargo_id', '2')->get();
            foreach ($admins as $admin) {
                $admin->notify(new Bellnotification('modelo armas'));
            }
            
        }
        salvaImagemArm($request);
        return redirect()->route('laudos.show',
            ['laudo_id' => $request->input('laudo_id')])
            ->with('success', __('flash.create_f', ['model' => 'Espingardamista']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arma $pistola
     * @return \Illuminate\Http\Response
     */
    public function show(Arma $espingardamista)
    {
        
        return view('perito.laudo.materiais.armas.espingardamista.show',
            compact('espingardamista'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laudo $laudo
     * @param  \App\Models\Arma $pistola
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo,  $espingardaMista)
    {
        
        $espingardamista=Arma::find($espingardaMista);
        
        $marcas = Marca::marcasWithTrashed('armas', $espingardamista->marca);
        
        $origens = Origem::origensWithTrashed($espingardamista->origem);
        if($espingardamista->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Espingardamista', $espingardamista->calibre);
        }
        $imagens = $espingardamista->imagens;
        return view('perito.laudo.materiais.armas.espingardamista.edit',
            compact('espingardamista', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Arma $pistola
     * @return \Illuminate\Http\Response
     */
    public function update(EspingardamistaRequest $request, $laudo_id, Arma $espingardamista)
    {
        
        atualizaImagemArm($request, $pistolete->id);
        return redirect()->route('laudos.show', ['id' => $laudo_id])
            ->with('success', __('flash.update_f', ['model' => 'Espingarda mista']));
    }
}