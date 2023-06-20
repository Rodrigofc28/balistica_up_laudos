<div class="col-lg-{{ $size ?? "3" }} mt-2">
    <label for="indiciado"><strong>Indiciado</strong></label>
    <input class="form-control{{ $errors->has('indiciado') ? ' is-invalid' : '' }}"
           name="indiciado" autocomplete="off" type="text"
           value="{{ old('indiciado', $indiciado) }}" maxlength="80"/>
    @include('shared.error_feedback', ['name' => 'indiciado'])
</div>