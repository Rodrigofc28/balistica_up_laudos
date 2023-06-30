@extends('layout.component')
@section('js')
{!! Html::script('js/filtrar_solicitantes.js') !!}
{!! Html::script('js/calendar.js') !!}
{!! Html::script('js/cropper.js') !!}
{!! Html::script('js/dropzone.js') !!}
{!! Html::script('js/dropzone_config.js') !!}
{!! Html::script('js/cropper_image.js') !!}
{!! Html::script('js/edicaoimagem.js') !!}
{!! Html::script('js/edicaolaudo.js') !!}

@endsection
@section('page')


<div id="showLaudo" class="col-lg-12">
        <span><strong>REP:</strong> {{$laudo->rep}}</span><br>
        {{-- <input type="button" id="btn-edit" class="btn btn-success" value="Editar cabeçalho do Laudo">  --}}
</div>
      
{{-- <div class="col-lg-12" id="editarInformacoes">
    {!! Form::open(['route' => ['laudos.update', $laudo], 'method' => 'patch']) !!}

    <input type="hidden" value="{{$laudo->id}}" id="laudo_id" name="laudo_id">
    <div class="form-group row"> 
        
        
      

         @include('perito.laudo.attributes.rep', ['rep' => '' ?? old('rep')])
        @include('perito.laudo.attributes.oficio', ['oficio' => '' ?? old('oficio')])
        
        @include('perito.laudo.attributes.tipo_inquerito', ['tipo_inquerito2' => '' ??
        old('tipo_inquerito')])
        @include('perito.laudo.attributes.inquerito', ['inquerito' => '' ?? old('inquerito')])

        @include('shared.input_calendar', ['label' => 'Data da Solicitação',
        'name' => 'data_solicitacao', 'size' => '3', 'value' => ''])

        @include('shared.input_calendar', ['label' => 'Data da Designação',
        'name' => 'data_designacao', 'size' => '3', 'value' => ''])
        @include('shared.input_calendar', ['label' => 'Data da ocorrência', 'name' => 'data_ocorrencia', 'size' => '3',
    'value' => ''])
    @include('shared.input_calendar', ['label' => 'Data do recebimento', 'name' => 'data_recebimento', 'size' => '3',
    'value' => ''])

        <input class="form-control" type="hidden" name="perito_id" autocomplete="off" value="{{ Auth::id() }}" />
        @include('shared.attributes.secao', ['secao2' => '' ?? old('secao_id')])
        @include('shared.attributes.cidades', ['id' => 'cidade_id', 'size' => '4', 'cidade2' => '$laudo->cidade_id '??
        old('cidade_id')])
        

        @include('perito.laudo.attributes.solicitante', ['solicitante2' => $laudo->solicitante_id ??
        old('solicitante_id')])
        @include('perito.laudo.attributes.boletim_ocorrencia',['boletim2'=>''??old('boletim')])
       
         
        
        
        <div class="col-lg-3 mt-auto">
            <button type="submit" id="salvar" class="btn btn-primary mt-2">
                <i class="far fa-save" aria-hidden="true"></i>
                Editar Informações
            </button>
        </div>
        {{ Form::close() }} 
    </div>
</div>

<hr> --}}

