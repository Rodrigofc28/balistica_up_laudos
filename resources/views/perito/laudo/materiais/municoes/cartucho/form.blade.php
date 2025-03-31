@section('js')
{!! Html::script('js/sessionCartucho.js') !!}
@if($acao == 'Cadastrar')

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
<input  type="hidden" value="cartucho" name="tipo_municao"   class="form-control" type="text">

<div class="col-lg-12" style="padding: 0 5% 0">
  
   
     @if (session('municoes')&&$acao == 'Cadastrar')
            @php
                $municoes = collect(session('municoes', []))->map(fn($item) => (object) $item);
            @endphp

            <div class="itemCartuchoCadastro">
                <span class="subTituloCadastroCartucho">Itens Cadastrados nesta Sessão</span>   
                <div class="marcasCadastradasCartuchos">
                    <table border="1" width="100%" style="border-collapse: collapse; text-align: left;">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Marca</th>
                                <th>Calibre</th>
                                <th>Quantidade</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($municoes as $item)
                                <input  name="item" id="item" type="text" value="{{$item->item }}">
                                <tr>
                                    <td class="item{{$item->id}}" style="text-align:center">{{$item->item ?? 'N/A' }}</td>
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
        {{--Marca e origem-----------------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.marca', ['marca2' => $municao->marca->id ?? old('marca_id')])
        @include('perito.laudo.materiais.attributes.origem', ['origem2' => $municao->marca->id ?? old('origem_id')])
        {{--Tipo de calibre Nominal--------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.calibre', ['obrigatorio' => 'true', 'calibre2' =>
        $municao->calibre->id ?? old('calibre_id')])
        {{--Quantidade---------------------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.quantidade', ['quantidade' => $municao->quantidade ??
        old('quantidade')])
        {{--Dito no oficio--------------------------------------------------------------------------------------------------}}
        @if($laudo->laudoEfetConst=="B602"){{--Incluido no B602 dito no oficio--}}
            @include('perito.laudo.materiais.attributes.dito_oficio')
        @endif
        {{--Tipo de Estojo do cartucho---------------------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.estojo', ['estojo2' => $municao->estojo ?? old('estojo')])
        {{--Tipo de Projétil do cartucho---------------------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.projetil_arma_curta', ['projetil2' => $municao->projetil ??
        old('projetil')])
        {{--Tipo de espoleta do cartucho---------------------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.tipo_espoleta', ['tipo_espoleta2' => $municao->tipo_projetil ??
        old('tipo_projetil')])
        {{--Condição cartucho---------------------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.condicao_cartucho', ['funcionamento2' => $municao->funcionamento ??
        old('funcionamento')])
        {{--Observação---------------------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.municao_observacao',['observacao'=>$municao->observacao??old('observacao')])
        {{--Funcionamento---------------------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.funcionamentoCartucho',['funcionamentoCartucho'=>$municao->funcionamentoCartucho??old('funcionamentoCartucho')])
        {{--Nº de exame de coleta---------------------------------------------------------------------------------------------------------------}}
        @if($laudo->laudoEfetConst=="B601")
            @include('perito.laudo.materiais.attributes.material_coletado_municao',['rep'=>empty($municao->rep_materialColetado)?session('rep_coleta'):$municao->rep_materialColetado ?? old('rep')])
        @endif
        {{--Lote---------------------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.lote',['lote'=>$municao->lote ??old('lote')])
         {{--Lacre de entrada e saida---------------------------------------------------------------------------------------------------------------}}
        @include('perito.laudo.materiais.attributes.lacrecartucho', [$name='lacrecartucho',$label='Nº lacre de entrada','lacre'=>empty($municao->lacrecartucho)?session('lacre_entrada'):$municao->lacrecartucho ?? old('lacre')])
        @include('perito.laudo.materiais.attributes.lacrecartucho', [$name='lacre_saida',$label='N° lacre de saida','lacre'=>empty($municao->lacre_saida)?session('lacre_entrada'):$municao->lacre_saida ?? old('lacre') ])
        {{--Checkbox da coleta padrão---------------------------------------------------------------------------------------------------------------}}
        @if($laudo->laudoEfetConst=="B602")
            @include('perito.laudo.materiais.attributes.cartuchoPadrao')
        @endif
    </div>
    
       @include('perito.laudo.materiais.attributes.imagem_municao',['tipo'=>'DA MUNIÇÃO'])
      
    <div id="btnAcao" class="row justify-content-between mb-4">
        <div  class="col-lg-3 mt-1">
            <a class="btn btn-secondary btn-block" href="{!! URL::previous() !!}">
                <i class="fas fa-arrow-circle-left"></i> Voltar</a>
        </div>
        <div   class="col-lg-3 mt-1">
            <button type="submit"  class="btn btn-success btn-block submit_arma_form"><strong>
                    <i class="fas fa-plus" aria-hidden="true"></i> {{ $acao }}</strong>
            </button>
            {{ Form::close() }}
        </div>
        <div  class="col-lg-3 mt-1">
            <a style="color: rgb(250, 250, 250)" id="itensAdd" class="btn btn-success btn-block" >
                <svg xmlns="http://www.w3.org/2000/svg" width="15px"  viewBox="0 0 448 512">
                    <path fill="aliceblue" d="M64 80c-8.8 0-16 7.2-16 16l0 320c0 8.8 7.2 16 16 16l320 0c8.8 0 16-7.2 16-16l0-320c0-8.8-7.2-16-16-16L64 80zM0 96C0 60.7 28.7 32 64 32l320 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96zM200 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/>
                </svg> Incluir Novo Item
            </a>
        </div>
        <div  class="col-lg-3 mt-1">
            <a class="btn btn-secondary btn-block" href="{{route('laudos.show', ['id' => $laudo->id])}}">
                <i class="fas fa-arrow-circle-left"></i> Voltar para Visão Geral do Laudo</a>
        </div>
    </div>
</div>
@include('perito.modals.calibre_modal'){{--Incluindo a modal do calibre --}}
@include('perito.modals.marca_modal')

   
<script src="{{asset('js/redimensionando_foto.js')}}"></script>
<script src="{{asset('js/municaoImagem.js')}}"></script>
<script src="{{asset('js/itensAdd.js')}}"></script>