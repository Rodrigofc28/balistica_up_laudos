<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Disposição dos Canos <code>*</code></strong></label>
        <select required class="js-single-select form-control{{ $errors->has('disposicao_canos') ? ' is-invalid' : '' }}"
                name="disposicao_canos" id="disposicao_canos">
            <option value=""></option>
            @foreach (['Justapostos', 'Sobrepostos'] as $disposicao_canos)
                <option value="{{ mb_strtolower($disposicao_canos)}}" {{ (mb_strtolower($disposicao_canos) == mb_strtolower($disposicao_canos2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($disposicao_canos)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'disposicao_canos'])
    </div>
</div>
