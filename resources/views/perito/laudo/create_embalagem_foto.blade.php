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
    #croppie-container,#croppe2{
        
        height: 300px;
        width: 300px;
       position: relative;
      
        
    }
    .embalagemFoto{
       
    }
</style>
@section('page')
<h4><strong style="padding:10px"> ADICIONAR IMAGENS DA EMBALAGEM RECEBIDA </strong> </h4>
<div class="conteinerImagemRecebida">
  
    <label class="upImage embalagemFoto" >
        
            <b>FOTO FRENTE</b>
            <div id="croppie-container"></div>
            
            
            <div>
              
                
                <img style="display: none" id="verificador" src="{{ asset('image/verificar.png') }}" alt="Verificador">
            </div>
            <div>
                <button id="crop-button"><img style="width: 50px" src="{{ asset('image/tesoura.png') }}" alt="rotacionar"> Cortar</button>
                <button id="rotate-button"><img style="width: 50px" src="{{ asset('image/rotate.png') }}" alt="rotacionar"> Girar</button>
            </div>
            
    </label>
    <img id="frente" src="{{ asset('image/embalagem.png') }}" alt="upload de imagem" style="cursor:pointer;">
        <!-- Foto Verso -->
    <label class="upImage" >
            <b>FOTO VERSO</b>
            <div id="croppe2">

            </div>
            <div>
                
                <img  style="display: none" id="verificador2" src="{{ asset('image/verificar.png') }}" alt="Verificador">
            </div>
            <div>
                <button id="crop-button-lado-direito"><img style="width: 50px" src="{{ asset('image/tesoura.png') }}" alt="rotacionar"> Cortar</button>
                <button id="rotate-button-lado-direito"><img style="width: 50px" src="{{ asset('image/rotate.png') }}" alt="rotacionar"> Girar</button>
            </div>
    </label>
    <img id="verso_img" src="{{ asset('image/embalagem.png') }}" alt="upload de imagem" style="cursor:pointer;">
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

