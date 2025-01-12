@extends('layout.component')
<style>
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
    
    #image {
      display: none; /* Oculta a imagem até o upload */
      max-width: 30%;
    }
    .conteinerImg{
        width: 60%;
        padding: 5%;
    }
    .preview {
      width: 300px;
      height: 300px;
      overflow: hidden;
      border: 1px solid #ddd;
      margin-top: 10px;
    }
    
</style>
@section('page')


  
    
 <div class="conteinerImagemRecebida">
    <div>
        <h4><strong style="padding:10px">IMAGENS DA EMBALAGEM</strong> </h4>
       
        <input style="display:none" type="file" id="inputFile" accept="image/*">
       
        
       <div id="cont_frente">
            <b>FRENTE</b>
            <div class="preview" hidden id="preview"></div>
            <div style="display:flex">
                
                <div class="preview" id="preview"></div>
                <div class="conteinerImg">
                    <img id="image" alt="Imagem para crop">
                </div>
            </div>
       </div> 
       
        <div style="display:none" id="cont_tras">
            <b>VERSO</b>
            <div class="preview" hidden id="preview"></div>
            <div style="display:flex">
                <div class="preview" id="preview"></div>
                <div class="conteinerImg">
                    <img id="image" alt="Imagem para crop">
                </div>
            </div>
        </div>
        <div>
          <button id="frente" onclick="click_input_file('frente','inputFile')"  alt="adicionar"><img style="width: 50px" src="{{ asset('image/add-image.png') }}" alt="adiciona foto"></button>
          <button id="rotateButton"><img style="width: 50px" src="{{ asset('image/rotate.png') }}" alt="rotacionar"> </button>
          <button onclick="next('seta_frente')" id="seta_frente">FRENTE</button>
          <button onclick="next('seta_verso')" id="seta_verso">VERSO</button>
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
<script>
    function click_input_file(icon, file_input) {
        document.getElementById(icon).addEventListener('click', () => {
            document.getElementById(file_input).click();
        });
       
    }
   document.addEventListener('DOMContentLoaded', () => {
      const inputFile = document.getElementById('inputFile');
      const image = document.getElementById('image');
      const preview = document.getElementById('preview');
      const upImage = document.getElementById('upImage'); // Seu input de arquivo
      const upImage2 = document.getElementById('upImage2'); // Seu input de arquivo
      const rotateButton = document.getElementById('rotateButton');
      let cropper;

      inputFile.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file && file.type.startsWith('image/')) {
          const reader = new FileReader();

          reader.onload = () => {
            image.src = reader.result; // Define o src da imagem
            image.style.display = 'block'; // Exibe a imagem

            if (cropper) {
              cropper.destroy(); // Remove o cropper anterior, se existir
            }

            // Inicializa o Cropper.js
            cropper = new Cropper(image, {
              aspectRatio: 1, // Proporção do quadrado
              viewMode: 0, // Garante que a área visível esteja dentro dos limites
              autoCrop: true, // Habilita o crop box automaticamente
              autoCropArea: 0.8, // Define 80% da imagem como área inicial de corte
              movable: true, // Permite mover o crop box
              zoomable: true, // Permite dar zoom na imagem
              scalable: true, // Permite redimensionar
              highlight: true, // Destaca a área de corte
              guides: true, // Mostra as linhas-guia dentro do crop box
              background: true, // Exibe o fundo sombreado
              cropBoxResizable: true, // Permite redimensionar o crop box
              preview: '.preview', // Atualiza automaticamente a pré-visualização
              ready() {
                console.log('Cropper pronto!'); // Verifica quando o cropper está pronto
              },
              crop() {
                const canvas = cropper.getCroppedCanvas({
                  width: 200, // Largura do canvas
                  height: 200, // Altura do canvas
                });

                preview.innerHTML = ''; // Limpa a pré-visualização anterior
                const croppedImage = document.createElement('img');
                croppedImage.src = canvas.toDataURL(); // Converte o canvas para DataURL
                preview.appendChild(croppedImage); // Adiciona a nova imagem cortada
                canvas.toBlob((blob) => {
                const file = new File([blob], "cropped-image.png", { type: 'image/png' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file); // Adiciona o arquivo ao DataTransfer

                // Simula a seleção do arquivo
                upImage.files = dataTransfer.files;
                }, 'image/png');
                canvas.toBlob((blob) => {
                const file = new File([blob], "cropped-image2.png", { type: 'image/png' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file); // Adiciona o arquivo ao DataTransfer

                // Simula a seleção do arquivo
                upImage2.files = dataTransfer.files;
                }, 'image2/png');
              },
            });
          };

          reader.readAsDataURL(file); // Lê o arquivo como DataURL
        } else {
          alert('Por favor, selecione um arquivo de imagem válido.');
        }
      });
      rotateButton.addEventListener('click', () => {
    if (cropper) {
      cropper.rotate(90); // Rotaciona a imagem 90 graus no sentido horário
    }
  });
    });
    function salvaContinuar(imagem1, imagem2) {
            const img1 = document.getElementById(imagem1);
            const img2 = document.getElementById(imagem2);
            const fileimg = img1.files[0];
            const fileimg2 = img2.files[0];

            // Verifica se ambas as imagens foram selecionadas
            if (!fileimg || !fileimg2) {
                document.querySelector('.msgErro').style.display = 'block';
            } else {
                document.querySelector('.msgErro').style.display = 'none';
                // Agora permite o envio do formulário após verificar as imagens
                document.getElementById('uploadForm').submit();
            }
        }
    function next(arg){
        if(arg=="seta_verso"){
            document.getElementById('cont_frente').style.display="none"
            document.getElementById('cont_tras').style.display="block"
        }else if((arg=="seta_frente")){
            document.getElementById('cont_frente').style.display="block"
            document.getElementById('cont_tras').style.display="none"
        }
          
    }
  
</script>
        

        
        
       
@endsection