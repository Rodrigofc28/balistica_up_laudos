<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Tipo da Munição <code>*</code></strong></label>
        <select class="js-single form-control{{ $errors->has('tipo_municao') ? ' is-invalid' : '' }}"
            name="tipo_municao" id="tipo_municao">
            @foreach (['Cartucho', 'Estojo'] as $tipo_municao)
            <option value="{{ mb_strtolower($tipo_municao)}}"
                {{ (mb_strtolower($tipo_municao) == mb_strtolower($tipo_municao2)) ? 'selected=selected' : '' }}>
                {{mb_strtoupper($tipo_municao)}}
            </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'tipo_municao'])
    </div>
</div>