<script>
    document.getElementById('frente').addEventListener('click', function() {
      
    // Quando a imagem for clicada, dispara o clique no input de arquivo
            document.getElementById('upImage').click();
        });
    document.getElementById('verso_img').addEventListener('click', function() {
    
    // Quando a imagem for clicada, dispara o clique no input de arquivo
            document.getElementById('upImage2').click();
        });
    let croppieInstance = null;

    // Função para processar as imagens e exibir o verificador
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

    // Função para processar a imagem carregada no Croppie
    function processImage(inputId, verificadorId) {
        
        if(inputId=="upImage"){

                    
                        const input = document.getElementById(inputId);
                        const verificador = document.getElementById(verificadorId);
                        const file = input.files[0]; // Obtém o arquivo da imagem

                        if (file) {
                            verificador.style.display = 'block'; // Exibe o verificador ao carregar a imagem
                            document.querySelector('.msgErro').style.display = 'none';

                            // Se o Croppie já estiver inicializado, destruímos a instância anterior
                        

                            // Inicializa o Croppie após o carregamento da página
                            const el = document.getElementById('croppie-container');
                            croppieInstance = new Croppie(el, {
                                viewport: { width: 200, height: 200, type: 'square' }, // Área de visualização do corte
                                boundary: { width: 300, height: 300 }, // Área do contêiner para corte
                                showZoomer: false,
                                enableResize: true,
                                enableOrientation: true,
                                mouseWheelZoom: 'ctrl'
                            });

                            // Carrega a imagem no Croppie
                            croppieInstance.bind({
                                url: URL.createObjectURL(file), // Usando URL.createObjectURL para exibir a imagem local
                               
                            }).then(() => {
                                console.log('Croppie foi inicializado com sucesso!');
                            });

                            document.getElementById('rotate-button').addEventListener('click', () => {
                            
                                croppieInstance.rotate(90); // Rotaciona a imagem em 90 graus no sentido horário
                            });
                            // Botão de corte
                            document.getElementById('crop-button').addEventListener('click', () => {
                                croppieInstance.result({ type: 'blob', size: 'viewport' }).then((croppedBlob) => {
                                    const fileInput = document.getElementById('upImage');

                                    // Cria um arquivo a partir do Blob (corte feito)
                                    const file = new File([croppedBlob], "imagem-cortada1.jpg", { type: "image/jpeg" });

                                    // Cria um objeto DataTransfer para simular a seleção de um arquivo
                                    const dataTransfer = new DataTransfer();
                                    dataTransfer.items.add(file);

                                    // Atribui o arquivo ao input de tipo 'file'
                                    fileInput.files = dataTransfer.files;

                                    console.log('Imagem cortada:', file);
                                    swal('Corte realizado com sucesso!!')

                                    // Aqui você pode incluir o código para salvar a imagem cortada, como enviá-la no formulário
                                    document.querySelector('.msgErro').style.display = 'none'; // Após o corte, pode ocultar a mensagem de erro
                                });
                    });
                        } else {
                            verificador.style.display = 'none'; // Oculta o verificador se nenhum arquivo for selecionado
                        }
                }else if(inputId=="upImage2"){ //configuração da outra image
                    
                        const input = document.getElementById(inputId);
                        const verificador = document.getElementById(verificadorId);
                        const file = input.files[0]; // Obtém o arquivo da imagem

                        if (file) {
                           
                            verificador.style.display = 'block'; // Exibe o verificador ao carregar a imagem
                        
                            document.querySelector('.msgErro').style.display = 'none';

                            // Se o Croppie já estiver inicializado, destruímos a instância anterior
                        
 
                            // Inicializa o Croppie após o carregamento da página
                            const el = document.getElementById('croppe2');
                            
                            croppieInstance1 = new Croppie(el, {
                                viewport: { width: 300, height: 300, type: 'square' }, // Área de visualização do corte
                                boundary: { width: 300, height: 300 }, // Área do contêiner para corte
                                showZoomer: false,
                                enableResize: true,
                                enableOrientation: true,
                                mouseWheelZoom: 'ctrl'
                            });

                            // Carrega a imagem no Croppie
                            croppieInstance1.bind({
                                url: URL.createObjectURL(file), // Usando URL.createObjectURL para exibir a imagem local
                                zoom:0
                            }).then(() => {
                                console.log('Croppie foi inicializado com sucesso!');
                            });

                            document.getElementById('rotate-button-lado-direito').addEventListener('click', () => {
                            
                                croppieInstance1.rotate(90); // Rotaciona a imagem em 90 graus no sentido horário
                            });
                            // Botão de corte
                            document.getElementById('crop-button-lado-direito').addEventListener('click', () => {
                                croppieInstance1.result({ type: 'blob', size: 'viewport' }).then((croppedBlob) => {
                                    const fileInput = document.getElementById('upImage2');

                                    // Cria um arquivo a partir do Blob (corte feito)
                                    const file = new File([croppedBlob], "imagem-cortada2.jpg", { type: "image/jpeg" });

                                    // Cria um objeto DataTransfer para simular a seleção de um arquivo
                                    const dataTransfer = new DataTransfer();
                                    dataTransfer.items.add(file);

                                    // Atribui o arquivo ao input de tipo 'file'
                                    fileInput.files = dataTransfer.files;

                                    console.log('Imagem cortada:', file);
                                    swal('Corte realizado com sucesso!!')

                                    // Aqui você pode incluir o código para salvar a imagem cortada, como enviá-la no formulário
                                    document.querySelector('.msgErro').style.display = 'none'; // Após o corte, pode ocultar a mensagem de erro
                                });
                    });
                        } else {
                            verificador.style.display = 'none'; // Oculta o verificador se nenhum arquivo for selecionado
                        }
                }
    }

    // Adiciona evento de mudança para o primeiro input de imagem
    document.getElementById('upImage').addEventListener('change', function () {
        
        processImage('upImage', 'verificador');
    });

    // Adiciona evento de mudança para o segundo input de imagem
    document.getElementById('upImage2').addEventListener('change', function () {
        
        processImage('upImage2', 'verificador2');
    });
</script>

        
        
       
@endsection