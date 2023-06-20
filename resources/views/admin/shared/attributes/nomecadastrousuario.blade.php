<div class="col-lg-{{ $size ?? "12" }} mt-2">

    <input hidden  class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" autocomplete="off"
        type="text" value="{{ old('nome', $nome) }}" required />
    @include('shared.error_feedback', ['name' => 'nome'])
</div>