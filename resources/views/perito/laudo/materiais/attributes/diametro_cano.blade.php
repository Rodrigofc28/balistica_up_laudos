<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Diâmetro do cano </strong></label>
        <input id="diametro_cano"class="form-control {{ $errors->has('diametro_cano') ? ' is-invalid' : '' }}"
               name="diametro_cano" placeholder="0 (mm)" autocomplete="off"
               value="{{ old('diametro_cano',$diametro_cano2) }}" />
        @include('shared.error_feedback', ['name' => 'diametro_cano'])
    </div>
</div>