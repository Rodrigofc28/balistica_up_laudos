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
    
    #imageBase, #imageLateral {
      display: none; /* Oculta a imagem até o upload */
      max-width: 30%;
      
    }
    .conteinerImg{
        margin-left: 15%;
        width: 30%;
        padding: 5%;
    }
    .preview {
      width: 300px;
      height: 300px;
      overflow: hidden;
      
      margin-top: 10px;
      position: absolute;
      right: 15%;
    }
    .btnNext{
      border-radius:5px;
      padding:1%;
      color:#474444;
      text-decoration:underline ;
      background-color:rgb(248, 247, 247);
    }
    .posicao{
        text-decoration: underline;

    }
</style>

<div class="conteinerImagemRecebida">
<div>
    <h4 class="titulo">IMAGENS {{$tipo}} </h4>
    <input style="display: none"   type="file" name="up_image2" accept=".jpg,.png,.jpeg" id="up_image2">
    <input style="display: none"   type="file" name="up_image" accept=".jpg,.png,.jpeg" id="up_image">
    <input style="display: none"  type="file" id="inputFileBase" accept="image/*">
    <input style="display:none"  type="file" id="inputFileLateral" accept="image/*">
    
   <div id="cont_frente">
        <b class="posicao">FOTO DA BASE</b>
        <div class="preview" hidden id="previewBase"></div>
        <div style="display:flex">
            
            <div class="preview" id="previewBase"></div>
            <div class="conteinerImg">
                <img id="imageBase" >
            </div>
        </div>
        <button type="button" class="btnNext" id="retanguloPlusBase"  >4:3</button>
        <button type="button" class="btnNext" id="retanguloBase" >16:9</button>
        <button type="button" class="btnNext"   id="quadradoBase"  >1:1</button>
        <button type="button" class="btnNext" onclick="nextButton('base')" id="base"><img style="width: 20px" src="{{ asset('image/add-image.png') }}" alt="adiciona foto"></button>
        <button type="button" class="btnNext"  id="rotateButtonbase"><img style="width: 20px" src="{{ asset('image/rotate.png') }}" alt="rotacionar"> </button>
        <img style="width:30px" src="{{asset('image/scroll.png')}}" alt="zoom"><b>ZOOM</b> 
   </div> 
   <hr>
    <div  id="cont_tras">
        <b class="posicao">FOTO DA LATERAL</b>
        <div class="preview" hidden id="previewLateral"></div>
        <div style="display:flex">
            <div class="preview" id="previewLateral"></div>
            <div class="conteinerImg">
                <img id="imageLateral" >
            </div>
        </div>
        <button type="button" class="btnNext" id="retanguloPlusLateral"  >4:3</button>
        <button type="button" class="btnNext" id="retanguloLateral" >16:9</button>
        <button type="button" class="btnNext"   id="quadradoLateral"  >1:1</button>
        <button type="button" class="btnNext"  onclick="nextButton('lateral')"  id="lateral"><img style="width: 20px" src="{{ asset('image/add-image.png') }}" alt="adiciona foto"></button>
        <button type="button" class="btnNext"  id="rotateButtonLateral"><img style="width: 20px" src="{{ asset('image/rotate.png') }}" alt="rotacionar"> </button>
        <img style="width:30px" src="{{asset('image/scroll.png')}}" alt="zoom"><b>ZOOM</b>
        
    </div>

</div>   

</div>   

