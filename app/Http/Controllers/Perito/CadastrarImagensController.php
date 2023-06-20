<?php

namespace App\Http\Controllers\Perito;

use App\Http\Requests\ArmaRequest;
use App\Models\Calibre;
use App\Models\ImagensMunicoes;
use App\Models\Marca;
use App\Models\Origem;
use App\Models\Arma;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Svg\Tag\Image;

class CadastrarImagensController extends Controller
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
                $countIdMunicao=explode(',',$request->municao_id);
                
                $converte=md5($imagensMunicao.strtotime("now")).'.'.'jpg';
                /* 
                if(count($countIdMunicao)>0){
                    foreach($countIdMunicao as $idsMunicao)
                    {
                    ImagensMunicoes::create(['nome'=>$converte,'municao_id'=>$idsMunicao]);
                    }
                }else
                { */
                    ImagensMunicoes::create(['nome'=>$converte,'municao_id'=>$countIdMunicao[0]]);
              /*   } */
                    
                    
                if (!is_dir(storage_path('app/public/imagensMunicao'))) { // verifica se existe a pasta upload
                        mkdir(storage_path('app/public/imagensMunicao'), 0755, true);
                        $imagensMunicao->move(storage_path('app/public/imagensMunicao'),$converte);
                }else
                {
                        $imagensMunicao->move(storage_path('app/public/imagensMunicao'),$converte);
                };
         };
       return redirect()->back()
       ->with('msg',"Imagem salva com sucesso")
       ->with('idImag',$request->municao_id);
      // 
    }
    public function destroy($image){
        ImagensMunicoes::findOrFail($image)->delete();
        return redirect()->back()->with('msg',"Imagem deletada");
    } 
}