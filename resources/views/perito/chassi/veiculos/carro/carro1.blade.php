@extends('layout.component')
@section('page')

<style>
    /* Estilos gerais */


    .container {
        width: 100%;
        max-width: 80%;
        background: white;
        padding: 20px;
        text-align: center;
        box-sizing: border-box;
    }

    header {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .titulo {
        background-color: #949494;
        padding: 10px;
        color: #ddd;
    }

    /* Estilos para o progresso */
    .progress-container {
        display: flex;
        justify-content: space-between;
        position: relative;
        max-width: 400px;
        margin: 20px auto;
    }

    .progress-bar {
        position: absolute;
        top: 50%;
        left: 10%;
        width: 80%;
        height: 4px;
        background-color: #ddd;
        z-index: -1;
        transition: width 0.4s ease;
    }

    .step {
        width: 40px;
        height: 40px;
        background-color: #ddd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
    }

    .step.active {
        background-color: #00bcd4;
    }

    /* Estilos para os botões de navegação */
    .nav-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
    }

    .nav-buttons button {
        flex: 1;
        padding: 12px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        border: none;
        margin: 0 10px;
        background-color: #031d20c7;
        color: #f8f8f8;
    }

    .nav-buttons button:hover {
        background-color: #0691eeb7;
    }

    .nav-buttons button:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    //* Estilos para as imagens e containers de foto */
    .conteinerImagemRecebida {
        border: solid 1px #E0E0E0;
        text-align: center;
        padding: 5%;
        margin: 5%;
        margin-top: 20px;
        margin-bottom: 20px;
        overflow: hidden; /* Impede que a imagem ultrapasse o contêiner */
        width: 100%; /* Garante que o contêiner ocupe 100% da largura disponível */
        position: relative;
    }

    .conteinerImg {
        margin-left: 15%;
        width: 400px;
        padding: 5%;
        max-height: 400px;
        overflow: hidden;
        margin: right;
        position: relative;
    }

    .preview {
        position: left;
        right: 15%;
        top: 20%;
        width: 500px;
        height: 500px;
        display: hidden;
        max-width: 400px;
        overflow: hidden;
        max-height: 300px;
        object-fit: contain;
        border: 1px solid #ccc;
        overflow: hidden;
        margin-top: 10%;
    }

    .preview img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        overflow: hidden;
    }
    


    
    .photo-container {
        margin: 20px 0;
    }

    .photo-container img {
        width: 100%;
        max-width: 500px;
        margin: 10px 0;
        border-radius: 8px;
    }

    .btnNext {
        border-radius: 5px;
        padding: 1%;
        color: #e7dbdb;
        text-decoration: underline;
        background-color: rgb(255, 253, 253);
    }

    .posicao {
        text-decoration: underline;
    }

    .msgErro {
        color: #E0E0E0;
        background-color: rgb(182, 187, 190);
        padding: 4px;
        border-radius: 3px;
        display: none;
    }
</style>
</head>

