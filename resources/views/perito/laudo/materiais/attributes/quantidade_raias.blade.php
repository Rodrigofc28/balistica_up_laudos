<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Quantidade de Raias<code> *</code></strong></label>
        <input id="quantidade_raias"class="form-control{{ $errors->has('quantidade_raias') ? ' is-invalid' : '' }}"
               name="quantidade_raias" autocomplete="off" type="number"
               value="{{ old('quantidade_raias', $quantidade_raias) }}" min="0" required/>
        @include('shared.error_feedback', ['name' => 'quantidade_raias'])
    </div>
</div>
