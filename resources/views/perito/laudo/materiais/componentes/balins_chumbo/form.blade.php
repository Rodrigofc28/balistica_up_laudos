
@section('js')
{!! Html::script('js/selectProjeteis.js') !!} 
{!! Html::script('js/projetil.js') !!}
{!! Html::script('js/form_componentes.js') !!}
@if($acao == 'Cadastrar')
{!! Html::script('js/sessionProjet.js') !!}
@endif
@endsection


@if ($acao == 'Cadastrar')
{!! Form::open(['route' => ['componentes.store', $laudo ],'enctype' => 'multipart/form-data']) !!}
@elseif ($acao == 'Atualizar')
{!! Form::open(['route' => ['componentes.update', $laudo, $componente], 'method' => 'patch','enctype' => 'multipart/form-data']) !!}
@else
{!! Form::open() !!}
@endif
{{--B602 remover tipo de projetil, calibre medio, altura, aderencia, deformações,localidade, origem, qtd de raias, cavados e resaltos.
incluir marca e modelo, massa,const formato, calibre nominal caso nao tenha diametro e altura maxima qunt de projetil fixo lacres incluir texto 
B601 tipo antes de tipo de raiamento, quantidade fixa, numeros de cavados e numeros de resaltos, numero de coleta remover, dito no oficio incluir
--}}


<input type="hidden" name="laudo_id" id="laudo_id" value="{{ $laudo->id }}">
<input type="hidden" name="componente" id="componente" value="Projetil">

<div class="col-lg-12" style="padding: 0 5% 0">
 @if (session('projetil')&&$acao == 'Cadastrar')
            @php
                $projetil = collect(session('projetil', []))->map(fn($item) => (object) $item);
            @endphp

            <div class="itemCartuchoCadastro">
                <span class="subTituloCadastroCartucho">Itens Cadastrados nesta Sessão</span>   
                <div class="marcasCadastradasCartuchos">
                    <table border="1" width="100%" style="border-collapse: collapse; text-align: left;">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Constituição e Formato</th>
                                <th>Quantidade</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projetil as $item)
                                <tr>
                                    <td style="text-align:center">{{ $item->componente ?? 'N/A' }}</td>
                                    <td style="text-align:center">{{ $item->constituicao_formato ?? 'N/A' }}</td>
                                    <td style="text-align:center">{{ $item->quantidade_frascos ?? 0 }}</td>
                                    <td style="text-align:center">
                                        <button value="{{ route('componentes.destroy', [$laudo, $item]) }}" type="submit" class="btn btn-danger delete">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> 
        @else
            
        @endif
    <div class="row mb-3">
        @php
           // dd($laudo->laudoEfetConst);
        @endphp
        @include('perito.laudo.materiais.attributes.tipo_projetil', ['tipo_projetil2' =>
        $componente->tipo_projetil ?? old('tipo_projetil')])
        @include('perito.laudo.materiais.attributes.tipo_raiamento', ['tipo_raiamento2' =>
        $componente->tipo_raiamento ?? old('tipo_raiamento')])
            
        @include('perito.laudo.materiais.attributes.dito_oficio')
        @include('perito.laudo.materiais.attributes.provavelCalibre', ['obrigatorio' => 'true', 'calibre2' =>
        $municao->calibre->id ?? old('calibre_id')])
        @include('perito.laudo.materiais.attributes.massa', ['massa' =>(isset($componente))? $componente->massa:'','calibreReal'=>(isset($componente))?$componente->calibreReal:'','calibreNominal'=>(isset($componente))?$componente->calibreNominal:''
         ?? old('massa'), old('calibreReal'),old('calibreNominal') ])
       
         @include('perito.laudo.materiais.attributes.altura_projetil', ['altura' =>  $componente->altura_projetil ?? old('altura')])
         @include('perito.laudo.materiais.attributes.constituicao_formato',['constituicao_formato2' => $componente->constituicao_formato ?? old('constituicao_formato2')])
         @include('perito.laudo.materiais.attributes.aderencia',['aderencia2'=> $componente->aderencia ?? old('aderencia2')])
         
         @include('perito.laudo.materiais.attributes.sentido_raias', ['sentido_raias2' => $componente->sentido_raias ??
        old('sentido_raias')])
        @include('perito.laudo.materiais.attributes.quantidade_raias_projetil', ['quantidade_raias' => $componente->quantidade_raias
        ?? old('quantidade_raias')])
        
        @include('perito.laudo.materiais.attributes.cavados',['cavados'=>$componente->cavados??old('cavados')])
        @include('perito.laudo.materiais.attributes.ressaltos',['ressaltos'=>$componente->ressaltos??old('ressaltos')])
        @include('perito.laudo.materiais.attributes.projetil_observacao')
        
         
         @include('perito.laudo.materiais.attributes.lacrecartucho', [$name = 'lacrecartucho', $label ="Nº lacre de entrada",'lacre'=>empty($componente->lacrecartucho)?session('lacre_projetil_entrada'):$componente->lacrecartucho ??
        old('lacre')])
        @include('perito.laudo.materiais.attributes.lacrecartucho', [$name = 'lacreSaida', $label ="N° lacre de saida",'lacre'=>empty($componente->lacreSaida)?session('lacre_projetil_saida'):$componente->lacreSaida ??
        old('lacre')])
        @if($laudo->laudoEfetConst=="B602")
            @include('perito.laudo.materiais.attributes.material_coletado_projetil',['origem'=>empty($componente->origemcoletadaPerito)?session('origem'):$componente->origem_coletaPerito,'rep'=>empty($componente->rep_materialColetado)?session('rep_coleta'):$componente->rep_materialColetado??old('origem'),old('rep')])
        @endif
        
        @include('perito.laudo.materiais.attributes.detalharlocalidade',['detalharlocalidade'=>empty($componente->detalharLocalizacao)?session('detalhe_localizacao'):$componente->detalharLocalizacao??old('detalharlocalidade')])
        @include('perito.laudo.materiais.attributes.deformacaoAcidental',['deformacoes2'=>$componente->deformacaoAcidental??old('deformacoes2')])
       
    </div>
     @include('perito.laudo.materiais.attributes.imagem_municao',['tipo'=>'DOS PROJÉTEIS'])
    

    <div id="btnAcao" class="row justify-content-between mb-4">
        <div class="col-lg-4 mt-1">
            <a class="btn btn-secondary btn-block" href="{!! URL::previous() !!}">
                <i class="fas fa-arrow-circle-left"></i> Voltar</a>
        </div>
        
        <div class="col-lg-4 mt-1">
            <button type="submit" class="btn btn-success btn-block"><strong>
                    <i class="fas fa-plus" aria-hidden="true"></i> {{ $acao }}</strong>
            </button>
            {{ Form::close() }}
        </div>
        <div class="col-lg-4 mt-1">
            <a class="btn btn-secondary btn-block" href="{{route('laudos.show', ['id' => $laudo->id])}}">
                <i class="fas fa-arrow-circle-left"></i> Voltar para Visão Geral do Laudo</a>
        </div>
    </div>
</div>
<script src="{{asset('js/redimensionando_foto.js')}}"></script>
<script src="{{asset('js/municaoImagem.js')}}"></script>
