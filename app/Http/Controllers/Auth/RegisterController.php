<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\UserRequest;
use App\Models\Cargo;
use App\Models\Secao;
use App\Models\User;
use App\Notifications\Bellnotification;
use App\Models\cadastrousuario;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\cadastroRequest;
use Illuminate\Http\Request;
class RegisterController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {   
       
        $cargos = Cargo::all();
        $secoes = Secao::all();
        return view('admin/users/create', compact('cargos', 'secoes'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRequest $request)
    {
        $admins = User::where('cargo_id', '2')->get();
            foreach ($admins as $admin) {
                $admin->notify(new Bellnotification('usuarios a ser cadastrado'));
            }
           
        event(new Registered($user = $this->create($request->all())));
       
        return redirect()->route('users.index')
            ->with('success', __('flash.create_m', ['model' => 'Usuário']));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Criminalistica\User
     */
    protected function create(array $data)
    {
        
        User::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'secao_id' => $data['secao_id'],
            'cargo_id' => $data['cargo_id'],
            'password' => Hash::make($data['password']),
            'senhaGDL' => $data['senhaGDL'],
            'userGDL' => $data['userGDL']
        ]);
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param cadastrousuario $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(cadastrousuario $usuario)
    {   
        cadastrousuario::destroy($usuario->id);
       
        return response()->json(['success' => 'done']);
    }
}
