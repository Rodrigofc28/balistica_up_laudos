<?php

namespace App\Http\Controllers\Perito\Armas;

use App\Http\Controllers\Controller;
use App\Models\Componente;
use App\Models\Marca;
use App\Models\Calibre;
use App\Models\Arma;
use App\Models\Origem;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\Bellnotification;
use App\Http\Requests\ComponenteRequest;


class PressaoCarabinaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($laudo)
    {
        $calibres=Calibre::all();
        $marcas = Marca::categoria('armas');
        return view('perito.laudo.materiais.armas.pressaocarabinas.create',
            compact('laudo','marcas','calibres'));
    }
    public function store(ComponenteRequest $request, $laudo)
    {
        if($request->salva_cadastro==1){
            $admins = User::where('cargo_id', '2')->get();
            foreach ($admins as $admin) {
                $admin->notify(new Bellnotification('modelo armas'));
            }
            
        }
        salvaImagemArm($request);
        return redirect()->route('laudos.show', ['id' => $laudo->id])
            ->with('success', __('flash.create_m', ['model' => 'Carabina']));
    }

    
    public function edit( $laudo, $carabinaPressao)
    {
        
        $carabinaPressao = Arma::find($carabinaPressao);
        $marcas = Marca::marcasWithTrashed('armas', $carabinaPressao->marca);
        $origens = Origem::origensWithTrashed($carabinaPressao->origem);
        if($carabinaPressao->calibre==null){
            $calibres =[]; 
        }else{
        $calibres = Calibre::calibresWithTrashed('Carabina pressao', $carabinaPressao->calibre);
        }
        $imagens = $carabinaPressao->imagens;
        return view('perito.laudo.materiais.armas.pressaocarabinas.edit',
            compact('carabinaPressao', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));

    }
    public function update(Request $request, $laudo_id, Arma $pressaocarabina)
    {
        
        atualizaImagemArm($request, $pressaocarabina->id);
        return redirect()->route('laudos.show', ['id' => $laudo_id])
            ->with('success', __('flash.update_f', ['model' => 'carabina de Pressão']));
    }
}
