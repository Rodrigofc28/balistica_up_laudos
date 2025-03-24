
@if(isset($laudoMaterial))
<div class="col-lg-3 ">
    
    
    <input type="checkbox" name="material_coletado" id="material_coletado" value="sim"><strong> Material coletado por perito</strong><br>

</div>
@endif
@if(isset($laudo))



@if($laudo->material_coletado=="sim")
<div class="col-lg-3 ">

    <label  id="origem_coletaPeritoLabel" for=""><strong>Origem</strong> </label><br>
    <input  type="text" class="form-control" name="origem_coletaPerito" id="origem_coletaPerito">
    
    @include('shared.error_feedback', ['name' => 'material_coletado'])

</div>
@endif
@endif