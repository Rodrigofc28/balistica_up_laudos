
<div class="col-lg-3 ">
<div class="form-group">
    <label  id="origem_coletaPeritoLabel" for=""><strong>Origem</strong> </label><br>
    
    <select name="origem_coletaPerito" class="form-control" id="origem_coletaPerito" >
        <option value=""></option>
        <option value="EXAME DE LOCAL">EXAME DE LOCAL</option>
        <option value="EXAME DE NECROPSIA">EXAME DE NECROPSIA</option>
        <option value="ORIGEM DELEGACIA">ORIGEM DELEGACIA</option>
        
    </select>
    @include('shared.error_feedback', ['name' => 'origem_coletaPerito'])
    </div>
</div>


{{--
<div class="col-lg-3 ">
    <div class="form-group">
    <label   id="label_rep" for=""><strong>Nº Exame Coleta (xxxxx/ano) </strong></label>
    <input   class="form-control rep"  name="rep_materialColetado"  id="rep_materialColetado" value="{{old('rep',$rep)}}"><br>
    </div>
</div>--}}



