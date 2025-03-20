
@if(isset($laudoMaterial))
<style>
    .conteiner_sinb{
        display: flex;
        border: 1px solid black;
        justify-content: center;
        border-radius: 5px;
    }
    .infoMaterialColetado{
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
<div class="col-lg-3 ">
    @if($tipo_exame=='balistica')
        <b onmouseout="displayInfoOutColeta()" onmouseover="displayInfoColeta()">Trata-se de material coletado por perito</b>
        <div onmouseout="displayInfoOutColeta()" onmouseover="displayInfoColeta()" class="conteiner_sinb">
            <div style="padding: 5px">
                <label for="material_coletado_no">
                    <b>NÃO</b>
                <input type="radio" name="material_coletado" id="material_coletado_no" value="NULL" checked onclick="setRadioValueColeta(this)">
                </label>
                <label for="material_coletado_si">
                    <b>SIM</b>
                    <input type="radio" name="material_coletado" id="material_coletado_si" value="sim" onclick="setRadioValueColeta(this)">
                </label>
            </div>
            
        </div>

    @else
       
        <b >O veículo foi periciado no pátio da instituição?</b>
        <div class="conteiner_sinb">
            <div style="padding: 5px">
                <label for="periciaVeiculono">
                    <b>NÃO</b>
                <input type="radio" name="periciaVeiculo" id="periciaVeiculono" value="NULL" checked onclick="setRadioValueColeta(this)">
                </label>
                <label for="periciaVeiculosi">
                    <b>SIM</b>
                    <input type="radio" name="periciaVeiculo" id="periciaVeiculosi" value="sim" onclick="setRadioValueColeta(this)">
                </label>
            </div>
            
        </div>
    @endif
    
    <div onmouseout="displayInfoOutColeta()" onmouseover="displayInfoColeta()" id="infoMaterialColetado" class="infoMaterialColetado">
        <p>A tabela <b>material encaminhado a exame</b>  será ajustada.</p>
        <p>Para exames de material coletado por perito criminal (local ou necrópsia):</p>
        <p>
        <b>Tipo - </b> 
            <b>Qtde - </b>
            <b>Origem - </b>
            <b>Nº Exame Coleta - </b>
            <b>Nº Requisição - </b>
            <b>Lacre - </b>
        </p>
        <p>Para exames de material encaminhado por terceiros (delegacias, etc) via Ofício:</p> 
        <p>
            <b>Natureza - </b> 
            <b>Qtde - </b>
            <b>Tipo - </b>
            <b>Dito no Ofício - </b>
           
            <b>Lacre - </b>
        </p>
    </div>
    
</div>
@endif
@if(isset($laudo))


<div class="col-lg-3 ">

    <label   id="label_rep" for=""><strong>Nº Exame Coleta (xxxxx/ano) </strong></label>
    <input  type="text" class="form-control rep" name="rep_materialColetado" id="rep_materialColetado"><br>

</div>
@if($laudo->material_coletado=="sim")
<div class="col-lg-3 ">

    <label  id="origem_coletaPeritoLabel" for=""><strong>Origem</strong> </label><br>
    <input  type="text" class="form-control" name="origem_coletaPerito" id="origem_coletaPerito">
    
    @include('shared.error_feedback', ['name' => 'material_coletado'])

</div>
@endif
@endif
<script>
    function setRadioValueColeta(radio) {
        var form = document.getElementById('formulario');
        var checkedRadio = form.querySelector('input[type="radio"]:checked');
        
        // Se "NÃO" for marcado, o valor será NULL, se "SIM" for marcado, o valor será 1
        form.querySelector('input[name="material_coletado"]').value = checkedRadio ? checkedRadio.value : 'NULL';
    }
    function displayInfoColeta(){
            document.getElementById('infoMaterialColetado').style.display="block"
    }
    function displayInfoOutColeta(){
             document.getElementById('infoMaterialColetado').style.display="none"
    }
</script>