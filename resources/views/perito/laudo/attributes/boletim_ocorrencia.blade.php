<div class="col-lg-3 mt-2" >
    
    <label for="boletim_ocorrencia"><strong>Boletim de ocorrência </strong></label><br>
    <input class="form-control" name="boletim_ocorrencia" id="boletim_ocorrencia" type="text" value="{{old('boletim',$boletim2)}}">

    

    @include('shared.error_feedback', ['name' => 'laudoEfetConst'])
</div>