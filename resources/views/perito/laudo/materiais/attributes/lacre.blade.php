<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Nº do Lacre saída <code>*</code> </strong></label>
        <input class="form-control{{ $errors->has('num_lacre') ? ' is-invalid' : '' }}"
                required
               name="num_lacre" autocomplete="off" type="text" id="lacreSaida"
               value="{{ old('num_lacre', $num_lacre) }}" />
        @include('shared.error_feedback', ['name' => 'lacre'])
    </div>
</div>
