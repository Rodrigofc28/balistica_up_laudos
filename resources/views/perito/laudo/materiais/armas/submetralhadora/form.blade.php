@section('js')

{!! Html::script('js/cabo_material.js') !!} 
{!! Html::script('js/recorte.js') !!} 
@if($acao == 'Cadastrar')
{!! Html::script('js/sessionSubmetralhadora.js') !!} 
@endif
@endsection


@if ($acao == 'Cadastrar')
{!! Form::open(['route' => ['submetralhadoras.store', $laudo ,'arma'=>$arma_submetralhadora_gdl], 'files' => true]) !!}
@elseif ($acao == 'Atualizar')
{!! Form::open(['route' => ['submetralhadoras.update', $laudo, $submetralhadora], 'method' => 'patch', 'files' => true]) !!}
@else
{!! Form::open() !!}
@endif


<input type="hidden" name="laudo_id" id="laudo_id" value="{{ $laudo->id }}">
<input type="hidden" name="tipo_arma" id="tipo_arma" value="Submetralhadora">

<div class="col-lg-12" style="padding: 0 5% 0">
    <div class="row mb-3">
        @empty($arma_submetralhadora_gdl)
        
        @else
            @include('perito.laudo.materiais.attributes.atributes_arma_gdl',['name_arma_gdl'=>$arma_submetralhadora_gdl])
        @endempty
        @empty($armas)
            @else
                @include('perito.laudo.materiais.attributes.buscar_cadastro_salvo',[$nomeArma='Submetralhadora'])
        @endempty
        @include('perito.laudo.materiais.attributes.marca', ['marca2' => $submetralhadora->marca->id ?? old('marca_id')])
        @include('perito.laudo.materiais.attributes.origem', ['origem2' => $submetralhadora->origem->id ?? old('origem_id')])
        @include('perito.laudo.materiais.attributes.modelo', ['modelo' => $submetralhadora->modelo ?? old('modelo')])
        @include('perito.laudo.materiais.attributes.serie', ['tipo_serie2' => $submetralhadora->tipo_serie ??
        old('tipo_serie'), 'num_serie' => $submetralhadora->num_serie ?? old('num_serie')])
        @include('perito.laudo.materiais.attributes.numero_patrimonio',['numero_patrimonio'=>$submetralhadora->numero_patrimonio ?? old ('numero_patrimonio')])
        @include('perito.laudo.materiais.attributes.calibre', ['obrigatorio' => true, 'calibre2' =>
        $submetralhadora->calibre->id ?? old('calibre_id')])
        @include('perito.laudo.materiais.attributes.calibre_real', ['calibre_real' => $submetralhadora->calibre_real ??
        old('calibre_real')])
        @include('perito.laudo.materiais.attributes.dito_oficio')
        @include('perito.laudo.materiais.attributes.sistema_funcionamento', ['sistema_funcionamento2' =>
        $submetralhadora->sistema_funcionamento ?? old('sistema_funcionamento')])
        
        @include('perito.laudo.materiais.attributes.capacidade_carregador', ['capacidade_carregador' =>
        $submetralhadora->capacidade_carregador ?? old('capacidade_carregador')])
        @include('perito.laudo.materiais.attributes.sistema_percussao', ['sistema_percussao2' =>
        $submetralhadora->sistema_percussao ?? old('sistema_percussao')])
        @include('perito.laudo.materiais.attributes.sistema_disparo',['sistema_disparo2'=>$submetralhadora->sistema_disparo ?? old('sistema_disparo')])
        @include('perito.laudo.materiais.attributes.tipo_acabamento', ['tipo_acabamento2' =>
        $submetralhadora->tipo_acabamento ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.acabamento_outra_opcao', ['tipo_acabamento2' => $submetralhadora->tipo_acabamento
        ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.cabo', ['cabo2' => $submetralhadora->cabo ?? old('cabo')])
        @include('perito.laudo.materiais.attributes.cabo_outra_opcao', ['cabo2' => $submetralhadora->cabo ?? old('cabo')])
        @include('perito.laudo.materiais.attributes.coronha', ['coronha_fuste2' => $submetralhadora->coronha_fuste ??
        old('coronha_fuste')])
        @include('perito.laudo.materiais.attributes.telha',['telha'=>$submetralhadora->telha ?? old('telha')])
        @include('perito.laudo.materiais.attributes.comprimento', ['comprimento_total' => $submetralhadora->comprimento_total
        ?? old('comprimento_total')])
        @include('perito.laudo.materiais.attributes.comprimento_cano', ['comprimento_cano' =>
        $submetralhadora->comprimento_cano ?? old('comprimento_cano')])
        @include('perito.laudo.materiais.attributes.sentido_raias', ['sentido_raias2' => $submetralhadora->sentido_raias ??
        old('sentido_raias')])
        @include('perito.laudo.materiais.attributes.quantidade_raias', ['quantidade_raias' =>
        $submetralhadora->quantidade_raias ?? old('quantidade_raias')])
        @include('perito.laudo.materiais.attributes.funcionamento', ['funcionamento2' => $submetralhadora->funcionamento ??
        old('funcionamento')])
        @include('perito.laudo.materiais.attributes.estado_geral', ['estado_geral2' => $submetralhadora->estado_geral ??
        old('estado_geral')])
        @include('perito.laudo.attributes.material_coletado')
        @include('perito.laudo.materiais.attributes.lacre', ['num_lacre' => $submetralhadora->num_lacre ?? old('num_lacre')])
        @include('perito.laudo.materiais.attributes.lacresaida', ['num_lacre_saida' => $submetralhadora->num_lacre_saida ?? old('num_lacre_saida')])
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
@include('perito.modals.calibre_modal', ['tipo_arma' => 'submetralhadora'])
@include('perito.modals.marca_modal')
@include('perito.modals.pais_modal')
@if($acao == 'Atualizar')
@include('perito.modals.visualizar_imagens_modal', ['arma_id' => $submetralhadora->id])
@endif
        
        
        
        
        
        
        
        
        
        
        
        
        
        