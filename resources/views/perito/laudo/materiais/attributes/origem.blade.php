<div class="col-lg-3">
    <div class="form-group">
        <label><strong>País de Origem <code>*</code></strong></label>
       
        <select required class="js-single-origens form-control{{ $errors->has('marca_id') ? ' is-invalid' : '' }}"
            name="origem_id" id="pais">
            <option></option>
            @foreach ($marcas as $marca)
            <option value="{{ $marca->id }}" {{ $marca->id == $origem2 ? 'selected=selected' : '' }} }} >
                {{mb_strtoupper($marca->pais_origem)}}
            </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'marca_id'])
    </div>
</div>