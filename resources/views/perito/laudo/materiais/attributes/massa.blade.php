<div class="col-lg-3">
    <div class="form-group">

            <label><strong>Massa(g)<code>*</code></strong></label>
            <input class="form-control{{ $errors->has('massa') ? ' is-invalid' : '' }}"
                   name="massa" autocomplete="off" type="text"
                   value="{{ old('massa', $massa) }}" min="0" id="massa" pattern="[0-9]{1}\,[0-9]{3}" placeholder="0 g" required/>
        
        @include('shared.error_feedback', ['name' => 'massa'])
    </div>
</div>
<div class="col-lg-3">
    <div class="form-group">

    <label><strong>Calibre real médio<code>*</code></strong></label>
            <input class="form-control {{ $errors->has('calibreReal') ? ' is-invalid' : '' }}"
                   name="calibreReal" autocomplete="off" type="text"
                   value="{{old('calibreReal',$calibreReal)}}" min="0" id="calibre_real_medio" required/>
    </div>
</div>
<div class="col-lg-3">
    <div class="form-group">

    <label><strong>Provável calibre nominal<code>*</code></strong></label>
            <input class="form-control {{ $errors->has('calibreNominal') ? ' is-invalid' : '' }}"
                   name="calibreNominal" autocomplete="off" id="provavel_calibre" type="text"
                   value="{{old('calibreNominal',$calibreNominal)}}" min="0" required/>
    </div>
</div>