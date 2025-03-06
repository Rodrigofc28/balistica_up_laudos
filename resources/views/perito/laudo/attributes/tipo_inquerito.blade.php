<div class="col-lg-3 mt-2">
    <label for="tipo_inquerito"><strong>Tipo de documento<strong><code>*</code></strong></strong></label>
    
    <select required class="js-single-select form-control {{ $errors->has('tipo_inquerito') ? ' is-invalid' : '' }}"
            name="tipo_inquerito" id="tipo_inquerito">
        <option value=""></option>
        @foreach(['BO','IP/APFD','BOC','IP ONLINE','IP/PM','AI'] as $tipo_inquerito)
            <option  value="{{ $tipo_inquerito }}"  {{ $tipo_inquerito == $tipo_inquerito2 ? 'selected=selected' : '' }}>
                {{$tipo_inquerito}}
            </option>
        @endforeach
    </select>
    @include('shared.error_feedback', ['name' => 'tipo_inquerito'])
</div>
