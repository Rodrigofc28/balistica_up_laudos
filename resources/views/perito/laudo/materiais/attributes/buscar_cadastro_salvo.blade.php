<img style="width: 20%" id="imagemModeloCantoSuperior" src="" alt="">


     <select style="margin:5px ;" class="form-control" placeholder="fgdfg" name="busca_cadastro" id="busca_cadastro">
        <option value="" disabled selected>Selecione um modelo salvo</option>
            <optgroup label="Arma">
            @foreach($armas as $arma)
                @php
                
                        $teste=json_decode($arma->modelo);
                @endphp
            
                @if($teste->tipo_arma==$nomeArma)
                        <option value="{{$arma->modelo}}">{{$teste->marca->nome}} {{$teste->modelo}}</option>
                @else
                @endif
            
            @endforeach;
        </optgroup>
    </select>
