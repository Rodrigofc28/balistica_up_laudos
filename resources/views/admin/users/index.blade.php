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
        color:rgb(205, 214, 218);
        background-color:rgb(66, 66, 66);
      padding: 3%;
    }
    
    
    .conteinerModelCadastroUser > label,input,select {
        width: 100%;
        text-align:left;
    }
   
</style>


<input type="text" placeholder="Busca por E-mail">
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

    
 


