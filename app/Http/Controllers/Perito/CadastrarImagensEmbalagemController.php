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
        //transforma em file
        
        if($request->fotoEmbalagem==null){
            return redirect()->back()->with('msgerror',"Erro ao tenta salva imagem"); 
        }
       
        
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
       return redirect()->back()->with('msg',"Imagem salva com sucesso");
      // 
    }
    
    public function destroy($image){
        ImagemEmbalagem::findOrFail($image)->delete();
        return redirect()->back()->with('msg',"Imagem deletada");
    } 
    
}
