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
use Illuminate\Support\Facades\Auth;
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
        $secao = Secao::all();
        $usuarios = User::orderBy('nome', 'desc') // Ordenação alfabética crescente
                        ->get();
        $users = User::paginate(10);
       
        return view('admin.users.index', compact('users','usuarios','cargos','secao'));
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
    
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */



     
     public function store(Request $request, User $user)
     {
         
         $user->status = 'cadastrado';
        
         if ($request->filled('password')) {
             $user->password = Hash::make($request->input('password'));
         }
 
       
         $user->save();
 
         return redirect()->route('users.index')
             ->with('success', __('flash.update_m', ['model' => 'Usuário']));
     }
    /**
    
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */



     
     public function update(Request $request, $id)
     {
         
         // Encontra o usuário pelo ID
         $user = User::findOrFail($request->id);
     
         // Valida os dados recebidos
         $request->validate([
             'nome' => 'required',
             'email' => 'required|string|email|unique:users,email,' . $request->id,
         ]);
     
         // Atualiza os campos do usuário
         $user->nome = $request->input('nome');
         $user->email = $request->input('email');
         $user->userGDL = $request->input('userGDL');
         $user->senhaGDL = $request->input('senhaGDL');
         
         $user->cargo_id = $request->has('cargo_id') ? $request->input('cargo_id') : $user->cargo_id;
         
         
         $user->secao_id = $request->input('secao_id');

         $user->tecnico_perito_aut = $request->input('tecnico_perito_aut') ?? [];
         $user->save();
    
         // Retorna uma resposta JSON
         return response()->json(['message' => 'Usuário atualizado com sucesso!']);
     }
    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        try {
            
          $user =  DB::table('users')->where('id', $id->id)->delete();
            
         
            if ($user) {
               
                 return response()->json(['success' => true, 'message' => 'Usuário deletado com sucesso!']);
            }
               
            else {
                return response()->json(['success' => false, 'message' => 'Usuário não encontrado!']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erro ao deletar: ' . $e->getMessage()]);
        }
    }
    //busca pelo nome do usuario
    public function search(Request $request)
    {
        $cargos = Cargo::all();
        $secao = Secao::all();
        $users = User::paginate(10); 
        $search = $request->input('search');

        $usuarios = User::when($search, function ($query, $search) {
            return $query->where('nome', 'LIKE', "%{$search}%");
        })
        ->orderBy('nome', 'desc') // Ordenação alfabética (A-Z)
        ->get();
    
        return view('admin.users.index', compact('users','usuarios','cargos','secao'));
    }
    //Busca os não cadastrados 
    public function naoCadastrados()
    {
        $cargos = Cargo::all();
        $secao = Secao::all();
        $users = User::paginate(10); 
        $search='nao cadastrado';

        $usuarios = User::where('status', 'nao cadastrado')->get();
    
        return view('admin.users.index', compact('users','usuarios','cargos','secao'));
    }
    //Busca pela função 
    public function funcao(Request $request)
    {
      
        $cargos = Cargo::all();
        $secao = Secao::all();
        $users = User::paginate(10); 
        $search='nao cadastrado';

        $usuarios = User::where('cargo_id', $request->funcao)->get();
    
        return view('admin.users.index', compact('users','usuarios','cargos','secao'));
    }

    //Perfil do usuario
    public function userPerfil(Request $request)
    {   
        $userAll=User::all();
        $user=Auth::user();
        $secao = Secao::all();
        $userAll = $userAll->filter(function($user) {
            return $user->cargo_id == 3;
        });
        return view('perito.perfil.index', compact('user','secao','userAll'));
    }
    function encryptPassword($password, $key) {
        $encryptedPassword = openssl_encrypt($password, 'AES-128-ECB', $key);
        return base64_encode($encryptedPassword);
    }


}
