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

        <body>


            <div class="progress-container">
                <div class="progress-bar"></div>
                <div class="step active">✔</div>
                <div class="step">✔</div>
                <div class="step">✔</div>
                <div class="step">✔</div>
            </div>




            <h2>Motocicleta</h2>


            <div class="form-group">
                <label for="estado-conservacao">Estado de conservação:</label>
                <select id="estado-conservacao">
                    <option>Selecione</option>
                    <option>BAIXADO</option>
                    <option>MAU</option>
                    <option>BOM</option>
                    <option>REGULAR</option>
                    <option>ÓTIMO</option>
                </select>
            </div>


            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <select id="modelo">
                    <option>Selecione</option>
                    <option value="AFRICA_TWIN">AFRICA TWIN</option>
                    <option value="BMW_R1250GS">BMW R1250GS</option>
                    <option value="DUCATI_MONSTER">DUCATI MONSTER</option>
                    <option value="HONDA_CB500F">HONDA CB500F</option>
                    <option value="INDIAN_SCOUT">INDIAN SCOUT</option>
                    <option value="KAWASAKI_NINJA_400">KAWASAKI NINJA 400</option>
                    <option value="KTM_390_DUKE">KTM 390 DUKE</option>
                    <option value="LAMBRETTA_L50">LAMBRETTA L50</option>
                    <option value="MOTO_GUZZI_V85TT">MOTO GUZZI V85TT</option>
                    <option value="MV_AGUSTA_F3">MV AGUSTA F3</option>
                    <option value="NORTON_650SS">NORTON 650SS</option>
                    <option value="PEUGEOT_PHX125">PEUGEOT PHX125</option>
                    <option value="ROYAL_ENFIELD_HIMALAYAN">ROYAL ENFIELD HIMALAYAN</option>
                    <option value="SUZUKI_VSTROM_650">SUZUKI VSTROM 650</option>
                    <option value="TRIUMPH_BOBBER">TRIUMPH BOBBER</option>
                    <option value="VESPA_GTS300">VESPA GTS300</option>
                    <option value="YAMAHA_MT09">YAMAHA MT09</option>
                </select>

                <input type="text" id="outro" name="Outros" placeholder="Outros">
            </div>

            <div class="form-group">
                <label for="marca">Marca:</label>
                <select id="marca">
                    <option>Selecione</option>
                    <option value="ajs">AJS</option>
                    <option value="aprilia">APRILIA</option>
                    <option value="bmw">BMW</option>
                    <option value="bsa">BSA</option>
                    <option value="cagiva">CAGIVA</option>
                    <option value="canam">CAN-AM</option>
                    <option value="ducati">DUCATI</option>
                    <option value="honda">HONDA</option>
                    <option value="husqvarna">HUSQVARNA</option>
                    <option value="indian">INDIAN</option>
                    <option value="kawasaki">KAWASAKI</option>
                    <option value="ktm">KTM</option>
                    <option value="lambretta">LAMBRETTA</option>
                    <option value="laverda">LAVERDA</option>
                    <option value="motoguzzi">MOTO GUZZI</option>
                    <option value="mvagusta">MV AGUSTA</option>
                    <option value="norton">NORTON</option>
                    <option value="peugeot">PEUGEOT</option>
                    <option value="royalenfield">ROYAL ENFIELD</option>
                    <option value="suzuki">SUZUKI</option>
                    <option value="triumph">TRIUMPH</option>
                    <option value="vespa">VESPA</option>
                    <option value="yamaha">YAMAHA</option>
                </select>


                <input type="text" id="outro" name="Outros" placeholder="Outros">
            </div>


           
            <div class="form-group">
                <label for="placa">Placa atual:</label>

                <input type="text" id="num_placa" oninput="validarPlaca(this)" maxlength="7" placeholder="AAA1A11"
                >

                <label>
                    <input type="checkbox" id="sem_placa" onchange="togglePlaca()"> Sem placa
                </label>
            </div>

            <script>
                function togglePlaca() {
                    let checkbox = document.getElementById('sem_placa');
                    let inputPlaca = document.getElementById('num_placa');

                    if (checkbox.checked) {
                        inputPlaca.value = "";
                        inputPlaca.disabled = true;
                    } else {
                        inputPlaca.disabled = false;
                    }
                }

            </script>

            
            <div class="form-container">
                <div class="form-group">
                    <label for="ano-fabricacao">Ano de Fabricação:</label>
                    <input type="text" id="ano-fabricacao" name="ano-fabricacao" pattern="\d{4}" maxlength="4"
                        minlength="4" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>

                <div class="form-group">
                    <label for="ano-modelo">Ano do Modelo:</label>
                    <input type="text" id="ano-modelo" name="ano-modelo" pattern="\d{4}" maxlength="4" minlength="4"
                        required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
            </div>

            <div class="form-group">
                <label>Cor predominante:</label>
                <BR></BR>
                <div class="color-options">
                    <label><input type="radio" name="cor" value="Vermelho"> Vermelho</label>
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

                    <input type="text" id="outro" name="Outros" placeholder="Outros">
                </div>
            </div>


            <div class="buttons">
                <button id="prev" disabled>Voltar</button>
                <button id="next">Avançar</button>
            </div>

            <script>
                const steps = document.querySelectorAll(".step");
                const progressBar = document.querySelector(".progress-bar");
                const prevButton = document.getElementById("prev");
                const nextButton = document.getElementById("next");

                let currentStep = 1;

                nextButton.addEventListener("click", () => {
                    currentStep++;
                    updateProgress();
                });

                prevButton.addEventListener("click", () => {
                    currentStep--;
                    updateProgress();
                });

                function updateProgress() {
                    steps.forEach((step, index) => {
                        if (index < currentStep) {
                            step.classList.add("active");
                        } else {
                            step.classList.remove("active");
                        }
                    });

                    progressBar.style.width = ((currentStep - 1) / (steps.length - 1)) * 100 + "%";

                    prevButton.disabled = currentStep === 1;
                    nextButton.disabled = currentStep === steps.length;
                }

            </script>
    </div>
@endsection