

@foreach ($armas as $arma)

<tr>
    <td> {{ mb_strtoupper($arma->tipo_arma) }} </td>
    <td> {{ isset($arma->marca->nome) ? $arma->marca->nome : '' }} </td>
    <td> {{isset($arma->calibre->nome) ? $arma->calibre->nome : ""}} </td>
    <td>1</td>
    <td> {{ $arma->num_lacre_saida }} </td>{{-- No banco o lacre de entrada ta invertido sendo ele  num_lacre_saida--}}
    <td> {{ $arma->num_lacre }} </td>

    <td>
        <!-- <button value="{{ $arma->id }}" type="button" class="btn btn-success addImagem">
            <i class="fas fa-camera"></i>
        </button> -->
        <a class="btn btn-primary" href="{{ route(armas_route_name($arma->tipo_arma).'.edit', [$laudo, $arma]) }}">
            <i class="far fa-edit"></i>
        </a>
        
        <button value="{{ route('armas.destroy', [$laudo, $arma]) }}" type="submit" class="btn btn-danger delete">
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
    
</tr>


@endforeach
@include('perito.modals.upload')