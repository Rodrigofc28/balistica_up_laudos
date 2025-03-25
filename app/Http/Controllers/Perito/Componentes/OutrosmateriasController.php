<?php

namespace App\Http\Controllers\Perito\Componentes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Componente;
use App\Models\Outros_balistica;

class OutrosmateriasController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($laudo)
    {
        
        return view('perito.laudo.materiais.componentes.outros.create',
            compact('laudo'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  $laudo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $request->validate([
            'up_image' => 'image|mimes:jpeg,png,jpg',
            'up_image2' => 'image|mimes:jpeg,png,jpg',
        ]);
      // Processamento das imagens
        $data = $request->except('up_image', 'up_image2');

        if ($request->hasFile('up_image') && $request->file('up_image')->isValid() &&
            $request->hasFile('up_image2') && $request->file('up_image2')->isValid()) {
            
            $base = md5($request->file('up_image') . strtotime("now")) . '.jpg';
            $lateral = md5($request->file('up_image2') . strtotime("now")) . '.jpg';
    
            $uploadPath = storage_path('app/public/imagensOutros');
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
    
            $request->file('up_image')->move($uploadPath, $base);
            $request->file('up_image2')->move($uploadPath, $lateral);
    
            // Preparar dados para o banco de dados
            $data = $request->except(['up_image', 'up_image2']); // Excluir campos desnecessários
            $data['up_image'] = 'imagensOutros/' . $base;
            $data['up_image2'] = 'imagensOutros/' . $lateral;
    
            
        }
            Outros_balistica::create($data);
        

        return redirect()->route('laudos.show',
        ['laudo_id' => $request->input('laudo_id')])
        ->with('success', __('flash.create_f', ['model' => 'Material ']));
        
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
        return view('perito.laudo.materiais.componentes.polvora.edit',
            compact('componente', 'laudo'));
    }
}
