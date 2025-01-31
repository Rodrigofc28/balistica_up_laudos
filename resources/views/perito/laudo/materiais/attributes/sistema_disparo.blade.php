<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Sistema de funcionamento <code>*</code></strong></label>
        <select required required class="js-single form-control{{ $errors->has('sistema_disparo') ? ' is-invalid' : '' }}"
                name="sistema_disparo" id="sistema_disparo">
                <option value=""></option>
            @foreach (['Ação simples','Dupla ação','Movimento duplo ( ação simples + dupla )','Ação híbrida ( dupla ação  com semiengatilhamento )'] as $sistema_disparo)
                <option value="{{ mb_strtolower($sistema_disparo)}}" {{ (mb_strtolower($sistema_disparo) == mb_strtolower($sistema_disparo2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($sistema_disparo)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'sistema_disparo'])
    </div>
</div>
