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
        width: 400px;
       position: relative;
       background: #f0f0f0;
       bottom: 50px;
       margin-top:50px;
        
    }
    .embalagemFoto{
       
    }
</style>
@section('page')

<div class="conteinerImagemRecebida">
  <h4><strong style="padding:10px"> ADICIONAR IMAGENS DA EMBALAGEM RECEBIDA </strong> </h4>
    <label class="upImage embalagemFoto" >
        
            <b>FOTO FRENTE</b>
            <div id="croppie-container"></div>
            
            
            <div>
              
                
                <img style="display: none" id="verificador" src="{{ asset('image/verificar.png') }}" alt="Verificador">
            </div>
            <div>
                <button id="frente" onclick="acao('frente','upImage')" alt="adicionar"><img style="width: 50px" src="{{ asset('image/add-image.png') }}" alt="adiciona foto"></button>
           
                <button id="rotate-button"><img style="width: 50px" src="{{ asset('image/rotate.png') }}" alt="rotacionar"> </button>
            </div>
            
    </label>
    
        <!-- Foto Verso -->
    <label class="upImage" >
            <b>FOTO VERSO</b>
            <div id="croppe2">

            </div>
            <div>
                
                <img  style="display: none" id="verificador2" src="{{ asset('image/verificar.png') }}" alt="Verificador">
            </div>
            <div>
                <button id="verso_img" onclick="acao2('verso_img','upImage2')"  id="crop-button-lado-direito"><img style="width: 50px" src="{{ asset('image/add-image.png') }}" alt="adicionar foto"></button>
                <button id="rotate-button-lado-direito"><img style="width: 50px" src="{{ asset('image/rotate.png') }}" alt="rotacionar"></button>
            </div>
    </label>
    
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
<script type="module" >
    import RedimensionaImage from "{{ asset('js/redimensionando_foto.js') }}";
    
    
    const redimensionador1 = new RedimensionaImage('upImage','verificador', 'croppie-container','rotate-button', 'instance1');
    const redimensionador2 = new RedimensionaImage('upImage2', 'verificador2', "croppe2", "rotate-button-lado-direito", 'instance2');
    //acao do botao 1
    window.acao = function (icon, file_input) {
        redimensionador1.click_input_file(icon, file_input);
    };
    //acao do botao 2
    window.acao2 = function (icon, file_input) {
        redimensionador2.click_input_file(icon, file_input);
    };
    // update de corte
    function tratarUpdateRedimensionador(redimensionador) {
        const croppieInstance = redimensionador.get_croppieInstances();
        
        // Se a instância do Croppie foi encontrada
        if (croppieInstance) {
            croppieInstance.result({ type: 'blob', size: 'viewport' }).then((croppedBlob) => {
                const fileInput = document.getElementById(redimensionador.get_input());

                if (!fileInput) {
                    console.error('Input de arquivo não encontrado.');
                    return;
                }

                // Criar arquivo a partir do Blob
                const file = new File([croppedBlob], "imagem-cortada.jpg", { type: "image/jpeg" });

                // Simular seleção do arquivo no input
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;

                console.log('Imagem cortada automaticamente:', file);
            }).catch((error) => {
                console.error('Erro ao cortar a imagem:', error);
            });
        }
    }

    // Adicionar evento de 'update' para ambos os redimensionadores
    window.document.getElementById(redimensionador1.get_croppie()).addEventListener('update', function (ev) {
        const cropData = ev.detail; // Obter os dados de corte (opcional)
        console.log('Área de corte ajustada:', cropData);
        tratarUpdateRedimensionador(redimensionador1);
    });

    window.document.getElementById(redimensionador2.get_croppie()).addEventListener('update', function (ev) {
        const cropData = ev.detail; // Obter os dados de corte (opcional)
        console.log('Área de corte ajustada:', cropData);
        tratarUpdateRedimensionador(redimensionador2);
    });
</script>
<script>
   
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
   
   
</script>

        
        
       
@endsection