<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Retem do Carregador <code>*</code></strong></label>
        <select required id="retem_carregador"class="js-single form-control{{ $errors->has('retem_carregador') ? ' is-invalid' : '' }}" name="retem_carregador">
            @foreach (['Ambidestro', 'Lado Direito', 'Lado Esquerdo'] as $retem_carregador)
                <option value="{{ mb_strtolower($retem_carregador)}}" {{ (mb_strtolower($retem_carregador) == mb_strtolower($retem_carregador2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($retem_carregador)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'retem_carregador'])
    </div>
</div>