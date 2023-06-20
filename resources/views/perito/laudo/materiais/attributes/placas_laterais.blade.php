<div class="col-lg-3">
    <div class="form-group">
        <label>Placas Laterais *</label>
        <select id="placas_laterais"class="js-single-select form-control{{ $errors->has('placas_laterais') ? ' is-invalid' : '' }}" name="placas_laterais">
            <option value=""></option>
            @foreach (['Desprovido', 'Sintético'] as $placas_laterais)
                <option value="{{ mb_strtolower($placas_laterais)}}" {{ (mb_strtolower($placas_laterais) == mb_strtolower($placas_laterais2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($placas_laterais)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'placas_laterais'])
    </div>
</div>