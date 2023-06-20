<div class="col-lg-3">
    <label for="cidade_id"><strong>Cidade <code>*</code></strong></label>
    <select class="js-single-cidades form-control {{ $errors->has('cidade_id') ? ' is-invalid' : '' }}" name="cidade_id"
        id="cidade">
        <option></option>
        @foreach($cidades as $cidade)
        <option value="{{ $cidade->nome }}" {{ $cidade->nome == $cidade2 ? 'selected=selected' : '' }}>
            {{$cidade->nome}}
        </option>
        @endforeach
    </select>
   <strong> <span id="rua"></span></strong>
    <strong><span id="complemento"></span></strong>
    @include('shared.error_feedback', ['name' => 'cidade_id'])
</div>