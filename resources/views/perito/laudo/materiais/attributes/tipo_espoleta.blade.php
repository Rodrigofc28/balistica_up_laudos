<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Espoleta<code>*</code></strong></label>
        <select required class="js-single-select form-control{{ $errors->has('tipo_projetil') ? ' is-invalid' : '' }}"
                name="tipo_projetil" id="tipo_projetil">
            <option value=""></option>
            @foreach (['Latonada', 'Niquelada', 'Aço','Cobre'] as $tipo_espoleta)   
                <option value="{{ mb_strtolower($tipo_espoleta)}}" {{ (mb_strtolower($tipo_espoleta) == mb_strtolower($tipo_espoleta2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($tipo_espoleta)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'tipo_espoleta'])
    </div>
</div>