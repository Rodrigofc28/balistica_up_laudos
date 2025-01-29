<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Quantidade <code>*</code></strong></label>
        <input required class="form-control {{ $errors->has('quantidade') ? ' is-invalid' : '' }}"
               name="quantidade" autocomplete="off" type="number" id="quantidade"
               value="{{ old('quantidade', $quantidade) }}" min="0" required/>
        @include('shared.error_feedback', ['name' => 'quantidade'])
    </div>
</div>
