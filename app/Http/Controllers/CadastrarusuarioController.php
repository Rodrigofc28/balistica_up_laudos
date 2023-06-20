<?php

namespace App\Http\Controllers;

use App\Models\Secao;
use Illuminate\Http\Request;
use App\Models\cadastrousuario;
use App\Http\Requests\cadastroRequest;
use Illuminate\Support\Facades\Hash;

class CadastrarusuarioController extends Controller
{
   public function index(){
    $secoes = Secao::all();
        
    return view('cadastros.index',compact('secoes'));
   }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(cadastroRequest $request)
    {
       
       
        

       //$senhaDescriptografada=$this->decryptPassword($senhaCriptografada,'JtKS');
        //dd($senhaCriptografada,$senhaDescriptografada);
    $senhaCodificada= Hash::make($request['password']);    
    $usuarioNovo=$request->except('password','senhaGDL');
    $senhaCriptografada=$this->encryptPassword($request->senhaGDL,'JtKSJtKSJtKSJtKS');
    $usuarioNovoCadastro= array_merge($usuarioNovo,['password'=>$senhaCodificada,'senhaGDL'=>$senhaCriptografada]); 
    cadastrousuario::create($usuarioNovoCadastro);
    
    //cadastrousuario::create($request->all());
    return redirect()->route('home');
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param cadastrousuario $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        
        cadastrousuario::destroy($request->usuario);
       
        return redirect()->route('users.index');
    }

    function encryptPassword($password, $key) {
        $encryptedPassword = openssl_encrypt($password, 'AES-128-ECB', $key);
        return base64_encode($encryptedPassword);
    }
    
}
