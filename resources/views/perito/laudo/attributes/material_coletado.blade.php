
@if(isset($laudoMaterial))
<style>
    .conteiner_sinb{
        display: flex;
        border: 1px solid black;
        justify-content: center;
        border-radius: 5px;
    }
</style>
<div class="col-lg-3 ">
    
    <b>TRATA-SE DE MATERIAL COLETADO POR PERITO</b>
    
    <div class="conteiner_sinb">
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
</script>