<div class="col-lg-{{ $size ?? "12" }} mt-2">
    <label for="cargo_id"></label>
    <select class="js-single form-control {{ $errors->has('cargo_id') ? ' is-invalid' : '' }}" name="cargo_id">
        <option value=""></option>
        @foreach($cargos as $cargo)
        <option value="{{ $cargo->id }}" {{ $cargo->id == $cargo2 ? 'selected=selected' : '' }}>
            {{$cargo->nome}}
        </option>
        @endforeach
    </select>
    @include('shared.error_feedback', ['name' => 'cargo_id'])
</div>