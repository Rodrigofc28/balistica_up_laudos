<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Funcionamento <code>*</code> </strong></label>
        <select required class="js-single-select form-control{{ $errors->has('funcionamento') ? ' is-invalid' : '' }}"
                name="funcionamento" id="funcionamento" required>
            <option value=""></option>
            @foreach (['Eficiente', 'Ineficiente'] as $funcionamento)
                <option value="{{ mb_strtolower($funcionamento)}}"
                        {{ (mb_strtolower($funcionamento) == mb_strtolower($funcionamento2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($funcionamento)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'funcionamento'])
    </div>
</div>
