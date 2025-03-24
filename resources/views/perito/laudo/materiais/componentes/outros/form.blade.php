@section('js')
    {!! Html::script('js/form_componentes.js') !!}
@endsection

@if ($acao == 'Cadastrar')
    {!! Form::open(['route' => ['outro.store', $laudo ]]) !!}
@elseif ($acao == 'Atualizar')
    {!! Form::open(['route' => ['outro.update', $laudo, $componente], 'method' => 'patch']) !!}
@else
    {!! Form::open() !!}
@endif

<input type="hidden" name="laudo_id" id="laudo_id" value="{{ $laudo->id }}">
<input type="hidden" name="componente" id="componente" value="Pólvora">

<div class="col-lg-12" style="padding: 0 5% 0">
    <div class="row mb-5">
        <label for="descricaoOutros">Descrição do Item Periciado</label>
        <textarea name="descricao_item" class="form-control"  id="" cols="30" rows="5"></textarea>
        <div class="col-lg-3">
            <label for="quantidadeOutros">Quantidade Descrição:</label>
            <input class="form-control" name="quantidade_descricao" id="quantidadeDescricaoOutros" type="number"> 
        </div>
        <div class="col-lg-3">
            <label for="quantidadeOutros">Quantidade:</label>
            <input class="form-control" name="quantidade" id="quantidadeOutros" type="number"> 
        </div>
        <div class="col-lg-3">
              <label for="quantidadeOutros">Medida:</label>
            <select class="form-control" name="medida" id="medidaOutros">
                <option ></option>
                @foreach (['GRAMAS(g)','QUILOGRAMAS(Kg)'] as $item)
                    <option value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        </div>    
        <div class="col-lg-3">
            <label for="lacreEntradaOutros">Lacre de Entrada</label>
            <input class="form-control" name="lacre_Entrada" id="lacreEntradaOutros" type="text">
        </div> 
        <div class="col-lg-3">  
            
            <label for="lacreSaidaOutros">Lacre de Saída</label>
            <input class="form-control" name="lacre_saida" id="lacreSaidaOutros" type="text">
            
        </div> 
        
        
    </div>
    @include('perito.laudo.materiais.attributes.imagem_municao',['tipo'=>'OUTROS MATERIAIS'])
    <div class="row justify-content-between mb-4">
        <div class="col-lg-4 mt-1">
            <a class="btn btn-secondary btn-block" href="{!! URL::previous() !!}">
                <i class="fas fa-arrow-circle-left"></i> Voltar</a>
        </div>
        <div class="col-lg-4 mt-1">
            <button type="submit" class="btn btn-success btn-block submit_arma_form"><strong>
                    <i class="fas fa-plus" aria-hidden="true"></i> {{ $acao }}</strong>
            </button>
            {{ Form::close() }}
        </div>
    </div>
    <script src="{{asset('js/redimensionando_foto.js')}}"></script>
    <script src="{{asset('js/municaoImagem.js')}}"></script>
</div>