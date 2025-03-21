
<div class="col-lg-3">
    <div class="form-group">
    <label   for="ressaltos"><strong>Nº Ressaltos <code>*</code></strong></label>
    <input required class="form-control "type="number" name="ressaltos" id="ressaltos" value="{{old('ressaltos',$ressaltos)}}">
@include('shared.error_feedback', ['name' => 'resaltos'])
</div>
</div>