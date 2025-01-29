<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Comprimento total <code>*</code></strong></label>
        <input required id="comprimento_total"class="form-control{{ $errors->has('comprimento_total') ? ' is-invalid' : '' }}"
               name="comprimento_total" placeholder="0 (cm)" autocomplete="off"
               value="{{ old('comprimento_total', $comprimento_total) }}" required/>
        @include('shared.error_feedback', ['name' => 'comprimento_total'])
    </div>
</div>
