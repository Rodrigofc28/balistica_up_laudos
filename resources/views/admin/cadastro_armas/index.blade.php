@section('js')
{!! Html::script('js/admin_modelo_cadastro.js') !!}

@endsection

@extends('shared.table_cadastro_arma', ['card_name' => 'Países',
'model_name_plural' => 'Cadastrar modelo armas',
'model_name_singular' => 'cadastrar modelo de arma',

'ths' => ['CADASTRADO','ARMA','MARCA', 'MODELO','FABRICAÇÃO','AÇÃO']])
                
            
            @php
                // Marca todas as notificações como lidas
                $notificacoes = Auth::user()->unreadNotifications->where('data.mensagem', 'modelo armas');
                if ($notificacoes->isNotEmpty()) {
                   
                    $notificacoes->markAsRead();
                }
            @endphp
            
           
            
            
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
               
                
@if (count($armas) > 0)
@php
$armaArray=[];
$i=0;

foreach($armas as $arma){
    if($arma->salva_cadastro==1){
        $armaArray[$i]=$arma;
    }
    $i++;
}

$arrayReverte=array_reverse($armaArray,true);


@endphp

@foreach ($arrayReverte as $arma)
@if($arma->salva_cadastro!=null)
<tr>
   
    <td>
        @if($arma->status=='1')
            <img src="{{asset('image/verificar.png')}}" alt="">
        @else
            <img src="{{asset('image/check.png')}}" alt="">
    @endif
    </td>
    <td> {{($arma->tipo_arma==null)?($arma-> tipo_arma='sem valor'):($arma-> tipo_arma) }}</td>
    <td> {{ $arma->marca->nome }}</td>
    <td>{{ $arma-> modelo }}</td>
    <td>{{ $arma-> marca->fabricacao }}</td>
    
    <td>
        <button value="{{ route('cadastro_armas.store') }}"   class="btn btn-success model-arma" data-arma='@json($arma)'>
            <svg class="svg-inline--fa fa-plus fa-w-14" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
            Cadastrar
        </button>
        
        <button value="{{ route('cadastroArmaDelete', $arma->id) }}" class="btn btn-danger delete">
            <svg class="svg-inline--fa fa-trash fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg><!-- <i class="fa fa-fw fa-trash"></i> -->
            Deletar
        </button>
    </td>
   
       
   
</tr>

@endif
@endforeach
@endif

@endsection
