<label for="busca_cadastro" style="margin-left:15px ;"><strong>Buscar modelos salvos</strong></label>
     <select style="margin:5px ;" class="form-control" name="busca_cadastro" id="busca_cadastro">
            <option></option>
            
            @foreach($armas as $arma)
                @php
                
                        $teste=json_decode($arma->modelo);
                @endphp
            
                @if($teste->tipo_arma==$nomeArma)
                        <option value="{{$arma->modelo}}">{{$teste->marca->nome}} {{$teste->modelo}}</option>
                @else
                @endif
            
            @endforeach;
    </select>