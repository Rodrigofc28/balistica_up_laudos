@if(session('msgerror'))

<p class="msg" style="color:red;text-align:center" >{{session('msgerror')}}</p>
@endif



@if(session('msg')||session('msgerror'))

<p class="msg" style="color:green;text-align:center" >{{session('msg')}}</p>
@endif


<div  style="border:solid 1px #E0E0E0; ">
<h4><strong style="padding:10px;  ">PROJÉTIL</strong>  </h4>
  @php
  $colecoes=[];
  @endphp  
    @foreach ($obj as $obj_img)
    <p style="padding-left:1%" > LACRE {{$obj_img->lacrecartucho==""?'SAIDA '.$obj_img->lacreSaida:'ENTRADA '.$obj_img->lacrecartucho}}</p>
@php
    
    $numero = preg_replace('/^(\d+),\d+$/', '$1', $obj_img->{'group_concat(id)'});
    array_push($colecoes,$numero);
@endphp
    <form action="{{route('imagensProjetil')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <input type="text" value="{{$numero}}" hidden name="projetil_id">
                <input type="file" style="padding-left:1%"  name="image[]" multiple="multiple" id="" accept=".jpg, .jpeg, .png">
                <button type="submit" style="border:solid 0px;background:#007bff;color:white">enviar</button>
            </form>
        
      <hr>      
    @endforeach
    @foreach($componentes as $componente)
        @foreach($colecoes as $colecao )
            @if(isset($componente->imagensProjetil[0]->nome))
                @if($colecao==$componente->id)
                    <div style="background-color:#cad6ca">
                        <img src="{{asset('../public/storage/imagensProjetil/'.$componente->imagensProjetil[0]->nome)}}" style="width:100px;height:100px;padding:10px"alt="">
                        <a href="{{route('imagemProjetilExcluir',$componente->imagensProjetil[0])}}" style="color:white"><strong>EXCLUIR IMAGEM</strong></a>
                        <span><strong>{{$componente->lacrecartucho}}</strong></span>
                     </div>
                @endif
            @endif
        @endforeach
    @endforeach

</div>



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
