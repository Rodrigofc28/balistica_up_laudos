@section('js')

{!! Html::script('js/cabo_material.js') !!} 
@endsection

@if ($acao == 'Cadastrar')
    {!! Form::open(['route' => ['pressaocarabinas.store', $laudo ]]) !!}
@elseif ($acao == 'Atualizar')
    {!! Form::open(['route' => ['pressaocarabinas.update', $laudo, $carabinaPressao], 'method' => 'patch']) !!}
@else
    {!! Form::open() !!}
@endif

<input type="hidden" name="laudo_id" id="laudo_id" value="{{ $laudo->id }}">
<input type="hidden" name="tipo_arma" id="tipo_arma" value="Carabina pressao">

<div class="col-lg-12" style="padding: 0 5% 0">
    <div class="row mb-3">
    
    @empty($armas)
            @else
                 @include('perito.laudo.materiais.attributes.buscar_cadastro_salvo',[$nomeArma='Carabina pressao'])
        @endempty
        @include('perito.laudo.materiais.attributes.marca', ['marca2' => $carabinaPressao->marca->id ?? old('marca_id')]) 
        @include('perito.laudo.materiais.attributes.origem', ['origem2' => $carabinaPressao->origem->id ?? old('origem_id')])    
        @include('perito.laudo.materiais.attributes.modelo', ['modelo' => $carabinaPressao->modelo ?? old('modelo')])        
          
        
        
        @include('perito.laudo.materiais.attributes.numero_canos', ['num_canos2' => $carabinaPressao->num_canos ??
        old('num_canos')])                                                                                                                          
        @include('perito.laudo.materiais.attributes.sistema_carregamento', ['sistema_carregamento2' =>                                              
        $carabinaPressao->sistema_carregamento ?? old('sistema_carregamento')])
        @include('perito.laudo.materiais.attributes.calibre', ['obrigatorio' => true,'calibre2' => $carabinaPressao->calibre->id                            
        ?? old('calibre_id')])
        
        @include('perito.laudo.materiais.attributes.sistema_funcionamento', ['sistema_funcionamento2' =>
        $carabinaPressao->sistema_funcionamento ?? old('sistema_funcionamento')])                                                                             
        @include('perito.laudo.materiais.attributes.tipo_carregador', ['tipo_carregador2' =>
        $carabinaPressao->tipo_carregador ?? old('tipo_carregador')])
        @include('perito.laudo.materiais.attributes.capacidade_carregador', ['capacidade_carregador' =>                                             
        $carabinaPressao->capacidade_carregador ?? old('capacidade_carregador')])
        
        
        
        @include('perito.laudo.materiais.attributes.tipo_acabamento', ['tipo_acabamento2' => $carabinaPressao->tipo_acabamento
        ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.acabamento_outra_opcao', ['tipo_acabamento2' => $carabinaPressao->tipo_acabamento
        ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.cabo', ['cabo2' => $carabinaPressao->cabo ?? old('cabo')])
        @include('perito.laudo.materiais.attributes.cabo_outra_opcao', ['cabo2' => $carabinaPressao->cabo ?? old('cabo')])
        @include('perito.laudo.materiais.attributes.comprimento', ['comprimento_total' => $carabinaPressao->comprimento_total ??
        old('comprimento_total')])
        @include('perito.laudo.materiais.attributes.altura', ['altura' => $carabinaPressao->altura ?? old('altura')])
        @include('perito.laudo.materiais.attributes.comprimento_cano', ['comprimento_cano' => $carabinaPressao->comprimento_cano
        ?? old('comprimento_cano')])
        @include('perito.laudo.materiais.attributes.diametro_cano', ['diametro_cano2' =>
        $carabinaPressao->diametro_cano ?? old('diametro_cano')])
        @include('perito.laudo.materiais.attributes.quantidade_raias', ['quantidade_raias' => $carabinaPressao->quantidade_raias
        ?? old('quantidade_raias')])
        @include('perito.laudo.materiais.attributes.sentido_raias', ['sentido_raias2' => $carabinaPressao->sentido_raias ??
        old('sentido_raias')])
        @include('perito.laudo.materiais.attributes.estado_geral', ['estado_geral2' => $carabinaPressao->estado_geral ??
        old('estado_geral')])
        @include('perito.laudo.materiais.attributes.funcionamento', ['funcionamento2' => $carabinaPressao->funcionamento ??
        old('funcionamento')])
        @include('perito.laudo.materiais.attributes.lacresaida', ['num_lacre_saida' => $carabinaPressao->num_lacre_saida ?? old('num_lacre_saida')])
        @include('perito.laudo.materiais.attributes.lacre', ['num_lacre' => $carabinaPressao->num_lacre ?? old('num_lacre')])
        @include('perito.laudo.materiais.attributes.salva_modelo_cadastro')
         
        @include('perito.modals.calibre_modal', ['tipo_arma' => 'Carabina Pressão'])
        @include('perito.modals.marca_modal')
        @include('perito.modals.pais_modal')
        
        
        
    </div>
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