<?php

namespace App\Http\Controllers\Perito;

use App\Http\Requests\ArmaRequest;
use App\Models\Calibre;
use App\Models\ImagensProjetil;
use App\Models\Marca;
use App\Models\Origem;
use App\Models\Arma;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Svg\Tag\Image;

class CadastrarImagensProjetilController extends Controller
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
        if($request->image==null){
            return redirect()->back()->with('msgerror',"Erro ao tenta salva imagem"); 
        }
       
        
       foreach($request->image as $imagensMunicao){
       
       $converte=md5($imagensMunicao.strtotime("now")).'.'.'jpg';
    
        ImagensProjetil::create(['nome'=>$converte,'projetil_id'=>$request->projetil_id]);
       
        
        
        if (!is_dir(storage_path('app/public/imagensProjetil'))) { // verifica se existe a pasta upload
            mkdir(storage_path('app/public/imagensProjetil'), 0755, true);
            $imagensMunicao->move(storage_path('app/public/imagensProjetil'),$converte);
        }else{
            $imagensMunicao->move(storage_path('app/public/imagensProjetil'),$converte);
        };
         };
       return redirect()->back()->with('msg',"Imagem salva com sucesso");
      // 
    }
    public function destroy($image){
        ImagensProjetil::findOrFail($image)->delete();
        return redirect()->back()->with('msg',"Imagem deletada");
    } 
}