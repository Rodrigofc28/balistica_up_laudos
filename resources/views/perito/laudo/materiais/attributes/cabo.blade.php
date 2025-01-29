<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Cabo <code>*</code></strong></label>
        <select required class="js-single form-control{{ $errors->has('cabo') ? ' is-invalid' : '' }}" name="cabo" id="cabo" >
        <option value=""></option>
            @foreach (['Chifre', 'Madrepérola', 'Madeira', 'Material Sintético','Outros'] as $cabo)
                <option value="{{ mb_strtolower($cabo)}}" {{ (mb_strtolower($cabo) == mb_strtolower($cabo2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($cabo)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'cabo'])
    </div>
</div>