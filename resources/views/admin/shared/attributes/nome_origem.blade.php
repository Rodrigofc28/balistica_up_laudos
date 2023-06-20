<div class="col-lg-{{ $size ?? "12" }} mt-2">
<label for="nome">Pais origem*</label>
    <input  class="form-control{{ $errors->has('pais_origem') ? ' is-invalid' : '' }}" name="pais_origem" autocomplete="off"
        type="text" value="{{ old('pais_origem', $pais_origem) }}" required />
    @include('shared.error_feedback', ['name' => 'nome'])
</div>