<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Carregador <code>*</code></strong></label>
        <select class="js-single form-control{{ $errors->has('carregador') ? ' is-invalid' : '' }}" name="carregador">
            @foreach (['Monofilar', 'Tubular'] as $carregador)
                <option value="{{ mb_strtolower($carregador)}}" {{ (mb_strtolower($carregador) == mb_strtolower($carregador2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($carregador)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'carregador'])
    </div>
</div>