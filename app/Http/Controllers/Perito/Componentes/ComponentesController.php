<?php

namespace App\Http\Controllers\Perito\Componentes;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComponenteRequest;
use App\Models\Componente;
use Illuminate\Support\Facades\DB;
use App\Models\Marca;
use App\Models\Arma;

class ComponentesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComponenteRequest $request, $laudo)
    {
        $requestAderencia=implode(', ',$request->aderencia);
        $requ=implode(', ',$request->deformacaoAcidental);
        //$uyt=json_decode ($requ);
        
        
        Componente::create($request->except('aderencia','deformacaoAcidental'));
       
        DB::table('componentes')->where('lacrecartucho',$request->lacrecartucho)->update(['deformacaoAcidental'=>$requ]);
        DB::table('componentes')->where('lacrecartucho',$request->lacrecartucho)->update(['aderencia'=>$requestAderencia]);
        return redirect()->back()//route('laudos.show', ['id' => $laudo->id])
            ->with('success', __('flash.create_m', ['model' => 'projéteis']))
            ->with('lacre_projetil_entrada',$request->lacrecartucho)
            ->with('lacre_projetil_saida',$request->lacreSaida)
            ->with('rep_coleta',$request->rep_materialColetado)
            ->with('detalhe_localizacao',$request->detalharLocalizacao)
            ->with('origem',$request->origem_coletaPerito);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $laudo
     * @param  Componente $componente
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo, Componente $componente)
    {
        
       
      
        return view('perito.laudo.materiais.componentes.balins_chumbo.edit',
            compact( 'laudo', 'componente'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ComponenteRequest $request, $laudo, $componente)
    {
       
        $requestAderencia=implode('/',$request->aderencia);
        $requ=implode('/',$request->deformacaoAcidental);
        
        $updated_componente = $request->except('deformacaoAcidental','aderencia');
        
       
        Componente::find($componente->id)->fill($updated_componente)->save();
        
        DB::table('componentes')->where('lacrecartucho',$request->lacrecartucho)->update(['deformacaoAcidental'=>$requ,'aderencia'=>$requestAderencia]);
        return redirect()->route('laudos.show', ['id' => $laudo->id])
            ->with('success', __('flash.update_m', ['model' => 'Projetil']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $laudo
     * @param $componente
     * @return \Illuminate\Http\Response
     */
    public function destroy($laudo, $componente)
    {
       // Componente::destroy($componente->id);
        DB::table('componentes')->where('id', $componente->id)->delete();
        return response()->json(['success' => 'done']);
    }
}
