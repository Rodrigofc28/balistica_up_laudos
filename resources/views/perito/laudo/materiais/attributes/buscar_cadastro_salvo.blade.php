<style>
    .container {
        max-width: 100%;
        position: relative;
        display: inline-block;
        margin: 20px;
    }

    .imagemZoom {
        max-width: 100%;
        width: 600px; /* Ajuste conforme necessário */
        height: auto;
        display: block;
    }

    .zoom-lupa {
        position: absolute;
        border: 2px solid #000;
        border-radius: 50%;
        width: 300px;
        height: 300px;
        overflow: hidden;
        pointer-events: none;
        display: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        background-repeat: no-repeat;
    }
    .imgsConteiners{
        max-width: 100%;
        display: flex;
        margin: auto;
    }
    @media (max-width: 700px) {
        .imgsConteiners{
            max-width: 100%;
            display: block;
            margin: auto;
    }
    .imagemZoom{ width: 300px;}
}
</style>
    
    <div class="imgsConteiners" >
        <div class="container">
            <img class="imagemZoom" id="imagemModeloCantoDireito" >
            <div class="zoom-lupa"></div>
        </div>

        <div class="container">
            <img class="imagemZoom" id="imagemModeloCantoEsquerdo" >
            <div class="zoom-lupa"></div>
        </div>
    </div>

 
     <select style="margin:5px ;" class="form-control"  name="busca_cadastro" id="busca_cadastro">
        <option value="" disabled selected>Selecione um modelo salvo</option>
            <optgroup label="Arma">
            @foreach($armas as $arma)
              
           
                @if($arma->tipo_arma==$nomeArma)
                        <option value="{{$arma}}">{{$arma->tipo_arma}} {{$arma->marca->nome}} {{$arma->modelo}}</option>
                @else
                @endif
            
            @endforeach;
        </optgroup>
    </select>
    <script src="{{asset('js/imagemModelo.js')}}"></script>
    