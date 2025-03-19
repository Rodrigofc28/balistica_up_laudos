<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Estojo<code>*</code></strong></label>
        <select required class="js-single-select form-control{{ $errors->has('estojo') ? ' is-invalid' : '' }}"
                name="estojo" id="estojo">
                
            <option value=""></option>
            @foreach ([' Latonado', ' Niquelado' ,' Aço','Alumínio','Cobre',' Plástico com Culote Metálico',' Papelão com Culote Metálico'] as $estojo)
                <option value="{{ mb_strtolower($estojo)}}" {{ (mb_strtolower($estojo) == mb_strtolower($estojo2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($estojo)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'estojo'])
    </div>
</div>