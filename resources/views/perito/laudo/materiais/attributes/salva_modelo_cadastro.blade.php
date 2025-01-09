<div class="col-lg-3 mt-2">
    <style>
        .conteiner_sinb{
            display: flex;
            border: 1px solid black;
            justify-content: center;
            border-radius: 5px;
        }
    </style>
    <div class="form-group">
        <b>DESEJA SALVA O MODELO DESSA ARMA PARA EXAME FUTURO</b>
        <div class="conteiner_sinb">
            <div style="padding: 5px">
                <label for="salva_cadastro_no">
                    <b>NÃO</b>
                <input type="radio" name="salva_cadastro" id="salva_cadastro_no" value="NULL" checked onclick="setRadioValueCadastroArmas(this)">
                </label>
                <label for="salva_cadastro_si">
                    <b>SIM</b>
                    <input type="radio" name="salva_cadastro" id="salva_cadastro_si" value="1" onclick="setRadioValueCadastroArmas(this)">
                </label>
            </div>
            
        </div>      
           
                
    </div>
    <script>
        function setRadioValueCadastroArmas(radio) {
            var form = document.getElementById('formulario');
            var checkedRadio = form.querySelector('input[type="radio"]:checked');
            
            // Se "NÃO" for marcado, o valor será NULL, se "SIM" for marcado, o valor será 1
            form.querySelector('input[name="salva_cadastro"]').value = checkedRadio ? checkedRadio.value : 'NULL';
        }
    </script>
</div>