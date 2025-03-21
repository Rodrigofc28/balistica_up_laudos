@extends('layout.component')
@section('page')

    <style>
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

        h1 {
            margin-bottom: 20px;
        }

        h2 {
            margin-top: 20px;
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
            background-color: #031d20c7;
            color: #f8f8f8;
        }

        .nav-buttons button:hover {
            background-color: #0691eeb7;
        }

        .form-group {
            display: block;
            margin: 15px 0;
        }

        .form-group label {
            font-weight: bold;
            min-width: 150px;
            text-align: left;
            display: block;
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="file"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            margin-top: 10px;
        }


        .conditional-fields {
            display: none;
        }

        .section-title {
            text-align: center;
            text-decoration: underline;
            margin: 20px 0;
        }

        .radio-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 15px 0;
        }

        .radio-group label {
            font-weight: bold;
        }

        .inline-form-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
        }

        .inline-form-group label {
            font-weight: bold;
            min-width: 150px;
            text-align: left;
        }

        .inline-form-group input[type="text"] {
            width: 200px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            margin-right: 10px;
        }

        .inline-form-group input[type="file"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            margin-right: 10px;
        }

        .chassi-revelado-fields,
        .motor-revelado-fields {
            display: none;
        }

        .nao-revelado-fields {
            display: none;
        }

        .chassi-input {
            font-family: monospace;
            letter-spacing: 5px;
            font-size: 20px;
            text-transform: uppercase;
            width: 400px;
            text-align: center;
            border: 2px solid black;
            padding: 5px;
            outline: none;
        }

        .chassi-display {
            display: flex;
            gap: 5px;
            margin-top: 10px;
        }

        .chassi-display div {
            display: inline-block;
            width: 20px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            border: 1px solid black;
            font-size: 18px;
            font-weight: bold;
        }

        /* Botões para limpar campos
        .button-grouplimpar button {
        background-color: #1da518c7;
        color: white;
        font-size: 16px; 
        padding: 10px 20px; 
        border: none; 
        border-radius: 5px; 
        cursor: pointer; 
        transition: all 0.3s ease; 
        }

        .button-grouplimpar button:hover {
            background-color: #0691eeb7;
            transform: scale(1.05); 
        }

        .button-grouplimpar button:active {
            background-color: #0691eeb7;
            transform: scale(0.98); 
        }

        .button-grouplimpar button:focus {
            outline: none;
        }

        .button-grouplimpar button:disabled {
            background-color: #ccc; 
            cursor: not-allowed; 
        }
        */

        /*Botões de Voltar/Avançar/Recortar*/
        .button-group button {
            background-color: #031d20c7;
            color: white; /* Cor do texto */
            font-size: 16px; /* Tamanho da fonte */
            padding: 10px 20px; /* Espaçamento interno do botão */
            border: none; /* Remove a borda */
            border-radius: 5px; /* Bordas arredondadas */
            cursor: pointer; /* Cursor de ponteiro ao passar por cima */
            transition: all 0.3s ease; /* Transição suave para efeitos de hover */
        }

        .button-group button:hover {
            background-color: #0691eeb7;
            transform: scale(1.05); /* Leve aumento no tamanho ao passar o mouse */
        }

        .button-group button:active {
            background-color: #0691eeb7;
            transform: scale(0.98); /* Leve redução no tamanho ao clicar */
        }

        .button-group button:focus {
            outline: none; /* Remove a borda de foco */
        }

        .button-group button:disabled {
            background-color: #ccc;  /* Cor do botão desativado */
            cursor: not-allowed; /* Cursor de bloqueio */
        }

        .cropper-container {
            /*isso aqui limita para que não fuja para a esquerda*/
            overflow: hidden;
        }

        /* Estilo do contêiner */
        .crop-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            padding: 10px;
            max-width: 50%;
            margin: 0 auto;
            position: relative;
            overflow: hidden; /* Impede que a imagem ultrapasse o contêiner */
            width: 100%; /* Garante que o contêiner ocupe 100% da largura disponível */
        }

        /* Estilo da imagem com zoom */
        .preview img {
            max-width: 100%; /* Impede que a imagem ultrapasse a largura do contêiner */
            max-height: 400PX; /* Impede que a imagem ultrapasse a altura do contêiner */
            transform-origin: center center; /* Zoom centrado */
            transition: transform 0.3s ease; /* Transição suave */
            position: relative; /* Ao invés de absolute, para limitar seu movimento */
            object-fit: contain; /* Garante que a imagem se ajuste ao tamanho do contêiner */
        }

        /* Limitação do tamanho do preview */
        .image-preview {
            max-width: 400px;
            max-height: 1000px;
            overflow: hidden;
            border: 1px solid #220000;
        }

        /* Resultado cortado */
        #cropped-result {
            max-width: 300px;
            max-height: 300px;
            border: 1px solid #000000;
        }

        /* CSS para as caixas de texto */
        .caixaTexto {
            margin-bottom: 10px; /* Espaçamento entre a caixa de texto e os elementos abaixo */
        }

        .caixaTexto label {
            display: block;  /* Faz o label ocupar uma linha inteira */
            font-weight: bold; /* Deixa o texto do label em negrito */
            margin-bottom: 5px; /* Espaçamento entre o label e a caixa de texto */
        }

        .caixaTexto textarea {
            width: 100%; /* Faz a caixa de texto ocupar toda a largura disponível */
            padding: 8px; /* Adiciona um pequeno padding dentro da caixa de texto */
            border: 1px solid #ccc; /* Bordas suaves */
            border-radius: 4px; /* Bordas arredondadas */
            font-size: 14px; /* Tamanho da fonte */
            box-sizing: border-box; /* Garantir que padding e border não aumentem a largura total */
        }
    </style>
    </head>

    <body>
        <div class="container">
            <header>
                <h1> Exame de Identificação Veicular </h1>
            </header>

            <div class="progress-container">
                <div class="progress-bar"></div>
                <div class="step active"> 1 </div>
                <div class="step active"> 2 </div>
                <div class="step active"> 3 </div>
                <div class="step"> 4 </div>
            </div>

            <h2 style="text-decoration: underline;"> Motocicleta </h2>
            <br>
            <form id="form" action="{{ route('motocicleta.exame') }}" method="POST" onsubmit="handleFormSubmit(event)">
                {{ csrf_field() }}
                <input hidden name="laudo_id" value="{{ $laudo->id}}">

                <div class="button-group" id="chassiSection"> <!-- Seção do Chassi -->
                    <div class="section-title" style="font-size: 25px;"> Chassi </div>
                    <div class="radio-group">
                        <label> Situação: </label>
                        <label>
                            <input type="radio" name="chassi_status" value="integro" onchange="toggleFields('chassi')"required>
                            Íntegro
                        </label>
                        <label>
                            <input type="radio" name="chassi_status" value="adulterado" onchange="toggleFields('chassi')" required>
                            Adulterado
                        </label>
                    </div>

                    <div class="conditional-fields" id="integroFieldsChassi">
                        <div class="form-group">
                            <label for="chassiAtual"> Número do Chassi: </label>
                            <input type="text" id="chassiAtual" name="chassi_numero" maxlength="17"
                                placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                                oninput="updateChassiDisplay(this, 'chassiAtualDisplay')"
                            >
                            <div id="chassiAtualDisplay" class="chassi-display"></div>
                        </div>

                        <div class="form-group">
                            <label for="fotoChassiAtual"> Foto do Chassi: </label>
                            <input type="file" id="fotoChassiAtual" name="chassi_foto" class="image-input">
                            <label>
                                <input type="checkbox" id="nao-tem-foto-chassi" name="chassi_nao_tem_foto" onchange="toggleFotoChassi()">
                                Não tem foto
                            </label>
                        </div>

                        <div class="crop-container">
                            <img id="image-preview-chassi" alt="Preview" style="width: 0px"
                                    src="{{ asset('image/add-image.png') }}" class="image-preview"
                            >
                        </div>

                        <button id="crop-button-chassi" style="display:none;">Recortar</button>

                        <canvas id="cropped-result-chassi"></canvas>
                        <!-- <div class="button-grouplimpar">
                        <button type="button" id="limparCamposIntegro" onclick="limparCampos('integro')">Limpar campos</button>

                        </div>-->
                    </div>

                    <div class="conditional-fields" id="adulteradoFieldsChassi">
                        <div class="form-group">
                            <label for="chassiAdulterado"> Chassi Adulterado: </label>
                            <input type="text" id="chassi_adulterado" name="chassi_adulterado_numero" maxlength="17"
                                placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                                oninput="updateChassiDisplay(this, 'chassiAdulteradoDisplay')">
                            <div id="chassiAdulteradoDisplay" class="chassi-display"></div>
                        </div>

                        <div class="form-group">
                            <label for="arquivoChassiAdulterado">Foto do chassi adulterado:</label>
                            <input type="file" id="arquivo_chassi_adulterado" name="chassi_adulterado_foto" class="image-input">
                            <label>
                                <input type="checkbox" id="nao-tem-foto-chassi-adulterado"
                                onchange="toggleFotoChassiAdulterado()">
                                Não tem foto
                            </label>
                        </div>

                        <div class="crop-container">
                            <img id="image-preview-chassi-adulterado" alt="Preview" style="width: 0px"
                                src="{{ asset('image/add-image.png') }}" class="image-preview">
                        </div>

                        <button id="crop-button-chassi-adulterado" style="display:none;"> Recortar </button>

                        <canvas id="cropped-result-chassi-adulterado"></canvas>

                        <div class="form-group">
                            <label for="tipoadulteracao"> Tipo de adulteração: </label>
                            <select id="tipoadulteracao" name="chassi_tipo_adulteracao"
                                onchange="bloquearrCampos('chassi', 'Chassi'); mostrarInformacoesTransplante(); mostrarInformacoesReparos();">
                                <option value="">Selecione</option>
                                <option value="adulteracao_simples"> Adulteração simples </option>
                                <option value="sem_numero_chassi"> Chapa sem número </option>
                                <option value="contundencia"> Contundência </option>
                                <option value="desbaste"> Desbaste </option>
                                <option value="desbaste_regravacao"> Desbaste e regravação </option>
                                <option value="implante_chassi"> Implante </option>
                                <option value="nao_localizado"> Não localizado </option>
                                <option value="oxidacao_chassi"> Oxidação </option>
                                <option value="recortado"> Recortado </option>
                                <option value="remarcado"> Remarcado </option>
                                <option value="reparos_chassi"> Reparos </option>
                                <option value="substituido_transplante"> Substituído </option>
                                <option value="transplante_chassi"> Transplante </option>
                            </select>
                        </div>

                        <div id="caixaTextoTransplante" class="caixaTexto" style="display: none;">
                            <label for="campoTransplante"> Informações sobre o Transplante: </label>
                            <textarea id="campoTransplante" name="transplante_chassi" rows="4" cols="50"></textarea>
                        </div>

                        <div id="caixaTextoReparos" class="caixaTexto" style="display: none;">
                            <label for="campoReparos"> Informações sobre os Reparos: </label>
                            <textarea id="campoReparos" name="reparo_chassi" rows="4" cols="50"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="metodologiaChassi"> Metodologia Aplicada: </label>
                            <select id="metodologiaChassi" name="chassi_metodologia">
                                <option value="">Selecione</option>
                                <option value="tratamento_quimico"> Aplicar tratamento químico-metalográfico </option> <!-- Aplicação?? -->
                                <option value="instrumento_optico"> Utilização de instrumento óptico adequado (LUPA) </option>
                            </select>
                            {{-- <label>
                                <input type="checkbox" id="nao-se-aplica-metodologia-chassi"
                                    name="nao-se-aplica-metodologia-chassi" onchange="toggleMetodologiaChassi()"> Não se
                                aplica
                            </label>--}}
                        </div>

                        <div class="form-group">
                            <label for="resultadoChassi"> Resultado: </label>
                            <select id="resultadoChassi" name="chassi_resultado" onchange="toggleReveladoFields('chassi')">
                                <option value=""> Selecione </option>
                                <option value="corroborado"> Corroborad o</option>
                                <option value="nao_confirmado"> Não confirmado </option>
                                <option value="nao_revelado"> Não revelado </option>
                                <option value="revelado"> Revelado </option>
                                <option value="revelado_parcialmente"> Revelado parcialmente </option>
                            </select>
                            {{-- <label>
                                <input type="checkbox" id="nao-se-aplica-resultado-chassi"
                                    name="chassi_nao_se_aplica_resultado" onchange="toggleResultadoChassi()"> Não se aplica
                            </label>--}}
                        </div>

                        <div class="chassi-revelado-fields" id="chassi-revelado">
                            <div class="form-group">
                                <label for="chassiRevelado"> Número do chassi revelado: </label>
                                <input type="text" id="chassiRevelado" name="chassi_revelado_numero" maxlength="17"
                                    placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                                    oninput="updateChassiDisplay(this, 'chassiReveladoDisplay')">
                                <div id="chassiReveladoDisplay" class="chassi-display"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="fotoChassiRevelado"> Foto do chassi revelado: </label>
                                <input type="file" id="fotoChassiRevelado" name="chassi_revelado_foto" class="image-input">
                                <label>
                                    <input type="checkbox" id="nao-tem-foto-chassi-revelado"
                                    onchange="toggleFotoChassiRevelado()">
                                    Não tem foto
                                </label>
                            </div>

                            <div class="crop-container">
                                <img id="image-preview-chassi-revelado" alt="Preview" style="width: 0px"
                                    src="{{ asset('image/add-image.png') }}" class="image-preview">
                            </div>
                            
                            <button id="crop-button-chassi-revelado" style="display:none;"> Recortar </button>
                            
                            <canvas id="cropped-result-chassi-revelado"></canvas>
                        </div>
                        <!-- Campo Corroborado para o Chassi -->
                        <div class="chassi-revelado-fields" id="chassi-corroborado">
                            <div class="form-group">
                                <label for="chassiCorroborado"> Número do chassi corroborado: </label>
                                <input type="text" id="chassiCorroborado" name="chassi_corroborado_numero" maxlength="17"
                                    placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                                    oninput="updateChassiDisplay(this, 'chassiCorroboradoDisplay')">
                                <div id="chassiCorroboradoDisplay" class="chassi-display"></div>
                            </div>
                            <div class="form-group">
                                <label for="fotoChassiCorroborado" >Foto do chassi corroborado: </label>
                                <input type="file" id="fotoChassiCorroborado" name="chassi_corroborado_foto"
                                    class="image-input">
                                <label>
                                    <input type="checkbox" id="nao-tem-foto-chassi-corroborado"
                                    onchange="toggleFotoChassiCorroborado()">
                                    Não tem foto
                                </label>
                            </div>

                            <div class="crop-container">
                                <img id="image-preview-chassi-corroborado" alt="Preview" style="width: 0px"
                                    src="{{ asset('image/add-image.png') }}" class="image-preview">
                            </div>

                            <button id="crop-button-chassi-corroborado" style="display:none;"> Recortar </button>

                            <canvas id="cropped-result-chassi-corroborado"></canvas>
                        </div>

                        <div class="chassi-revelado-fields" id="chassi-revelado-parcialmente">
                            <div class="form-group">
                                <label for="chassiReveladoParcialmente"> Chassi Revelado Parcialmente: </label>
                                <input type="text" id="chassiReveladoParcialmente"
                                    name="chassi_revelado_parcialmente_numero" maxlength="17"
                                    placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                                    oninput="updateChassiDisplay(this, 'chassiReveladoParcialmenteDisplay')">
                                <div id="chassiReveladoParcialmenteDisplay" class="chassi-display"></div>
                            </div>

                            <div class="form-group">
                                <label for="fotoChassiReveladoParcialmente"> Foto do Chassi Revelado Parcialmente: </label>
                                <input type="file" id="fotoChassiReveladoParcialmente"
                                    name="chassi_revelado_parcialmente_foto" class="image-input">
                                <label>
                                    <input type="checkbox" id="nao-tem-foto-chassi-revelado-parcialmente"
                                    onchange="toggleFotoChassiReveladoParcialmente()">
                                    Não tem foto
                                </label>
                            </div>

                            <div class="crop-container">
                                <img id="image-preview-chassi-revelado-parcialmente" alt="Preview" style="width: 0px"
                                    src="{{ asset('image/add-image.png') }}" class="image-preview">
                            </div>

                            <button id="crop-button-chassi-revelado-parcialmente" style="display:none;">Recortar</button>
                            
                            <canvas id="cropped-result-chassi-revelado-parcialmente"></canvas>
                        </div>

                        <!--<div class="button-grouplimpar">
                            <button type="button" id="limparCamposAdulterado" onclick="limparCampos('adulterado')">Limpar campos</button>
                        </div>-->
                    </div>

                </div>

                <script>
                    
                    function limparCampos(tipo) {
                        if (tipo === 'integro') {
                            // Limpa os campos da seção Integro
                            document.getElementById("chassiAtual").value = "";
                            document.getElementById("fotoChassiAtual").value = "";
                            document.getElementById("chassiAtualDisplay").innerHTML = "";
                            document.getElementById("image-preview-chassi").style.width = '0px';
                            document.getElementById("cropped-result-chassi").getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

                            // Limpa os campos da seção Adulterado
                            document.getElementById('chassi_adulterado').value = "";
                            document.getElementById('chassiAdulteradoDisplay').innerHTML = "";
                            document.getElementById('arquivo_chassi_adulterado').value = "";
                            document.getElementById('nao-tem-foto-chassi-adulterado').checked = false;
                            document.getElementById('image-preview-chassi-adulterado').style.width = '0px';
                            document.getElementById('campoTransplante').value = "";
                            document.getElementById('campoReparos').value = "";
                            document.getElementById('tipoadulteracao').value = "";
                            document.getElementById('metodologiaChassi').value = "";
                            document.getElementById('resultadoChassi').value = "";
                            document.getElementById('chassiRevelado').value = "";
                            document.getElementById('chassiReveladoDisplay').innerHTML = "";
                            document.getElementById('fotoChassiRevelado').value = "";
                            document.getElementById('nao-tem-foto-chassi-revelado').checked = false;
                            document.getElementById('image-preview-chassi-revelado').style.width = '0px';
                            document.getElementById('chassiReveladoParcialmente').value = "";
                            document.getElementById('chassiReveladoParcialmenteDisplay').innerHTML = "";
                            document.getElementById('fotoChassiReveladoParcialmente').value = "";
                            document.getElementById('nao-tem-foto-chassi-revelado-parcialmente').checked = false;
                            document.getElementById('image-preview-chassi-revelado-parcialmente').style.width = '0px';
                            document.getElementById('chassiCorroborado').value = ""; // Adicionado
                            document.getElementById('chassiCorroboradoDisplay').innerHTML = ""; // Adicionado
                            document.getElementById('fotoChassiCorroborado').value = ""; // Adicionado
                            document.getElementById('nao-tem-foto-chassi-corroborado').checked = false; // Adicionado

                        } else if (tipo === 'adulterado') {
                            // Limpa os campos da seção Integro
                            document.getElementById("chassiAtual").value = "";
                            document.getElementById("fotoChassiAtual").value = "";
                            document.getElementById("chassiAtualDisplay").innerHTML = "";
                            document.getElementById("image-preview-chassi").style.width = '0px';
                            document.getElementById("cropped-result-chassi").getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

                            // Limpa os campos da seção Adulterado
                            document.getElementById('chassi_adulterado').value = "";
                            document.getElementById('chassiAdulteradoDisplay').innerHTML = "";
                            document.getElementById('arquivo_chassi_adulterado').value = "";
                            document.getElementById('nao-tem-foto-chassi-adulterado').checked = false;
                            document.getElementById('image-preview-chassi-adulterado').style.width = '0px';
                            document.getElementById('campoTransplante').value = "";
                            document.getElementById('campoReparos').value = "";
                            document.getElementById('tipoadulteracao').value = "";
                            document.getElementById('metodologiaChassi').value = "";
                            document.getElementById('resultadoChassi').value = "";
                            document.getElementById('chassiRevelado').value = "";
                            document.getElementById('chassiReveladoDisplay').innerHTML = "";
                            document.getElementById('fotoChassiRevelado').value = "";
                            document.getElementById('nao-tem-foto-chassi-revelado').checked = false;
                            document.getElementById('image-preview-chassi-revelado').style.width = '0px';
                            document.getElementById('chassiReveladoParcialmente').value = "";
                            document.getElementById('chassiReveladoParcialmenteDisplay').innerHTML = "";
                            document.getElementById('fotoChassiReveladoParcialmente').value = "";
                            document.getElementById('nao-tem-foto-chassi-revelado-parcialmente').checked = false;
                            document.getElementById('image-preview-chassi-revelado-parcialmente').style.width = '0px';
                            document.getElementById('chassiCorroborado').value = ""; // Adicionado
                            document.getElementById('chassiCorroboradoDisplay').innerHTML = ""; // Adicionado
                            document.getElementById('fotoChassiCorroborado').value = ""; // Adicionado
                            document.getElementById('nao-tem-foto-chassi-corroborado').checked = false; // Adicionado
                        }
                    }

                    // Adiciona evento de mudança nos botões de opção
                    document.querySelectorAll('input[name="chassi_status"]').forEach(function (radio) {
                        radio.addEventListener('change', function () {
                            const tipo = this.value;
                            limparCampos(tipo);
                        });
                    });

                    // Função para alternar campos visíveis entre Íntegro e Adulterado
                    function toggleFields(tipo) {
                        if (tipo === 'chassi') {
                            const integroFieldsChassi = document.getElementById("integroFieldsChassi");
                            const adulteradoFieldsChassi = document.getElementById("adulteradoFieldsChassi");

                            // Verifica o status selecionado (radio button)
                            const statusChassi = document.querySelector('input[name="chassi_status"]:checked').value;

                            if (statusChassi === 'integro') {
                                // Limpa os campos da seção Adulterado antes de ocultá-la
                                limparCampos('adulterado', 'chassi');
                                integroFieldsChassi.style.display = 'block';
                                adulteradoFieldsChassi.style.display = 'none';
                            } else {
                                // Limpa os campos da seção Integro antes de ocultá-la
                                limparCampos('integro', 'chassi');
                                integroFieldsChassi.style.display = 'none';
                                adulteradoFieldsChassi.style.display = 'block';
                            }
                        } else if (tipo === 'motor') {
                            const integroFieldsMotor = document.getElementById("integroFieldsMotor");
                            const adulteradoFieldsMotor = document.getElementById("adulteradoFieldsMotor");

                            // Verifica o status selecionado (radio button)
                            const statusMotor = document.querySelector('input[name="motor_status"]:checked').value;

                            if (statusMotor === 'integro') {
                                // Limpa os campos da seção Adulterado antes de ocultá-la
                                limparCampos('adulterado', 'motor');
                                integroFieldsMotor.style.display = 'block';
                                adulteradoFieldsMotor.style.display = 'none';
                            } else {
                                // Limpa os campos da seção Integro antes de ocultá-la
                                limparCampos('integro', 'motor');
                                integroFieldsMotor.style.display = 'none';
                                adulteradoFieldsMotor.style.display = 'block';
                            }
                        }
                    }



                </script>
                <br>
                <hr><br>

                <div class="button-group"><!-- Seção do Motor -->
                    <div class="section-title" style="font-size: 25px;">Motor</div>
                    <div class="radio-group">
                        <label>Situação:</label>
                        <label>
                            <input type="radio" name="motor_status" value="integro" onchange="toggleFields('motor')"
                                required> Íntegro
                        </label>
                        <label>
                            <input type="radio" name="motor_status" value="adulterado" onchange="toggleFields('motor')"
                                required>
                            Adulterado
                        </label>
                        <label>
                            <input type="radio" name="motor_status" value="sem_motor" onchange="toggleFields('motor')"
                                required>
                            Sem motor
                        </label>
                    </div>



                    <div class="conditional-fields" id="integroFieldsMotor">
                        <div class="form-group">
                            <label for="motorAtual">Número do Motor:</label>
                            <input type="text" id="motorAtual" name="motor_numero" maxlength="20"
                                placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                                oninput="updateChassiDisplay(this, 'motorAtualDisplay')">
                            <div id="motorAtualDisplay" class="chassi-display"></div>
                        </div>
                        <div class="form-group">
                            <label for="fotoMotorAtual">Foto do Motor:</label>
                            <input type="file" id="fotoMotorAtual" name="motor_foto" class="image-input">
                            <label>
                                <input type="checkbox" id="nao-tem-foto-motor" name="motor_nao_tem_foto"
                                    onchange="toggleFotoMotor()"> Não tem foto
                            </label>
                        </div>
                        <div class="crop-container">
                            <img id="image-preview-motor" alt="Preview" style="width: 0px"
                                src="{{ asset('image/add-image.png') }}" class="image-preview">
                        </div>
                        <button id="crop-button-motor" style="display:none;">Recortar</button>
                        <canvas id="cropped-result-motor"></canvas>
                        <br><br>
                        <!--<div class="button-grouplimpar">
    <button type="button" onclick="toggleFieldsMotor(); limparCamposMotor('integro');">Limpar campos</button>


    </div>-->

                    </div>

                    <div class="conditional-fields" id="adulteradoFieldsMotor">
                        <div class="form-group">
                            <label for="motorAdulterado">Motor Adulterado:</label>
                            <input type="text" id="motorAdulterado" name="motor_adulterado_numero" maxlength="20"
                                placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                                oninput="updateChassiDisplay(this, 'motorAdulteradoDisplay')">
                            <div id="motorAdulteradoDisplay" class="chassi-display"></div>
                        </div>
                        <div class="form-group">
                            <label for="arquivoMotorAdulterado">Foto do Motor Adulterado:</label>
                            <input type="file" id="arquivoMotorAdulterado" name="motor_adulterado_foto" class="image-input">
                            <label>
                                <input type="checkbox" id="nao-tem-foto-motor-adulterado"
                                    onchange="toggleFotoMotorAdulterado()"> Não tem foto
                            </label>
                        </div>
                        <div class="crop-container">
                            <img id="image-preview-motor-adulterado" alt="Preview" style="width: 0px"
                                src="{{ asset('image/add-image.png') }}" class="image-preview">
                        </div>
                        <button id="crop-button-motor-adulterado" style="display:none;">Recortar</button>
                        <canvas id="cropped-result-motor-adulterado"></canvas>
                        <div class="form-group">
                            <label for="tipoadulteracaoMotor">Tipo de adulteração:</label>
                            <select id="tipoadulteracaoMotor" name="motor_tipo_adulteracao"
                                onchange="bloquearCampos('motor', 'Motor'); mostrarInformacoesReparosMotor(); mostrarInformacoesTransplanteMotor();">
                                <option value="">Selecione</option>
                                <option value="adulteracao_simples">Adulteração simples</option>
                                <option value="sem_numero_motor">Chapa sem número</option>
                                <option value="contundencia_nao_revelado">Contundência</option>
                                <option value="desbaste_revelado">Desbaste</option>
                                <option value="desbaste_regravação_nao_revelado">Desbaste e regravação</option>
                                <option value="implante_motor">Implante</option>
                                <option value="nao_localizado">Não localizado</option>
                                <option value="oxidacao_motor">Oxidação</option>
                                <option value="recortado">Recortado</option>
                                <option value="remarcado_nao_confirmado">Remarcado</option>
                                <option value="reparos_motor">Reparos</option>
                                <option value="substituido_transplante">Substituído</option>
                                <option value="transplate_motor">Transplante</option><!--Ta errado mesmo - transplante -->
                            </select>
                        </div>

                        <div id="caixaTextoReparosMotor" class="caixaTexto" style="display: none;">
                            <label for="campoReparosMotor">Informações sobre os Reparos:</label>
                            <textarea id="campoReparosMotor" name="reparo_motor" rows="4" cols="50"></textarea>
                        </div>

                        <div id="caixaTextoTransplanteMotor" class="caixaTexto" style="display: none;">
                            <label for="campoTransplanteMotor">Informações sobre o Transplante:</label>
                            <textarea id="campoTransplanteMotor" name="transplante_motor_text" rows="4"
                                cols="50"></textarea>
                        </div>




                        <div class="form-group">
                            <label for="metodologiaMotor">Metodologia Aplicada:</label>
                            <select id="metodologiaMotor" name="motor_metodologia">
                                <option value="">Selecione</option>
                                <option value="tratamento_quimico">Aplicar tratamento químico - Metalográfico</option>
                                <option value="instrumento_optico">Utilização de instrumento óptico adequado (LUPA)</option>
                            </select>
                            {{-- <label>
                                <input type="checkbox" id="nao-se-aplica-metodologia-motor"
                                    name="motor_nao_se_aplica_metodologia" onchange="toggleMetodologiaMotor()"> Não se
                                aplica
                            </label>--}}
                        </div>

                        <div class="form-group">
                            <label for="resultadoMotor">Resultado:</label>
                            <select id="resultadoMotor" name="motor_resultado" onchange="toggleReveladoFields('motor')">
                                <option value="">Selecione</option>
                                <option value="corroborado">Corroborado</option>
                                <option value="nao_confirmado">Não confirmado</option>
                                <option value="nao_revelado">Não revelado</option>
                                <option value="revelado">Revelado</option>
                                <option value="revelado_parcialmente">Revelado parcialmente</option>


                            </select>
                            {{--<label>
                                <input type="checkbox" id="nao-se-aplica-resultado-motor"
                                    name="motor_nao_se_aplica_resultado" onchange="toggleResultadoMotor()"> Não se aplica
                            </label> --}}
                        </div>

                        <!--Campos para preencher quando for motor revelado no resultado-->
                        <div class="motor-revelado-fields" id="motor-revelado">
                            <div class="form-group">
                                <label for="motorRevelado">Número do motor revelado:</label>
                                <input type="text" id="motorRevelado" name="motor_revelado_numero" maxlength="20"
                                    placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                                    oninput="updateChassiDisplay(this, 'motorReveladoDisplay')">
                                <div id="motorReveladoDisplay" class="chassi-display"></div>
                            </div>
                            <div class="form-group">
                                <label for="fotoMotorRevelado">Foto do motor:</label>
                                <input type="file" id="fotoMotorRevelado" name="motor_revelado_foto" class="image-input">
                                <label>
                                    <input type="checkbox" id="nao-tem-foto-motor-revelado"
                                        onchange="toggleFotoMotorRevelado()"> Não tem foto
                                </label>
                            </div>
                            <div class="crop-container">
                                <img id="image-preview-motor-revelado" alt="Preview" style="width: 0px"
                                    src="{{ asset('image/add-image.png') }}" class="image-preview">
                            </div>
                            <button id="crop-button-motor-revelado" style="display:none;">Recortar</button>
                            <canvas id="cropped-result-motor-revelado"></canvas>
                        </div>
                        <!-- Campo Corroborado para o Motor -->
                        <div class="motor-revelado-fields" id="motor-corroborado">
                            <div class="form-group">
                                <label for="motorCorroborado">Número do motor corroborado:</label>
                                <input type="text" id="motorCorroborado" name="motor_corroborado_numero" maxlength="20"
                                    placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                                    oninput="updateChassiDisplay(this, 'motorCorroboradoDisplay')">
                                <div id="motorCorroboradoDisplay" class="chassi-display"></div>
                            </div>
                            <div class="form-group">
                                <label for="fotoMotorCorroborado">Foto do motor corroborado:</label>
                                <input type="file" id="fotoMotorCorroborado" name="motor_corroborado_foto"
                                    class="image-input">
                                <label>
                                    <input type="checkbox" id="nao-tem-foto-motor-corroborado"
                                        onchange="toggleFotoMotorCorroborado()"> Não tem foto
                                </label>
                            </div>
                            <div class="crop-container">
                                <img id="image-preview-motor-corroborado" alt="Preview" style="width: 0px"
                                    src="{{ asset('image/add-image.png') }}" class="image-preview">
                            </div>
                            <button id="crop-button-motor-corroborado" style="display:none;">Recortar</button>
                            <canvas id="cropped-result-motor-corroborado"></canvas>

                            <!--Campos para preencher caso resultaso de motor seja Revelado parcialmente-->
                            <div class="motor-revelado-fields" id="motor-revelado-parcialmente">
                                <div class="form-group">
                                    <label for="motorReveladoParcialmente">Motor Revelado Parcialmente:</label>
                                    <input type="text" id="motorReveladoParcialmente"
                                        name="motor_revelado_parcialmente_numero" maxlength="20"
                                        placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                                        oninput="updateChassiDisplay(this, 'motorReveladoParcialmenteDisplay')">
                                    <div id="motorReveladoParcialmenteDisplay" class="chassi-display"></div>
                                </div>
                                <div class="form-group">
                                    <label for="fotoMotorReveladoParcialmente">Foto do Motor Revelado Parcialmente:</label>
                                    <input type="file" id="fotoMotorReveladoParcialmente"
                                        name="motor_revelado_parcialmente_foto" class="image-input">
                                    <label>
                                        <input type="checkbox" id="nao-tem-foto-motor-revelado-parcialmente"
                                            onchange="toggleFotoMotorReveladoParcialmente()"> Não tem foto
                                    </label>
                                </div>
                                <div class="crop-container">
                                    <img id="image-preview-motor-revelado-parcialmente" alt="Preview" style="width: 0px"
                                        src="{{ asset('image/add-image.png') }}" class="image-preview">
                                </div>
                                <button id="crop-button-motor-revelado-parcialmente" style="display:none;">Recortar</button>
                                <canvas id="cropped-result-motor-revelado-parcialmente"></canvas>

                            </div>

                        </div>
                        <!--  <div class="button-grouplimpar">
                <button type="button" onclick="limparCamposMotor('adulterado')">Limpar campos</button>
            </div>-->
                    </div>

                    <script>

                        // Função para alternar campos visíveis entre Íntegro e Adulterado para o motor
                        function toggleFieldsMotor() {
                            console.log('toggleFieldsMotor executado');
                            const integroFieldsMotor = document.getElementById("integroFieldsMotor");
                            const adulteradoFieldsMotor = document.getElementById("adulteradoFieldsMotor");

                            // Verifica o status selecionado (radio button)
                            const statusMotor = document.querySelector('input[name="motor_status"]:checked');

                            if (statusMotor) {
                                if (statusMotor.value === 'integro') {
                                    integroFieldsMotor.style.display = 'block';
                                    adulteradoFieldsMotor.style.display = 'none';
                                } else if (statusMotor.value === 'adulterado') {
                                    integroFieldsMotor.style.display = 'none';
                                    adulteradoFieldsMotor.style.display = 'block';
                                } else if (statusMotor.value === 'sem_motor') {
                                    integroFieldsMotor.style.display = 'none';
                                    adulteradoFieldsMotor.style.display = 'none';
                                    // Limpa os campos do motor
                                    limparCamposMotor('integro');
                                    limparCamposMotor('adulterado');
                                }
                            }
                        }

                        // Função para limpar campos do motor
                        function limparCamposMotor(tipo) {
                            if (tipo === 'integro') {
                                // Limpa os campos da seção Integro do motor
                                document.getElementById("motorAtual").value = "";
                                document.getElementById("fotoMotorAtual").value = "";
                                document.getElementById("motorAtualDisplay").innerHTML = "";
                                document.getElementById("image-preview-motor").style.width = '0px';
                                document.getElementById("cropped-result-motor").getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

                                // Limpa os campos da seção Adulterado do motor
                                document.getElementById('motorAdulterado').value = "";
                                document.getElementById('motorAdulteradoDisplay').innerHTML = "";
                                document.getElementById('arquivoMotorAdulterado').value = "";
                                document.getElementById('nao-tem-foto-motor-adulterado').checked = false;
                                document.getElementById('image-preview-motor-adulterado').style.width = '0px';
                                document.getElementById('campoTransplanteMotor').value = "";
                                document.getElementById('campoReparosMotor').value = "";
                                document.getElementById('tipoadulteracaoMotor').value = "";
                                document.getElementById('metodologiaMotor').value = "";
                                document.getElementById('resultadoMotor').value = "";
                                document.getElementById('motorRevelado').value = "";
                                document.getElementById('motorReveladoDisplay').innerHTML = "";
                                document.getElementById('fotoMotorRevelado').value = "";
                                document.getElementById('nao-tem-foto-motor-revelado').checked = false;
                                document.getElementById('image-preview-motor-revelado').style.width = '0px';
                                document.getElementById('motorReveladoParcialmente').value = "";
                                document.getElementById('motorReveladoParcialmenteDisplay').innerHTML = "";
                                document.getElementById('fotoMotorReveladoParcialmente').value = "";
                                document.getElementById('nao-tem-foto-motor-revelado-parcialmente').checked = false;
                                document.getElementById('image-preview-motor-revelado-parcialmente').style.width = '0px';
                                document.getElementById('motorCorroborado').value = ""; // Adicionado
                                document.getElementById('motorCorroboradoDisplay').innerHTML = ""; // Adicionado
                                document.getElementById('fotoMotorCorroborado').value = ""; // Adicionado
                                document.getElementById('nao-tem-foto-motor-corroborado').checked = false; // Adicionado

                            } else if (tipo === 'adulterado') {
                                // Limpa os campos da seção Integro do motor
                                document.getElementById("motorAtual").value = "";
                                document.getElementById("fotoMotorAtual").value = "";
                                document.getElementById("motorAtualDisplay").innerHTML = "";
                                document.getElementById("image-preview-motor").style.width = '0px';
                                document.getElementById("cropped-result-motor").getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

                                // Limpa os campos da seção Adulterado do motor
                                document.getElementById('motorAdulterado').value = "";
                                document.getElementById('motorAdulteradoDisplay').innerHTML = "";
                                document.getElementById('arquivoMotorAdulterado').value = "";
                                document.getElementById('nao-tem-foto-motor-adulterado').checked = false;
                                document.getElementById('image-preview-motor-adulterado').style.width = '0px';
                                document.getElementById('campoTransplanteMotor').value = "";
                                document.getElementById('campoReparosMotor').value = "";
                                document.getElementById('tipoadulteracaoMotor').value = "";
                                document.getElementById('metodologiaMotor').value = "";
                                document.getElementById('resultadoMotor').value = "";
                                document.getElementById('motorRevelado').value = "";
                                document.getElementById('motorReveladoDisplay').innerHTML = "";
                                document.getElementById('fotoMotorRevelado').value = "";
                                document.getElementById('nao-tem-foto-motor-revelado').checked = false;
                                document.getElementById('image-preview-motor-revelado').style.width = '0px';
                                document.getElementById('motorReveladoParcialmente').value = "";
                                document.getElementById('motorReveladoParcialmenteDisplay').innerHTML = "";
                                document.getElementById('fotoMotorReveladoParcialmente').value = "";
                                document.getElementById('nao-tem-foto-motor-revelado-parcialmente').checked = false;
                                document.getElementById('image-preview-motor-revelado-parcialmente').style.width = '0px';
                                document.getElementById('motorCorroborado').value = ""; // Adicionado
                                document.getElementById('motorCorroboradoDisplay').innerHTML = ""; // Adicionado
                                document.getElementById('fotoMotorCorroborado').value = ""; // Adicionado
                                document.getElementById('nao-tem-foto-motor-corroborado').checked = false; // Adicionado
                            }
                        }

                        // Adiciona evento de mudança nos botões de opção do motor
                        document.querySelectorAll('input[name="motor_status"]').forEach(function (radio) {
                            radio.addEventListener('change', toggleFieldsMotor);
                        });
                    </script>




                    <div class="nav-buttons">
                        <button id="prev" onclick="window.history.back()">Voltar</button>
                        <button type="submit">Avançar</button>
                    </div>
            </form>


            <script>
                // Função para mostrar/ocultar o campo de "Informações sobre os Reparos" no motor
                function mostrarInformacoesReparosMotor() {
                    const tipoadulteracaoMotor = document.getElementById('tipoadulteracaoMotor').value;
                    const caixaTextoReparosMotor = document.getElementById('caixaTextoReparosMotor');

                    if (tipoadulteracaoMotor === 'reparos_motor') {
                        caixaTextoReparosMotor.style.display = 'block';  // Exibe o campo
                    } else {
                        caixaTextoReparosMotor.style.display = 'none';  // Oculta o campo
                    }
                }

                // Função para mostrar/ocultar o campo de "Informações sobre o Transplante" no motor
                function mostrarInformacoesTransplanteMotor() {
                    const tipoadulteracaoMotor = document.getElementById('tipoadulteracaoMotor').value;
                    const caixaTextoTransplanteMotor = document.getElementById('caixaTextoTransplanteMotor');

                    if (tipoadulteracaoMotor === 'transplate_motor') {
                        caixaTextoTransplanteMotor.style.display = 'block';  // Exibe o campo
                    } else {
                        caixaTextoTransplanteMotor.style.display = 'none';  // Oculta o campo
                    }
                }


            </script>

            <script>
                // Função para mostrar/ocultar o campo de "Informações sobre o Transplante"
                function mostrarInformacoesTransplante() {
                    const tipoadulteracao = document.getElementById('tipoadulteracao').value;
                    const caixaTextoTransplante = document.getElementById('caixaTextoTransplante');

                    if (tipoadulteracao === 'transplante_chassi') {
                        caixaTextoTransplante.style.display = 'block';  // Exibe o campo
                    } else {
                        caixaTextoTransplante.style.display = 'none';  // Oculta o campo
                    }
                }

                // Função para mostrar/ocultar o campo de "Informações sobre os Reparos"
                function mostrarInformacoesReparos() {
                    const tipoadulteracao = document.getElementById('tipoadulteracao').value;
                    const caixaTextoReparos = document.getElementById('caixaTextoReparos');

                    if (tipoadulteracao === 'reparos_chassi') {
                        caixaTextoReparos.style.display = 'block';  // Exibe o campo
                    } else {
                        caixaTextoReparos.style.display = 'none';  // Oculta o campo
                    }
                }


            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
            <script>

                function initializeCropper(inputId, previewId, cropButtonId, resultId) {
                    let cropper;

                    document.getElementById(inputId).addEventListener("change", function (event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                const imagePreview = document.getElementById(previewId);
                                imagePreview.src = e.target.result;
                                imagePreview.style.display = "block";

                                if (cropper) {
                                    cropper.destroy();
                                }

                                cropper = new Cropper(imagePreview, {
                                    aspectRatio: NaN,
                                    viewMode: 1,
                                    zoomable: true,
                                    movable: true,
                                    scalable: true,
                                    autoCropArea: 0.7
                                });

                                document.getElementById(cropButtonId).style.display = "block";
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                    document.getElementById(cropButtonId).addEventListener("click", function () {
                        if (cropper) {
                            const canvas = cropper.getCroppedCanvas({
                                width: 600,
                                height: 300
                            });

                            const croppedResult = document.getElementById(resultId);
                            const ctx = croppedResult.getContext("2d");
                            croppedResult.width = canvas.width;
                            croppedResult.height = canvas.height;
                            ctx.clearRect(0, 0, canvas.width, canvas.height);
                            ctx.drawImage(canvas, 0, 0);
                        }
                    });
                }


                initializeCropper("fotoChassiAtual", "image-preview-chassi", "crop-button-chassi", "cropped-result-chassi");
                initializeCropper("arquivo_chassi_adulterado", "image-preview-chassi-adulterado", "crop-button-chassi-adulterado", "cropped-result-chassi-adulterado");
                initializeCropper("fotoChassiRevelado", "image-preview-chassi-revelado", "crop-button-chassi-revelado", "cropped-result-chassi-revelado");
                initializeCropper("fotoChassiReveladoParcialmente", "image-preview-chassi-revelado-parcialmente", "crop-button-chassi-revelado-parcialmente", "cropped-result-chassi-revelado-parcialmente");
                initializeCropper("fotoMotorAtual", "image-preview-motor", "crop-button-motor", "cropped-result-motor");
                initializeCropper("arquivoMotorAdulterado", "image-preview-motor-adulterado", "crop-button-motor-adulterado", "cropped-result-motor-adulterado");
                initializeCropper("fotoMotorRevelado", "image-preview-motor-revelado", "crop-button-motor-revelado", "cropped-result-motor-revelado");
                initializeCropper("fotoMotorReveladoParcialmente", "image-preview-motor-revelado-parcialmente", "crop-button-motor-revelado-parcialmente", "cropped-result-motor-revelado-parcialmente");
                initializeCropper("fotoChassiCorroborado", "image-preview-chassi-corroborado", "crop-button-chassi-corroborado", "cropped-result-chassi-corroborado");
                initializeCropper("fotoMotorCorroborado", "image-preview-motor-corroborado", "crop-button-motor-corroborado", "cropped-result-motor-corroborado");


                // Bloquear campos motor
                function bloquearCampos(tipo, secao) {
                    const select = document.getElementById(`tipoadulteracao${secao}`);
                    const numeroInput = document.getElementById(`${tipo}Adulterado`);
                    const fotoInput = document.getElementById(`arquivo${secao}Adulterado`);
                    const metodologiaSelect = document.getElementById(`metodologia${secao}`);
                    const resultadoSelect = document.getElementById(`resultado${secao}`);

                    if (select.value === 'recortado' || select.value === 'sem_numero_motor') {
                        if (numeroInput) numeroInput.disabled = true;
                        if (fotoInput) fotoInput.disabled = false; // Apenas a foto fica ativa
                        if (metodologiaSelect) metodologiaSelect.disabled = true;
                        if (resultadoSelect) resultadoSelect.disabled = true;
                    } else if (['substituido_transplante', 'nao_localizado'].includes(select.value)) {
                        if (numeroInput) numeroInput.disabled = true;
                        if (fotoInput) fotoInput.disabled = true;
                        if (metodologiaSelect) metodologiaSelect.disabled = true;
                        if (resultadoSelect) resultadoSelect.disabled = true;
                    } else {
                        if (numeroInput) numeroInput.disabled = false;
                        if (fotoInput) fotoInput.disabled = false;
                        if (metodologiaSelect) metodologiaSelect.disabled = false;
                        if (resultadoSelect) resultadoSelect.disabled = false;
                    }
                }

                // bloquear campos Chassi
                function bloquearrCampos(section, tipo) {
                    const tipoadulteracao = document.getElementById('tipoadulteracao').value;
                    const chassiAdulterado = document.getElementById('chassi_adulterado');
                    const arquivoChassiAdulterado = document.getElementById('arquivo_chassi_adulterado');
                    const metodologiaChassi = document.getElementById('metodologiaChassi');
                    const resultadoChassi = document.getElementById('resultadoChassi');

                    if (tipoadulteracao === 'recortado' ||
                        tipoadulteracao === 'sem_numero_chassi') {
                        if (chassiAdulterado) chassiAdulterado.disabled = true;
                        if (arquivoChassiAdulterado) arquivoChassiAdulterado.disabled = false; // Apenas a foto fica ativa
                        if (metodologiaChassi) metodologiaChassi.disabled = true;
                        if (resultadoChassi) resultadoChassi.disabled = true;
                    } else if (tipoadulteracao === 'substituido_transplante' ||
                        tipoadulteracao === 'nao_localizado') {
                        if (chassiAdulterado) chassiAdulterado.disabled = true;
                        if (arquivoChassiAdulterado) arquivoChassiAdulterado.disabled = true;
                        if (metodologiaChassi) metodologiaChassi.disabled = true;
                        if (resultadoChassi) resultadoChassi.disabled = true;
                    } else {
                        if (chassiAdulterado) chassiAdulterado.disabled = false;
                        if (arquivoChassiAdulterado) arquivoChassiAdulterado.disabled = false;
                        if (metodologiaChassi) metodologiaChassi.disabled = false;
                        if (resultadoChassi) resultadoChassi.disabled = false;
                    }
                }




                // Toggle fields
                function toggleFields(type) {
                    const status = document.querySelector(`input[name="${type}_status"]:checked`)?.value;

                    const integroFields = document.getElementById(`integroFields${type.charAt(0).toUpperCase() + type.slice(1)}`);
                    const adulteradoFields = document.getElementById(`adulteradoFields${type.charAt(0).toUpperCase() + type.slice(1)}`);

                    if (status === "integro") {
                        integroFields.style.display = "block";
                        adulteradoFields.style.display = "none";
                    } else {
                        integroFields.style.display = "none";
                        adulteradoFields.style.display = "block";
                    }
                }


                // Update chassi display
                function updateChassiDisplay(input, displayId) {
                    const displayDiv = document.getElementById(displayId);
                    displayDiv.innerHTML = "";

                    input.value.split("").forEach(char => {
                        const charDiv = document.createElement("div");
                        charDiv.textContent = char;
                        charDiv.style.display = "inline-block";
                        charDiv.style.width = "20px";
                        charDiv.style.height = "30px";
                        charDiv.style.textAlign = "center";
                        charDiv.style.lineHeight = "30px";
                        charDiv.style.border = "1px solid black";
                        charDiv.style.fontSize = "18px";
                        charDiv.style.fontWeight = "bold";
                        displayDiv.appendChild(charDiv);
                    });
                }


                // Toggle revelado fields
                // Toggle revelado fields
                // Função para mostrar/ocultar o campo de "Informações sobre os Reparos" no motor
                function mostrarInformacoesReparosMotor() {
                    const tipoadulteracaoMotor = document.getElementById('tipoadulteracaoMotor').value;
                    const caixaTextoReparosMotor = document.getElementById('caixaTextoReparosMotor');

                    if (tipoadulteracaoMotor === 'reparos_motor') {
                        caixaTextoReparosMotor.style.display = 'block';  // Exibe o campo
                    } else {
                        caixaTextoReparosMotor.style.display = 'none';  // Oculta o campo
                    }
                }

                // Função para mostrar/ocultar o campo de "Informações sobre o Transplante" no motor
                function mostrarInformacoesTransplanteMotor() {
                    const tipoadulteracaoMotor = document.getElementById('tipoadulteracaoMotor').value;
                    const caixaTextoTransplanteMotor = document.getElementById('caixaTextoTransplanteMotor');

                    if (tipoadulteracaoMotor === 'transplate_motor') {
                        caixaTextoTransplanteMotor.style.display = 'block';  // Exibe o campo
                    } else {
                        caixaTextoTransplanteMotor.style.display = 'none';  // Oculta o campo
                    }
                }

                // Toggle revelado fields
                function toggleReveladoFields(type) {
                    const resultado = document.getElementById(`resultado${type.charAt(0).toUpperCase() + type.slice(1)}`).value;
                    console.log(`Tipo: ${type}, Resultado: ${resultado}`); // Log para depuração

                    const reveladoFields = document.getElementById(`${type}-revelado`);
                    const corroboradoFields = document.getElementById(`${type}-corroborado`);
                    const reveladoParcialmenteFields = document.getElementById(`${type}-revelado-parcialmente`);
                    const naoReveladoFields = document.getElementById(`nao-revelado-${type}`);

                    if (resultado === "revelado") {
                        console.log("Mostrando campos Revelado");
                        reveladoFields.style.display = "block";
                        corroboradoFields.style.display = "none";
                        reveladoParcialmenteFields.style.display = "none";
                        naoReveladoFields.style.display = "none";
                    } else if (resultado === "corroborado") {
                        console.log("Mostrando campos Corroborado");
                        reveladoFields.style.display = "none";
                        corroboradoFields.style.display = "block";
                        reveladoParcialmenteFields.style.display = "none";
                        naoReveladoFields.style.display = "none";
                    } else if (resultado === "revelado_parcialmente") {
                        console.log("Mostrando campos Revelado Parcialmente");
                        reveladoFields.style.display = "none";
                        corroboradoFields.style.display = "none";
                        reveladoParcialmenteFields.style.display = "block";
                        naoReveladoFields.style.display = "none";
                    } else if (resultado === "nao_revelado" || resultado === "nao_confirmado") {
                        console.log("Mostrando campos Não Revelado");
                        reveladoFields.style.display = "none";
                        corroboradoFields.style.display = "none";
                        reveladoParcialmenteFields.style.display = "none";
                        naoReveladoFields.style.display = "block";
                    } else {
                        console.log("Ocultando todos os campos");
                        reveladoFields.style.display = "none";
                        corroboradoFields.style.display = "none";
                        reveladoParcialmenteFields.style.display = "none";
                        naoReveladoFields.style.display = "none";
                    }
                }

                // Adiciona o evento de change para o campo 'resultadoMotor'
                document.getElementById('resultadoMotor').addEventListener('change', function () {
                    toggleReveladoFields('motor');
                });



                // Toggle foto chassi
                function toggleFotoChassi() {
                    toggleFotoInput("nao-tem-foto-chassi", "fotoChassiAtual");
                }

                // Toggle foto chassi revelado
                function toggleFotoChassiRevelado() {
                    toggleFotoInput("nao-tem-foto-chassi-revelado", "fotoChassiRevelado");
                }

                // Toggle foto chassi revelado parcialmente
                function toggleFotoChassiReveladoParcialmente() {
                    toggleFotoInput("nao-tem-foto-chassi-revelado-parcialmente", "fotoChassiReveladoParcialmente");
                }

                // Toggle foto motor
                function toggleFotoMotor() {
                    toggleFotoInput("nao-tem-foto-motor", "fotoMotorAtual");
                }

                // Toggle foto motor revelado
                function toggleFotoMotorRevelado() {
                    toggleFotoInput("nao-tem-foto-motor-revelado", "fotoMotorRevelado");
                }

                // Toggle foto motor revelado parcialmente
                function toggleFotoMotorReveladoParcialmente() {
                    toggleFotoInput("nao-tem-foto-motor-revelado-parcialmente", "fotoMotorReveladoParcialmente");
                }

                // Toggle foto chassi adulterado
                function toggleFotoChassiAdulterado() {
                    toggleFotoInput("nao-tem-foto-chassi-adulterado", "arquivo_chassi_adulterado");
                }

                // Toggle foto motor adulterado
                function toggleFotoMotorAdulterado() {
                    toggleFotoInput("nao-tem-foto-motor-adulterado", "arquivoMotorAdulterado");
                }


                // Toggle foto input
                function toggleFotoInput(checkboxId, fileInputId) {
                    const checkbox = document.getElementById(checkboxId);
                    const fileInput = document.getElementById(fileInputId);

                    if (checkbox.checked) {
                        fileInput.disabled = true;
                    } else {
                        fileInput.disabled = false;
                    }
                }


                // Toggle metodologia chassi
                function toggleMetodologiaChassi() {
                    const checkbox = document.getElementById("nao-se-aplica-metodologia-chassi");
                    const select = document.getElementById("metodologiaChassi");

                    if (checkbox.checked) {
                        select.disabled = true;
                    } else {
                        select.disabled = false;
                    }
                }


                // Toggle resultado chassi
                function toggleResultadoChassi() {// 
                    const checkbox = document.getElementById("nao-se-aplica-resultado-chassi");
                    const select = document.getElementById("resultadoChassi");

                    if (checkbox.checked) {
                        select.disabled = true;
                    } else {
                        select.disabled = false;
                    }
                }


                // Toggle metodologia motor
                function toggleMetodologiaMotor() {
                    const checkbox = document.getElementById("nao-se-aplica-metodologia-motor");
                    const select = document.getElementById("metodologiaMotor");

                    if (checkbox.checked) {
                        select.disabled = true;
                    } else {
                        select.disabled = false;
                    }
                }


                // Toggle resultado motor
                function toggleResultadoMotor() {
                    const checkbox = document.getElementById("nao-se-aplica-resultado-motor");
                    const select = document.getElementById("resultadoMotor");

                    if (checkbox.checked) {
                        select.disabled = true;
                    } else {
                        select.disabled = false;
                    }
                }
                // Toggle foto motor corroborado
                function toggleFotoMotorCorroborado() {
                    toggleFotoInput("nao-tem-foto-motor-corroborado", "fotoMotorCorroborado");
                }

                // Toggle foto chassi corroborado
                function toggleFotoChassiCorroborado() {
                    toggleFotoInput("nao-tem-foto-chassi-corroborado", "fotoChassiCorroborado");
                }

            </script>
@endsection