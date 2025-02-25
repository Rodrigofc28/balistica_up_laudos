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
    <div class="row mb-3">
        @empty($arma_estojo_gdl)
        
        @else
            @include('perito.laudo.materiais.attributes.atributes_arma_gdl',['name_arma_gdl'=>$arma_estojo_gdl])
        @endempty
        
        
        @include('perito.laudo.materiais.attributes.marca', ['marca2' => $municao->marca->id ?? old('marca_id')])
        @include('perito.laudo.materiais.attributes.origem', ['origem2' => $municao->marca->id ?? old('origem_id')])
        
        @include('perito.laudo.materiais.attributes.calibre', ['obrigatorio' => 'true', 'calibre2' =>
        $municao->calibre->id ?? old('calibre_id')])
        @include('perito.laudo.materiais.attributes.quantidade', ['quantidade' => $municao->quantidade ??
        old('quantidade')])
        @include('perito.laudo.materiais.attributes.estojo', ['estojo2' => $municao->estojo ?? old('estojo')])
        
        @include('perito.laudo.materiais.attributes.tipo_espoleta', ['tipo_espoleta2' => $municao->tipo_projetil ??
        old('tipo_projetil')])
       
        @include('perito.laudo.materiais.attributes.condicao_estojo', ['funcionamento2' => $municao->funcionamento ??
        old('funcionamento')])
        @include('perito.laudo.materiais.attributes.municao_observacao',['observacao'=>$municao->observacao??old('observacao')])
        @include('perito.laudo.materiais.attributes.funcionamentoCartucho',['funcionamentoCartucho'=>$municao->funcionamentoCartucho??old('funcionamentoCartucho')])
        @include('perito.laudo.materiais.attributes.material_coletado_municao',['rep'=>empty($municao->rep_materialColetado)?session('rep_coleta'):$municao->rep_materialColetado ?? old('rep')])
        @include('perito.laudo.materiais.attributes.lote',['lote'=>$municao->lote ??old('lote')])
        @include('perito.laudo.materiais.attributes.lacrecartucho', [$name='lacrecartucho',$label='Nº lacre de entrada','lacre'=>empty($municao->lacrecartucho)?session('lacre_entrada'):$municao->lacrecartucho ?? old('lacre')])
        @include('perito.laudo.materiais.attributes.lacrecartucho', [$name='lacre_saida',$label='N° lacre de saida','lacre'=>empty($municao->lacre_saida)?session('lacre_entrada'):$municao->lacre_saida ?? old('lacre') ])
       
        @include('perito.laudo.materiais.attributes.cartuchoPadrao')
       
    </div>
       @include('perito.laudo.materiais.attributes.imagem_municao',['tipo'=>'DA MUNIÇÃO'])
    @if($acao == 'Atualizar')
    <div>
        <hr>
       <strong>• Imagem salva •</strong><br>
       @if(isset($municao->imagens[0]->nome))
        <img src="{{asset('../storage/imagensMunicao/'.$municao->imagens[0]->nome)}}" style="width:100px;height:100px"alt="">
        <strong><a href="{{route('imagemCartuchoExcluir',$municao->imagens[0])}}" style="color:red">Excluir Imagem</a></strong>
        @else
        <p>• Sem Imagem</p>
        @endif
        @if(isset($municao->imagens[1]->nome))
        <img src="{{asset('../storage/imagensMunicao/'.$municao->imagens[1]->nome)}}" style="width:100px;height:100px"alt="">
        <strong><a href="{{route('imagemCartuchoExcluir',$municao->imagens[1])}}"style="color:red">Excluir Imagem</a></strong>
        @endif  
       
    </div>
     @endif
     
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