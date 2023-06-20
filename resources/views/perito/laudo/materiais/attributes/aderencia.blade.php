<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Aderências <code> *</code></strong></label>
        <select class="js-example-basic-multiple"
                name="aderencia[]" multiple="multiple" id="aderencia">
            <option value=""></option>
            @foreach (['TOD', 'NNI','SS','NDR','Caliça','Madeira','Terra'] as $aderencia)
                <option value="{{mb_strtoupper($aderencia)}}" >
                    {{mb_strtoupper($aderencia)}}
                </option>
            @endforeach
        </select>
        <label hidden disabled for="aderencia_input">Aderências (Outros)</label><br>
        <input hidden disabled type="text" name="aderencia" id="aderencia_input">
        @include('shared.error_feedback', ['name' => 'aderencia'])
    </div>
</div>