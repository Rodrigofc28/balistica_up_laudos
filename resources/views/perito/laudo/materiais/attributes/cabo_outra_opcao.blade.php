<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Cabo (outros) <code>*</code></strong></label>
        <input required disabled  id="cabo_outra_opcao"class="form-control  {{ $errors->has('cabo') ? ' is-invalid' : '' }}"
               name="cabo"  
               value="{{ old('cabo') }}" required/>
        @include('shared.error_feedback', ['name' => 'cabo'])
    </div>
</div>