<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Nº do Lacre entrada<code>*</code></strong> </label>
        <input required class="form-control{{ $errors->has('num_lacre') ? ' is-invalid' : '' }}"
               name="num_lacre_saida" autocomplete="off" type="text" id="numLacreEntrada"
               value="{{ old('num_lacre_saida', $num_lacre_saida) }}" required/>
        @include('shared.error_feedback', ['name' => 'lacre'])
    </div>
</div>