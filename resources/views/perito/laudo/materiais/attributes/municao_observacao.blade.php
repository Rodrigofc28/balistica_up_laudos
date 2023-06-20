<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Observação </strong></label>
        <input class="form-control{{ $errors->has('observacao') ? ' is-invalid' : '' }}" type="text" value="{{old('observacao',$observacao)}}" name="observacao" id="observacao">
        
    </div>
</div>