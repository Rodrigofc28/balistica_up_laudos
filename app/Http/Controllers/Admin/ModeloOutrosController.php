<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outros_balistica;

class ModeloOutrosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outros = Outros_balistica::paginate(10);
        return view('admin.outros.index',compact('outros'));
    }
    //modificar status
    public function update(Request $request)
    {

        //ajusta para ver se foi cadastrado
        Outros_balistica::where('id', $request->id)->update(['status' => 1,'descricao_item'=>$request->descricao_item,'marca'=>$request->marca,'nome'=>$request->nome]);
         
        
       
        return response()->json(['message' => 'Arma cadastrada com sucesso!']);
        
    }
    //deletar
    public function delete($outro)
    {
       
       
        Outros_balistica::destroy($outro);
         
         return response()->json(['message' => 'Outro material deletado com sucesso!']);
       
    }

    

    
}
