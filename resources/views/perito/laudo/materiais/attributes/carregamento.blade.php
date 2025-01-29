<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Carregamento <code>*</code></strong></label>
        <select required id="carregamento" class="js-single form-control{{ $errors->has('carregamento') ? ' is-invalid' : '' }}"
            name="carregamento">
            @foreach (['Automática', 'Semi-automática'] as $carregamento)
            <option value="{{ mb_strtolower($carregamento)}}"
                {{ (mb_strtolower($carregamento) == mb_strtolower($carregamento2)) ? 'selected=selected' : '' }}>
                {{mb_strtoupper($carregamento)}}
            </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'carregamento'])
    </div>
</div>