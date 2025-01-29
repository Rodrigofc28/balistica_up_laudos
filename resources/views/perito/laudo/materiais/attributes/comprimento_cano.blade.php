<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Comprimento do Cano <code>*</code></strong></label>
        <input required id="comprimento_cano"class="form-control {{ $errors->has('comprimento_cano') ? ' is-invalid' : '' }}" name="comprimento_cano"
               placeholder="0 (cm)" autocomplete="off"
               value="{{ old('comprimento_cano', $comprimento_cano) }}" required/>
        @include('shared.error_feedback', ['name' => 'comprimento_cano'])
    </div>
</div>
