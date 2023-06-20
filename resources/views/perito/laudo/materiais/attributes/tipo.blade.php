<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Tipo <code>*</code></strong></label>
        <select id="tipo"class="js-single form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}"
            name="tipo">
            @foreach (['Projétil', 'Camisa', 'Núcleo', 'Fragmento de Projétil','Fragmento de Camisa','Corpo de Chumbo'] as $tipo)
            <option value="{{ mb_strtolower($tipo)}}"
                {{ (mb_strtolower($tipo) == mb_strtolower($tipo2)) ? 'selected=selected' : '' }}>
                {{mb_strtoupper($tipo)}}
            </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'tipo'])
    </div>
</div>