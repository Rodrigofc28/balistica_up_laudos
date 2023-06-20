
@if(isset($laudoMaterial))
<div class="col-lg-3 ">
    
    
    <input type="checkbox" name="material_coletado" id="material_coletado" value="sim"><strong> Material coletado por perito</strong><br>

</div>
@endif
@if(isset($laudo))


<div class="col-lg-3 ">

    <label   id="label_rep" for=""><strong>Nº Exame Coleta (xxxxx/ano) </strong></label>
    <input  type="text" class="form-control rep" name="rep_materialColetado" value="{{ old('rep', $rep) }}" id="rep_materialColetado"><br>

</div>
@if($laudo->material_coletado=="sim")
<div class="col-lg-3 ">

    <label  id="origem_coletaPeritoLabel" for=""><strong>Origem</strong> </label><br>
    <input  type="text" class="form-control" name="origem_coletaPerito" id="origem_coletaPerito">
    
    @include('shared.error_feedback', ['name' => 'material_coletado'])

</div>
@endif
@endif