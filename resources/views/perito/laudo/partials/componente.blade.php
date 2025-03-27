@if(session('msgerror'))

<p class="msg" style="color:red;text-align:center" >{{session('msgerror')}}</p>
@endif



@if(session('msg')||session('msgerror'))

<p class="msg" style="color:green;text-align:center" >{{session('msg')}}</p>
@endif




@foreach ($componentes as $componente)

    <tr align="center">
        <td> {{ mb_strtoupper($componente->componente) }} </td>
        <td>{{ isset($componente->marca->nome) ? $componente->marca->nome : '' }}</td>


        <td>{{isset($componente->getCalibreProjetilAttribute()->nome)}}</td>
        <td> {{ $componente->quantidade_frascos }}
             </td>
             <td>{{$componente->lacreSaida}}</td>
        <td>{{$componente->lacrecartucho}}</td>
        <td>
        

       
        </button>
            <a class="btn btn-primary"
               href="{{ route('componentes.edit', [$laudo, $componente]) }}">
                <i class="far fa-edit"></i>
            </a>
            <button value="{{ route('componentes.destroy', [$laudo, $componente]) }}" type="submit" class="btn btn-danger delete">
                <i class="far fa-trash-alt"></i>
            </button>
        </td>
        
    </tr>
@endforeach
