@extends('layout.component')
@section('page')
<div class="container">
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

        .progress-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
            color: #4bb2c4;
        }

        .form-group {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin: 15px 0;
            justify-content: center;
            align-items: center;
        }

        .form-group label {
            font-weight: bold;
            min-width: 120px;
            text-align: left;
            margin-right: 10px;
        }

        .form-group select,
        .form-group input[type="text"],
        .form-group input[type="date"] {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .form-group .add-button {
            padding: 10px;
            background-color: #031d20c7;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .form-group .add-button:hover {
            background-color: #5cc7d8ee;
        }

        .form-group .color-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .form-group .color-options label {
            display: flex;
            align-items: center;
            gap: 5px;
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

        .buttons {
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            color: #f8f8f8;
            background-color: #031d20c7;
        }

        button:hover {
            background-color: #0691eeb7;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .form-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        select {
            width: 150px;
            padding: 5px;
        }

        input[type="number"] {
            width: 80px;
            padding: 5px;
        }

        .form-container {
            display: flex;
            gap: 20px;
        }

        .form-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
    <header>
        <h1>Exame de Identificação Veicular</h1>
    </header>
    <br>
    <div class="progress-container">
        <div class="progress-bar"></div>
        <div class="step active"></div>
        <div class="step"></div>
        <div class="step"></div>
        <div class="step"></div>
    </div>
<br>
    <h2>Motocicleta</h2>

<br>

<form action="{{ route('motocicletadois.store') }}" method="POST">
    @csrf
        <div class="form-group">
            <label for="estado-conservacao">Estado de conservação:</label>
            <select id="estado-conservacao" name="estado-conservacao" required>
                <option>Selecione</option>
                <option>BAIXADO</option>
                <option>MAU</option>
                <option>BOM</option>
                <option>REGULAR</option>
                <option>ÓTIMO</option>
            </select>
        </div>
        
        
        <div class="form-group">
            <label for="marca">Marca:</label>
            <select id="marca" name="marca" required>
                <option>Selecione</option>
                <option value="Outros">Outros</option>

            
            </select>
            <input type="text" id="outro-marca" name="outro-marca" placeholder="Digite a marca" style="display:none;">
        </div>

        <div class="form-group">
            <label for="modelo">Modelo:</label>
            <select id="modelo" name="modelo" required>
                <option>Selecione</option>
                <option value="Outros">Outros</option>


            </select>
            <input type="text" id="outro-modelo" name="outro-modelo" placeholder="Digite o modelo" style="display:none;">
        </div>
        
        <div class="form-group">
            <label for="data">Ano:</label>
            <input type="text" id="data" maxlength="4" placeholder="0000" name="data" required>
        </div>

        <div class="form-group">
            <label for="placa">Placa atual:</label>
            <input type="text" id="placa" name="placa">
            <label><input type="checkbox" id="nao-tem-placa" name="nao-tem-placa"> Não tem placa</label>
        </div>   
        
        

        <div class="form-group">
            <label>Cor predominante:</label><br>
            <div class="color-options">
                <label><input type="radio" name="cor" value="Vermelho" required> Vermelho</label>
                <label><input type="radio" name="cor" value="Azul"> Azul</label>
                <label><input type="radio" name="cor" value="Verde"> Verde</label>
                <label><input type="radio" name="cor" value="Preto"> Preto</label>
                <label><input type="radio" name="cor" value="Branco"> Branco</label>
                <label><input type="radio" name="cor" value="Cinza"> Cinza</label>
                <label><input type="radio" name="cor" value="Rosa"> Rosa</label>
                <label><input type="radio" name="cor" value="Roxo"> Roxo</label>
                <label><input type="radio" name="cor" value="Marrom"> Marrom</label>
                <label><input type="radio" name="cor" value="Amarelo"> Amarelo</label>
                <label><input type="radio" name="cor" value="Laranja"> Laranja</label>
                
                <!-- Campo para adicionar cor personalizada -->
                <label><input type="radio" name="cor" value="Outras" id="outra-cor-radio"> Outras</label>
            </div>
        
            <!-- Campo de texto que aparece apenas quando 'Outras' é selecionado -->
            <input type="text" id="outro-cor" name="outro-cor" placeholder="Digite a cor" style="display:none;">
        </div>

        

 

        <div class="nav-buttons">
            <button id="prev" onclick="window.history.back()">Voltar</button>
            <button id="next" class="btn btn-primary" type="button" onclick="saveAndRedirect()">Avançar</button>

        </div>
    </form>   
    
    <script>
<script>

        function saveAndRedirect() {
        // Coletar os dados do formulário ou dos campos que precisam ser salvos
        let data = {
            campo1: document.getElementById('campo1').value,
            campo2: document.getElementById('campo2').value,
            // Adicione outros campos conforme necessário
        };

        // Enviar os dados via AJAX
        fetch('URL_DO_BACKEND', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Para Laravel
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {  // Verifique se o backend retorna um sucesso
                // Caso o salvamento seja bem-sucedido, redirecionar para a próxima página
                window.location.href = 'URL_DA_PRÓXIMA_TELA';  // Defina aqui a URL da próxima tela
            } else {
                alert('Erro ao salvar os dados!'); // Mensagem de erro caso algo não tenha dado certo
            }
        })
        .catch((error) => {
            console.error('Erro ao salvar os dados:', error);
            alert('Houve um erro ao tentar salvar. Tente novamente.');
        });
    }
</script>

        

        <script>
            document.getElementById('outra-cor-radio').addEventListener('change', function() {
                const outroCorInput = document.getElementById('outro-cor');
                if (this.checked) {
                    outroCorInput.style.display = 'inline-block';
                } else {
                    outroCorInput.style.display = 'none';
                }
            });
        </script>

    <script>
        // função para ordenar as opções do select
        function ordenarSelect(selectId) {
            var select = document.getElementById(selectId);
            var options = Array.from(select.options);
            options.sort(function(a, b) {
                if (a.text < b.text) return -1;
                if (a.text > b.text) return 1;
                return 0;
            });
    
            // Limpar as opções atuais
            select.innerHTML = "";
    
            // Re-inserir as opções ordenadas
            options.forEach(function(option) {
                select.appendChild(option);
            });
        }
    
        // Chamar a função de ordenação para os dois selects
        window.onload = function() {
            ordenarSelect("modelo");
            ordenarSelect("marca");
        }
    
        // Script para mostrar o campo de texto de modelo apenas quando 'Outros' for selecionado
        document.getElementById('modelo').addEventListener('change', function() {
            const outroModeloInput = document.getElementById('outro-modelo');
            if (this.value === 'Outros') {
                outroModeloInput.style.display = 'inline-block';
            } else {
                outroModeloInput.style.display = 'none';
            }
        });
    
        // Script para mostrar o campo de texto de marca apenas quando 'Outros' for selecionado
        document.getElementById('marca').addEventListener('change', function() {
            const outroMarcaInput = document.getElementById('outro-marca');
            if (this.value === 'Outros') {
                outroMarcaInput.style.display = 'inline-block';
            } else {
                outroMarcaInput.style.display = 'none';
            }
        });
    </script>

    <script>
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

        function updateProgress() {
            // Atualiza as etapas ativas
            steps.forEach((step, index) => {
                if (index < currentStep) {
                    step.classList.add("active");
                } else {
                    step.classList.remove("active");
                }
            });

            // Atualiza a barra de progresso
            progressBar.style.width = `${(currentStep - 1) * (100 / (steps.length - 1))}%`;

            // Controle do botão de navegação
            prevButton.disabled = currentStep === 1;
            nextButton.disabled = currentStep === steps.length;
        }
        const placaInput = document.getElementById("placa");
const naoTemPlacaCheckbox = document.getElementById("nao-tem-placa");

naoTemPlacaCheckbox.addEventListener("change", () => {
    placaInput.disabled = naoTemPlacaCheckbox.checked;
});

    </script>
</div>
@endsection