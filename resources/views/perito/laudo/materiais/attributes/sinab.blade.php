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
            border: 1px solid black;
            border-radius: 5px;
            padding: 25px;
            text-align: justify;
            color: rgb(127, 128, 129);
            position: relative;
            margin-bottom: 0px;
            
        }
    </style>
<b onmouseout="displayInfoOut()" onmouseover="displayInfo()" >Trata-se de material elegível para o sinab</b>
<div onmouseout="displayInfoOut()" onmouseover="displayInfo()" class="conteiner_sinb">
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
<div onmouseout="displayInfoOut()" onmouseover="displayInfo()" id="info" class="info">
    <p >
        Caso não tenha sido coletado padrão da arma ou caso a arma seja institucional, será suprimido o parágrafo referente ao SINAB
        no laudo.
    </p>  
    <p>Parágrafo Coleta de Padrões Balísticos: <b>e/ou inclusão no Banco Nacional de Perfis Balísticos.</b> </p>  
    
    <p>Parágrafo Considerações Finais: <b>Cumpre ressaltar que os padrões balísticos elegíveis para inclusão no Banco Nacional de Perfis Balísticos (BNPB) 
        devem ser armazenados pelo prazo de 20 anos conforme definido no Procedimento Operacional do Sistema Nacional de Análise Balística (SINAB), 
        independentemente de futura destruição da arma.</b> </p>  
    </div>

     

 


</div></div>
<script>
    function setRadioValue(radio) {
        var form = document.getElementById('formulario');
        var checkedRadio = form.querySelector('input[type="radio"]:checked');
        
        // Se "NÃO" for marcado, o valor será NULL, se "SIM" for marcado, o valor será 1
        form.querySelector('input[name="sinab"]').value = checkedRadio ? checkedRadio.value : 'NULL';
    }
    function displayInfo(){
            document.getElementById('info').style.display="block"
    }
    function displayInfoOut(){
             document.getElementById('info').style.display="none"
    }
</script>