@section('js')

{!! Html::script('js/cabo_material.js') !!} 
@endsection

@if ($acao == 'Cadastrar')
    {!! Form::open(['route' => ['pressaopistolas.store', $laudo ]]) !!}
@elseif ($acao == 'Atualizar')
    {!! Form::open(['route' => ['pressaopistolas.update', $laudo, $pistolaPressao], 'method' => 'patch']) !!}
@else
    {!! Form::open() !!}
@endif

<input type="hidden" name="laudo_id" id="laudo_id" value="{{ $laudo->id }}">
<input type="hidden" name="tipo_arma" id="tipo_arma" value="Pistola pressao">

<div class="col-lg-12" style="padding: 0 5% 0">
    <div class="row mb-3">
    
    @empty($armas)
            @else
                 @include('perito.laudo.materiais.attributes.buscar_cadastro_salvo',[$nomeArma='Pistola pressao'])
        @endempty
        @include('perito.laudo.materiais.attributes.marca', ['marca2' => $pistolaPressao->marca->id ?? old('marca_id')]) 
        @include('perito.laudo.materiais.attributes.origem', ['origem2' => $pistolaPressao->origem->id ?? old('origem_id')])    
        @include('perito.laudo.materiais.attributes.modelo', ['modelo' => $pistolaPressao->modelo ?? old('modelo')])        
          
        
        
        @include('perito.laudo.materiais.attributes.numero_canos', ['num_canos2' => $pistolaPressao->num_canos ??
        old('num_canos')])                                                                                                                          
        @include('perito.laudo.materiais.attributes.sistema_carregamento', ['sistema_carregamento2' =>                                              
        $pistolaPressao->sistema_carregamento ?? old('sistema_carregamento')])
        @include('perito.laudo.materiais.attributes.calibre', ['obrigatorio' => true,'calibre2' => $pistolaPressao->calibre->id                            
        ?? old('calibre_id')])
        
        @include('perito.laudo.materiais.attributes.sistema_funcionamento', ['sistema_funcionamento2' =>
        $pistolaPressao->sistema_funcionamento ?? old('sistema_funcionamento')])                                                                             
        @include('perito.laudo.materiais.attributes.tipo_carregador', ['tipo_carregador2' =>
        $pistolaPressao->tipo_carregador ?? old('tipo_carregador')])
        @include('perito.laudo.materiais.attributes.capacidade_carregador', ['capacidade_carregador' =>                                             
        $pistolaPressao->capacidade_carregador ?? old('capacidade_carregador')])
        
        
        
        @include('perito.laudo.materiais.attributes.tipo_acabamento', ['tipo_acabamento2' => $pistolaPressao->tipo_acabamento
        ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.acabamento_outra_opcao', ['tipo_acabamento2' => $pistolaPressao->tipo_acabamento
        ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.cabo', ['cabo2' => $pistolaPressao->cabo ?? old('cabo')])
        @include('perito.laudo.materiais.attributes.cabo_outra_opcao', ['cabo2' => $pistolaPressao->cabo ?? old('cabo')])
        @include('perito.laudo.materiais.attributes.comprimento', ['comprimento_total' => $pistolaPressao->comprimento_total ??
        old('comprimento_total')])
        @include('perito.laudo.materiais.attributes.altura', ['altura' => $pistolaPressao->altura ?? old('altura')])
        @include('perito.laudo.materiais.attributes.comprimento_cano', ['comprimento_cano' => $pistolaPressao->comprimento_cano
        ?? old('comprimento_cano')])
        @include('perito.laudo.materiais.attributes.diametro_cano', ['diametro_cano2' =>
        $pistolaPressao->diametro_cano ?? old('diametro_cano')])
        @include('perito.laudo.materiais.attributes.quantidade_raias', ['quantidade_raias' => $pistolaPressao->quantidade_raias
        ?? old('quantidade_raias')])
        @include('perito.laudo.materiais.attributes.sentido_raias', ['sentido_raias2' => $pistolaPressao->sentido_raias ??
        old('sentido_raias')])
        @include('perito.laudo.materiais.attributes.estado_geral', ['estado_geral2' => $pistolaPressao->estado_geral ??
        old('estado_geral')])
        @include('perito.laudo.materiais.attributes.funcionamento', ['funcionamento2' => $pistolaPressao->funcionamento ??
        old('funcionamento')])
        @include('perito.laudo.materiais.attributes.lacresaida', ['num_lacre_saida' => $pistolaPressao->num_lacre_saida ?? old('num_lacre_saida')])
        @include('perito.laudo.materiais.attributes.lacre', ['num_lacre' => $pistolaPressao->num_lacre ?? old('num_lacre')])
        @include('perito.laudo.materiais.attributes.salva_modelo_cadastro')
         
        @include('perito.modals.calibre_modal', ['tipo_arma' => 'Pistola pressao'])
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