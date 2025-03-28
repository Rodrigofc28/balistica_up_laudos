@section('js')
{!! Html::script('js/cabo_material.js') !!} 
{!! Html::script('js/recorte.js') !!} 
{!! Html::script('js/sessionArmas.js') !!} 
@endsection
@if ($acao == 'Cadastrar')
{!! Form::open(['route' => ['espingardamistas.store', $laudo ], 'files' => true]) !!}
@elseif ($acao == 'Atualizar')
{!! Form::open(['route' => ['espingardamistas.update', $laudo, $espingardamista], 'method' => 'patch', 'files' => true]) !!}
@else
{!! Form::open() !!}
@endif

<input type="hidden" name="laudo_id" id="laudo_id" value="{{ $laudo->id }}">
<input type="hidden" name="tipo_arma" id="tipo_arma" value="Espingarda mista">

<div class="col-lg-12" style="padding: 0 5% 0">
    <div class="row mb-3">
        
    @empty($armas)
        @else
            @include('perito.laudo.materiais.attributes.buscar_cadastro_salvo',[$nomeArma='Espingarda mista'])
    @endempty
        @include('perito.laudo.materiais.attributes.marca', ['marca2' => $espingardamista->marca->id ?? old('marca_id')])
        @include('perito.laudo.materiais.attributes.origem', ['origem2' => $espingardamista->origem->id ?? old('origem_id')])
        @include('perito.laudo.materiais.attributes.modelo', ['modelo' => $espingardamista->modelo ?? old('modelo')])
        @include('perito.laudo.materiais.attributes.serie', ['tipo_serie2' => $espingardamista->tipo_serie ??
        old('tipo_serie'), 'num_serie' => $espingardamista->num_serie ?? old('num_serie')])
        @include('perito.laudo.materiais.attributes.numero_canos', ['num_canos2' => $espingardamista->num_canos ??
        old('num_canos')])
        @include('perito.laudo.materiais.attributes.numeracao_montagem', ['numeracao_montagem' =>
        $espingardamista->numeracao_montagem ?? old('numeracao_montagem')])
        @include('perito.laudo.materiais.attributes.sistema_carregamento', ['sistema_carregamento2' =>
        $espingardamista->sistema_carregamento ?? old('sistema_carregamento')])
        @include('perito.laudo.materiais.attributes.calibre', ['obrigatorio' => true, 'calibre2' =>
        $espingardamista->calibre->id ?? old('calibre_id')])
        
        @include('perito.laudo.materiais.attributes.calibre_real', ['calibre_real' => $espingardamista->calibre_real ??
        old('calibre_real')])
        
        @include('perito.laudo.materiais.attributes.capacidade_carregador', ['capacidade_carregador' =>
        $espingardamista->capacidade_carregador ?? old('capacidade_carregador')])
        
        @include('perito.laudo.materiais.attributes.sistema_disparo',['sistema_disparo2'=>$espingardamista->sistema_disparo ?? old('sistema_disparo')])
        @include('perito.laudo.materiais.attributes.tipo_acabamento', ['tipo_acabamento2' =>
        $espingardamista->tipo_acabamento ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.acabamento_outra_opcao', ['tipo_acabamento2' => $espingardamista->tipo_acabamento
        ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.sistema_percussao', ['sistema_percussao2' =>
        $espingardamista->sistema_percussao ?? old('sistema_percussao')])
        @include('perito.laudo.materiais.attributes.cabo', ['cabo2' => $espingardamista->cabo ?? old('cabo')])
        @include('perito.laudo.materiais.attributes.cabo_outra_opcao', ['cabo2' => $espingardamista->cabo ?? old('cabo')])
        @include('perito.laudo.materiais.attributes.coronha_fuste', ['coronha_fuste2' => $espingarda->coronha_fuste ??
        old('coronha_fuste')])
        @include('perito.laudo.materiais.attributes.telha',['telha2'=>$espingardamista->telha ?? old('telha')])
        @include('perito.laudo.materiais.attributes.comprimento', ['comprimento_total' => $espingardamista->comprimento_total
        ?? old('comprimento_total')])
        @include('perito.laudo.materiais.attributes.comprimento_cano', ['comprimento_cano' =>
        $espingardamista->comprimento_cano ?? old('comprimento_cano')])
        @include('perito.laudo.materiais.attributes.diametro_cano', ['diametro_cano2' =>
        $espingardamista->diametro_cano ?? old('diametro_cano')])
        @include('perito.laudo.materiais.attributes.quantidade_raias', ['quantidade_raias' => $espingardamista->quantidade_raias
        ?? old('quantidade_raias')])
        @include('perito.laudo.materiais.attributes.sentido_raias', ['sentido_raias2' => $espingardamista->sentido_raias ??
        old('sentido_raias')])
        @include('perito.laudo.materiais.attributes.estado_geral', ['estado_geral2' => $espingardamista->estado_geral ??
        old('estado_geral')])
        @include('perito.laudo.materiais.attributes.funcionamento', ['funcionamento2' => $espingardamista->funcionamento ??
        old('funcionamento')])
        
        @include('perito.laudo.materiais.attributes.lacresaida', ['num_lacre_saida' => $espingardamista->num_lacre_saida ?? old('num_lacre_saida')])
        @include('perito.laudo.materiais.attributes.lacre', ['num_lacre' => $espingardamista->num_lacre ?? old('num_lacre')]) 
       
        @include('perito.laudo.materiais.attributes.salva_modelo_cadastro')
        @include('perito.laudo.materiais.attributes.municaoFornecidaPela')
        
        
    </div>
    @include('perito.laudo.materiais.attributes.imagemArmas',['tipo'=>'armaLonga'])
    <div id="btnAcao" class="row justify-content-between mb-4">
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
@include('perito.modals.calibre_modal', ['tipo_arma' => 'espingardamista'])
@include('perito.modals.marca_modal')
@include('perito.modals.pais_modal')
@if($acao == 'Atualizar')
@include('perito.modals.visualizar_imagens_modal', ['arma_id' => $espingardamista->id])
@endif
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        