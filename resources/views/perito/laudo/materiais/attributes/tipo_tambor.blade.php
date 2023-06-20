<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Tipo tambor <code>*</code></strong></label>
        <select required class="js-single-select form-control{{ $errors->has('tipo_tambor') ? ' is-invalid' : '' }}" id="tipo_tambor" name="tipo_tambor">
            <option value=""></option>
            @foreach (['Fixo com janela', 'Fixo basculante para cima', 'Fixo basculante para baixo', 'Reversível para direita','Reversivél para a esquerda','Removível'] as $tipo_tambor)
                <option value="{{ mb_strtolower($tipo_tambor)}}" {{ (mb_strtolower($tipo_tambor) == mb_strtolower($tipo_tambor2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($tipo_tambor)}}
                </option>
            @endforeach
        </select>
        
    </div>
</div>