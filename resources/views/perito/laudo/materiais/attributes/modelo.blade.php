<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Modelo </strong></label>
        <input class="form-control{{ $errors->has('modelo') ? ' is-invalid' : '' }}"id="modelo" name="modelo" autocomplete="off" type="text"
               value="{{ old('modelo', $modelo) }}"/>
        @include('shared.error_feedback', ['name' => 'modelo'])
    </div>
</div>
