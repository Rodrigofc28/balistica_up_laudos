
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

<input type="hidden" name="laudo_id" id="laudo_id" value="{{ $laudo->id }}">
<input type="hidden" name="componente" id="componente" value="Projetil">
{{------------------------------------------------------------------------------------------------------------------------------}}
        {{--Tabela de cadastro de projetil--}}
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
        {{--Texto de observação--}}
        @if($laudo->laudoEfetConst=="B602"){{--Incluido no B601 tipo de projétil--}}
            <span class="obsTipoExame">OBS: Para exames de constatação deve-se utilizar o formulário contido na natureza B601</span>
        @endif
    <div class="row mb-3">
        
        {{------------------------------------------------------------------------------------------------------------------------------}}
        {{--Tipo de projétil--}}
        @if($laudo->laudoEfetConst=="B601"){{--Incluido no B601 tipo de projétil--}}
           @include('perito.laudo.materiais.attributes.tipo_projetil', ['tipo_projetil2' =>
            $componente->tipo_projetil ?? old('tipo_projetil')])
        @endif
        {{------------------------------------------------------------------------------------------------------------------------------}}
        {{--Tipo de raiamento--}}
        @include('perito.laudo.materiais.attributes.tipo_raiamento', ['tipo_raiamento2' =>
        $componente->tipo_raiamento ?? old('tipo_raiamento')])
        {{------------------------------------------------------------------------------------------------------------------------------}}
        {{--dito no oficio--}}
        @include('perito.laudo.materiais.attributes.dito_oficio')
        {{------------------------------------------------------------------------------------------------------------------------------}}
        {{--provavel calibre nominal--}}
        @include('perito.laudo.materiais.attributes.provavelCalibre', ['obrigatorio' => 'true', 'calibre2' =>
        $municao->calibre->id ?? old('calibre_id')])
        {{------------------------------------------------------------------------------------------------------------------------------}}
        {{--calibre medio e altura--}}
        
            @include('perito.laudo.materiais.attributes.massa', ['massa' =>(isset($componente))? $componente->massa:'','calibreReal'=>(isset($componente))?$componente->calibreReal:'','calibreNominal'=>(isset($componente))?$componente->calibreNominal:''
             ?? old('massa'), old('calibreReal'),old('calibreNominal') ])
        
            @include('perito.laudo.materiais.attributes.altura_projetil', ['altura' =>  $componente->altura_projetil ?? old('altura')])
        
        {{------------------------------------------------------------------------------------------------------------------------------}}
        {{--Constituição e formato--}}
         @include('perito.laudo.materiais.attributes.constituicao_formato',['constituicao_formato2' => $componente->constituicao_formato ?? old('constituicao_formato2')])
         {{------------------------------------------------------------------------------------------------------------------------------}}
         {{--Aderencias--}}
        @if($laudo->laudoEfetConst=="B601"){{--Incluido aderencia no B601--}}
            @include('perito.laudo.materiais.attributes.aderencia',['aderencia2'=> $componente->aderencia ?? old('aderencia2')])
        @endif
        {{------------------------------------------------------------------------------------------------------------------------------}}
        {{--Sentido da raias--}}
        @if($laudo->laudoEfetConst=="B601"){{--Incluido Sentido da raias B601--}}
            @include('perito.laudo.materiais.attributes.sentido_raias', ['sentido_raias2' => $componente->sentido_raias ??
            old('sentido_raias')])
        @endif
        {{------------------------------------------------------------------------------------------------------------------------------}}
        {{--Quantidade de raias--}}
        @if($laudo->laudoEfetConst=="B601"){{--Incluido quantidade de raias B601--}}
            @include('perito.laudo.materiais.attributes.quantidade_raias_projetil', ['quantidade_raias' => $componente->quantidade_raias
            ?? old('quantidade_raias')])
        @endif
        {{--Quantidade --}}
        @if($laudo->laudoEfetConst=="B602"){{--Incluido quantidade de raias B601--}}
            @include('perito.laudo.materiais.attributes.quantidadeProjetil',['quantidadeProjetil'=>$componente->quantidade_frascos??old('quantidadeProjetil')])
        @endif
        {{------------------------------------------------------------------------------------------------------------------------------}}
        {{--Resaltos e cavados--}}
        @if($laudo->laudoEfetConst=="B601"){{--Incluido cavados e resaltos no B601--}}
            @include('perito.laudo.materiais.attributes.cavados',['cavados'=>$componente->cavados??old('cavados')])
            @include('perito.laudo.materiais.attributes.ressaltos',['ressaltos'=>$componente->ressaltos??old('ressaltos')])
        @endif
        {{------------------------------------------------------------------------------------------------------------------------------}}
        {{--Observação--}}
        @include('perito.laudo.materiais.attributes.projetil_observacao')
        {{------------------------------------------------------------------------------------------------------------------------------}}
         {{--Lacre de entrada e de saida--}}
         @include('perito.laudo.materiais.attributes.lacrecartucho', [$name = 'lacrecartucho', $label ="Nº lacre de entrada",'lacre'=>empty($componente->lacrecartucho)?session('lacre_projetil_entrada'):$componente->lacrecartucho ??
        old('lacre')])
        @include('perito.laudo.materiais.attributes.lacrecartucho', [$name = 'lacreSaida', $label ="N° lacre de saida",'lacre'=>empty($componente->lacreSaida)?session('lacre_projetil_saida'):$componente->lacreSaida ??
        old('lacre')])
        {{------------------------------------------------------------------------------------------------------------------------------}}
        {{--Material coletado--}}
        @if($laudo->laudoEfetConst=="B601"){{--Incluido no B602 matérial coletado --}}
            @include('perito.laudo.materiais.attributes.material_coletado_projetil',['origem'=>empty($componente->origemcoletadaPerito)?session('origem'):$componente->origem_coletaPerito,'rep'=>empty($componente->rep_materialColetado)?session('rep_coleta'):$componente->rep_materialColetado??old('origem'),old('rep')])
        @endif
        {{------------------------------------------------------------------------------------------------------------------------------}}
        {{--Defomações--}}
        @if($laudo->laudoEfetConst=="B601"){{--Incluido Deformações no B601--}}
            @include('perito.laudo.materiais.attributes.detalharlocalidade',['detalharlocalidade'=>empty($componente->detalharLocalizacao)?session('detalhe_localizacao'):$componente->detalharLocalizacao??old('detalharlocalidade')])
        
            @include('perito.laudo.materiais.attributes.deformacaoAcidental',['deformacoes2'=>$componente->deformacaoAcidental??old('deformacoes2')])
        @endif
        {{------------------------------------------------------------------------------------------------------------------------------}}
    </div>
    {{------------------------------------------------------------------------------------------------------------------------------}}
        {{--Imagens --}}
     @include('perito.laudo.materiais.attributes.imagem_municao',['tipo'=>'DOS PROJÉTEIS'])
    {{------------------------------------------------------------------------------------------------------------------------------}}
        {{--Modal de cadastrado de calibres--}}
     @include('perito.modals.calibre_modal')

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
