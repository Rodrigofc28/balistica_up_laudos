@extends('layout.component')
@section('page')
<div class="container">
    <style>
        /* Estilos para o container */
        .container {
            width: 100%;
            max-width: 80%;
            background: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <header>
        <h1>Exame de Identificação Veicular de Ônibus</h1>
    </header>
    <br>
    <div class="progress-container">
        <div class="progress-bar"></div>
        <div class="step active">1</div>
        <div class="step">2</div>
        <div class="step ">3</div>
        <div class="step">4</div>
    </div>
    <br>
    <h2>Ônibus</h2>

   

    <form id="form"  method="POST">
        {{ csrf_field() }}
        <input hidden  type="text">
        <input type="text" name="veiculo_id" value="onibus" hidden>
        <div class="form-group">
            <label for="estado-conservacao">Estado de conservação:</label>
            <select id="estado-conservacao" name="estado_conservacao" required>
                <option>Selecione</option>      
                <option>MAU</option>
                <option>BOM</option>
                <option>REGULAR</option>
                <option>ÓTIMO</option>
            </select>
        </div>

        <div class="form-group">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca_fabricacao" placeholder="Digite a marca" required>
            <button id="add-marca" type="button">Adicionar marca</button>
            <div id="marca-suggestions"></div>
        </div>
        
        <div class="form-group">
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" placeholder="Digite o modelo" required>
            <button id="add-modelo" type="button">Adicionar modelo</button>
            <div id="modelo-suggestions"></div>
        </div>
        <div class="form-group">
            <label for="data">Ano fabricação:</label>
            <input type="text" id="data" maxlength="4" placeholder="0000" name="ano_fab" required>
        </div>
        <div class="form-group">
            <label for="anomodelo">Ano do modelo:</label>
            <input type="text" id="data" maxlength="4" placeholder="0000" name="ano" required>

        </div>
        <div class="form-group">
            <label for="placa">Placa atual:</label>
            <input type="text" id="placa" name="placa"maxlength="7" placeholder="XXX0X00" >
            <label><input type="checkbox" id="nao-tem-placa" name="nao-tem-placa"> Não tem placa</label>
        </div>
            <div class="form-group">
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
                
                <!-- Opção "Outras" -->
                <label>
                    <input type="radio" name="cor" value="Outras" id="outras-radio">
                    Outras
                </label>
                <input type="text" name="cor" id="outra-cor" placeholder="Digite a cor" disabled>
            </div>
        
  
        <script>
        document.addEventListener("DOMContentLoaded", function () {
            const outraCorRadio = document.getElementById("outras-radio");
            const outraCorInput = document.getElementById("outra-cor");
            const radios = document.querySelectorAll("input[name='cor']");
        
            // Mostrar ou ocultar o campo de texto baseado na seleção do radio
            radios.forEach(radio => {
                radio.addEventListener("change", function () {
                    if (outraCorRadio.checked) {
                        outraCorInput.style.display = "block";
                        outraCorInput.disabled = false;
                        outraCorInput.required = true;
                    } else {
                        outraCorInput.style.display = "none";
                        outraCorInput.disabled = true;
                        outraCorInput.required = false;
                    }
                });
            });
        
            // Ajustar valor antes de enviar o formulário
            document.querySelector("form").addEventListener("submit", function (e) {
                if (outraCorRadio.checked) {
                    if (outraCorInput.value.trim() === "") {
                        e.preventDefault();
                        alert("Por favor, insira a cor desejada.");
                    } else {
                        // Define o valor da coluna cor_outros
                        document.querySelector("input[name='cor_outros']").value = outraCorInput.value;
                        // Define o valor da coluna cor como "Outras"
                        document.querySelector("input[name='cor']").value = "Outras";
                    }
                } else {
                    // Define o valor da coluna cor como a cor selecionada
                    document.querySelector("input[name='cor']").value = document.querySelector("input[name='cor']:checked").value;
                }
            });
        });
            </script>
        </form>
        
            </script>
          </form>

        <div class="nav-buttons">
            <button id="prev" onclick="window.history.back()">Voltar</button>
            <button id="next" class="btn btn-primary" type="button" >Avançar</button>
        </div>

        <script>

document.addEventListener('DOMContentLoaded', function () {
    const marcaInput = document.getElementById('marca');
    const modeloInput = document.getElementById('modelo');
    const marcaSuggestions = document.getElementById('marca-suggestions');
    const modeloSuggestions = document.getElementById('modelo-suggestions');

    // Função para buscar marcas
    function buscarMarcas(termo) {
        if (termo.length >= 2) {
            fetch(`/veiculos/buscar-marcas?termo=${termo}`)
                .then(response => response.json())
                .then(data => {
                    marcaSuggestions.innerHTML = data.map(marca => `
                        <div onclick="selecionarMarca('${marca}')">${marca}</div>
                    `).join('');
                });
        } else {
            marcaSuggestions.innerHTML = '';
        }
    }

    // Função para buscar modelos
    function buscarModelos(termo) {
        if (termo.length >= 2) {
            fetch(`/veiculos/buscar-modelos?termo=${termo}`)
                .then(response => response.json())
                .then(data => {
                    modeloSuggestions.innerHTML = data.map(modelo => `
                        <div onclick="selecionarModelo('${modelo}')">${modelo}</div>
                    `).join('');
                });
        } else {
            modeloSuggestions.innerHTML = '';
        }
    }

    // Buscar marcas ao digitar
    marcaInput.addEventListener('input', function () {
        buscarMarcas(marcaInput.value);
    });

    // Buscar modelos ao digitar
    modeloInput.addEventListener('input', function () {
        buscarModelos(modeloInput.value);
    });

    // Adicionar nova marca
    document.getElementById('add-marca').addEventListener('click', function () {
        const marca = marcaInput.value;
        if (marca) {
            fetch('/veiculos/adicionar-marca', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ marca_fabricacao: marca })
            })
            .then(response => response.json())
            .then(data => {
                alert('Marca adicionada com sucesso!');
                marcaInput.value = ''; // Limpar o campo
                buscarMarcas(''); // Atualizar sugestões
            })
            .catch(error => {
                console.error('Erro ao adicionar marca:', error);
            });
        }
    });

    // Adicionar novo modelo
    document.getElementById('add-modelo').addEventListener('click', function () {
        const modelo = modeloInput.value;
        if (modelo) {
            fetch('/veiculos/adicionar-modelo', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ modelo: modelo })
            })
            .then(response => response.json())
            .then(data => {
                alert('Modelo adicionado com sucesso!');
                modeloInput.value = ''; // Limpar o campo
                buscarModelos(''); // Atualizar sugestões
            })
            .catch(error => {
                console.error('Erro ao adicionar modelo:', error);
            });
        }
    });
});

