@section('js')
{!! Html::script('js/admin_modelo_cadastro.js') !!}

@endsection
@extends('shared.table_cadastro_arma', ['card_name' => 'Países',
'model_name_plural' => 'Cadastrar modelo armas',
'model_name_singular' => 'cadastrar modelo de arma',

'ths' => ['ARMA','MARCA', 'MODELO','FABRICAÇÃO']])
                


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
    <td> {{($arma->tipo_arma==null)?($arma-> tipo_arma='sem valor'):($arma-> tipo_arma) }}</td>
    <td> {{ $arma->marca->nome }}</td>
    <td>{{ $arma-> modelo }}</td>
    <td>{{ $arma-> marca->fabricacao }}</td>
    
    <td>
        {{--verefica se a variavel $cadastros existe, se existir faz o foreach--}}

        @if(!empty($cadastros))
            @foreach ($cadastros as $cadastro)
                @php
                    $cadastroArma=json_decode($cadastro->modelo);
                    
                @endphp
                @if($cadastroArma->id==$arma->id)
                    <form style="display: flex;"action="{{ route('cadastro_armas.edit', $arma->id) }}" method="get">
                        {{ csrf_field() }}
                        
                        <input type="text" hidden name="cadastro" value="{{$cadastro->id}}" id="">
                        <input class="btn btn-danger" style="width:150px;"type="submit"  id="deletarcadastro" value="Deletar">
                    </form>
                
                @endif   
            @endforeach 
        @endif    
             
        
        
    </td>
    <td>
        <form action="{{ route('cadastro_armas.store') }}" method="post">
                    {{ csrf_field() }}
                    <input type="text" hidden name="modelo" value="{{$arma}}" id="">

                    <input class="btn btn-success" style="width:150px;display: inline-flex;"  type="submit" id="cadastrar" value="Cadastrar">
            </form> 
    </td>
</tr>

@endif
@endforeach
@endif

@endsection
