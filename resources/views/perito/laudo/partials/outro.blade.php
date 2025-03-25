@foreach ($outros as $outro)

<tr>
    <td> {{ mb_strtoupper('outros') }} </td>
    <td> {{ isset($outro->marca) ? $outro->marca : '' }} </td>
    <td> </td>
    <td>1</td>
    <td> {{ $outro->lacre_entrada }} </td>{{-- No banco o lacre de entrada ta invertido sendo ele  num_lacre_saida--}}
    <td> {{ $outro->lacre_saida }} </td>

    <td>
      {{--<a class="btn btn-primary" href="{{ route(armas_route_name($arma->tipo_arma).'.edit', [$laudo, $arma]) }}">
            <i class="far fa-edit"></i>
        </a>
        
        <button value="{{ route('armas.destroy', [$laudo, $arma]) }}" type="submit" class="btn btn-danger delete">
            <i class="far fa-trash-alt"></i>
        </button>--}}
        
    </td>
    
</tr>


@endforeach
@include('perito.modals.upload')