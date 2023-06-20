<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Estado Geral <code>*</code></strong></label>
        <select class="js-single form-control{{ $errors->has('estado_geral') ? ' is-invalid' : '' }}"
                name="estado_geral" id="estado_geral">
                <option></option>
            @foreach (['Regular','Bom', 'Ruim'] as $estado_geral)
                <option value="{{ mb_strtolower($estado_geral)}}"
                        {{ (mb_strtolower($estado_geral) == mb_strtolower($estado_geral2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($estado_geral)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'estado_geral'])
    </div>
</div>