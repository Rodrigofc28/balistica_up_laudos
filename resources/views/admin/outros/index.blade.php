@section('js')
{!! Html::script('js/admin_modelo_outro.js') !!}

@endsection

@extends('shared.tabela_cadastro_outros', ['card_name' => 'Países',
'model_name_plural' => 'Cadastrar outros materiais',
'model_name_singular' => 'Cadastrar outro material',

'ths' => ['CADASTRADO','CADASTRADA PELO(A) PERITO(A)','NOME','MARCA','AÇÃO']])

                
            
            @php
                // Marca todas as notificações como lidas
                $notificacoes = Auth::user()->unreadNotifications->where('data.mensagem', 'modelo armas');
                if ($notificacoes->isNotEmpty()) {
                   
                    $notificacoes->markAsRead();
                }
            @endphp
            
           
            <style>
                .input-container {
                    position: relative;
                    margin-top: 20px;
                }
                
                .input-container input {
                    width: 100%;
                    padding: 10px;
                    font-size: 16px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    outline: none;
                }
                
                .input-container label {
                    position: absolute;
                    top: 50%;
                    left: 10px;
                    transform: translateY(-50%);
                    background: white;
                    padding: 0 5px;
                    color: #888;
                    transition: 0.3s;
                }
                
                .input-container input:focus + label,
                .input-container input:valid + label {
                    top: 0;
                    left: 10px;
                    font-size: 12px;
                    color: #333;
                }
                </style>           
            
@section('table-content')
                <div>
                        @if ($errors->any())
                                <div class="alert alert-danger">
                                        <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li style="color:red;">{{ $error }}</li>
                                                @endforeach
                                        </ul>
                        </div>
                        @endif
                </div>
               
                



@foreach ($outros as $outro)

<tr>
   
    <td>
        @if($outro->status=='1')
            <img  src="{{asset('image/verificar.png')}}" alt="">
        @else
            <img  src="{{asset('image/check.png')}}" alt="">
        @endif
    </td>
    <td>{{ optional($outro->laudo)->perito->nome ?? 'N/A' }}</td>
    <td>{{$outro->nome}}</td>
    <td>{{$outro->marca}}</td>
    
    <td>
        <button   class="btn btn-primary model-outro" data-outro='@json($outro)' >
            <svg class="svg-inline--fa fa-edit fa-w-18 fa-fw" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path></svg>
            Cadastrar | Editar
        </button>
        
        <button  class="btn btn-danger delete">
            <svg class="svg-inline--fa fa-trash fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg><!-- <i class="fa fa-fw fa-trash"></i> -->
            Deletar
        </button>
    </td>
   
       
   
</tr>


@endforeach


@endsection