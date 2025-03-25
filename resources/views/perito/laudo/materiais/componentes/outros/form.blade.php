@section('js')
    {!! Html::script('js/form_componentes.js') !!}
@endsection

@if ($acao == 'Cadastrar')
    {!! Form::open(['route' => ['outro.store', $laudo ],'enctype' => 'multipart/form-data']) !!}
@elseif ($acao == 'Atualizar')
    {!! Form::open(['route' => ['outro.update', $laudo, $componente], 'method' => 'patch','enctype' => 'multipart/form-data']) !!}
@else
    {!! Form::open() !!}
@endif
<style>
    .radioModelo{
        border: 1px solid #c4c2c2;
        padding: 5px;
        border-radius: 5px;
    }
</style>
<input type="hidden" name="laudo_id" id="laudo_id" value="{{ $laudo->id }}">
<input type="hidden" name="material" id="material" value="outros">

<div class="col-lg-12" style="padding: 0 5% 0">
    <div class="row mb-5">
        <label for="descricaoOutros">Descrição do Item Periciado</label>
        <textarea name="descricao_item" class="form-control"  id="" cols="30" rows="5"></textarea>
        <div class="col-lg-3">
            <label for="marca">Marca:</label>
            <input class="form-control" name="marca" id="marca" type="text"> 
        </div>
        <div class="col-lg-3">
            <label for="marca">Nome do Objeto:</label>
            <input class="form-control" name="nome" id="nome" type="text"> 
        </div>
        <div class="col-lg-3">
            <label for="quantidadeOutros">Quantidade:</label>
            <input class="form-control" name="quantidade" id="quantidadeOutros" type="number"> 
        </div>
        <div class="col-lg-3">
              <label for="quantidadeOutros">Unidade:</label>
            <select class="form-control" name="medida" id="medidaOutros">
                <option ></option>
                @foreach ([ 'GRAMAS (g)', 'QUILOGRAMAS (Kg)', 'MILILITROS (ml)', 'LITROS (L)'] as $item)
                    <option value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        </div>    
        <div class="col-lg-3">
            <label for="lacreEntradaOutros">Lacre de Entrada</label>
            <input class="form-control" name="lacre_entrada" id="lacreEntradaOutros" type="text">
        </div> 
        <div class="col-lg-3">  
            
            <label for="lacreSaidaOutros">Lacre de Saída</label>
            <input class="form-control" name="lacre_saida" id="lacreSaidaOutros" type="text">
            
        </div> 
        <div class="col-lg-3">  
            
            <label  for="salvaModelo">Deseja salvar esse modelo</label>
            <div class="radioModelo">
                <span>Sim</span>
                <input type="radio" value="sim" name="modelo" id="modelo">
            </div>
            <div class="radioModelo">
                <span>Não</span>
                <input type="radio" value="nao" name="modelo" id="modelo">
            </div>
            
            
        </div> 
        <div class="col-lg-3"> 
            <input class="form-control" style="margin-top: 10%" placeholder="Nome do modelo" name="modeloSalvo" id="modeloSalvo" type="text">
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
    <script>
        //Aparece o modelo para ser o nome do modelo
        document.addEventListener("DOMContentLoaded", function () {
            const inputSim = document.querySelector("input[value='sim']");
            const inputNao = document.querySelector("input[value='nao']");
            const modeloSalvo = document.getElementById("modeloSalvo");

            function toggleInput() {
                if (inputSim.checked) {
                    modeloSalvo.style.display = "block";
                } else {
                    modeloSalvo.style.display = "none";
                }
            }

            inputSim.addEventListener("change", toggleInput);
            inputNao.addEventListener("change", toggleInput);
            
            // Ocultar o input no início
            modeloSalvo.style.display = "none";
        });
    </script>
</div>