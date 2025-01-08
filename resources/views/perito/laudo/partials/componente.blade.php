@if(session('msgerror'))

<p class="msg" style="color:red;text-align:center" >{{session('msgerror')}}</p>
@endif



@if(session('msg')||session('msgerror'))

<p class="msg" style="color:green;text-align:center" >{{session('msg')}}</p>
@endif




@foreach ($componentes as $componente)

    <tr align="center">
        <td> {{ mb_strtoupper($componente->componente) }} </td>
        <td></td>
        <td>{{$componente->calibreNominal}}</td>
        <td> {{ $componente->quantidade_frascos }}
             </td>
        
        <td>{{$componente->lacrecartucho}}</td>
        <td>
        

       <!--  @if(count($componente->imagensProjetil) < 1 )
            <form action="{{route('imagensProjetil')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="text" value="{{$componente->id}}" hidden name="projetil_id">
                <input type="file" name="image[]" multiple="multiple" id="" accept=".jpg, .jpeg, .png">
                    <button type="submit" style="border:solid 0px;background:orange;color:white">enviar</button>
            </form>
        @endif -->
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
