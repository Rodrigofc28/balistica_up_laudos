<?php

namespace App\Http\Controllers\Perito\Componentes;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComponenteRequest;
use App\Models\Componente;
use Illuminate\Support\Facades\DB;
use App\Models\Marca;
use App\Models\Arma;
use App\Models\Calibre;
use Illuminate\Http\Request;
class ComponentesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $laudo)
    {
     
        if($request->input('calibreNominal') == 'sem'){
            $request->merge(['calibreNominal' => null]);
        }
        $request->validate([
            'up_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'up_image2' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
        if($request->input('aderencia')){
            $requestAderencia = implode(', ', $request->aderencia);
        }else{
            $requestAderencia = '';
        }
        if($request->input('deformacaoAcidental')){
            $requ = implode(', ', $request->deformacaoAcidental);
        }else{
            $requ = "";
        }
        
    
        if ($request->hasFile('up_image') && $request->file('up_image')->isValid() &&
            $request->hasFile('up_image2') && $request->file('up_image2')->isValid()) {
            
            $base = md5($request->file('up_image')->getClientOriginalName() . strtotime("now")) . '.' . $request->file('up_image')->getClientOriginalExtension();
            $lateral = md5($request->file('up_image2')->getClientOriginalName() . strtotime("now")) . '.' . $request->file('up_image2')->getClientOriginalExtension();
    
            $uploadPath = storage_path('app/public/imagensMunicaoProjeteis');
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
    
            $request->file('up_image')->move($uploadPath, $base);
            $request->file('up_image2')->move($uploadPath, $lateral);
    
            // Preparar dados para o banco de dados
            $data = $request->except(['up_image', 'up_image2', 'aderencia', 'deformacaoAcidental']); // Excluir campos desnecessários
            $data['up_image'] = 'imagensMunicaoProjeteis/' . $base;
            $data['up_image2'] = 'imagensMunicaoProjeteis/' . $lateral;
    
            // Criar registro no banco
            Componente::create($data);
        }
    
        DB::table('componentes')->where('lacrecartucho', $request->lacrecartucho)->update([
            'deformacaoAcidental' => $requ,
            'aderencia' => $requestAderencia,
        ]);
        session()->put('projetil', Componente::where('laudo_id', $laudo->id)
        ->get()); 
       
        return redirect()->back()
            ->with('success', __('flash.create_m', ['model' => 'projéteis']))
            ->with('lacre_projetil_entrada', $request->lacrecartucho)
            ->with('lacre_projetil_saida', $request->lacreSaida)
            ->with('rep_coleta', $request->rep_materialColetado)
            ->with('detalhe_localizacao', $request->detalharLocalizacao)
            ->with('origem', $request->origem_coletaPerito);
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
        $calibres = Calibre::whereNotArmas();
       
      
        return view('perito.laudo.materiais.componentes.balins_chumbo.edit',
            compact( 'laudo', 'componente','calibres'));

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
        // Validação dos arquivos de imagem
        $request->validate([
            'up_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'up_image2' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        // Preparação dos campos de texto
        $requestAderencia = implode(', ', $request->aderencia);
        $requ = implode(', ', $request->deformacaoAcidental);
    
        // Verificar se os arquivos de imagem foram enviados e processá-los
        if ($request->hasFile('up_image') && $request->file('up_image')->isValid() &&
            $request->hasFile('up_image2') && $request->file('up_image2')->isValid()) {
            
            $base = md5($request->file('up_image')->getClientOriginalName() . strtotime("now")) . '.' . $request->file('up_image')->getClientOriginalExtension();
            $lateral = md5($request->file('up_image2')->getClientOriginalName() . strtotime("now")) . '.' . $request->file('up_image2')->getClientOriginalExtension();
    
            $uploadPath = storage_path('app/public/imagensMunicaoProjeteis');
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
    
            $request->file('up_image')->move($uploadPath, $base);
            $request->file('up_image2')->move($uploadPath, $lateral);
    
            // Atualizar o componente com as novas imagens
            $updated_componente = $request->except(['up_image', 'up_image2', 'aderencia', 'deformacaoAcidental']);
            $updated_componente['up_image'] = 'imagensMunicaoProjeteis/' . $base;
            $updated_componente['up_image2'] = 'imagensMunicaoProjeteis/' . $lateral;
    
            Componente::find($componente->id)->fill($updated_componente)->save();
        } else {
            // Se não houver novas imagens, apenas atualiza outros dados
            $updated_componente = $request->except(['aderencia', 'deformacaoAcidental']);
            Componente::find($componente->id)->fill($updated_componente)->save();
        }
    
        // Atualizar os campos 'deformacaoAcidental' e 'aderencia' na tabela 'componentes'
        DB::table('componentes')->where('lacrecartucho', $request->lacrecartucho)->update([
            'deformacaoAcidental' => $requ,
            'aderencia' => $requestAderencia,
        ]);
    
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
