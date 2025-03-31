
<div class="col-lg-3 ">
<div class="form-group">
    <label  id="origem_coletaPeritoLabel" for=""><strong>Origem</strong> </label><br>
    
    <select name="origem_coletaPerito" class="form-control" id="origem_coletaPerito" >
        <option value=""></option>
        <option value="EXAME DE LOCAL">EXAME DE LOCAL</option>
        <option value="EXAME DE NECROPSIA">EXAME DE NECROPSIA</option>
        <option value="ORIGEM DELEGACIA">ORIGEM DELEGACIA</option>
        <option value="OUTROS">OUTROS</option>
    </select>
    @include('shared.error_feedback', ['name' => 'origem_coletaPerito'])
    </div>
</div>
<script>
    //script para a exibição do campo de origem da coleta de material
    document.addEventListener("DOMContentLoaded", function () {
    const selectOrigem = document.getElementById("origem_coletaPerito");
    const inputOutros = document.createElement("input");
    
    inputOutros.type = "text";
    inputOutros.name = "origem_coletaPerito";
    inputOutros.className = "form-control mt-2";
    inputOutros.placeholder = "Especifique";
    inputOutros.style.display = "none";
    
    selectOrigem.parentNode.appendChild(inputOutros);
    
    selectOrigem.addEventListener("change", function () {
        if (selectOrigem.value === "OUTROS") {
            inputOutros.style.display = "block";
            selectOrigem.removeAttribute("name");
        } else {
            inputOutros.style.display = "none";
            selectOrigem.setAttribute("name", "origem_coletaPerito");
        }
    });
});
</script>

{{--
<div class="col-lg-3 ">
    <div class="form-group">
    <label   id="label_rep" for=""><strong>Nº Exame Coleta (xxxxx/ano) </strong></label>
    <input   class="form-control rep"  name="rep_materialColetado"  id="rep_materialColetado" value="{{old('rep',$rep)}}"><br>
    </div>
</div>--}}



