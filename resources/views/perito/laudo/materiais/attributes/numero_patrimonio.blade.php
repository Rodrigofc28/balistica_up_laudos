<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Número de patrimônio</strong></label>
        <input class="form-control" name="numero_patrimonio" id="numPatrimonio" autocomplete="off" type="text"
               value="{{ old('numero_patrimonio', $numero_patrimonio) }}"/>
        @include('shared.error_feedback', ['name' => 'numero_patrimonio'])
    </div>
</div>