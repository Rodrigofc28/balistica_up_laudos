<?php

namespace App\Http\Controllers\Perito\Municoes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Calibre;
use App\Models\Marca;
use App\Models\Municao;
use App\Models\Armas_Gdl;
class ArmasCurtasController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$laudo)
    {
        $arma_estojo_gdl=Armas_Gdl::find($request->id);
        $marcas = Marca::categoria('municoes');
        $calibres = Calibre::whereNotArmas(['Espingarda']);
        return view('perito.laudo.materiais.municoes.arma_curta.create',
            compact('laudo', 'marcas', 'calibres','arma_estojo_gdl'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Municao $municao
     * @return \Illuminate\Http\Response
     */
    public function show(Municao $municao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Municao $municao
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo, Municao $municao)
    {
        $marcas = Marca::marcasWithTrashed('municoes', $municao->marca);
        $calibres = Calibre::calibresMunicoesWithTrashed(['revólver', 'pistola'], $municao->calibre);
        return view('perito.laudo.materiais.municoes.arma_curta.edit',
            compact('municao', 'laudo', 'marcas', 'calibres'));
    }
}
