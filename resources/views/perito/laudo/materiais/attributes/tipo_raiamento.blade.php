<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Tipo de Raiamento <code> *</code></strong></label>
        <select required class="js-single-select form-control{{ $errors->has('tipo_raiamento') ? ' is-invalid' : '' }}"
                name="tipo_raiamento" id="tipo_raiamento">
            <option value=""></option>
            @foreach (['Convencional', 'Poligonal','Poligonal aprimorado','Não raiado'] as $tipo_raiamento)
                <option value="{{ $tipo_raiamento}}" {{ ($tipo_raiamento == $tipo_raiamento2) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($tipo_raiamento)}}
                </option>
            @endforeach
        </select>
        
        @include('shared.error_feedback', ['name' => 'tipo_raiamneto'])
    </div>
</div>
