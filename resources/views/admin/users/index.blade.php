@section('js')
{!! Html::script('js/cadastrousuariobottom.js') !!}
{!! Html::script('js/editarUsuarioCadastro.js') !!}
@extends('shared.tableusuario', ['card_name' => 'Listar Usuários',
'model_name_plural' => 'Usuários',
'model_name_singular' => 'Usuário',
'habilitar_pesquisa' => true,
'pesquisar' => 'Digite o nome do usuário cadastrado',
'route_search_name' => 'users',

'dados' => $users,
'ths' => ['Cadastrado','Nome', 'Email','Função','Ação']])

@section('table-content')


<style>
    .btnAcoesUsuarios{
        color: rgb(241, 244, 245);
        margin: auto
        
    }
    .conteinerModelCadastroUser{
        color:rgb(167, 169, 170);
        background-color:rgb(224, 219, 219);
      padding: 3%;
    }
    
    
    .conteinerModelCadastroUser > label,input,select {
        width: 100%;
        text-align:left;
    }
   
</style>

<div style="display: flex">
{{--Busca Pelo Nome--}}
    <form method="GET"  action="{{ route('users.search') }}">
        <div style="display: flex">
            <input type="text" style="width: 100%" name="search" placeholder="Buscar por nome">
            <button type="submit" class="btn btn-light"  style="display: flex; align-items: center;">    
                <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
        </div>
        
    </form>
{{--Busca Não Cadastrados--}}
    <form method="GET"  action="{{ route('naoCadastrados') }}">
        <div style="display: flex">
            
            <button type="submit" class="btn btn-light"  style="display: flex; align-items: center;">    
                
                <b>Não Cadastrados</b>
                &nbsp
                <img src="{{asset('image/check.png')}}" alt="">
            </button>
        </div>
        
    </form>
{{--Todos--}}
    <form method="GET"  action="{{ route('users.search') }}">
        <div style="display: flex">
            
            <button type="submit" class="btn btn-light"  style="display: flex; align-items: center;">    
               <b>Todos os Usuarios</b>
               &nbsp
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                </svg>
            </button>
        </div>
        
    </form>
{{--Seleciona por Função--}}
    <form method="GET"  action="{{ route('funcao') }}">
        <div style="display: flex">
           
            
                
               <b>Busca por Função</b>
               
       
            <select name="funcao"  onchange="this.form.submit()">
                <option selected ></option>
                <option value="1">Perito</option>
                <option value="3">Técnico</option>
                <option value="2">Administrador</option>
            </select>
        </div>
        
    </form>
</div>
@if (count($usuarios) > 0)

 @php

    $notificacoes = Auth::user()->unreadNotifications->where('data.mensagem', 'usuarios a ser cadastrado');
    if ($notificacoes->isNotEmpty()) {
        // Marca todas as notificações como lidas
        $notificacoes->markAsRead();
    }
            
    $arrayColection= $usuarios->all();
    $usuarios=array_reverse($arrayColection);


 @endphp


@foreach( $usuarios as $usuario  )


<tr >
    
        <td >
            @if($usuario->status=='cadastrado')
                <img src="{{asset('image/verificar.png')}}" alt="">
            @else
                <img src="{{asset('image/check.png')}}" alt="">
            @endif
        </td>
        {!! Form::open(['route' => ['users.store', $usuario->id], 'method' => 'post']) !!} 
                <td >{{$usuario->nome}}</td>
                <td >{{ $usuario->email }}</td>
                @if($usuario->cargo_id==1 )
                    <td>Perito</td>
                @elseif($usuario->cargo_id==3)
                    <td>Técnico de Perícia</td>
                @else
                    <td>Administrador</td>
                @endif
                <td  >
                    <div style="display: flex;" >
                    
                        <button  id="confirmacadastrobutton"  class="btn btn-success btnAcoesUsuarios"  type="submit"  >
                            <svg class="svg-inline--fa fa-plus fa-w-14" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
                            Cadastrar
                        </button>
        {{ Form::close() }} 
                <button  value="{{ route('users.update', $usuario) }}" data-secao='@json($secao)'  data-usuario='@json($usuario)'  type="button" class="btn btn-primary btnAcoesUsuarios show-alert">
                    <svg class="svg-inline--fa fa-edit fa-w-18 fa-fw" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path></svg>
                    Editar
                </button>
               
                <button value="{{ route('usuarios.destroy', $usuario) }}" class="btn btn-danger delete">
                    <svg class="svg-inline--fa fa-trash fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg><!-- <i class="fa fa-fw fa-trash"></i> -->
                    Deletar
                </button>
                    
            </div>
        </td>
     
            
</tr>        
@endforeach
@endif


@endsection
@endsection
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>    

    
 


