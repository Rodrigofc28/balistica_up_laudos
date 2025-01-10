@section('js')
{!! Html::script('js/form_garrucha.js') !!}
{!! Html::script('js/cabo_material.js') !!} 
{!! Html::script('js/recorte.js') !!} 
{!! Html::script('js/sessionGarrucha.js') !!} 
@if($acao == 'Cadastrar')
{!! Html::script('js/sessionArmas.js') !!} 
@endif
@endsection
@if ($acao == 'Cadastrar')
{!! Form::open(['route' => ['garruchas.store', $laudo,'arma'=>$arma_garrucha_gdl ], 'files' => true]) !!}
@elseif ($acao == 'Atualizar')
{!! Form::open(['route' => ['garruchas.update', $laudo, $garrucha], 'method' => 'patch', 'files' => true]) !!}
@else
{!! Form::open() !!}
@endif

<input type="hidden" name="laudo_id" id="laudo_id" value="{{ $laudo->id }}">
<input type="hidden" name="tipo_arma" id="tipo_arma" value="Garrucha">

<div class="col-lg-12" style="padding: 0 5% 0">
    <div class="row mb-3">
        @empty($arma_garrucha_gdl)
        
        @else
            @include('perito.laudo.materiais.attributes.atributes_arma_gdl',['name_arma_gdl'=>$arma_garrucha_gdl])
        @endempty
        {{--Verifica se @armas esta vazio caso não esteja inclui buscar_cadastro_salvo--}}
        @empty($armas)
            @else
                @include('perito.laudo.materiais.attributes.buscar_cadastro_salvo',[$nomeArma='Garrucha'])
        @endempty
        @include('perito.laudo.materiais.attributes.marca', ['marca2' => $garrucha->marca->id ?? old('marca_id')])
        @include('perito.laudo.materiais.attributes.origem', ['origem2' => $garrucha->origem->id ?? old('origem2')])
        @include('perito.laudo.materiais.attributes.modelo', ['modelo' => $garrucha->modelo ?? old('modelo')])
        @include('perito.laudo.materiais.attributes.calibre', ['obrigatorio' => true, 'calibre2' =>
        $garrucha->calibre->id ?? old('calibre_id')])
        @include('perito.laudo.materiais.attributes.serie', ['tipo_serie2' => $garrucha->tipo_serie ??
        old('tipo_serie'), 'num_serie' => $garrucha->num_serie ?? old('num_serie')])
        @include('perito.laudo.materiais.attributes.dito_oficio')
        @include('perito.laudo.materiais.attributes.numero_canos', ['num_canos2' => $garrucha->num_canos ??
        old('num_canos')])
        @include('perito.laudo.materiais.attributes.sistema_carregamento', ['sistema_carregamento2' =>
        $garrucha->sistema_carregamento ?? old('sistema_carregamento')])
        
        @include('perito.laudo.materiais.attributes.sistema_percussao', ['sistema_percussao2' =>
        $garrucha->sistema_percussao ?? old('sistema_percussao')])
        @include('perito.laudo.materiais.attributes.sistema_disparo',['sistema_disparo2'=>$garrucha->sistema_disparo ?? old('sistema_disparo')])
        @include('perito.laudo.materiais.attributes.tipo_acabamento', ['tipo_acabamento2' => $garrucha->tipo_acabamento
        ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.acabamento_outra_opcao', ['tipo_acabamento2' => $carabina->tipo_acabamento
        ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.cabo', ['cabo2' => $garrucha->cabo ?? old('cabo')])
        @include('perito.laudo.materiais.attributes.cabo_outra_opcao', ['cabo2' => $carabina->cabo ?? old('cabo')])
        @include('perito.laudo.materiais.attributes.comprimento', ['comprimento_total' => $garrucha->comprimento_total
        ?? old('comprimento_total')])
        @include('perito.laudo.materiais.attributes.altura', ['altura' => $garrucha->altura ?? old('altura')])
        @include('perito.laudo.materiais.attributes.comprimento_cano', ['comprimento_cano' =>
        $garrucha->comprimento_cano ?? old('comprimento_cano')])
        @include('perito.laudo.materiais.attributes.diametro_cano', ['diametro_cano2' =>
        $garrucha->diametro_cano ?? old('diametro_cano')])
        @include('perito.laudo.materiais.attributes.quantidade_raias', ['quantidade_raias' =>
        $garrucha->quantidade_raias ?? old('quantidade_raias')])
        @include('perito.laudo.materiais.attributes.sentido_raias', ['sentido_raias2' => $garrucha->sentido_raias ??
        old('sentido_raias')])
        @include('perito.laudo.materiais.attributes.funcionamento', ['funcionamento2' => $garrucha->funcionamento ??
        old('funcionamento')])
        @include('perito.laudo.materiais.attributes.estado_geral', ['estado_geral2' => $garrucha->estado_geral ??
        old('estado_geral')])
        @include('perito.laudo.attributes.material_coletado')
        @include('perito.laudo.materiais.attributes.lacresaida', ['num_lacre_saida' => $garrucha->num_lacre_saida ?? old('num_lacre_saida')])
        @include('perito.laudo.materiais.attributes.lacre', ['num_lacre' => $garrucha->num_lacre ?? old('num_lacre')])
        
        @include('perito.laudo.materiais.attributes.salva_modelo_cadastro')
        @include('perito.laudo.materiais.attributes.municaoFornecidaPela')
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
@include('perito.modals.calibre_modal', ['tipo_arma' => 'garrucha'])
@include('perito.modals.marca_modal')
@include('perito.modals.pais_modal')
@if($acao == 'Atualizar')
@include('perito.modals.visualizar_imagens_modal', ['arma_id' => $garrucha->id])
@endif
        
        
        
        
        
        
        
        
        
        