<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Trava de Segurança <code>*</code></strong></label>
        <select id="trava_seguranca"class="js-single form-control{{ $errors->has('trava_seguranca') ? ' is-invalid' : '' }}" name="trava_seguranca">
            @foreach (['Ambidestro', 'Lado Direito', 'Lado Esquerdo', 'Não Possui'] as $trava_seguranca)
                <option value="{{ mb_strtolower($trava_seguranca)}}" {{ (mb_strtolower($trava_seguranca) == mb_strtolower($trava_seguranca2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($trava_seguranca)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'trava_seguranca'])
    </div>
</div>