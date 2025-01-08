
@if(session('msgerror'))

<p class="msg" style="color:red;text-align:center" >{{session('msgerror')}}</p>
@endif



@if(session('msg')||session('msgerror'))

<p class="msg" style="color:green;text-align:center" >{{session('msg')}}</p>
@endif

<div  style="border:solid 1px #E0E0E0; ">

</div>
@foreach ($municoes as $municao)

<tr align="center">
    <td> {{ mb_strtoupper($municao->tipo_municao) }} </td>
    <td> {{ $municao->marca->nome ?? '' }} </td>
    <td> {{ $municao->calibre->nome ?? '' }} </td>
    <td> {{ $municao->quantidade }} (Unidades)</td>
    
    <td>{{ $municao->lacrecartucho }}</td>
    <td>
       
        <a class="btn btn-primary" href="{{ route('municoes.edit', [$laudo, $municao]) }}">
            <i class="far fa-edit"></i>
        </a>
        
        <button value="{{ route('municoes.destroy', [$laudo, $municao]) }}" type="submit" class="btn btn-danger delete">
            <i class="far fa-trash-alt"></i>
        </button>
        
    </td>
    
</tr>
@endforeach