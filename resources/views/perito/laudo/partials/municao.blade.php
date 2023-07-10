
@if(session('msgerror'))

<p class="msg" style="color:red;text-align:center" >{{session('msgerror')}}</p>
@endif



@if(session('msg')||session('msgerror'))

<p class="msg" style="color:green;text-align:center" >{{session('msg')}}</p>
@endif

<div  style="border:solid 1px #E0E0E0; ">

    @php
        $colecoes=[];
    @endphp  
    @foreach ($objMuni as $obj_img)
        @php
            
                $numero = preg_replace('/^(\d+),\d+$/', '$1', $obj_img->{'group_concat(id)'});
                array_push($colecoes,$numero);
                if(!empty($obj_img->lacrecartucho)){
                    $mensagemImage="ENTRADA $obj_img->lacrecartucho";
                }else{
                    $mensagemImage="SAIDA $obj_img->lacre_saida";
                }
        @endphp
        
            <h4><strong style="padding:10px;  ">{{mb_strtoupper($obj_img->tipo_municao)}} </strong> </h4>
            
            <p style="padding-left:1%" > LACRE {{$mensagemImage}} </p>
        
        
            <form action="{{route('imagens')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    <input type="text" value="{{$numero}}" hidden name="municao_id">
                    <div class="input-group mb-2">
                        <button style="border:solid 0px;">BASE</button>
                        <button type="submit" style="border:solid 0px;background:#007bff;color:white" >ENVIAR</button>
                        <input type="file" class="form-control" id="inputGroupFile01"name="image[]" multiple="multiple"id="" accept=".jpg, .jpeg, .png">
                        
                    </div>
                    <div class="input-group mb-2">
                        <button style="border:solid 0px;">LATERAL</button>
                        <button type="submit" style="border:solid 0px;background:#007bff;color:white" >ENVIAR</button>
                        <input type="file" class="form-control" id="inputGroupFile01"name="image[]" multiple="multiple"id="" accept=".jpg, .jpeg, .png">
                        
                    </div>

            </form>
            
            <hr> 
        
    @endforeach
    @foreach($municoes as $municao)
        @foreach($colecoes as $colecao )
            @if(isset($municao->imagens[0]->nome))
                @if($colecao==$municao->id)
                    <div style="background-color:#cad6ca">
                        <img src="{{asset('../public/storage/imagensMunicao/'.$municao->imagens[0]->nome)}}" style="width:100px;height:100px;padding:10px"alt="">
                        <strong><a href="{{route('imagemCartuchoExcluir',$municao->imagens[0])}}" style="color:white">EXCLUIR IMAGEM</a></strong>
                        <span><strong>{{$municao->lacrecartucho==''?$municao->lacre_saida:$municao->lacrecartucho}}</strong></span>
                    </div>
                    @if(!empty($municao->imagens[1]->nome))
                        <div style="background-color:#cad6ca">
                            <img src="{{asset('../public/storage/imagensMunicao/'.$municao->imagens[1]->nome)}}" style="width:100px;height:100px;padding:10px"alt="">
                            <strong><a href="{{route('imagemCartuchoExcluir',$municao->imagens[1])}}" style="color:white">EXCLUIR IMAGEM</a></strong>
                            <span><strong>{{$municao->lacrecartucho==''?$municao->lacre_saida:$municao->lacrecartucho}}</strong></span>
                        </div>
                    @endif
                @endif
            @endif
        @endforeach
    @endforeach

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