<div class="col-lg-12">
    
    {{-- IMAGENS EMBALAGENS --}}
    <div style="border:solid 1px #E0E0E0; ">
    
        <form action="{{route('embalagem')}}" method="post"  enctype="multipart/form-data">
        {{ csrf_field() }}
            
       
            <h4 style="color:#fff;background-color:rgb(19, 19, 18);text-align:center"><strong style="padding:10px "> ADICIONAR IMAGENS DA EMBALAGEM RECEBIDA </strong> </h4>
            <input type="text" hidden name="laudo_id" value="{{$laudo->id}}">
            <div class="input-group mb-2">
                <button style="border:solid 0px;">FRENTE</button>
                <button type="submit" style="border:solid 0px;background:#007bff;color:white" >ENVIAR </button>
                
                <input type="file" class="form-control" id="inputGroupFile01"name="fotoEmbalagem[]" multiple="multiple"id="" accept=".jpg, .jpeg, .png">
                
            </div>
            <div class="input-group mb-2">
                <button style="border:solid 0px;">VERSO</button>
                <button type="submit" style="border:solid 0px;background:#007bff;color:white" >ENVIAR</button>
                <input type="file" class="form-control" id="inputGroupFile01"name="fotoEmbalagem[]" multiple="multiple"id="" accept=".jpg, .jpeg, .png">
                
            </div>
            
           
        </form>
    
        <hr>
        @if(count($laudo->imagens)>0)
            <div style="background-color: #565956">
                <button id="btnAumentarImg" style="border: 2px solid white" class="btn btn-primary" >+</button>
                <button id="btnDiminuirImg" style="border: 2px solid white" class="btn btn-primary" >-</button>
            </div>
        @endif
        <div id="imageHideShow">
        
        
                @if(isset($laudo->imagens[0]->nome))
            
            
                    
                    @php
                    
                        for ($i = 0; $i < count($laudo->imagens); $i++) {
                            echo '<div style="background-color:#7e827e">    
                                <img src="' . asset('../public/storage/imagensEmbalagem/' . $laudo->imagens[$i]->nome) . '" style="width:100px;height:100px;padding:10px" alt="">
                                <strong><a href="' . route('imagemExcluir', $laudo->imagens[$i]) . '" style="color:white">EXCLUIR IMAGEM</a></strong>
                                </div>';
                        }
                    @endphp
                @endif
        </div>
 
    </div>
    {{-- IMAGENS CARTUCHOS E ESTOJOS --}}
    <div  style="border:solid 1px #E0E0E0;max-width:100% ">

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
            
                <h6><strong style="padding:10px;background-color:rgb(113, 109, 109);color:#fff  ">IMAGEM {{mb_strtoupper($obj_img->tipo_municao)}} </strong> </h6>
                
                <p style="padding-left:1%" > LACRE {{$mensagemImage}} </p>
            
            
                <form action="{{route('imagens')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="input-group mb-2">
                            <input type="text" value="{{$numero}}" hidden name="municao_id">
                            <button type="submit" style="border:solid 0px;background:#007bff;color:white">ENVIAR</button>
                            <input type="file" class="form-control" style="padding-left:1%" name="image[]" multiple="multiple" id="inputGroupFile01" accept=".jpg, .jpeg, .png">
                            
                            
                        </div>
                        
                </form>
            
                <hr> 
            
        @endforeach
        @foreach($municoes as $municao)
            @foreach($colecoes as $colecao )
                @if(isset($municao->imagens[0]->nome))
                    @if($colecao==$municao->id)
                        <div style="background-color:#909690">
                            <img src="{{asset('../public/storage/imagensMunicao/'.$municao->imagens[0]->nome)}}" style="width:100px;height:100px;padding:10px"alt="">
                            <strong><a href="{{route('imagemCartuchoExcluir',$municao->imagens[0])}}" style="color:white">EXCLUIR IMAGEM</a></strong>
                            <span><strong>{{$municao->lacrecartucho==''?$municao->lacre_saida:$municao->lacrecartucho}}</strong></span>
                        </div>
                    @endif
                @endif
            @endforeach
        @endforeach
    
    </div>
    {{-- IMAGENS PROJETIL --}}
    <div  style="border:solid 1px #E0E0E0; ">
            
        
        
          @php
          $colecoes=[];
          @endphp  
            @foreach ($obj as $obj_img)
            <h4><strong style="padding:10px;background-color:rgb(113, 109, 109);color:#fff ">IMAGEM PROJÉTIL</strong>  </h4>
            <p style="padding-left:1%" > LACRE {{$obj_img->lacrecartucho==""?'SAIDA '.$obj_img->lacreSaida:'ENTRADA '.$obj_img->lacrecartucho}}</p>
        @php
            
            $numero = preg_replace('/^(\d+),\d+$/', '$1', $obj_img->{'group_concat(id)'});
            array_push($colecoes,$numero);
        @endphp
            <form action="{{route('imagensProjetil')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="input-group mb-2">
                            <input type="text" value="{{$numero}}" hidden name="projetil_id">
                            <button type="submit" style="border:solid 0px;background:#007bff;color:white">ENVIAR</button>
                            <input type="file" style="padding-left:1%" class="form-control"  name="image[]" multiple="multiple" id="inputGroupFile01" accept=".jpg, .jpeg, .png">
                            
                        </div>
                        
                        
            </form>
                
              <hr>      
            @endforeach
            @foreach($componentes as $componente)
                @foreach($colecoes as $colecao )
                    @if(isset($componente->imagensProjetil[0]->nome))
                        @if($colecao==$componente->id)
                            <div style="background-color:#797d79">
                                <img src="{{asset('../public/storage/imagensProjetil/'.$componente->imagensProjetil[0]->nome)}}" style="width:100px;height:100px;padding:10px"alt="">
                                <a href="{{route('imagemProjetilExcluir',$componente->imagensProjetil[0])}}" style="color:white"><strong>EXCLUIR IMAGEM</strong></a>
                                <span><strong>{{$componente->lacrecartucho}}</strong></span>
                             </div>
                        @endif
                    @endif
                @endforeach
            @endforeach
        
        </div>
        
    <p id="titulo"><strong>Peças</strong></p>
    @include('perito.laudo.materiais.attributes.lista_pecas_gdl')
    <div class="row mb-3">
        <div class="col-lg-3 mt-2">
            <a class="btn btn-secondary btn-block" href="{!! URL::previous() !!}">
                <i class="fas fa-arrow-circle-left"></i> Voltar</a>
        </div>

    <div class="col-lg-3 mt-2">
        <a class="btn btn-primary btn-block" href="{{ route('laudos.docx', $laudo )}}">
            <i class="fas fa-file-download" aria-hidden="true"></i>
            Gerar Laudo (.docx)
        </a>
    </div>
</div>
</div>
@include('perito.modals.solicitante_modal')
@endsection
        
        

    
