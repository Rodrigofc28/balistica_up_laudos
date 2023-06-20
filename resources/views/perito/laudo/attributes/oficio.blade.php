<div class="col-lg-{{ $size ?? "3" }} mt-2">
    <label for="oficio"><strong>Ofício </strong></label>
    <input class="form-control{{ $errors->has('oficio') ? ' is-invalid' : '' }}"
         id="oficio"  name="oficio" autocomplete="off" type="text"
           value="{{ old('oficio', $oficio) }}" />
    @include('shared.error_feedback', ['name' => 'oficio'])
</div>