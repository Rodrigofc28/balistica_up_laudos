@extends('layout.component')
@section('js')
{!! Html::script('js/calendar.js') !!}
{!! Html::script('js/filtrar_solicitantes.js') !!}
{!! Html::script('js/laudo_habilit.js') !!}

@endsection
@section('page')
<div class="col-8">
    <h4>Cadastrar Informações Gerais do Laudo</h4>
</div>
<hr>

{{ Form::open(['route' => 'laudos.store']) }}

<div>

</div>
<div class="row m-auto">
    @php
    
    if(!empty($reps)){
        
        $dataSolicitacao=$reps['data_solicitacao'];
        $dataDesignacao=$reps['data_designacao'];
        $dataRecebimento=$reps['data_recebimento'];
    }else{
        $dataSolicitacao='';
        $dataDesignacao='';
        $dataRecebimento='';
    }
    @endphp
    @include('perito.laudo.attributes.constatacao_eficiencia')
    
   
    @include('perito.laudo.attributes.envolvidos')
    

    @include('perito.laudo.attributes.rep', ['rep' => $reps['rep'] ?? old('rep')])
    @include('perito.laudo.attributes.oficio', ['oficio' => $reps['oficio'] ?? old('oficio')])
    
    @include('perito.laudo.attributes.tipo_inquerito', ['tipo_inquerito2' => $laudo->tipo_inquerito ??
    old('tipo_inquerito')])
    @include('perito.laudo.attributes.inquerito', ['inquerito' => '' ?? old('inquerito')])
    @include('perito.laudo.attributes.boletim_ocorrencia',['boletim2'=>$reps['bo']??old('boletim')])
    @include('shared.input_calendar', ['label' => 'Data da Solicitação', 'name' => 'data_solicitacao', 'size' => '3',
    'value' => $dataRecebimento])
    @include('shared.input_calendar', ['label' => 'Data do recebimento', 'name' => 'data_recebimento', 'size' => '3',
    'value' => $dataSolicitacao])
    
    @include('shared.input_calendar', ['label' => 'Data da Designação','name' => 'data_designacao', 'size' => '3',
    'value' => $dataDesignacao])
    @include('shared.input_calendar', ['label' => 'Data da ocorrência', 'name' => 'data_ocorrencia', 'size' => '3',
    'value' => ''])
    

    
    <input class="form-control" type="hidden" name="perito_id" autocomplete="off" value="{{ Auth::id() }}" />
    @include('shared.attributes.secao', ['secao2' => $laudo->secao_id ?? old('secao_id')])
    
    
    <input type="text" name="nomeIncluir" hidden id="nomeIncluir">
    
    @include('shared.attributes.cidades', ['size' => '4', 'cidade2' => $laudo->cidade_id ?? old('cidade_id')])
    
    @include('perito.laudo.attributes.solicitante', ['solicitante2' => $laudo->solicitante_id ?? old('solicitante_id')])
   
    @include('perito.laudo.attributes.repExameComplementar', ['rep' => $laudo->rep ?? old('')])
     @include('perito.laudo.materiais.attributes.sinab')
    @include('perito.laudo.attributes.material_coletado',[$laudoMaterial="1"])
    
    @if($reps!="")

        <span id="inqueritosPoliciais" ip="{{$reps->ip}}" orgao="{{$reps->orgao}}" cidade="{{$reps->cidade}}"></span>
        <span id="inqueritosPoliciais1" ip="{{$reps->ipOn}}" orgao="{{$reps->ipOnOrgao}}" cidade="{{$reps->ipOnCidade}}"></span>
        <span id="inqueritosPoliciais2" ip="{{$reps->ipPm}}" orgao="{{$reps->ipPmOrgao}}" cidade="{{$reps->ipPmCidade}}"></span>
        <span id="inqueritosPoliciais3" ip="{{$reps->boc}}" orgao="{{$reps->bocOrgao}}" cidade="{{$reps->bocCidade}}"></span>
        <span id="inqueritosPoliciais4" ip="{{$reps->bo}}" orgao="{{$reps->orgaBo}}" cidade="{{$reps->cidadeBo}}"></span>
        <span id="inqueritosPoliciais5" ip="{{$reps->ipAi}}" orgao="{{$reps->orgaoAi}}" cidade="{{$reps->cidadeAi}}"></span>
    @endif
</div>
@if($reps!=""&$armasGdl!="")

    <div style="border:1px solid black;">
        <div id="tab_gdl" >
            <strong><p id="titulo">Lista de Envolvidos</p></strong> <br>
               
              @php
                $envolvidoGdl=implode(',',$reps['envolvido'])
              @endphp
                <input type="text" hidden name="envolvidoGdl" value="{{$envolvidoGdl}}">
                @foreach($reps['envolvido'] as $envolvido)
                    <span>&nbsp;{{$envolvido}}</span><br>
                @endforeach
            
            
        </div>
        <div id="tab_gdl" >
             <hr>  
            <p  id="titulo"><strong> Cidade / Órgão Solicitante</strong> </p> <br>
             
            <span id="cidadeSpan"></span> /
            <input hidden type="text" name="cidadeGdl" id="cidadeIn" value="">
            <span id="orgaoSpan"></span> 
            
            <input hidden type="text" name="orgaoGdl" id="orgaoIn" value="">
            
            
        </div>
        <hr>
        <div id="tab_gdl">
            <p id="titulo"><strong>Peças</strong></p>
            @foreach($armasGdl as $armagdl)
            <div>
                <p><strong>ITEM:</strong> {{$armagdl->tipo_item}}</p>
                <p><strong>MARCA:</strong> {{$armagdl->marca}}</p>
                <p><strong>QUANTIDADE:</strong> {{$armagdl->quantidade}}</p>
                <p><strong>OBSERVAÇÃO:</strong> {{$armagdl->observacao}}</p>
                <p><strong>IDENTIFICAÇÃO:</strong> {{$armagdl->identificacao}}</p>
            </div> 
            <div>
                <a href="#">EDITAR</a>
            </div>   
                <hr>
                
            @endforeach
        </div>
    </div>
 @endif


<div class="row m-auto">
    <div class="col-lg-3 mt-3">
        <p><strong><code>*</code> Obrigatório</strong></p>
    </div>
</div>
<div class="row m-auto justify-content-between">
    <div class="col-lg-4 mt-3 mb-4">
        <a class="btn btn-secondary btn-block" href="{{ route('laudos.index') }}">
            <i class="fas fa-arrow-circle-left"></i> Voltar</a>
    </div>
    <div class="col-lg-4 mt-3 mb-4">
        <button class="btn btn-success btn-block" type="submit">
            <i class="fas fa-save"></i> Salvar e Continuar
        </button>
    </div>
</div>
{{ Form::close() }}
@include('perito.modals.solicitante_modal')
@endsection
