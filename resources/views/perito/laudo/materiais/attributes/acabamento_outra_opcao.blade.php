<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Acabamento (outros) <code>*</code></strong></label>
        <input disabled  id="acabamento_outra_opcao"class="form-control  {{ $errors->has('tipo_acabamento') ? ' is-invalid' : '' }}"
               name="tipo_acabamento"  
               value="{{ old('tipo_acabamento') }}" required/>
        @include('shared.error_feedback', ['name' => 'tipo_acabamento'])
    </div>
</div>