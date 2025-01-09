@extends('layout.component')
<style>
    .conteinerImagemRecebida{
        border:solid 1px #E0E0E0;
        text-align: center;
        padding: 20%;
    }
    .msgErro{
        color:#E0E0E0;
        background-color: rgb(182, 187, 190);
        padding: 4px;
        border-radius: 3px;
        display: none
    }
</style>
@section('page')
    
    <div class="conteinerImagemRecebida" >
    
        <form id="uploadForm" action="{{ route('embalagem') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
        
            <h4><strong style="padding:10px "> ADICIONAR IMAGENS DA EMBALAGEM RECEBIDA </strong> </h4>
            <input type="text" hidden name="laudo_id" value="{{ $laudo_id }}">
        
            <!-- Foto Frente -->
            <label class="upImage" for="upImage">
                <b>FOTO FRENTE</b>
                <input hidden type="file" required name="fotoEmbalagem[]" accept=".jpg,.png,.jpeg" id="upImage">
                <div>
                    <img id="frente" src="{{ asset('image/embalagem.png') }}" alt="upload de imagem" style="cursor:pointer;">
                    <img style="display: none" id="verificador" src="{{ asset('image/verificar.png') }}" alt="Verificador">
                </div>
            </label>
        
            <!-- Foto Verso -->
            <label class="upImage" for="upImage2">
                <b>FOTO VERSO</b>
                <input hidden type="file" required name="fotoEmbalagem[]" accept=".jpg,.png,.jpeg" id="upImage2">
                <div>
                    <img id="verso" src="{{ asset('image/embalagem.png') }}" alt="upload de imagem" style="cursor:pointer;">
                    <img style="display: none" id="verificador2" src="{{ asset('image/verificar.png') }}" alt="Verificador">
                </div>
            </label>
        
            <!-- Botão de Envio -->
            <button onclick="salvaContinuar('upImage','upImage2')" id="submitButton" class="btn btn-success btn-block" type="submit" >
                <svg class="svg-inline--fa fa-save fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="save" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M433.941 129.941l-83.882-83.882A48 48 0 0 0 316.118 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V163.882a48 48 0 0 0-14.059-33.941zM224 416c-35.346 0-64-28.654-64-64 0-35.346 28.654-64 64-64s64 28.654 64 64c0 35.346-28.654 64-64 64zm96-304.52V212c0 6.627-5.373 12-12 12H76c-6.627 0-12-5.373-12-12V108c0-6.627 5.373-12 12-12h228.52c3.183 0 6.235 1.264 8.485 3.515l3.48 3.48A11.996 11.996 0 0 1 320 111.48z"></path></svg>
                SALVA E CONTINUA
            </button>
        </form>
        <span class="msgErro" >Adicione As duas Imagens FRENTE e VERSO para salva e continuar</span>
        <script>
            // Função para processar a imagem e exibir o verificador
            function salvaContinuar(imagem1,imagem2){
                const img1 = document.getElementById(imagem1);
                const img2 = document.getElementById(imagem2);
                const fileimg = img1.files[0];
                const fileimg2 = img2.files[0];
                if (!fileimg || !fileimg2) {
                        document.querySelector('.msgErro').style.display = 'block';
                    } else {
                        document.getElementById('submitButton').click(); // Se as imagens foram selecionadas, submete o formulário
                    }
            }
            function processImage(inputId, verificadorId) {
                const input = document.getElementById(inputId);
                const verificador = document.getElementById(verificadorId);
                const file = input.files[0]; // Obtém o arquivo selecionado
                
                if (file) {
                    verificador.style.display = 'block'; // Exibe o verificador quando a imagem for carregada
                    document.querySelector('.msgErro').style.display = 'none';
                } else {
                    verificador.style.display = 'none'; // Oculta o verificador se nenhum arquivo for selecionado
                }
            }
        
            // Adiciona evento de mudança para o primeiro input de imagem
            document.getElementById('upImage').addEventListener('change', function() {
                processImage('upImage', 'verificador');
            });
        
            // Adiciona evento de mudança para o segundo input de imagem
            document.getElementById('upImage2').addEventListener('change', function() {
                processImage('upImage2', 'verificador2');
            });
        </script>
        
        
        
       
@endsection