<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Quantidade de Canos<code> *</code></strong></label>
        <input class="form-control {{ $errors->has('quantidade_canos') ? ' is-invalid' : '' }}"
                   name="quantidade_canos" autocomplete="off" type="number"
                   value="{{old('quantidade_canos','$quantidade_canos')}}" required/>
        
        @include('shared.error_feedback', ['name' => 'quantidade_canos'])
    </div>
</div>