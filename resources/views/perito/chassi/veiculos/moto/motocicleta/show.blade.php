@extends('layout.component')
@section('page')
    {!! Html::script('js/filtrar_solicitantes.js') !!}
    {!! Html::script('js/calendar.js') !!}
    {!! Html::script('js/cropper.js') !!}
    {!! Html::script('js/dropzone.js') !!}
    {!! Html::script('js/dropzone_config.js') !!}
    {!! Html::script('js/cropper_image.js') !!}
    {!! Html::script('js/edicaoimagem.js') !!}
    {!! Html::script('js/edicaolaudo.js') !!}

    <div class="container">
        <style>
            /* Estilos para o container */
            .container {
                width: 100%;
                max-width: 90%;
                background: white;
                padding: 20px;
                border-radius: 10px;
                /*box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);*/
                text-align: center;
                box-sizing: border-box;
            }

            /* Estilos para o cabeçalho */
            header {
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
            }

            /* Estilos para o progresso */
            .progress-bar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin: 15px 0;
                color: #4bb2c4;
            }



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
            }

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








            .form-group {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .conteiner_embalagens_foto {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                justify-content: center
            }

            .fotosEmbalagens {
                border: 1px solid black;

                border-radius: 5px;
                padding: 3px;
                background-color: #ffffff;
            }

            .icon-substituir {
                width: 50px;
                background-color: red;
                border-radius: 5px;
            }

            .back {
                margin-top: 40px;
                flex: 1;

            }

            .back button {
                padding: 12px;
                border-radius: 5px;
                font-size: 16px;
                width: 100px;
                justify-content: center;
                cursor: pointer;
                border: none;
                margin: 0 10px;
                background-color: #031d20c7;
                color: #f8f8f8;
            }

            .back button:hover {
                background-color: #0691eeb7;
            }

            /* Estilos gerais dos botões */
            button {
                font-size: 16px;
                font-weight: bold;
                padding: 8px 15px;
                border: none;
                cursor: pointer;
                border-radius: 5px;
                transition: all 0.3s ease-in-out;
            }


            .editar {
                background-color: #169db4;
                border: 1px solid #003842;
                color: white;
            }

            .editar:hover {
                background-color: #0b9ea8a1;
            }


            .deletar {
                background-color: #9e0300;
                color: white;
                border: 1px solid #220100;
            }

            .deletar:hover {
                background-color: #c62828;
            }
        </style>

        <header>
            <h1>Exame de Identificação Veicular</h1>
        </header>

        <div class="progress-container">
            <div class="progress-bar"></div>
            <div class="step active">1</div>
            <div class="step active">2</div>
            <div class="step active">3</div>
            <div class="step active">4</div>
        </div>

        <h2 style="text-decoration: underline;">Motocicleta</h2>

        <div id="showLaudo" class="col-lg-12">
            <span>
                <strong> REP: </strong> {{$laudo->rep}}
            </span>

            <br> <!-- Pula linha -->

            <span>
                <strong> Oficio: </strong> {{$laudo->oficio}}
            </span>

            <br> <!-- Pula linha -->

            <span>
                <strong> Cidade: </strong> {{$laudo->cidade_id}}
            </span>

            <br> <!-- Pula linha -->

            <span>
                <strong> Órgão solicitante: </strong> {{ $laudo->solicitante->nome ?? '' }}
            </span>
        </div>


        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered  table-striped" id="tabela_chassis">
                    <thead align="center">
                        <tr>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Ano</th>
                            <th>Nº da placa</th>
                            <th colspan="2">Ações</th>
                        </tr>
                    </thead>

                    <tbody align="center">
                        <td>{{$chassi['veiculo_id']}}</td>
                        <td>{{$chassi['marca_fabricacao']}}</td>
                        <td>{{$chassi['modelo']}}</td>
                        <td>{{$chassi['ano']}}</td>
                        <td>{{$chassi['placa']}}</td>
                        <td><button class="editar">Editar</button></td>
                        <td><button class="deletar" $row=id>Deletar</button></td>
                    </tbody>
                </table>
            </div>

            <!--  <div class="row mb-3">
                            <div class="col-lg-3 mt-2">
                                <a class="btn btn-secondary btn-block" href="">
                                    <i class="fas fa-arrow-circle-left"></i> Voltar</a>
                            </div>
                    -->

            <div class="back">
                <button id="prev" onclick="window.history.back()">Voltar</button>
            </div>

            <hr>

            <div class="col-lg-3 mt-2">
                <a class="btn btn-primary btn-block" href="{{ route('laudosChassi.docx', ['laudo' => $laudo]) }}">
                    <i class="fas fa-file-download" aria-hidden="true"></i>
                    Gerar Laudo (.docx)
                </a>
            </div>

        </div>
    </div>

    <script>
        // Função para atualizar a barra de progresso
        const steps = document.querySelectorAll(".step");
        const progressBar = document.querySelector(".progress-bar");
        const prevButton = document.getElementById("prev");
        const nextButton = document.getElementById("next");

        let currentStep = 1;

        nextButton.addEventListener("click", (e) => {
            e.preventDefault();
            const form = document.getElementById("form");
            if (form.checkValidity()) {
                form.submit();
            }
        });

        prevButton.addEventListener("click", () => {
            currentStep--;
            if (currentStep < 1) {
                currentStep = 1; // Não permitir ir abaixo do primeiro passo
            }
            updateProgress();
        });

    </script>

    <script>
        document.querySelector("form").addEventListener("submit", function (e) {
            e.preventDefault(); // Previne o envio normal
            // Submete o formulário de forma assíncrona (AJAX, fetch, etc.) se necessário
            // Após o envio, redireciona o usuário para uma página diferente
            window.location.replace("nova-pagina-de-sucesso");
        });
    </script>

@endsection