// Funções para selecionar marca/modelo
function selecionarMarca(nome) {
    document.getElementById('marca').value = nome;
    document.getElementById('marca-suggestions').innerHTML = '';
}

function selecionarModelo(nome) {
    document.getElementById('modelo').value = nome;
    document.getElementById('modelo-suggestions').innerHTML = '';

    document.querySelector('form').addEventListener('submit', function (event) {
    const marca = document.getElementById('marca').value;
    const modelo = document.getElementById('modelo').value;

    // Verificar se a marca/modelo foi selecionada ou adicionada
    if (!marca || !modelo) {
        event.preventDefault();
        alert('Por favor, selecione ou adicione uma marca e um modelo.');
    }
});
}
        </script>

    <script>
        // Função para adicionar marca
        document.getElementById('add-marca').addEventListener('click', function() {
            const marca = document.getElementById('marca').value;
            if (marca !== '') {
                fetch('/add-marca', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ marca: marca })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Marca adicionada com sucesso!');
                        document.getElementById('marca').value = '';
                    } else {
                        alert('Erro ao adicionar marca!');
                    }
                })
                .catch(error => console.error(error));
            }
        });

        // Função para adicionar modelo
        document.getElementById('add-modelo').addEventListener('click', function() {
            const modelo = document.getElementById('modelo').value;
            if (modelo !== '') {
                fetch('/add-modelo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ modelo: modelo })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Modelo adicionado com sucesso!');
                        document.getElementById('modelo').value = '';
                    } else {
                        alert('Erro ao adicionar modelo!');
                    }
                })
                .catch(error => console.error(error));
            }
        });

        // Função para buscar marcas
        document.getElementById('marca').addEventListener('input', function() {
            const marca = document.getElementById('marca').value;
            if (marca !== '') {
                fetch(`/buscar-marcas?marca=${marca}`)
                .then(response => response.json())
                .then(data => {
                    const marcaSuggestions = document.getElementById('marca-suggestions');
                    marcaSuggestions.innerHTML = '';
                    data.forEach(marca => {
                        const option = document.createElement('div');
                        option.textContent = marca;
                        option.addEventListener('click', () => {
                            document.getElementById('marca').value = marca;
                            marcaSuggestions.innerHTML = '';
                        });
                        marcaSuggestions.appendChild(option);
                    });
                })
                .catch(error => console.error(error));
            }
        });

        // Função para buscar modelos
        document.getElementById('modelo').addEventListener('input', function() {
            const modelo = document.getElementById('modelo').value;
            if (modelo !== '') {
                fetch(`/buscar-modelos?modelo=${modelo}`)
                .then(response => response.json())
                .then(data => {
                    const modeloSuggestions = document.getElementById('modelo-suggestions');
                    modeloSuggestions.innerHTML = '';
                    data.forEach(modelo => {
                        const option = document.createElement('div');
                        option.textContent = modelo;
                        option.addEventListener('click', () => {
                            document.getElementById('modelo').value = modelo;
                            modeloSuggestions.innerHTML = '';
                        });
                        modeloSuggestions.appendChild(option);
                    });
                })
                .catch(error => console.error(error));
            }
        });

        // Função para mostrar/ocultar campo de texto para cor personalizada
        document.querySelectorAll('input[name="cor"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const outroCorInput = document.getElementById('outro-cor');
                if (this.value === 'Outras') {
                    outroCorInput.style.display = 'inline-block';
                } else {
                    outroCorInput.style.display = 'none';
                }
            });
        });
        // Função para salvar e redirecionar
        function saveAndRedirect(event) {
            event.preventDefault()

            console.log(route)
            
            const form = document.getElementById('form');
            if (form.checkValidity()) {
                form.action = route;
                form.submit();
            }
        }

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

        // Função para atualizar a placa
        const placaInput = document.getElementById("placa");
        const naoTemPlacaCheckbox = document.getElementById("nao-tem-placa");

        naoTemPlacaCheckbox.addEventListener("change", () => {
            placaInput.disabled = naoTemPlacaCheckbox.checked;
        });
    </script>
</div>
@endsection