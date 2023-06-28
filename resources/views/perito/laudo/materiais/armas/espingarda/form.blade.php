@section('js')
{!! Html::script('js/form_espingarda.js') !!}
{!! Html::script('js/cabo_material.js') !!} 
{!! Html::script('js/recorte.js') !!} 
@if($acao == 'Cadastrar')
{!! Html::script('js/sessionEspingarda.js') !!}
@endif
@endsection



@if ($acao == 'Cadastrar')
{!! Form::open(['route' => ['espingardas.store', $laudo,'arma'=>$arma_espingarda_gdl], 'files' => true]) !!}
@elseif ($acao == 'Atualizar')
{!! Form::open(['route' => ['espingardas.update', $laudo, $espingarda], 'method' => 'patch', 'files' => true]) !!}
@else
{!! Form::open() !!}
@endif

<input type="hidden" name="laudo_id" id="laudo_id" value="{{ $laudo->id }}">
<input type="hidden" name="tipo_arma" id="tipo_arma" value="Espingarda">

<div class="col-lg-12" style="padding: 0 5% 0">
    <div class="row mb-3">
        {{-- Dados capturados GDL --}}
        @empty($arma_espingarda_gdl)
        
        @else
            @include('perito.laudo.materiais.attributes.atributes_arma_gdl',['name_arma_gdl'=>$arma_espingarda_gdl])
        @endempty
        @empty($armas)
            @else
            @include('perito.laudo.materiais.attributes.buscar_cadastro_salvo',[$nomeArma='Espingarda'])
        @endempty
        @include('perito.laudo.materiais.attributes.marca', ['marca2' => $espingarda->marca->id ?? old('marca_id')])
        @include('perito.laudo.materiais.attributes.origem', ['origem2' => $espingarda->origem->id ?? old('origem_id')])
        @include('perito.laudo.materiais.attributes.modelo', ['modelo' => $espingarda->modelo ?? old('modelo')])
        @include('perito.laudo.materiais.attributes.serie', ['tipo_serie2' => $espingarda->tipo_serie ??
        old('tipo_serie'), 'num_serie' => $espingarda->num_serie ?? old('num_serie')])
        @include('perito.laudo.materiais.attributes.numeracao_montagem', ['numeracao_montagem' =>
        $espingarda->numeracao_montagem ?? old('numeracao_montagem')])
        @include('perito.laudo.materiais.attributes.sistema_carregamento', ['sistema_carregamento2' =>
        $espingarda->sistema_carregamento ?? old('sistema_carregamento')])
        @include('perito.laudo.materiais.attributes.calibre', ['obrigatorio' => true, 'calibre2' =>
        $espingarda->calibre->id ?? old('calibre_id')])
        @include('perito.laudo.materiais.attributes.calibre_real', ['calibre_real' => $espingarda->calibre_real ??
        old('calibre_real')])
        @include('perito.laudo.materiais.attributes.dito_oficio')
        @include('perito.laudo.materiais.attributes.numero_canos', ['num_canos2' => $espingarda->num_canos ??
        old('num_canos')])
        @include('perito.laudo.materiais.attributes.sistema_funcionamento', ['sistema_funcionamento2' =>
        $espingarda->sistema_funcionamento ?? old('sistema_funcionamento')])
        @include('perito.laudo.materiais.attributes.tipo_carregador', ['tipo_carregador2' =>
        $espingarda->tipo_carregador ?? old('tipo_carregador')])
        @include('perito.laudo.materiais.attributes.capacidade_carregador', ['capacidade_carregador' =>                                             
        $espingarda->capacidade_carregador ?? old('capacidade_carregador')])
        
        @include('perito.laudo.materiais.attributes.sistema_percussao', ['sistema_percussao2' =>
        $espingarda->sistema_percussao ?? old('sistema_percussao')])
        @include('perito.laudo.materiais.attributes.sistema_disparo',['sistema_disparo2'=>$espingarda->sistema_disparo ?? old('sistema_disparo')])
        @include('perito.laudo.materiais.attributes.tipo_acabamento', ['tipo_acabamento2' => $espingarda->tipo_acabamento
        ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.acabamento_outra_opcao', ['tipo_acabamento2' => $espingarda->tipo_acabamento
        ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.cabo', ['cabo2' => $espingarda->cabo ?? old('cabo')])
        @include('perito.laudo.materiais.attributes.cabo_outra_opcao', ['cabo2' => $espingarda->cabo ?? old('cabo')])
        @include('perito.laudo.materiais.attributes.coronha_fuste', ['coronha_fuste2' => $espingarda->coronha_fuste ??
        old('coronha_fuste')])
        @include('perito.laudo.materiais.attributes.telha',['telha'=>$espingarda->telha ?? old('telha')])
        
        @include('perito.laudo.materiais.attributes.comprimento', ['comprimento_total' => $espingarda->comprimento_total
        ?? old('comprimento_total')])
        @include('perito.laudo.materiais.attributes.comprimento_cano', ['comprimento_cano' =>
        $espingarda->comprimento_cano ?? old('comprimento_cano')])
        @include('perito.laudo.materiais.attributes.diametro_cano', ['diametro_cano2' =>
        $espingarda->diametro_cano ?? old('diametro_cano')])
         @include('perito.laudo.materiais.attributes.estado_geral', ['estado_geral2' => $espingarda->estado_geral ??
        old('estado_geral')])
        @include('perito.laudo.materiais.attributes.funcionamento', ['funcionamento2' => $espingarda->funcionamento ??
        old('funcionamento')])
        @include('perito.laudo.attributes.material_coletado')
        @include('perito.laudo.materiais.attributes.lacresaida', ['num_lacre_saida' => $espingarda->num_lacre_saida ?? old('num_lacre_saida')])
        @include('perito.laudo.materiais.attributes.lacre', ['num_lacre' => $espingarda->num_lacre ?? old('num_lacre')])
        
        @include('perito.laudo.materiais.attributes.salva_modelo_cadastro')
        <div class="col-lg-3">
        <input type="checkbox" name="institutoArma" id="institutoArma" value="sim"> <strong>Munição para teste fornecida por este Instituto</strong>
        </div>
        @include('perito.laudo.materiais.attributes.imagemArmas')
    </div>
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
@include('perito.modals.calibre_modal', ['tipo_arma' => 'espingarda'])
@include('perito.modals.marca_modal')
@include('perito.modals.pais_modal')
@if($acao == 'Atualizar')
@include('perito.modals.visualizar_imagens_modal', ['arma_id' => $espingarda->id])
@endif 
        
            
    
        
        
        
        
        
       
        
        
        
        
        
        