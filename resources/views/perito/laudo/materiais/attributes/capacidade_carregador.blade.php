<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Capacidade <code>*</code></strong></label>
        <input required id="capacidade_carregador" class="form-control {{ $errors->has('capacidade_carregador') ? ' is-invalid' : '' }}"
               name="capacidade_carregador" autocomplete="off" type="number"
               value="{{ old('capacidade_carregador', $capacidade_carregador) }}" min="0" required/>
        @include('shared.error_feedback', ['name' => 'capacidade_carregador'])
    </div>
</div>