<body>
<div class="container">
    <header>
        <h1>Exame de Identificação Veicular</h1>
    </header>
    <br>

    <div class="progress-container">
        <div class="progress-bar"></div>
        <div class="step active">1</div>
        <div class="step active">2</div>
        <div class="step ">3</div>
        <div class="step">4</div>
    </div>

    <h2 style="text-decoration: underline;">Carro</h2>
    <br><br>
    <div class="conteinerImagemRecebida">
        <div>
            <input style="display: none" type="file" id="inputFile" accept="image/*">
            <input style="display:none" type="file" id="inputFile1" accept="image/*">


            <form class="uploadForm" action="{{ route('carro.tela1') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input hidden  name="laudo_id" value="{{ $laudo->id }}">
        <input type="file" hidden name="imagem1" id="imagem1">

       <input type="file" hidden name="imagem2" id="imagem2">

         </form>
            <div id="cont_frente">
                <h3 class="posicao">Primeira foto: </h3>
                <div class="preview" hidden id="preview_frente"></div>
                <div style="display:flex">
                    <div class="preview" id="preview_frente"></div>
                    <div class="conteinerImg">
                        <img id="image_frente">
                    </div>
                </div>
                
                <button class="btnNext" onclick="next('seta_frente')"  id="seta_frente"><img style="width: 20px"
                    src="{{ asset('image/add-image.png') }}" alt="adiciona foto"></button>
                <button class="btnNext" id="rotateButton_frente"><img style="width: 20px" src="{{ asset('image/rotate.png') }}"
                        alt="rotacionar"> </button>
                <img style="width:30px" src="{{asset('image/scroll.png')}}" alt="zoom"><b>ZOOM</b>
                    <br><br>
                <div>
                    <input type="checkbox" id="nao_tem_imagem_frente" name="nao_tem_imagem_frente" onclick="desativarImagemFrente()">
                    <label for="nao_tem_imagem_frente">Não tem imagem</label>
                </div>
            </div>
            <br>
            <hr>
            <br>
            <div id="cont_tras">
                <h3 class="posicao">Segunda foto:</h3>
                <div class="preview" hidden id="preview_tras"></div>
                <div style="display:flex">
                    <div class="preview" id="preview_tras"></div>
                    <div class="conteinerImg">
                        <img id="image_tras">
                    </div>
                </div>
    
                <button class="btnNext" onclick="next('seta_verso')"  id="seta_verso"><img style="width: 20px"
                    src="{{ asset('image/add-image.png') }}" alt="adiciona foto"></button>
                <button class="btnNext" id="rotateButton_tras"><img style="width: 20px" src="{{ asset('image/rotate.png') }}"
                        alt="rotacionar"> </button>
                <img style="width:30px" src="{{asset('image/scroll.png')}}" alt="zoom"><b>ZOOM</b>
                <br><br>
                <div>
                    <input type="checkbox" id="nao_tem_imagem_tras"  name="nao_tem_imagem_tras" onclick="desativarImagemTras()">
                    <label for="nao_tem_imagem_tras">Não tem imagem</label>
                </div>
            </div>
        </div>
    </div>
   
    <div class="nav-buttons">
        <button id="prev" onclick="window.history.back()">Voltar</button>
        <button id="next" onclick="salvaContinuar('imagem1','imagem2')">Avançar</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let scale = 1;
    const preview = document.querySelector('.preview');
    const container = document.querySelector('.preview-container');

    // Zoom com rolagem do mouse
    container.addEventListener('wheel', (e) => {
        e.preventDefault();

        if (e.deltaY > 0) {
            // Zoom out
            scale *= 0.9;
        } else {
            // Zoom in
            scale *= 1.1;
        }

        // Limita o zoom
        scale = Math.min(Math.max(0.2, scale), 3); // Limita entre 0.2x e 3x

        // Aplica o zoom
        preview.style.transform = `scale(${scale})`;
    });

    function carrega(inputFile, image, cropper, preview, upImage, rotateButton, pre) {
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
                        aspectRatio: NaN,
                        viewMode: 0,
                        autoCrop: true,
                        autoCropArea: 0.8,
                        movable: true,
                        zoomable: true,
                        scalable: true,
                        highlight: true,
                        guides: true,
                        background: true,
                        cropBoxResizable: true,
                        preview: pre,
                        ready() {
                            console.log('Cropper pronto !');
                        },
                        crop() {
                            const canvas = cropper.getCroppedCanvas({
                                width: 400,
                                height: 400,
                            });

                            preview.innerHTML = ''; // Limpa a pré-visualização anterior
                            const croppedImage = document.createElement('img');
                            croppedImage.src = canvas.toDataURL();
                            preview.appendChild(croppedImage); // Exibe a imagem cortada
                            canvas.toBlob((blob) => {
                                const randomString = Math.random().toString(36).substring(2, 10);
                                const fileName = `cropped-image-${randomString}.png`;

                                const file = new File([blob], fileName, { type: 'image/png' });
                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(file);

                                upImage.files = dataTransfer.files;
                            }, 'image/png');
                        },
                    });
                };
                reader.readAsDataURL(file);
            } else {
                alert('Por favor, selecione um arquivo de imagem válido.');
            }
        })
        rotateButton.addEventListener('click', () => {
            if (cropper) {
                cropper.rotate(90); // Rotaciona a imagem 90 graus no sentido horário
            }
        });
    }

    function next(arg) {
        if (arg == "seta_verso") {
            click_input_file1('inputFile1')
        } else if (arg == "seta_frente") {
            click_input_file('inputFile')
        }
    }

    function click_input_file(file_input) {
        document.getElementById(file_input).click();
        let inputFile = document.getElementById('inputFile');
        let image = document.getElementById('image_frente');
        let preview = document.getElementById('preview_frente');
        let upImage = document.getElementById('imagem1');
        let rotateButton = document.getElementById('rotateButton_frente');
        let cropper;
        carrega(inputFile, image, cropper, preview, upImage, rotateButton, "#preview_frente");
    }

    function click_input_file1(file_input) {
        document.getElementById(file_input).click();
        let inputFile = document.getElementById('inputFile1');
        let image = document.getElementById('image_tras');
        let preview = document.getElementById('preview_tras');
        let upImage = document.getElementById('imagem2');
        let rotateButton = document.getElementById('rotateButton_tras');
        let cropper;
        carrega(inputFile, image, cropper, preview, upImage, rotateButton, "#preview_tras");
    }

    //Função para possibilitar o avanço para a proxima tela, com duas regras por ora
    function salvaContinuar(imagem1, imagem2) {
    const img1 = document.getElementById(imagem1);
    const img2 = document.getElementById(imagem2);
    const fileimg = img1.files[0];
    const fileimg2 = img2.files[0];
    const checkbox1 = document.getElementById("nao_tem_imagem_frente");
    const checkbox2 = document.getElementById("nao_tem_imagem_tras");

    if (checkbox1.checked || checkbox2.checked) {
        document.querySelector('.uploadForm').submit();
    } else if (!fileimg || !fileimg2) {
        console.log('imagem vazia')
    } else {
        console.log('imagem carregada')
        document.querySelector('.uploadForm').submit();
    }
}

    $(document).ready(function () {
    const steps = $(".step");
    const progressBar = $(".progress-bar");
    const prevButton = $("#prev");
    const nextButton = $("#next");

    let currentStep = 1;

    nextButton.on("click", function () {
        if (currentStep < steps.length) {
            currentStep++;
            updateProgress();
        }
    });

    prevButton.on("click", function () {
        if (currentStep > 1) {
            currentStep--;
            updateProgress();
        }
    });

    function updateProgress() {
        // Atualiza a visibilidade das etapas
        steps.each(function (index) {
            if (index + 1 === currentStep) {
                $(this).show(); // Exibe a etapa atual
            } else {
                $(this).hide(); // Oculta as etapas que não são a atual
            }
        });

        // Atualiza a barra de progresso
        progressBar.css("width", ((currentStep - 1) / (steps.length - 1)) * 100 + "%");

        // Desabilita os botões de navegação conforme o caso
        prevButton.prop("disabled", currentStep === 1);
        nextButton.prop("disabled", currentStep === steps.length);
    }

    // Inicializa com a primeira etapa visível
    updateProgress();
});

//Funão de controle dos checkbox "Não tem imagem"
function desativarImagemFrente() {
    var checkbox = document.getElementById("nao_tem_imagem_frente");
    var imagem = document.getElementById("imagem1");
    var botao = document.getElementById("seta_frente");
    if (checkbox.checked) {
        imagem.disabled = true;
        botao.disabled = true;
    } else {
        imagem.disabled = false;
        botao.disabled = false;
    }
}

function desativarImagemTras() {
    var checkbox = document.getElementById("nao_tem_imagem_tras");
    var imagem = document.getElementById("imagem2");
    var botao = document.getElementById("seta_verso");
    if (checkbox.checked) {
        imagem.disabled = true;
        botao.disabled = true;
    } else {
        imagem.disabled = false;
        botao.disabled = false;
    }
}

</script>

@endsection