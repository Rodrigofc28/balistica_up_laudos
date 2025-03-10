<?php

namespace App\Http\Controllers\Perito\Municoes;

use App\Http\Controllers\Controller;
use App\Http\Requests\MunicaoRequest;
use App\Models\Municao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MunicoesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MunicaoRequest $request, $laudo)
{   
    $request->validate([
        'up_image' => 'image|mimes:jpeg,png,jpg',
        'up_image2' => 'image|mimes:jpeg,png,jpg',
    ]);

    $tipoMunicao = $request->input('tipo_municao');
    // Verifica se já existe um estojo com os mesmos dados
    $existeEstojo = Municao::where('tipo_municao', 'estojo')
    ->where('calibre_id', $request->calibre_id)
    ->where('marca_id', $request->marca_id)
    ->where('laudo_id', $request->laudo_id)
    ->where('estojo', $request->estojo)
    ->where('funcionamento', $request->funcionamento)
    ->where('tipo_projetil', $request->tipo_projetil)
    ->exists();

    if ($existeEstojo) {
        return redirect()->back()->with('error', 'Esse estojo já foi cadastrado.');
    }
    
    // Verifica se já existe um cartucho com os mesmos dados
    $existeCartucho = Municao::where('tipo_municao', 'cartucho')
        ->where('calibre_id', $request->calibre_id)
        ->where('marca_id', $request->marca_id)
        ->where('laudo_id', $request->laudo_id)
        ->where('estojo', $request->estojo)
        ->where('projetil', $request->projetil)
        ->where('tipo_projetil', $request->tipo_projetil)
        ->where('funcionamento', $request->funcionamento)
        ->where('funcionamentoCartucho', $request->funcionamentoCartucho)
        ->exists();

    if ($existeCartucho) {
        return redirect()->back()->with('error', 'Esse cartucho já foi cadastrado.');
    }

    // Processamento das imagens
    $data = $request->except('up_image', 'up_image2');
    
    if (($request->hasFile('up_image') && $request->file('up_image')->isValid()) &&
        ($request->hasFile('up_image2') && $request->file('up_image2')->isValid())) {
        
        $base = md5($request->file('up_image') . strtotime("now")) . '.jpg';
        $lateral = md5($request->file('up_image2') . strtotime("now")) . '.jpg';

        $uploadPath = storage_path('app/public/imagensMunicao');

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $request->file('up_image')->move($uploadPath, $base);
        $request->file('up_image2')->move($uploadPath, $lateral);

        $data['up_image'] = 'imagensMunicao/' . $base;
        $data['up_image2'] = 'imagensMunicao/' . $lateral;
    }

    Municao::create($data);
    //enviando as munições tipo cartucho para a view
      
    session()->put('municoes', Municao::where('tipo_municao', 'cartucho')//cria uma sessao e armazena as munições
        ->where('laudo_id', $laudo->id)
        ->get()); 
    session()->put('estojo', Municao::where('tipo_municao', 'estojo')//cria uma sessao e armazena as munições
        ->where('laudo_id', $laudo->id)
        ->get()); 
    return redirect()->back()
        ->with('success', __('flash.create_f', ['model' => $tipoMunicao]))
        ->with('lacre_entrada', $request->lacrecartucho)
        ->with('lacre_saida', $request->lacre_saida)
        ->with('rep_coleta', $request->rep_materialColetado);
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Municao $municao
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo, Municao $municao)
    {
        if ($municao->municao_de == "arma longa") {
            return redirect()->route('armas_longas.edit', [$laudo, $municao]);
        } 
        if($municao->municao_de == "arma curta") {
            return redirect()->route('armas_curtas.edit', [$laudo, $municao]);
        }
        return redirect()->route('laudos.show',
            ['laudo_id' => $laudo->id])
            ->with('warning', 'Não é possível editar este material!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Municao $municao
     * @return \Illuminate\Http\Response
     */
    public function update(MunicaoRequest $request, $laudo_id, Municao $municao)
    {
        // Inicializa os dados para atualização com todos os campos do request, exceto as imagens
        $updated_municao = $request->except('up_image', 'up_image2'); // Exclui as imagens do array de dados
    
        // Verifica se há um novo arquivo para a imagem 1
       
        if ($request->hasFile('up_image') && $request->file('up_image')->isValid()) {
            // Exclui a imagem anterior, se existir
            if (file_exists(storage_path('app/public/' . $municao->up_image))) {
                unlink(storage_path('app/public/' . $municao->up_image)); // Remove a imagem do diretório
            }
    
            // Gerar um nome único para o novo arquivo
            $base = md5($request->file('up_image')->getClientOriginalName() . strtotime("now")) . '.' . $request->file('up_image')->getClientOriginalExtension();
            $uploadPath = storage_path('app/public/imagensMunicao');
            
            // Verificar se a pasta existe, se não, criar
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
    
            // Mover o novo arquivo para a pasta
            $request->file('up_image')->move($uploadPath, $base);
    
            // Atualiza o campo 'up_image' com o novo caminho relativo
            $updated_municao['up_image'] = 'imagensMunicao/' . $base;
        } else {
            // Caso o usuário não envie uma nova imagem, manter o valor atual no banco
            $updated_municao['up_image'] = $municao->up_image;
        }
    
        // Verifica se há um novo arquivo para a imagem 2
        if ($request->hasFile('up_image2') && $request->file('up_image2')->isValid()) {
            // Exclui a imagem anterior, se existir
            if (file_exists(storage_path('app/public/' . $municao->up_image2))) {
                unlink(storage_path('app/public/' . $municao->up_image2)); // Remove a imagem do diretório
            }
    
            // Gerar um nome único para o novo arquivo
            $lateral = md5($request->file('up_image2')->getClientOriginalName() . strtotime("now")) . '.' . $request->file('up_image2')->getClientOriginalExtension();
            $uploadPath = storage_path('app/public/imagensMunicao');
    
            // Verificar se a pasta existe, se não, criar
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
    
            // Mover o novo arquivo para a pasta
            $request->file('up_image2')->move($uploadPath, $lateral);
    
            // Atualiza o campo 'up_image2' com o novo caminho relativo
            $updated_municao['up_image2'] = 'imagensMunicao/' . $lateral;
        } else {
            // Caso o usuário não envie uma nova imagem, manter o valor atual no banco
            $updated_municao['up_image2'] = $municao->up_image2;
        }
    
        // Atualiza o registro no banco de dados
        $municao->fill($updated_municao)->save();
   
        // Redireciona para a página do laudo com a mensagem de sucesso
        return redirect()->route('laudos.show', ['id' => $laudo_id])
            ->with('success', __('flash.update_f', ['model' => 'Munição']));
    }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param $laudo
     * @param $municao
     * @return \Illuminate\Http\Response
     */
    public function destroy($laudo, $municao)
    {
       // Municao::destroy($municao->id);
        DB::table('municoes')->where('id', $municao->id)->delete();
        return response()->json(['success' => 'done']);
    }
}
