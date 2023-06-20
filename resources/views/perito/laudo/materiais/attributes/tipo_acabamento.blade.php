<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Tipo de Acabamento <code>*</code></strong></label>
        <select class="js-single form-control{{ $errors->has('tipo_acabamento') ? ' is-invalid' : '' }}"
                name="tipo_acabamento" id="tipo_acabamento">
                <option value=""></option>
            @foreach (['Desprovido', 'Cromado', 'Emborrachado', 'Niquelado', 'Oxidado','outros'] as $acabamento)
                <option value="{{ mb_strtolower($acabamento)}}" {{ (mb_strtolower($acabamento) == mb_strtolower($tipo_acabamento2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($acabamento)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'tipo_acabamento'])
    </div>
</div>
