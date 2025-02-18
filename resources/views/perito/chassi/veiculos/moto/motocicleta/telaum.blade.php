@extends('layout.component')
@section('page')

<style>
    /* Estilos gerais */


    .container {
        width: 90%;
        max-width: 1000px;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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

    /* Estilos para as imagens e containers de foto */
    .conteinerImagemRecebida {
        border: solid 1px #E0E0E0;
        text-align: center;
        padding: 5%;
        margin: 5%;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .conteinerImg {
        margin-left: 15%;
        width: 200px;
        padding: 5%;
        max-height: 400px;
        overflow: hidden;
        margin: right;
    }

    .preview {
        position: left;
        right: 15%;
        top: 20%;
        width: 500px;
        height: 500px;
        display: hidden;
        max-width: 400px;
      
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
        <div class="step active">✔</div>
        <div class="step">✔</div>
        <div class="step">✔</div>
        <div class="step">✔</div>
    </div>

    <h2>Motocicleta</h2>
    <br><br>
    <div class="conteinerImagemRecebida">
        <div>
            <input style="display: none" type="file" id="inputFile" accept="image/*">
            <input style="display:none" type="file" id="inputFile1" accept="image/*">


            <form class="uploadForm" action="{{ route('motocicleta.tela4') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
        <input type="file" hidden name="imagem1" id="imagem1">

       <input type="file" hidden name="imagem2" id="imagem2">

         </form>
            <div id="cont_frente">
                <h3 class="posicao">Foto 1: </h3>
                <div class="preview" hidden id="preview_frente"></div>
                <div style="display:flex">
                    <div class="preview" id="preview_frente"></div>
                    <div class="conteinerImg">
                        <img id="image_frente">
                    </div>
                </div>
                
                <button class="btnNext" onclick="next('seta_frente')"  id="seta_frente"><img style="width: 20px"
                        src="../img/add-image.png" alt="adiciona foto"></button>
                <button class="btnNext" id="rotateButton_frente"><img style="width: 20px" src="img/rotate.png"
                        alt="rotacionar"> </button>
                <img style="width:30px" src="img/scroll.png" alt="zoom"><b>ZOOM</b>
            </div>
            <br>
            <hr>
            <br>
            <div id="cont_tras">
                <h3 class="posicao">Foto 2:</h3>
                <div class="preview" hidden id="preview_tras"></div>
                <div style="display:flex">
                    <div class="preview" id="preview_tras"></div>
                    <div class="conteinerImg">
                        <img id="image_tras">
                    </div>
                </div>
    
                <button class="btnNext" onclick="next('seta_verso')"  id="seta_verso"><img style="width: 20px"
                        src="../img/add-image.png" alt="adiciona foto"></button>
                <button class="btnNext" id="rotateButton_tras"><img style="width: 20px" src="img/rotate.png"
                        alt="rotacionar"> </button>
                <img style="width:30px" src="img/scroll.png" alt="zoom"><b>ZOOM</b>
            </div>
        </div>
    </div>
   
    <div class="nav-buttons">
        <button id="prev" onclick="window.history.back()">Voltar</button>
        <button id="next" onclick="salvaContinuar('imagem1','imagem2')">Avançar</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/cropperjs"></script>
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
    function salvaContinuar(imagem1, imagem2) {
            const img1 = document.getElementById(imagem1);
            const img2 = document.getElementById(imagem2);
            const fileimg = img1.files[0];
            const fileimg2 = img2.files[0];

            
            if (!fileimg || !fileimg2) {
             console.log('imagem vazia')
               console
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

</script>

@endsection