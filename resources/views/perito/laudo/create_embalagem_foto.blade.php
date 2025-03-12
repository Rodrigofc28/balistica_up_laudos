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
        right: 15%;
      width: 300px;
      height: 300px;
      overflow: hidden;
      
      margin-top: 10px;
      position: absolute;
    }
    .btnNext{
      border-radius:5px;
      padding:1%;
      color:#e7dbdb;
      text-decoration:underline ;
      background-color:rgb(255, 253, 253);
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
            <button class="btnNext" id="retanguloPlusBtn"  ><img style="width: 50px" src="{{ asset('image/retangulo5.png') }}" alt="dimensional"> </button>
            
            <button class="btnNext" id="retanguloBtn" ><img style="width: 50px" src="{{ asset('image/retangulo.png') }}" alt="dimensional"> </button>
            <button class="btnNext"   id="quadradoBtn"  ><img style="width: 50px" src="{{ asset('image/quadrado.png') }}" alt="dimensional"> </button>
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
    
    <form class="uploadForm" action="{{ route('embalagem') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <input type="text" hidden name="laudo_id" value="{{ $laudo_id }}">
        <input type="hidden" id="status" name="status">
        <input hidden type="file" required name="fotoEmbalagem[]"  accept=".jpg,.png,.jpeg" id="upImage">
        <input hidden type="file" required name="fotoEmbalagem[]" accept=".jpg,.png,.jpeg" id="upImage2">
        <!-- Botão de Envio -->
        <button type="button" onclick="cadastrar('upImage', 'upImage2')" class="btn btn-light btn-block embalagemFoto">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                <path d="M8 0q-.264 0-.523.017l.064.998a7 7 0 0 1 .918 0l.064-.998A8 8 0 0 0 8 0M6.44.152q-.52.104-1.012.27l.321.948q.43-.147.884-.237L6.44.153zm4.132.271a8 8 0 0 0-1.011-.27l-.194.98q.453.09.884.237zm1.873.925a8 8 0 0 0-.906-.524l-.443.896q.413.205.793.459zM4.46.824q-.471.233-.905.524l.556.83a7 7 0 0 1 .793-.458zM2.725 1.985q-.394.346-.74.74l.752.66q.303-.345.648-.648zm11.29.74a8 8 0 0 0-.74-.74l-.66.752q.346.303.648.648zm1.161 1.735a8 8 0 0 0-.524-.905l-.83.556q.254.38.458.793l.896-.443zM1.348 3.555q-.292.433-.524.906l.896.443q.205-.413.459-.793zM.423 5.428a8 8 0 0 0-.27 1.011l.98.194q.09-.453.237-.884zM15.848 6.44a8 8 0 0 0-.27-1.012l-.948.321q.147.43.237.884zM.017 7.477a8 8 0 0 0 0 1.046l.998-.064a7 7 0 0 1 0-.918zM16 8a8 8 0 0 0-.017-.523l-.998.064a7 7 0 0 1 0 .918l.998.064A8 8 0 0 0 16 8M.152 9.56q.104.52.27 1.012l.948-.321a7 7 0 0 1-.237-.884l-.98.194zm15.425 1.012q.168-.493.27-1.011l-.98-.194q-.09.453-.237.884zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a7 7 0 0 1-.458-.793zm13.828.905q.292-.434.524-.906l-.896-.443q-.205.413-.459.793zm-12.667.83q.346.394.74.74l.66-.752a7 7 0 0 1-.648-.648zm11.29.74q.394-.346.74-.74l-.752-.66q-.302.346-.648.648zm-1.735 1.161q.471-.233.905-.524l-.556-.83a7 7 0 0 1-.793.458zm-7.985-.524q.434.292.906.524l.443-.896a7 7 0 0 1-.793-.459zm1.873.925q.493.168 1.011.27l.194-.98a7 7 0 0 1-.884-.237zm4.132.271a8 8 0 0 0 1.012-.27l-.321-.948a7 7 0 0 1-.884.237l.194.98zm-2.083.135a8 8 0 0 0 1.046 0l-.064-.998a7 7 0 0 1-.918 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
              </svg>
            Adicionar embalagem extra
        </button>
        
        <button type="button" onclick="salvaContinuar('upImage', 'upImage2')" class="btn btn-success btn-block embalagemFoto">
            <svg class="svg-inline--fa fa-save fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="save" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M433.941 129.941l-83.882-83.882A48 48 0 0 0 316.118 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V163.882a48 48 0 0 0-14.059-33.941zM224 416c-35.346 0-64-28.654-64-64 0-35.346 28.654-64 64-64s64 28.654 64 64c0 35.346-28.654 64-64 64zm96-304.52V212c0 6.627-5.373 12-12 12H76c-6.627 0-12-5.373-12-12V108c0-6.627 5.373-12 12-12h228.52c3.183 0 6.235 1.264 8.485 3.515l3.48 3.48A11.996 11.996 0 0 1 320 111.48z"></path></svg>
            Salva e continua
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
            let scale = 2;
            let cropper;
            carrega(inputFile,image,cropper,preview,upImage,rotateButton,prevFrente,scale)
        
       
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
            let scale = 2;
            let cropper;
            carrega(inputFile,image,cropper,preview1,upImage,rotateButton,preVerso,scale)
        
       
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
                document.getElementById('status').value = 'cadastrar';
                document.querySelector('.uploadForm').submit();
            }
        }
        function cadastrar(imagem1, imagem2) {
            const img1 = document.getElementById(imagem1);
            const img2 = document.getElementById(imagem2);
            const fileimg = img1.files[0];
            const fileimg2 = img2.files[0];

            
            if (!fileimg || !fileimg2) {
             
               document.querySelector('.msgErro').style.display = 'block';
            } else {
                document.querySelector('.msgErro').style.display = 'none';
                document.getElementById('status').value = 'adicionar';
                document.querySelector('.uploadForm').submit();
            }
        }
        
       
</script>
@endsection