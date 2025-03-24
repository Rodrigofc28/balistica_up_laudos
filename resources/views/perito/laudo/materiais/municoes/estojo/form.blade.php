@section('js')
{!! Html::script('js/form_municoes.js') !!}
@if($acao == 'Cadastrar')
{!! Html::script('js/sessionCartucho.js') !!}
@endif
@endsection

@if ($acao == 'Cadastrar')
{!! Form::open(['route' => ['municoes.store', $laudo], 'enctype' => 'multipart/form-data']) !!}
@elseif ($acao == 'Atualizar')
{!! Form::open(['route' => ['municoes.update', $laudo, $municao], 'method' => 'patch','enctype' => 'multipart/form-data']) !!}
@else
{!! Form::open() !!}
@endif

<input type="hidden" name="laudo_id" id="laudo_id" value="{{ $laudo->id }}">
<input type="hidden" name="municao_de" id="laudo_id" value="arma curta">
<input type="hidden" value="estojo" name="tipo_municao"   class="form-control" type="text">

<div class="col-lg-12" style="padding: 0 5% 0">
@if (session('estojo')&&$acao == 'Cadastrar')
    @php
        $municoes = collect(session('estojo', []))->map(fn($item) => (object) $item);
    @endphp

    <div class="itemCartuchoCadastro">
        <span class="subTituloCadastroCartucho">Itens Cadastrados nesta Sessão</span>   
        <div class="marcasCadastradasCartuchos">
            <table border="1" width="100%" style="border-collapse: collapse; text-align: left;">
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Calibre</th>
                        <th>Quantidade</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($municoes as $item)
                        <tr>
                            <td style="text-align:center">{{ $item->marca->nome ?? 'N/A' }}</td>
                            <td style="text-align:center">{{ $item->calibre->nome ?? 'N/A' }}</td>
                            <td style="text-align:center">{{ $item->quantidade ?? 0 }}</td>
                            <td style="text-align:center">
                                <button value="{{ route('municoes.destroy', [$laudo, $item]) }}" type="submit" class="btn btn-danger delete">
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
        {{--Marca e origem--------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.marca', ['marca2' => $municao->marca->id ?? old('marca_id')])
        @include('perito.laudo.materiais.attributes.origem', ['origem2' => $municao->marca->id ?? old('origem_id')])
        {{--Calibre--------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.calibre', ['obrigatorio' => 'true', 'calibre2' =>
        $municao->calibre->id ?? old('calibre_id')])
        {{--Dito no oficio--------------------------------------------------------------------------------------------------}}
        @if($laudo->laudoEfetConst=="B602"){{--Incluido no B602 dito no oficio--}}
            @include('perito.laudo.materiais.attributes.dito_oficio')
        @endif
        {{--Quantidade--------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.quantidade', ['quantidade' => $municao->quantidade ??
        old('quantidade')])
        {{--tipo de estojo--------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.estojo', ['estojo2' => $municao->estojo ?? old('estojo')])
        {{--tipo de espoleta--------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.tipo_espoleta', ['tipo_espoleta2' => $municao->tipo_projetil ??
        old('tipo_projetil')])
       {{--condição do estojo--------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.condicao_estojo', ['funcionamento2' => $municao->funcionamento ??
        old('funcionamento')])
        {{--observação--------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.municao_observacao',['observacao'=>$municao->observacao??old('observacao')])
        {{--material coletado--------------------------------------------------------------------------------------------------}}
        @if($laudo->laudoEfetConst!="B601")
            @include('perito.laudo.materiais.attributes.material_coletado_municao',['rep'=>empty($municao->rep_materialColetado)?session('rep_coleta'):$municao->rep_materialColetado ?? old('rep')])
        @endif
        {{--lote--------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.lote',['lote'=>$municao->lote ??old('lote')])
        @if($laudo->laudoEfetConst=="B601"){{--Incluido localidade e origem no B601--}}
            @include('perito.laudo.materiais.attributes.detalharlocalidade',['detalharlocalidade'=>empty($componente->detalharLocalizacao)?session('detalhe_localizacao'):$componente->detalharLocalizacao??old('detalharlocalidade')])
            @include('perito.laudo.materiais.attributes.material_coletado_projetil',['origem'=>empty($componente->origemcoletadaPerito)?session('origem'):$componente->origem_coletaPerito,'rep'=>empty($componente->rep_materialColetado)?session('rep_coleta'):$componente->rep_materialColetado??old('origem'),old('rep')])
           @include('perito.laudo.materiais.attributes.rep_de_coleta')
           
        @endif
        {{--lacre de entrada e saida--------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.lacrecartucho', [$name='lacrecartucho',$label='Nº lacre de entrada','lacre'=>empty($municao->lacrecartucho)?session('lacre_entrada'):$municao->lacrecartucho ?? old('lacre')])
        @include('perito.laudo.materiais.attributes.lacrecartucho', [$name='lacre_saida',$label='N° lacre de saida','lacre'=>empty($municao->lacre_saida)?session('lacre_entrada'):$municao->lacre_saida ?? old('lacre') ])
       {{--checkbox--------------------------------------------------------------------------------------------------}}
       @if($laudo->laudoEfetConst!="B601")
            @include('perito.laudo.materiais.attributes.cartuchoPadrao')
       @endif
    </div>
       @include('perito.laudo.materiais.attributes.imagem_municao',['tipo'=>'DA MUNIÇÃO'])
    
     
    <div id="btnAcao" class="row justify-content-between mb-4">
        <div  class="col-lg-4 mt-1">
            <a class="btn btn-secondary btn-block" href="{!! URL::previous() !!}">
                <i class="fas fa-arrow-circle-left"></i> Voltar</a>
        </div>
        <div   class="col-lg-4 mt-1">
            <button type="submit"  class="btn btn-success btn-block submit_arma_form"><strong>
                    <i class="fas fa-plus" aria-hidden="true"></i> {{ $acao }}</strong>
            </button>
            {{ Form::close() }}
        </div>
        <div  class="col-lg-4 mt-1">
            <a class="btn btn-secondary btn-block" href="{{route('laudos.show', ['id' => $laudo->id])}}">
                <i class="fas fa-arrow-circle-left"></i> Voltar para Visão Geral do Laudo</a>
        </div>
    </div>
</div>
@include('perito.modals.calibre_modal')
@include('perito.modals.marca_modal')

   
<script src="{{asset('js/redimensionando_foto.js')}}"></script>
<script src="{{asset('js/municaoImagem.js')}}"></script>