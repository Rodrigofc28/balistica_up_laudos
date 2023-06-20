<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Secao;
use App\Models\User;
use App\Http\Requests\UserUpdateRequest;
use App\Models\cadastrousuario;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
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
    public function index( )
    {   
        $cargos = Cargo::all();
        
        $usuarios=cadastrousuario::all();
        $users = User::paginate(10);
        return view('admin.users.index', compact('users','usuarios','cargos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $secoes = Secao::all();
        $cargos = Cargo::all();
        return view('admin.users.edit',
            compact('user', 'secoes', 'cargos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $senhaCriptografada=$this->encryptPassword($request->novaSenha,'JtKSJtKSJtKSJtKS');
        $user_updates =['senhaGDL'=>$senhaCriptografada];
 
        User::find($user->id)->fill($user_updates)->save();

        return redirect()->route('users.index')
            ->with('success', __('flash.update_m', ['model' => 'Usuário']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {   
        DB::table('laudos')->where('perito_id', '=', $user->id)->delete();
         DB::table('users')->where('id', '=', $user->id)->delete();
         
         
        $cargos = Cargo::all();
        $secoes = Secao::all();
        //User::destroy($user->nome);
        
        
        $usuarios=cadastrousuario::all();
        $users = User::paginate(10);
        return view('admin.users.index', compact('users','usuarios','cargos', 'secoes'));
    }

    public function search($nome)
    {
        $user = User::where('nome', 'like',"%$nome%")->first();
        if(empty($user)){
            return response()->json(['fail' => 'true',
            'message' => 'Nenhum usuário encontrado em este nome (' . $nome . ')']);
        } else {
            
           return response()->json(['fail' => 'true',
            'message' => ' usuário encontrado com este nome: ' . $user->nome . ' E-mail: '.$user->email. ' data do cadastro: '.$user->created_at]);
        }
    }
    function encryptPassword($password, $key) {
        $encryptedPassword = openssl_encrypt($password, 'AES-128-ECB', $key);
        return base64_encode($encryptedPassword);
    }


}
