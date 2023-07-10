<div class="col-lg-3" id="condicao_cartucho">
    <div class="form-group" id="condicao_cartucho">
        <label><strong>Condição cartucho<code> *</code></strong></label>
        <select class="js-single-select form-control{{ $errors->has('funcionamento') ? ' is-invalid' : '' }}"
                name="funcionamento" id="condicaoCartucho">
            <option value=""></option>
            @foreach (['Intacto', 'percutido e não deflagrado'] as $funcionamento)
                <option value="{{ mb_strtolower($funcionamento)}}"
                        {{ (mb_strtolower($funcionamento) == mb_strtolower($funcionamento2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($funcionamento)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'funcionamento'])
    </div>
</div>


<div class="col-lg-3" id="condicao_estojo">
    <div class="form-group" id="condicao_estojo">
        <label><strong>Condição estojo<code> *</code></strong></label>
        <select class="js-single-select form-control{{ $errors->has('funcionamento') ? ' is-invalid' : '' }}"
                name="funcionamento" id="condicaoEstojo">
            <option value=""></option>
            @foreach (['espoletado','percutido e deflagrado','recarregável'] as $funcionamento)
                <option value="{{ mb_strtolower($funcionamento)}}"
                        {{ (mb_strtolower($funcionamento) == mb_strtolower($funcionamento2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($funcionamento)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'funcionamento'])
    </div>
</div>