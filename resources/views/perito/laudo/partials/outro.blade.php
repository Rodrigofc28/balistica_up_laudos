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
        <button  class="btn btn-danger delete" value="{{ route('outrosmodelos.delete', $outro->id) }}">
            <svg class="svg-inline--fa fa-trash fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg><!-- <i class="fa fa-fw fa-trash"></i> -->
            Deletar
        </button>
    </td>
    
</tr>


@endforeach
@include('perito.modals.upload')