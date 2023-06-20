<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Capacidade do Tambor <code>*</code></strong></label>
        <input id="capacidade_tambor" class="form-control {{ $errors->has('capacidade_tambor') ? ' is-invalid' : '' }}"
               name="capacidade_tambor" autocomplete="off" type="number"
               value="{{ old('capacidade_tambor', $capacidade_tambor) }}" min="0" required/>
        @include('shared.error_feedback', ['name' => 'capacidade_tambor'])
    </div>
</div>
