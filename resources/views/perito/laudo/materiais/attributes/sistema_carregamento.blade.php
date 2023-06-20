<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Sistema de Carregamento <code>*</code></strong></label>
        <select id="sistema_carregamento"class="js-single form-control{{ $errors->has('sistema_carregamento') ? ' is-invalid' : '' }}"
                name="sistema_carregamento" id="sistema_carregamento">
                <option value=""></option>
            @foreach (['Retrocarga', 'Antecarga'] as $sistema_carregamento)
                <option value="{{ mb_strtolower($sistema_carregamento)}}" {{ (mb_strtolower($sistema_carregamento) == mb_strtolower($sistema_carregamento2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($sistema_carregamento)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'sistema_carregamento'])
    </div>
</div>
