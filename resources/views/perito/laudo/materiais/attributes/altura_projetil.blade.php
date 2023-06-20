<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Altura máxima (mm) <code>*</code></strong></label>
        <input class="form-control {{ $errors->has('altura') ? ' is-invalid' : '' }}"
               name="altura_projetil" autocomplete="off"
               value="{{ old('altura', $altura) }}"  placeholder="0 mm" id="altura_projetil"  required/>
        @include('shared.error_feedback', ['name' => 'altura'])
        
    </div>
</div>
