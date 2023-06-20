@section('js')
{!! Html::script('js/cadastrousuariobottom.js') !!}

@extends('shared.tableusuario', ['card_name' => 'Listar Usuários',
'model_name_plural' => 'Usuários',
'model_name_singular' => 'Usuário',
'habilitar_pesquisa' => true,
'pesquisar' => 'Digite o nome do usuário cadastrado',
'route_search_name' => 'users',

'dados' => $users,
'ths' => ['Nome', 'Email', 'Função']])

@section('table-content')




<h1 >Pedidos para cadastro</h1>
@if (count($usuarios) > 0)

 @php
    $arrayColection= $usuarios->all();
    $usuarios=array_reverse($arrayColection);


 @endphp


@foreach( $usuarios as $usuario  )
{!! Form::open(['route' => 'register']) !!}

<tr >
    
    <td >@include('admin.shared.attributes.nomecadastrousuario', ['nome' => $usuario->nome ?? old('nome',$usuario->nome)]){{$usuario->nome}}</td>
    <td >@include('admin.shared.attributes.email', ['email' => $usuario->email ?? old('email',$usuario->email)]) {{ $usuario->email }}</td>
    <td >@include('admin.shared.attributes.cargo', ['cargos' => $cargos, 'cargo2' => $user->cargo_id ?? old('cargo_id')])</td>
    <input type="text" hidden name="secao_id" value="{{$usuario->secao_id}}">
    <input type="text" hidden name="userGDL" value="{{$usuario->userGDL}}">
    <input type="text" hidden name="senhaGDL" value="{{$usuario->senhaGDL}}">
    @include('admin.shared.attributes.senha', ['label' => 'Senha', 'name' => 'password', 'required' => 'required' ?? old('senha',$usuario->password)   ])
    @include('admin.shared.attributes.senha', ['label' => 'Confirmação da Senha', 'name' => 'confirmacao_senha',
        'required' => 'required' ?? old('senha',$usuario->password)  ])
    <td  >
        <div >
        
            <button  id="confirmacadastrobutton" style="width:90px;height:30px" class="btn btn-success"  type="submit"  >
                <span  >Cadastrar</span> 
            </button>
            {{ Form::close() }} 
            @foreach( $users as $user  )
                @if($user->email==$usuario->email)
                
                
                <form action="{{ route('users.destroy', $user)  }}" method="post">
                            {{ csrf_field() }}
                    <button  type="submit" id="submitcadastro" style="width:90px;height:30px" class="btn btn-danger" >Deletar</button>
                </form>
                @endif  
                

            @endforeach 
        
            
        </div>
    </td>
       <td>
       @foreach( $users as $user  )
                @if($user->email==$usuario->email)
                {{$user->cargo->nome}}
                
                
                @endif  
                

            @endforeach 

       </td>
        <td>
        @foreach( $users as $user  )
                @if($user->email==$usuario->email)
                
                
                <form action="{{ route('users.update', $user)  }}" method="post">
                    {{ csrf_field() }}
                    Nova Senha <input type="password" name="novaSenha" id="">
                    <input type="submit" value="enviar">
                </form>
                @endif
        @endforeach
        </td>
            
</tr>        
@endforeach
@endif


@endsection
@endsection
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>    
    
    
 


