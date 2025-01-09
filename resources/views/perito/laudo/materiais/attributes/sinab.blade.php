<div class="col-lg-3 mt-2">
<div class="form-group">
    <style>
        .conteiner_sinb{
            display: flex;
            border: 1px solid black;
            justify-content: center;
            border-radius: 5px;
        }
        .info{
            display: none;
        }
    </style>
<b onmouseover="displayInfo()" >TRATA-SE DE MATERIAL ELEGÍVEL PARA O SINAB</b>
<div class="conteiner_sinb">
    <div style="padding: 5px">
        <label for="sinab_no">
            <b>NÃO</b>
        <input type="radio" name="sinab" id="sinab_no" value="NULL" checked onclick="setRadioValue(this)">
        </label>
        <label for="sinab_si">
            <b>SIM</b>
            <input type="radio" name="sinab" id="sinab_si" value="1" onclick="setRadioValue(this)">
        </label>
    </div>
    
</div>
<p id="info" class="info"></p>
 


</div></div>
<script>
    function setRadioValue(radio) {
        var form = document.getElementById('formulario');
        var checkedRadio = form.querySelector('input[type="radio"]:checked');
        
        // Se "NÃO" for marcado, o valor será NULL, se "SIM" for marcado, o valor será 1
        form.querySelector('input[name="sinab"]').value = checkedRadio ? checkedRadio.value : 'NULL';
    }
    function displayInfo(){

        swal('Caso não tenha sido coletado padrão da arma ou caso a arma seja institucional, será suprimido o parágrafo referente ao SINAB')
    }
</script>