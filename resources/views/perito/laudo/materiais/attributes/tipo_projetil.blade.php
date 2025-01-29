<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Tipo <code>*</code></strong></label>
        
        <select required class="js-single form-control{{ $errors->has('tipo_projetil') ? ' is-invalid' : '' }}" name="tipo_projetil"  id="tipo_projetil">
        <option></option>
            @foreach (['Projétil', 'Camisa', 'Núcleo',' Fragmento de Projétil','Fragmento de Camisa','Corpo de Chumbo'] as $tipo_projetil)
                <option value="{{$tipo_projetil}}" {{ ($tipo_projetil == $tipo_projetil2) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($tipo_projetil)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'tipo_projetil'])
    </div>
</div>