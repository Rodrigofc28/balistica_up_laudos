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

/* Estilo do contêiner */
/* Estilo do contêiner */
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
    max-width: none; /* Permite que a imagem ultrapasse a largura máxima para zoom */
    transform-origin: center center; /* Zoom centrado */
    transition: transform 0.3s ease; /* Transição suave */
    position: absolute; /* Para poder mover a imagem dentro do contêiner */
}

/* Limitação do tamanho do preview */
.image-preview {
    max-width: 300px;
    max-height: 100px;
    overflow: hidden;
    border: 1px solid #220000;
}

/* Resultado cortado */
#cropped-result {
    max-width: 300px;
    max-height: 300px;
    border: 1px solid #000000;
}


</style>
</head>

<body>
<div class="container">
    <header>
        <h1>Exame de Identificação Veicular</h1>
    </header>

    <div class="progress-container">
        <div class="progress-bar"></div>
        <div class="step active" id="step1">1</div>
        <div class="step" id="step2">2</div>
        <div class="step" id="step3">3</div>
        <div class="step" id="step4">4</div>
    </div>

    <h2>Motocicleta</h2>
 <form id="form" action="{{route('motocicleta.exame')}}" method="POST">
        {{ csrf_field() }}
        <input hidden  name="laudo_id" value="{{ $laudo->id}}">
    <div class="button-group" id="chassiSection"> <!-- Seção do Chassi -->
        <div class="section-title" style="font-size: 25px;">Chassi</div>
        <div class="radio-group">
            <label>Situação:</label>
            <label>
                <input type="radio" name="chassi_status" value="integro" onchange="toggleFields('chassi')"> Íntegro
            </label>
            <label>
                <input type="radio" name="chassi_status" value="adulterado" onchange="toggleFields('chassi')">
                Adulterado
            </label>
        </div>
        <div class="conditional-fields" id="integroFieldsChassi">
            <div class="form-group">
                <label for="chassiAtual">Número do Chassi:</label>
                <input type="text" id="chassiAtual" name="chassi_numero" maxlength="17"
                    placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                    oninput="updateChassiDisplay(this, 'chassiAtualDisplay')">
                <div id="chassiAtualDisplay" class="chassi-display"></div>
            </div>
    
            <div class="form-group">
                <label for="fotoChassiAtual">Foto do Chassi:</label>
                <input type="file" id="fotoChassiAtual" name="chassi_foto" class="image-input">
                <label>
                    <input type="checkbox" id="nao-tem-foto-chassi" name="chassi_nao_tem_foto"
                        onchange="toggleFotoChassi()"> Não tem foto
                </label>
            </div>
            <div class="crop-container">
                <img id="image-preview-chassi" alt="Preview" class="image-preview">
            </div>
            <button id="crop-button-chassi" style="display:none;">Recortar</button>
            <canvas id="cropped-result-chassi"></canvas>
       
        </div>
    
        <div class="conditional-fields" id="adulteradoFieldsChassi">
            <div class="form-group">
                <label for="chassiAdulterado">Chassi Adulterado:</label>
                <input type="text" id="chassi_adulterado" name="chassi_adulterado_numero" maxlength="17"
                    placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                    oninput="updateChassiDisplay(this, 'chassiAdulteradoDisplay')">
                <div id="chassiAdulteradoDisplay" class="chassi-display"></div>
            </div>
            <div class="form-group">
                <label for="arquivoChassiAdulterado">Foto do chassi adulterado:</label>
                <input type="file" id="arquivo_chassi_adulterado" name="chassi_adulterado_foto" class="image-input">
                <label>
                    <input type="checkbox" id="nao-tem-foto-chassi-adulterado" name="chassi_adulterado_nao_tem_foto"
                        onchange="toggleFotoChassiAdulterado()"> Não tem foto
                </label>
            </div>
            <div class="crop-container">
                <img id="image-preview-chassi-adulterado" alt="Preview" class="image-preview">
            </div>
            <button id="crop-button-chassi-adulterado" style="display:none;">Recortar</button>
            <canvas id="cropped-result-chassi-adulterado"></canvas>
            <div class="form-group">
                <label for="tipoadulteracao">Tipo de adulteração:</label>
                <select id="tipoadulteracao" name="chassi_tipo_adulteracao" onchange="bloquearrCampos('chassi', 'Chassi')">
                    <option value="selecione">Selecione</option>
                    <option value="desbaste_regravação_revelado">Desbaste e regravação</option>
                    <option value="contundencia_parcial">Contundência</option>
                    <option value="remarcado_corroborado">Remarcado</option>
                    <option value="desbaste_nao_revelado">Desbaste</option>
                    <option value="adulteracao_simples">Adulteração simples</option>
                    <option value="recortado">Recortado</option>
                    <option value="implante_chassi">Implante</option>
                    <option value="nao_localizado">Não localizado</option>
                    <option value="substituido_transplante">Substituído (transplante)</option>
                </select>
            </div>
    
            <div class="form-group">
                <label for="metodologiaChassi">Metodologia Aplicada:</label>
                <select id="metodologiaChassi" name="chassi_nao_se_aplica_metodologia">
                    <option value="">Selecione</option>
                    <option value="tratamento_quimico">Aplicar tratamento químico - Metalográfico</option>
                    <option value="instrumento_optico">Utilização de instrumento óptico adequado (LUPA)</option>
                </select>
                <label>
                    <input type="checkbox" id="nao-se-aplica-metodologia-chassi"
                        name="nao-se-aplica-metodologia-chassi" onchange="toggleMetodologiaChassi()"> Não se aplica
                </label>
            </div>
    
            <div class="form-group">
                <label for="resultadoChassi">Resultado:</label>
                <select id="resultadoChassi" name="chassi_resultado" onchange="toggleReveladoFields('chassi')">
                    <option value="">Selecione</option>
                    <option value="revelado">Revelado</option>
                    <option value="revelado_parcialmente">Revelado parcialmente</option>
                    <option value="nao_revelado">Não revelado</option>
                    <option value="corroborado">Corroborado</option>
                    <option value="nao_confirmado">Não confirmado</option>
                </select>
                <label>
                    <input type="checkbox" id="nao-se-aplica-resultado-chassi" name="chassi_nao_se_aplica_resultado"
                        onchange="toggleResultadoChassi()"> Não se aplica
                </label>
            </div>
            <div class="chassi-revelado-fields" id="chassi-revelado">
                <div class="form-group">
                    <label for="chassiRevelado">Número do Chassi:</label>
                    <input type="text" id="chassiRevelado" name="chassi_revelado_numero" maxlength="17"
                        placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                        oninput="updateChassiDisplay(this, 'chassiReveladoDisplay')">
                    <div id="chassiReveladoDisplay" class="chassi-display"></div>
                </div>
                <div class="form-group">
                    <label for="fotoChassiRevelado">Foto do Chassi:</label>
                    <input type="file" id="fotoChassiRevelado" name="chassi_revelado_foto" class="image-input">
                    <label>
                        <input type="checkbox" id="nao-tem-foto-chassi-revelado" name="chassi_revelado_nao_tem_foto"
                            onchange="toggleFotoChassiRevelado()"> Não tem foto
                    </label>
                </div>
                <div class="crop-container">
                    <img id="image-preview-chassi-revelado" alt="Preview" class="image-preview">
                </div>
                <button id="crop-button-chassi-revelado" style="display:none;">Recortar</button>
                <canvas id="cropped-result-chassi-revelado"></canvas>
            </div>
            <div class="chassi-revelado-fields" id="chassi-revelado-parcialmente">
                <div class="form-group">
                    <label for="chassiReveladoParcialmente">Chassi Revelado Parcialmente:</label>
                    <input type="text" id="chassiReveladoParcialmente" name="chassi_revelado_parcialmente_numero"
                        maxlength="17" placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                        oninput="updateChassiDisplay(this, 'chassiReveladoParcialmenteDisplay')">
                    <div id="chassiReveladoParcialmenteDisplay" class="chassi-display"></div>
                </div>
                <div class="form-group">
                    <label for="fotoChassiReveladoParcialmente">Foto do Chassi Revelado Parcialmente:</label>
                    <input type="file" id="fotoChassiReveladoParcialmente" name="chassi_revelado_parcialmente_foto"
                        class="image-input">
                    <label>
                        <input type="checkbox" id="nao-tem-foto-chassi-revelado-parcialmente"
                            name="chassi_revelado_parcialmente_nao_tem_fot"
                            onchange="toggleFotoChassiReveladoParcialmente()"> Não tem foto
                    </label>
                </div>
                <div class="crop-container">
                    <img id="image-preview-chassi-revelado-parcialmente" alt="Preview" class="image-preview">
                </div>
                <button id="crop-button-chassi-revelado-parcialmente" style="display:none;">Recortar</button>
                <canvas id="cropped-result-chassi-revelado-parcialmente"></canvas>
            </div>
            
        </div>
    </div>
    <br>  <hr><br>  
   
    <div class="button-group"><!-- Seção do Motor -->
        <div class="section-title" style="font-size: 25px;">Motor</div>
        <div class="radio-group">
            <label>Situação:</label>
            <label>
                <input type="radio" name="motor_status" value="integro" onchange="toggleFields('motor')"> Íntegro
            </label>
            <label>
                <input type="radio" name="motor_status" value="adulterado" onchange="toggleFields('motor')">
                Adulterado
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
                <input type="file" id="fotoMotorAtual" name="motor_adulterado_foto" class="image-input">
                <label>
                    <input type="checkbox" id="nao-tem-foto-motor" name="motor_adulterado_nao_tem_foto"
                        onchange="toggleFotoMotor()"> Não tem foto
                </label>
            </div>
            <div class="crop-container">
                <img id="image-preview-motor" alt="Preview" class="image-preview">
            </div>
            <button id="crop-button-motor" style="display:none;">Recortar</button>
            <canvas id="cropped-result-motor"></canvas>
          
        </div>
    
        <div class="conditional-fields" id="adulteradoFieldsMotor">
            <div class="form-group">
                <label for="motorAdulterado">Motor Adulterado:</label>
                <input type="text" id="motorAdulterado" name="motor_tipo_adulteracao" maxlength="20"
                    placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                    oninput="updateChassiDisplay(this, 'motorAdulteradoDisplay')">
                <div id="motorAdulteradoDisplay" class="chassi-display"></div>
            </div>
            <div class="form-group">
                <label for="arquivoMotorAdulterado">Arquivo do Motor Adulterado:</label>
                <input type="file" id="arquivoMotorAdulterado" name="motor_adulterado_nao_tem_foto" class="image-input">
                <label>
                    <input type="checkbox" id="nao-tem-foto-motor-adulterado" name="nao-tem-foto-motor-adulterado"
                        onchange="toggleFotoMotorAdulterado()"> Não tem foto
                </label>
            </div>
            <div class="crop-container">
                <img id="image-preview-motor-adulterado" alt="Preview" class="image-preview">
            </div>
            <button id="crop-button-motor-adulterado" style="display:none;">Recortar</button>
            <canvas id="cropped-result-motor-adulterado"></canvas>
            <div class="form-group">
                <label for="tipoadulteracaoMotor">Tipo de adulteração:</label>
                <select id="tipoadulteracaoMotor" name="motor_tipo_adulteracao"
                    onchange="bloquearCampos('motor', 'Motor')">
                    <option value="selecione">Selecione</option>
                    <option value="desbaste_regravação_nao_revelado">Desbaste e regravação</option>
                    <option value="contundencia_nao_revelado">Contundência</option>
                    <option value="desbaste_revelado">Desbaste</option>
                    <option value="remarcado_nao_confirmado">Remarcado</option>
                    <option value="recortado">Recortado</option>
                     <option value="adulteracao_simples">Adulteração simples</option>
                     <option value="implante_motor">Implante</option>
                    <option value="nao_localizado">Não localizado</option>
                    <option value="substituido_transplante">Substituído (transplante)</option>
                </select>
            </div>
    
            <div class="form-group">
                <label for="metodologiaMotor">Metodologia Aplicada:</label>
                <select id="metodologiaMotor" name="motor_metodologia">
                    <option value="">Selecione</option>
                    <option value="tratamento_quimico">Aplicar tratamento químico - Metalográfico</option>
                    <option value="instrumento_optico">Utilização de instrumento óptico adequado (LUPA)</option>
                </select>
                <label>
                    <input type="checkbox" id="nao-se-aplica-metodologia-motor"
                        name="motor_nao_se_aplica_metodologia" onchange="toggleMetodologiaMotor()"> Não se aplica
                </label>
            </div>
    
            <div class="form-group">
                <label for="resultadoMotor">Resultado:</label>
                <select id="resultadoMotor" name="motor_resultado" onchange="toggleReveladoFields('motor')">
                    <option value="">Selecione</option>
                    <option value="revelado">Revelado</option>
                    <option value="revelado_parcialmente">Revelado parcialmente</option>
                    <option value="nao_revelado">Não revelado</option>
                    <option value="corroborado">Corroborado</option>
                    <option value="nao_confirmado">Não confirmado</option>
                </select>
                <label>
                    <input type="checkbox" id="nao-se-aplica-resultado-motor" name="motor_nao_se_aplica_resultado"
                        onchange="toggleResultadoMotor()"> Não se aplica
                </label>
            </div>

            <div class="motor-revelado-fields" id="motor-revelado">
                <div class="form-group">
                    <label for="motorRevelado">Número do motor:</label>
                    <input type="text" id="motorRevelado" name="motor_revelado_numero" maxlength="20"
                        placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                        oninput="updateChassiDisplay(this, 'motorReveladoDisplay')">
                    <div id="motorReveladoDisplay" class="chassi-display"></div>
                </div>
                <div class="form-group">
                    <label for="fotoMotorRevelado">Foto do motor:</label>
                    <input type="file" id="fotoMotorRevelado" name="motor_revelado_foto" class="image-input">
                    <label>
                        <input type="checkbox" id="nao-tem-foto-motor-revelado" name="nmotor_revelado_nao_tem_foto"
                            onchange="toggleFotoMotorRevelado()"> Não tem foto
                    </label>
                </div>
                <div class="crop-container">
                    <img id="image-preview-motor-revelado" alt="Preview" class="image-preview">
                </div>
                <button id="crop-button-motor-revelado" style="display:none;">Recortar</button>
                <canvas id="cropped-result-motor-revelado"></canvas>
            </div>
            <div class="motor-revelado-fields" id="motor-revelado-parcialmente">
                <div class="form-group">
                    <label for="motorReveladoParcialmente">Motor Revelado Parcialmente:</label>
                    <input type="text" id="motorReveladoParcialmente" name="motor_revelado_parcialmente_numero"
                        maxlength="20" placeholder="Exemplo: 9BD12345678901234" class="chassi-input"
                        oninput="updateChassiDisplay(this, 'motorReveladoParcialmenteDisplay')">
                    <div id="motorReveladoParcialmenteDisplay" class="chassi-display"></div>
                </div>
                <div class="form-group">
                    <label for="fotoMotorReveladoParcialmente">Foto do Motor Revelado Parcialmente:</label>
                    <input type="file" id="fotoMotorReveladoParcialmente" name="motor_revelado_parcialmente_foto"
                        class="image-input">
                    <label>
                        <input type="checkbox" id="nao-tem-foto-motor-revelado-parcialmente"
                            name="motor_revelado_parcialmente_nao_tem_foto"
                            onchange="toggleFotoMotorReveladoParcialmente()"> Não tem foto
                    </label>
                </div>
                <div class="crop-container">
                    <img id="image-preview-motor-revelado-parcialmente" alt="Preview" class="image-preview">
                </div>
                <button id="crop-button-motor-revelado-parcialmente" style="display:none;">Recortar</button>
                <canvas id="cropped-result-motor-revelado-parcialmente"></canvas>
            
        </div>
       
    </div>
    <button type="submit">Avançar</button>
    </form>
    
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
    
    
                        if (cropper) {// Remove o cropper anterior (se existir)
                            cropper.destroy();
                        }
    
    
                        cropper = new Cropper(imagePreview, {// Inicia o Cropper.js com mais liberdade de movimento
                            aspectRatio: NaN, // Permite ajuste livre (removendo a restrição fixa)
                            viewMode: 1,      // Permite que a imagem saia um pouco da área de recorte
                            zoomable: true,   // Permite dar zoom
                            movable: true,    // Permite mover livremente
                            scalable: true,   // Permite redimensionar
                            autoCropArea: 0.7 // Define uma área inicial de recorte maior
                        });
    
    
                        document.getElementById(cropButtonId).style.display = "block";     // Mostra o botão de recorte
                    };
                    reader.readAsDataURL(file);
                }
            });
    
            document.getElementById(cropButtonId).addEventListener("click", function () {
                if (cropper) {
                    const canvas = cropper.getCroppedCanvas({
                        width: 600, // Mantém um recorte mais largo
                        height: 300
                    });
    
    
                    const croppedResult = document.getElementById(resultId);       // Exibe o recorte no <canvas>
                    const ctx = croppedResult.getContext("2d");
                    croppedResult.width = canvas.width;
                    croppedResult.height = canvas.height;
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(canvas, 0, 0);
                }
            });
        }
    
    
        initializeCropper("fotoChassiAtual", "image-preview-chassi", "crop-button-chassi", "cropped-result-chassi");
        initializeCropper("arquivoChassiAdulterado", "image-preview-chassi-adulterado", "crop-button-chassi-adulterado", "cropped-result-chassi-adulterado");
        initializeCropper("fotoChassiRevelado", "image-preview-chassi-revelado", "crop-button-chassi-revelado", "cropped-result-chassi-revelado");
        initializeCropper("fotoChassiReveladoParcialmente", "image-preview-chassi-revelado-parcialmente", "crop-button-chassi-revelado-parcialmente", "cropped-result-chassi-revelado-parcialmente");
        initializeCropper("fotoMotorAtual", "image-preview-motor", "crop-button-motor", "cropped-result-motor");
        initializeCropper("arquivoMotorAdulterado", "image-preview-motor-adulterado", "crop-button-motor-adulterado", "cropped-result-motor-adulterado");
        initializeCropper("fotoMotorRevelado", "image-preview-motor-revelado", "crop-button-motor-revelado", "cropped-result-motor-revelado");
        initializeCropper("fotoMotorReveladoParcialmente", "image-preview-motor-revelado-parcialmente", "crop-button-motor-revelado-parcialmente", "cropped-result-motor-revelado-parcialmente");
    
    
        // Bloquear campos
        function bloquearCampos(tipo, secao) {
    const select = document.getElementById(`tipoadulteracao${secao}`);
    const numeroInput = document.getElementById(`${tipo}Adulterado`);
    const fotoInput = document.getElementById(`arquivo${secao}Adulterado`);
    const metodologiaSelect = document.getElementById(`metodologia${secao}`);
    const resultadoSelect = document.getElementById(`resultado${secao}`);

    if (select.value === 'recortado') {
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

    if (tipoadulteracao === 'recortado') {
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
        function toggleReveladoFields(type) {// 
            const resultado = document.getElementById(`resultado${type.charAt(0).toUpperCase() + type.slice(1)}`).value;
            const reveladoFields = document.getElementById(`${type}-revelado`);
            const reveladoParcialmenteFields = document.getElementById(`${type}-revelado-parcialmente`);
            const naoReveladoFields = document.getElementById(`nao-revelado-${type}`);
    
            if (resultado === "revelado" || resultado === "corroborado") {
                reveladoFields.style.display = "block";
                reveladoParcialmenteFields.style.display = "none";
                naoReveladoFields.style.display = "none";
            } else if (resultado === "revelado_parcialmente") {
                reveladoFields.style.display = "none";
                reveladoParcialmenteFields.style.display = "block";
                naoReveladoFields.style.display = "none";
            } else if (resultado === "nao_revelado" || resultado === "nao_confirmado") {
                reveladoFields.style.display = "none";
                reveladoParcialmenteFields.style.display = "none";
                naoReveladoFields.style.display = "block";
            } else {
                reveladoFields.style.display = "none";
                reveladoParcialmenteFields.style.display = "none";
                naoReveladoFields.style.display = "none";
            }
        }
    
    
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
            toggleFotoInput("nao-tem-foto-chassi-adulterado", "arquivoChassiAdulterado");
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
    
    </script>
@endsection