<div class="col-lg-3">
    <label for="cidade_id"><strong>Buscar Cidade</strong></label>
    <form action="{{route('solicitantes.search')}}" method="get">
        <select onchange="this.form.submit()" class="js-single-cidades form-control {{ $errors->has('cidade_id') ? ' is-invalid' : '' }}" name="cidade"
            id="cidade">
            <option></option>
            @foreach($cidades as $cidade)
            <option value="{{ $cidade->nome }}" {{ $cidade->nome == $cidade2 ? 'selected=selected' : '' }}>
                {{$cidade->nome}}
            </option>
            @endforeach
        </select>
    </form>
    
   
    @include('shared.error_feedback', ['name' => 'cidade_id'])
</div>