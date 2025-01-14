@section('js')
{!! Html::script('js/cabo_material.js') !!} 
{!! Html::script('js/recorte.js') !!}
@if($acao == 'Cadastrar')
{!! Html::script('js/sessionPistolete.js') !!}  
@endif
@endsection
@if ($acao == 'Cadastrar')
{!! Form::open(['route' => ['pistoletes.store', $laudo,'arma'=>$arma_pistolete_gdl ], 'files' => true]) !!}
@elseif ($acao == 'Atualizar')
{!! Form::open(['route' => ['pistoletes.update', $laudo, $pistolete], 'method' => 'patch', 'files' => true]) !!}
@else
{!! Form::open() !!}
@endif

<input type="hidden" name="laudo_id" id="laudo_id" value="{{ $laudo->id }}">
<input type="hidden" name="tipo_arma" id="tipo_arma" value="Pistolete">

<div class="col-lg-12" style="padding: 0 5% 0">
    <div class="row mb-3">
        @empty($arma_pistolete_gdl)
        
        @else
            @include('perito.laudo.materiais.attributes.atributes_arma_gdl',['name_arma_gdl'=>$arma_pistolete_gdl])
        @endempty
        @empty($armas)
            @else
                @include('perito.laudo.materiais.attributes.buscar_cadastro_salvo',[$nomeArma='Pistolete'])
        @endempty
        @include('perito.laudo.materiais.attributes.marca', ['marca2' => $pistolete->marca->id ?? old('marca_id')]) 
        @include('perito.laudo.materiais.attributes.origem', ['origem2' => $pistolete->origem->id ?? old('origem_id')])
        @include('perito.laudo.materiais.attributes.modelo', ['modelo' => $pistolete->modelo ?? old('modelo')])
        @include('perito.laudo.materiais.attributes.serie', ['tipo_serie2' => $pistolete->tipo_serie ??
        old('tipo_serie'), 'num_serie' => $pistolete->num_serie ?? old('num_serie')])
        @include('perito.laudo.materiais.attributes.numero_canos', ['num_canos2' => $pistolete->num_canos ??
        old('num_canos')])
        @include('perito.laudo.materiais.attributes.sistema_carregamento', ['sistema_carregamento2' =>
        $pistolete->sistema_carregamento ?? old('sistema_carregamento')])
        @include('perito.laudo.materiais.attributes.numeracao_montagem', ['numeracao_montagem' =>
        $pistolete->numeracao_montagem ?? old('numeracao_montagem')])
        @include('perito.laudo.materiais.attributes.calibre', ['obrigatorio' => true, 'calibre2' =>
        $pistolete->calibre->id ?? old('calibre_id')])
        
        @include('perito.laudo.materiais.attributes.calibre_real', ['calibre_real' => $pistolete->calibre_real ??
        old('calibre_real')])
        @include('perito.laudo.materiais.attributes.dito_oficio')
        @include('perito.laudo.materiais.attributes.sistema_percussao', ['sistema_percussao2' =>
        $pistolete->sistema_percussao ?? old('sistema_percussao')])
        @include('perito.laudo.materiais.attributes.sistema_disparo',['sistema_disparo2'=>$pistolete->sistema_disparo ?? old('sistema_disparo')])
        @include('perito.laudo.materiais.attributes.tipo_acabamento', ['tipo_acabamento2' =>
        $pistolete->tipo_acabamento ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.acabamento_outra_opcao', ['tipo_acabamento2' => $pistolete->tipo_acabamento
        ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.cabo', ['cabo2' => $pistolete->cabo ?? old('cabo')])
        @include('perito.laudo.materiais.attributes.cabo_outra_opcao', ['cabo2' => $pistolete->cabo ?? old('cabo')])
        @include('perito.laudo.materiais.attributes.comprimento', ['comprimento_total' => $pistolete->comprimento_total
        ?? old('comprimento_total')])
        @include('perito.laudo.materiais.attributes.comprimento_cano', ['comprimento_cano' =>
        $pistolete->comprimento_cano ?? old('comprimento_cano')])
        @include('perito.laudo.materiais.attributes.diametro_cano', ['diametro_cano2' =>
        $pistolete->diametro_cano ?? old('diametro_cano')])
        @include('perito.laudo.materiais.attributes.estado_geral', ['estado_geral2' => $pistolete->estado_geral ??
        old('estado_geral')])
         @include('perito.laudo.materiais.attributes.funcionamento', ['funcionamento2' => $pistolete->funcionamento ??
        old('funcionamento')])
        @include('perito.laudo.attributes.material_coletado')
        @include('perito.laudo.materiais.attributes.lacresaida', ['num_lacre_saida' => $pistolete->num_lacre_saida ?? old('num_lacre_saida')])
        @include('perito.laudo.materiais.attributes.lacre', ['num_lacre' => $pistolete->num_lacre ?? old('num_lacre')]) 
        @include('perito.laudo.materiais.attributes.salva_modelo_cadastro')
        @include('perito.laudo.materiais.attributes.municaoFornecidaPela')
        
     </div>
    @include('perito.laudo.materiais.attributes.imagemArmas')
    <div class="row justify-content-between mb-4">
        <div class="col-lg-4 mt-1">
            <a class="btn btn-secondary btn-block" href="{!! URL::previous() !!}">
                <i class="fas fa-arrow-circle-left"></i> Voltar</a>
        </div>
        @if($acao == 'Atualizar')
        <div class="col-lg-4 mt-1">
            <button class="btn btn-primary btn-block ver_imagens" type="button">
                <i class="fas fa-camera"></i> Visualizar Imagens</button>
        </div>
        @endif
        <div class="col-lg-4 mt-1">
            <button type="submit" class="btn btn-success btn-block submit_arma_form"><strong>
                    <i class="fas fa-plus" aria-hidden="true"></i> {{ $acao }}</strong>
            </button>
            {{ Form::close() }}
        </div>
    </div>
</div>
@include('perito.modals.calibre_modal', ['tipo_arma' => 'pistolete'])
@include('perito.modals.marca_modal')
@include('perito.modals.pais_modal')
@if($acao == 'Atualizar')
@include('perito.modals.visualizar_imagens_modal', ['arma_id' => $pistolete->id])
@endif    
        
        
        
        
        
        
        
        
       
        
        
        
        
       
        
        
        
        
        
        
        
        
        
        
   