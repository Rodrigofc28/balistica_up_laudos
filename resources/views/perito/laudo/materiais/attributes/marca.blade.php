<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Marca <code>*</code></strong></label>
        <button type="button" class="btn-cadastro float-right" id="cadastrar_marca">
            <i class="fas fa-plus" aria-hidden="true"></i> Cadastrar
        </button>
        <select required class="js-single-marcas form-control{{ $errors->has('marca_id') ? ' is-invalid' : '' }}" name="marca_id"
            id="marca">
            <option></option>
            @foreach ($marcas as $marca)
            <option value="{{ $marca->id }}" {{ $marca->id == $marca2 ? 'selected=selected' : '' }}>
                {{mb_strtoupper($marca->nome)}}
            </option>
            
            @endforeach
        </select>
        
        @include('shared.error_feedback', ['name' => 'marca_id'])
    </div>
</div>