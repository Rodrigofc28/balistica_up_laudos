<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

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
    //deletar
    public function delete($outro)
    {
       
        Outros_balistica::where('id', $outro)->update(['status' => 0]);
        Outros_balistica::where('id', $outro)->delete();
         
         return response()->json(['message' => 'Outro material deletado com sucesso!']);
       
    }

    

    
}
