<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Controllers\Perito\Armas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Armas\PistoleteRequest;
use App\Models\Arma;
use App\Models\Calibre;
use App\Models\Marca;
use App\Models\Origem;
use App\Models\Cadastroarmas;
use Illuminate\Http\Request;
use App\Notifications\Bellnotification;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class PressaoPistolaController extends Controller
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
        $calibres = Calibre::whereArma('Pistolete');
        $armas = DB::select('select modelo from cadastroarmas ');
        return view('perito.laudo.materiais.armas.pressaopistolas.create',
            compact('laudo', 'marcas', 'origens', 'calibres','armas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        return view('perito.laudo.materiais.armas.pressaopistolas.show',
            compact('arma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laudo $laudo
     * @param  \App\Models\Arma $pistola
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo, $pistolaPressao)
    {
        
        $pistolaPressao = Arma::find($pistolaPressao);
        $marcas = Marca::marcasWithTrashed('armas', $pistolaPressao->marca);
        $origens = Origem::origensWithTrashed($pistolaPressao->origem);
        if($pistolaPressao->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('pressaopistolas', $pistolaPressao->calibre);
        }
        $imagens = $pistolaPressao->imagens;
        
        return view('perito.laudo.materiais.armas.pressaopistolas.edit',
            compact('pistolaPressao', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Arma $pistola
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $laudo_id, Arma $pressaopistola)
    {
        $updated_arma = $request->all();
        Arma::find($pressaopistola->id)->fill($updated_arma)->save();
        return redirect()->route('laudos.show', ['id' => $laudo_id])
            ->with('success', __('flash.update_f', ['model' => 'Pistola de Pressão']));
    }
}