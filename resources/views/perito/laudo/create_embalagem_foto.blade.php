@extends('layout.component')
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
    
    #image, #image1{
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
      border: 1px solid #ddd;
      margin-top: 10px;
    }
    .btnNext{
      border-radius:5px;
      padding:1%;
      color:#ffff;
      text-decoration:underline ;
      background-color:rgb(167, 162, 162);
    }
    .posicao{
        text-decoration: underline;

    }
</style>
@section('page')


  
    
 <div class="conteinerImagemRecebida">
    <div>
        <h4 class="titulo">IMAGENS DA EMBALAGEM </h4>
       
        <input style="display: none"  type="file" id="inputFile" accept="image/*">
        <input style="display:none"  type="file" id="inputFile1" accept="image/*">
        
       <div id="cont_frente">
            <b class="posicao">FRENTE</b>
            <div class="preview" hidden id="preview"></div>
            <div style="display:flex">
                
                <div class="preview" id="preview"></div>
                <div class="conteinerImg">
                    <img id="image" >
                </div>
            </div>
            <button class="btnNext" onclick="next('seta_frente')" id="seta_frente"><img style="width: 20px" src="{{ asset('image/add-image.png') }}" alt="adiciona foto"></button>
            <button class="btnNext"  id="rotateButton"><img style="width: 20px" src="{{ asset('image/rotate.png') }}" alt="rotacionar"> </button>
            <img style="width:30px" src="{{asset('image/scroll.png')}}" alt="zoom"><b>ZOOM</b> 
       </div> 
       <hr>
        <div  id="cont_tras">
            <b class="posicao">VERSO</b>
            <div class="preview" hidden id="prev"></div>
            <div style="display:flex">
                <div class="preview" id="prev"></div>
                <div class="conteinerImg">
                    <img id="image1" >
                </div>
            </div>
            <button class="btnNext"  onclick="next('seta_verso')"  id="seta_verso"><img style="width: 20px" src="{{ asset('image/add-image.png') }}" alt="adiciona foto"></button>
            <button class="btnNext"  id="rotateButton1"><img style="width: 20px" src="{{ asset('image/rotate.png') }}" alt="rotacionar"> </button>
            <img style="width:30px" src="{{asset('image/scroll.png')}}" alt="zoom"><b>ZOOM</b>
            
        </div>

       
    
    </div>   
    <form id="uploadForm" action="{{ route('embalagem') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        
        <input type="text" hidden name="laudo_id" value="{{ $laudo_id }}">

        <!-- Foto Frente -->
        
    
        <input hidden type="file" required name="fotoEmbalagem[]" accept=".jpg,.png,.jpeg" id="upImage">
        <input hidden type="file" required name="fotoEmbalagem[]" accept=".jpg,.png,.jpeg" id="upImage2">
        <!-- Botão de Envio -->
        <button type="button" onclick="salvaContinuar('upImage', 'upImage2')" class="btn btn-success btn-block embalagemFoto">
            <svg class="svg-inline--fa fa-save fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="save" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M433.941 129.941l-83.882-83.882A48 48 0 0 0 316.118 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V163.882a48 48 0 0 0-14.059-33.941zM224 416c-35.346 0-64-28.654-64-64 0-35.346 28.654-64 64-64s64 28.654 64 64c0 35.346-28.654 64-64 64zm96-304.52V212c0 6.627-5.373 12-12 12H76c-6.627 0-12-5.373-12-12V108c0-6.627 5.373-12 12-12h228.52c3.183 0 6.235 1.264 8.485 3.515l3.48 3.48A11.996 11.996 0 0 1 320 111.48z"></path></svg>
            SALVA E CONTINUA
        </button>
    </form>

    <span class="msgErro" style="display: none;">Adicione as duas imagens (FRENTE e VERSO) para salvar e continuar</span>
    
</div>
<!--cropper js-->
<script src="./js/redimensionando_foto.js"></script>
<script>
    //Frente Embalagens
    function click_input_file(file_input) {
            
            document.getElementById(file_input).click();
            let inputFile = document.getElementById('inputFile');
            let image = document.getElementById('image');
            let preview = document.getElementById('preview');
            let upImage = document.getElementById('upImage'); // Seu input de arquivo
            let prevFrente = "#preview"
            let rotateButton = document.getElementById('rotateButton');
            let cropper;
            carrega(inputFile,image,cropper,preview,upImage,rotateButton,prevFrente)
        
       
    }
    //Verso Embalagens
    function click_input_file1(file_input) {
            
            document.getElementById(file_input).click();
            let inputFile = document.getElementById('inputFile1');
            let image = document.getElementById('image1');
            let preview1 = document.getElementById('prev');
            let preVerso = "#prev"
            let upImage = document.getElementById('upImage2'); // Seu input de arquivo
            let rotateButton = document.getElementById('rotateButton1');
            let cropper;
            carrega(inputFile,image,cropper,preview1,upImage,rotateButton,preVerso)
        
       
    }
     function next(arg){
        if(arg=="seta_verso"){
            
            click_input_file1('inputFile1')
        }else if((arg=="seta_frente")){
            
            click_input_file('inputFile')
        }
          
    }
    function salvaContinuar(imagem1, imagem2) {
            const img1 = document.getElementById(imagem1);
            const img2 = document.getElementById(imagem2);
            const fileimg = img1.files[0];
            const fileimg2 = img2.files[0];

            
            if (!fileimg || !fileimg2) {
             
               document.querySelector('.msgErro').style.display = 'block';
            } else {
                document.querySelector('.msgErro').style.display = 'none';
                
                document.getElementById('uploadForm').submit();
            }
        }
</script>
@endsection