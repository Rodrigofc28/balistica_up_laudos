<div class="col-lg-3">
    <div class="form-group">
    
    <label  for="cavados"><strong>Cavados <code>*</code></strong></label>
    <input required class="form-control "type="number" name="cavados" id="cavados" value="{{old('cavados',$cavados)}}">
@include('shared.error_feedback', ['name' => 'cavados'])
</div>
</div>