
<style>
    .titulo{
        background-color: #949494;
        padding:10px;
        color: #ddd;
    }
    .conteinerImagemRecebida{
        border:solid 1px #E0E0E0;
        text-align: center;
        padding: 4%;
    }
    .msgErro{
        color:#E0E0E0;
        background-color: rgb(182, 187, 190);
        padding: 4px;
        border-radius: 3px;
        display: none
    }
    
    .image {
      display: none; /* Oculta a imagem até o upload */
      max-width: 50%;
      
      
    }
    .conteinerImg{
        margin-left: 15%;
        width: 30%;
        padding: 5%;
        
        position: relative;
    }
    .preview {
      right: 15%;
      width: 300px;
      height: 300px;
      overflow: hidden;
      
      
      position: absolute;
    }
    .btnNext{
      border-radius:5px;
      padding:1%;
      color:#ffff;
      text-decoration:underline ;
      background-color:rgb(250, 249, 249);
    }
    .posicao{
        text-decoration: underline;

    }
</style>
<div class="conteinerImagemRecebida">
    <div>
        
       <h2 class="titulo">IMAGENS</h2>
        <input style="display: none" type="file" id="inputFileDir" accept="image/*">
        <input style="display:none"  type="file" id="inputFileEsq" accept="image/*">
        <input style="display:none"  type="file" id="inputFileSerie" accept="image/*">
        <input hidden type="file"   name="imagemCantoSuperior" id="imagemCantoSuperior">
        <input hidden type="file"  name="imagemCantoInferior" id="imagemCantoInferior">
        <input hidden type="file"  name="imagemNumSerie" id="imagemNumSerie">

       <div id="cont_lat_dir">
            <b class="posicao">Vista lateral direita</b>
            <div class="preview" hidden id="preview_dir"></div>
            <div style="display:block">
                
                <div class="preview" id="preview_dir"></div>
                <div class="conteinerImg">
                    <img class="image" id="image_dir" >
                </div>
            </div>
            <button type="button" class="btnNext" onclick="nextButton('dir')" id="dir"><img style="width: 20px" src="{{ asset('image/add-image.png') }}" alt="adiciona foto"></button>
            <button type="button" class="btnNext"  id="rotateButtonDir"><img style="width: 20px" src="{{ asset('image/rotate.png') }}" alt="rotacionar"> </button>
            <img style="width:30px" src="{{asset('image/scroll.png')}}" alt="zoom"><b>ZOOM</b> 
       </div> 
       <hr>
        <div  id="cont_lat_esq">
            <b class="posicao">Vista lateral esquerda</b>
            <div class="preview" hidden id="preview_esq"></div>
            <div style="display:flex">
                <div class="preview" id="preview_esq"></div>
                <div class="conteinerImg">
                    <img class="image" id="image_esq" >
                </div>
            </div>
            <button type="button" class="btnNext"  onclick="nextButton('esq')"  id="esq"><img style="width: 20px" src="{{ asset('image/add-image.png') }}" alt="adiciona foto"></button>
            <button type="button" class="btnNext"  id="rotateButtonEsq"><img style="width: 20px" src="{{ asset('image/rotate.png') }}" alt="rotacionar"> </button>
            <img style="width:30px" src="{{asset('image/scroll.png')}}" alt="zoom"><b>ZOOM</b>
            
        </div>
        <hr>
        <div  id="cont_num_ser">
            <b class="posicao">Número de série</b>
            <div class="preview" hidden id="preview_serie"></div>
            <div style="display:flex">
                <div class="preview" id="preview_serie"></div>
                <div class="conteinerImg">
                    <img class="image" id="image_serie" >
                </div>
            </div>
            <button class="btnNext" type="button"  onclick="nextButton('serie')"  id="serie"><img style="width: 20px" src="{{ asset('image/add-image.png') }}" alt="adiciona foto"></button>
            <button class="btnNext" type="button" id="rotateButtonSerie"><img style="width: 20px" src="{{ asset('image/rotate.png') }}" alt="rotacionar"> </button>
            <img style="width:30px" src="{{asset('image/scroll.png')}}" alt="zoom"><b>ZOOM</b>
            
        </div>
    </div> 
    <script src="{{asset('js/redimensionando_foto.js')}}"></script>
    <script src="{{asset('js/sessionArmImg.js')}}"></script>
    </div>   
