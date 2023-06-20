
<div class="col-lg-3 ">
<div class="form-group">
    <label  id="origem_coletaPeritoLabel" for=""><strong>Origem</strong> </label><br>
    <input  type="text" class="form-control" name="origem_coletaPerito" id="origem_coletaPerito" value="{{old('origem',$origem)}}">
    
    @include('shared.error_feedback', ['name' => 'origem_coletaPerito'])
    </div>
</div>



<div class="col-lg-3 ">
    <div class="form-group">
    <label   id="label_rep" for=""><strong>Nº Exame Coleta (xxxxx/ano) </strong></label>
    <input   class="form-control rep"  name="rep_materialColetado"  id="rep_materialColetado" value="{{old('rep',$rep)}}"><br>
    </div>
</div>



