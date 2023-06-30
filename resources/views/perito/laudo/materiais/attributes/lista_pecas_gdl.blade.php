
       <section>
        @php
        $contadorDom=0;
        @endphp
        @foreach($armasGdl as $armagdl)
            <hr>
            <div style="background-color: rgb(194, 189, 179);padding:8px ">
                <div style="background-color: rgb(70, 70, 65);padding:8px" >
                                <button id="aumentar" class="btn btn-primary" style="border: 2px solid white" onclick="acaoBtnAumentar({{$contadorDom}})" >+</button>
                                <button id="diminuir" class="btn btn-primary" style="border: 2px solid white" onclick="acaoBtnDiminuir({{$contadorDom}})" >-</button>
                            
                                    
                                    @if($armagdl->status=="CADASTRAR")
                                    {{-- Cadastrar Arma --}}
                                        @switch($armagdl->tipo_item)
                                            @case('ESPINGARDA(S)')
                                                
                                                    <a class="btn btn-primary" style="border: 2px solid white"  href="{{ route("espingardas.create", [$laudo,'id'=>$armagdl->id,'armas'=>$armasGdl]) }}">EDITAR</a>
                                                        @break
                                            
                                            @case('REVÓLVER(ES)')
                                                    <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("revolveres.create", [$laudo,'id'=>$armagdl->id,'armas'=>$armasGdl]) }}">EDITAR</a>
                                                        @break
                                
                                            
                                            
                                            @case('PISTOLA(S)')
                                                    <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("pistolas.create", [$laudo,'id'=>$armagdl->id,'armas'=>$armasGdl]) }}">EDITAR</a>
                                                        @break
                            
                                            
                                            @case('CARTUCHO(S)')
                                                    <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("armas_curtas.create", [$laudo,'id'=>$armagdl->id,'armas'=>$armasGdl]) }}">EDITAR</a>
                                                        @break
                                                        
                                                
                                            @case('FUZIL(IS)')
                                                        <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("fuzils.create", [$laudo,'id'=>$armagdl->id,'armas'=>$armasGdl]) }}">EDITAR</a>
                                                            @break
                                    
                                                
                                                
                                            @case('GARRUCHA(S)')
                                                        <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("garruchas.create", [$laudo,'id'=>$armagdl->id,'armas'=>$armasGdl]) }}">EDITAR</a>
                                                            @break
                                
                                                
                                            @case('METRALHADORA(S)')
                                                        <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("metralhadoras.create", [$laudo,'id'=>$armagdl->id,'armas'=>$armasGdl]) }}">EDITAR</a>
                                                            @break
                                                        
                                            @case('SUBMETRALHADORA(S)')
                                                        <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("submetralhadoras.create", [$laudo,'id'=>$armagdl->id,'armas'=>$armasGdl]) }}">EDITAR</a>
                                                            @break
                                                            
                                            @case('PISTOLETE(S)')
                                                        <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("pistoletes.create", [$laudo,'id'=>$armagdl->id,'armas'=>$armasGdl]) }}">EDITAR</a>
                                                            @break
                                                        
                                            @case('PROJÉTEIS')
                                                        <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("balins_chumbo.create", [$laudo,'id'=>$armagdl->id,'armas'=>$armasGdl]) }}">EDITAR</a>
                                                            @break
                                                    {{--  --}}        
                                            @case('ESTOJO(S)')
                                                        <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("armas_curtas.create", [$laudo,'id'=>$armagdl->id,'armas'=>$armasGdl]) }}">EDITAR</a>
                                                            @break
                                                            
                                            @case('CARABINA(S)')
                                                        <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("carabinas.create", [$laudo,'id'=>$armagdl->id,'armas'=>$armasGdl]) }}">EDITAR</a>
                                                            @break

                                            @case('OUTROS')
                                                    <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("laudos.materiais", [$laudo,'id'=>$armagdl->id]) }}">EDITAR</a>
                                                        @break
                                            @default
                                <!-- Código a ser executado caso $valor não corresponda a nenhum dos casos anteriores -->
                                        @endswitch

                                    
                                    @endif
                                    @if($armagdl->status=="CADASTRADO")
                                    {{-- Editar Arma --}}
                                        @switch($armagdl->tipo_item)
                                            @case('ESPINGARDA(S)')
                                                
                                                    <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("edit_gdl_espingarda",[$laudo,$armagdl->id]) }}">EDITAR</a>
                                                        @break
                                            
                                            @case('REVÓLVER(ES)')
                                
                                                    <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("edit_gdl_revolver",[$laudo,$armagdl->id]) }}">EDITAR</a>
                                                @break

                                            @case('PISTOLA(S)')
                                                
                                                    <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("edit_gdl_pistola",[$laudo,$armagdl->id]) }}">EDITAR</a>
                                                @break
                                            @case('FUZIL(IS)')
                                                    <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("edit_gdl_fuzil", [$laudo,$armagdl->id]) }}">EDITAR</a>
                                                @break
                                            @case('GARRUCHA(S)')
                                                <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("edit_gdl_garrucha", [$laudo,$armagdl->id]) }}">EDITAR</a>
                                                @break
                                            @case('METRALHADORA(S)')
                                                <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("edit_gdl_metralhadora", [$laudo,$armagdl->id]) }}">EDITAR</a>
                                                @break
                                            @case('SUBMETRALHADORA(S)')
                                                <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("edit_gdl_submetralhadora", [$laudo,$armagdl->id]) }}">EDITAR</a>
                                                @break
                                            @case('PISTOLETE(S)')
                                                <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("edit_gdl_pistolete", [$laudo,$armagdl->id]) }}">EDITAR</a>
                                                @break

                                            @case('CARABINA(S)')
                                                <a class="btn btn-primary " style="border: 2px solid white" href="{{ route("edit_gdl_carabina", [$laudo,$armagdl->id]) }}">EDITAR</a>
                                                @break
                                            
                                            
                                            @default
                                <!-- Código a ser executado caso $valor não corresponda a nenhum dos casos anteriores -->
                                        @endswitch
                    
                    
                                    @endif
                                    <span style="color:rgb(14, 14, 14);background-color: rgb(194, 189, 179)">{{$armagdl->tipo_item}}</span>
                                    @if($armagdl->status=="CADASTRADO")  @else <span id="status_pecas" style="background-color:rgb(194, 189, 179);color:rgb(226, 44, 44)"  ><strong>STATUS: PENDENTE!</strong> </span>@endif
                                    
                    </div>
                    <hr>
                    <div id="group_pecas_gdl{{$contadorDom}}"   >
                    
                    <p><strong>MARCA:</strong> {{$armagdl->marca}}</p>
                    <p><strong>QUANTIDADE:</strong> {{$armagdl->quantidade}}</p>
                    <p><strong>OBSERVAÇÃO:</strong> {{$armagdl->observacao}}</p>
                    <p><strong>IDENTIFICAÇÃO:</strong> {{$armagdl->identificacao}}</p>
                    <p><strong>LACRE DE ENTRADA:</strong> {{$armagdl->lacre_entrada}}</p>
                  
                </div>
                @php
                $contadorDom++
                @endphp 
             
            </div>
         <hr>
        @endforeach
    </section> 