<?php

namespace App\Http\Controllers\Perito;
use App\Http\Requests\ArmaRequest;
use App\Models\Calibre;
use App\Models\ImagemEmbalagem;
use App\Models\Marca;
use App\Models\Origem;
use App\Models\Arma;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Svg\Tag\Image;


class CadastrarImagensEmbalagemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $arma
     * @return \Illuminate\Http\Response
     */
    

    public function store(Request $request)
    {
        
   
        $laudo_id=$request->laudo_id;
        if($request->fotoEmbalagem==null){
            return view('perito.laudo.create_embalagem_foto', compact('laudo_id'));
        }
       
       
       
        //para adicionar mais fotos as embalagens
         if($request->status=='adicionar'){
            foreach($request->fotoEmbalagem as $imagensEmbalagem){
       
                $converte=md5($imagensEmbalagem.strtotime("now")).'.'.'jpg';
            
                ImagemEmbalagem::create(['nome'=>$converte,'laudo_id'=>$request->laudo_id]);
            
                
                
                if (!is_dir(storage_path('app/public/imagensEmbalagem'))) { // verifica se existe a pasta upload
                    mkdir(storage_path('app/public/imagensEmbalagem'), 0755, true); //cria a pasta com permissão 0755
                    $imagensEmbalagem->move(storage_path('app/public/imagensEmbalagem'),$converte);
                }else{
                    $imagensEmbalagem->move(storage_path('app/public/imagensEmbalagem'),$converte);
                };
         };
      
            return view('perito.laudo.create_embalagem_foto', compact('laudo_id'))->with('msg', 'Imagem substituída com sucesso!');
        }else if($request->status=='cadastrar'){
        // para cadastrar as fotos das embalagens
            foreach($request->fotoEmbalagem as $imagensEmbalagem){
       
                $converte=md5($imagensEmbalagem.strtotime("now")).'.'.'jpg';
            
                ImagemEmbalagem::create(['nome'=>$converte,'laudo_id'=>$request->laudo_id]);
            
                
                
                if (!is_dir(storage_path('app/public/imagensEmbalagem'))) { // verifica se existe a pasta upload
                    mkdir(storage_path('app/public/imagensEmbalagem'), 0755, true); //cria a pasta com permissão 0755
                    $imagensEmbalagem->move(storage_path('app/public/imagensEmbalagem'),$converte);
                }else{
                    $imagensEmbalagem->move(storage_path('app/public/imagensEmbalagem'),$converte);
                };
         };
           return redirect()->route('laudos.materiais', ['laudo_id' => $laudo_id]);
        }
     
         
    
      
 
        
        
    }
   
    public function update(Request $request)
            {
              
                // Buscar a imagem existente pelo ID
                $imagem = ImagemEmbalagem::where('id', $request->id)->first();
               
                if (!$imagem) {
                    return redirect()->back()->with('msgerror', "Imagem não encontrada.");
                }

                // Verificar se uma nova imagem foi enviada
                if (!$request->hasFile('fotoEmbalagem')) {
                    return redirect()->back()->with('msgerror', "Nenhuma imagem foi enviada para atualizar.");
                }

                // Processar a nova imagem
                $novaImagem = $request->file('fotoEmbalagem');
                $novoNome = md5($novaImagem . strtotime("now")) . '.' . $novaImagem->getClientOriginalExtension();

                // Caminho do diretório de armazenamento
                $diretorio = storage_path('app/public/imagensEmbalagem');

                // Criar o diretório caso ele não exista
                if (!is_dir($diretorio)) {
                    mkdir($diretorio, 0755, true);
                }

                // Remover a imagem antiga, se existir
                $caminhoAntigo = $diretorio . '/' . $imagem->nome;
                if (file_exists($caminhoAntigo)) {
                    unlink($caminhoAntigo);
                }

                // Salvar a nova imagem no diretório
                $novaImagem->move($diretorio, $novoNome);

                // Atualizar o registro no banco de dados
                $imagem->nome = $novoNome;
                $imagem->save();

                return redirect()->back()->with('msg', "Imagem substituída com sucesso!");
            }


    public function destroy($image){
        ImagemEmbalagem::findOrFail($image)->delete();
        return redirect()->back()->with('msg',"Imagem deletada");
    } 
    
}
