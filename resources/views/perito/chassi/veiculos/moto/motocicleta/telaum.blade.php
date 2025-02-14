@extends('layout.component')
@section('page')

<style>

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
    }

    .conteinerImg {
        margin-left: 15%;
        width: 30%;
        padding: 5%;
    }

    #image,
    #image1 {
        display: none;
        max-width: 30%;
    }

    .preview {
        position: left;
        right: 15%;
        top: 20%;
        width: 500px;
        height: 500px;
        display: hidden;
        margin-top: 20%; /* Achei essa coisa, arrumar posição outra tela */
        max-width: 300px;
        max-height: 300px;
        object-fit: contain;
        border: 1px solid #ccc;
        overflow: hidden;
    }



.preview img {
width: 100%;
height: 100%;
object-fit: contain;
}


.preview img {
width: 100%;
height: 100%;

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

            <div id="cont_frente">
                <h3 class="posicao">Foto 1: </h3>
                <div class="preview" hidden id="preview"></div>
                <div style="display:flex">
                    <div class="preview" id="preview"></div>
                    <div class="conteinerImg">
                        <img id="image">
                    </div>
                </div>
                <button class="btnNext" onclick="next('seta_frente')" id="seta_frente"><img style="width: 20px"
                        src="../img/add-image.png" alt="adiciona foto"></button>
                <button class="btnNext" id="rotateButton"><img style="width: 20px" src="img/rotate.png"
                        alt="rotacionar"> </button>
                <img style="width:30px" src="img/scroll.png" alt="zoom"><b>ZOOM</b>
            </div>
            <br>
            <hr>
            <div id="cont_tras">
                <h3 class="posicao">Foto 2:</h3>
                <div class="preview" hidden id="prev"></div>
                <div style="display:flex">
                    <div class="preview" id="prev"></div>
                    <div class="conteinerImg">
                        <img id="image1">
                    </div>
                </div>
                <button class="btnNext" onclick="next('seta_verso')" id="seta_verso"><img style="width: 20px"
                        src="../img/add-image.png" alt="adiciona foto"></button>
                <button class="btnNext" id="rotateButton1"><img style="width: 20px" src="img/rotate.png"
                        alt="rotacionar"> </button>
                <img style="width:30px" src="img/scroll.png" alt="zoom"><b>ZOOM</b>
            </div>
        </div>
        <span class="msgErro" style="display: none;">Adicione as duas imagens (FRENTE e VERSO) para salvar e
            continuar</span>
    </div>

    <div class="nav-buttons">
        <button id="prev" >Voltar</button>
        <button id="next">Avançar</button>
    </div>

    <script>
        // função pra pra redimensiona
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
                            aspectRatio: NaN, // Proporção do quadrado
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
                            preview: pre, // Atualiza automaticamente a pré-visualização
                            ready() {
                                console.log('Cropper pronto !'); // Verifica quando o cropper está pronto
                            },
                            crop() {
                                const canvas = cropper.getCroppedCanvas({
                                    width: 400, // Largura do canvas
                                    height: 400, // Altura do canvas
                                });

                                preview.innerHTML = ''; // Limpa a pré-visualização anterior
                                const croppedImage = document.createElement('img');
                                croppedImage.src = canvas.toDataURL(); // Converte o canvas para DataURL
                                preview.appendChild(croppedImage); // na a nova imagem cortada
                                canvas.toBlob((blob) => {
                                    const randomString = Math.random().toString(36).substring(2, 10); // Gera uma string aleatória
                                    const fileName = `cropped-image-${randomString}.png`; // Concatena o nome com o random

                                    const file = new File([blob], fileName, { type: 'image/png' });
                                    const dataTransfer = new DataTransfer();
                                    dataTransfer.items.add(file); // Adiciona o arquivo ao DataTransfer

                                    // Simula a seleção do arquivo
                                    upImage.files = dataTransfer.files;
                                }, 'image/png');
                            },
                        });
                    };
                    reader.readAsDataURL(file); // Lê o arquivo como DataURL
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

        function click_input_file(file_input) {
            document.getElementById(file_input).click();
            let inputFile = document.getElementById('inputFile');
            let image = document.getElementById('image');
            let preview = document.getElementById('preview');
            let upImage = document.getElementById('upImage'); // Seu input de arquivo
            let prevFrente = "#preview"
            let rotateButton = document.getElementById('rotateButton');
            let cropper;
            carrega(inputFile, image, cropper, preview, upImage, rotateButton, prevFrente)
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
            carrega(inputFile, image, cropper, preview1, upImage, rotateButton, preVerso)
        }

        function next(arg) {
            if (arg == "seta_verso") {
                click_input_file1('inputFile1')
            } else if ((arg == "seta_frente")) {
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

        $(document).ready(function () {
            const steps = $(".step");
            const progressBar = $(".progress-bar");
            const prevButton = $("#prev");
            const nextButton = $("#next");

            let currentStep = 1;

            nextButton.on("click", function () {
                currentStep++;
                updateProgress();
            });

            prevButton.on("click", function () {
                currentStep--;
                updateProgress();
            });

            function updateProgress() {
                steps.each(function (index) {
                    if (index < currentStep) {
                        $(this).addClass("active");
                    } else {
                        $(this).removeClass("active");
                    }
                });

                progressBar.css("width", ((currentStep - 1) / (steps.length - 1)) * 100 + "%");

                prevButton.prop("disabled", currentStep === 1);
                nextButton.prop("disabled", currentStep === steps.length);
            }
        });
    </script>
    <script src="https://unpkg.com/cropperjs/dist/cropper.min.js"></script>
</div>
</body>

@endsection