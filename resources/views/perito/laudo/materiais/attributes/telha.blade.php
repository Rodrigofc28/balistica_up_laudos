<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Telha <code>*</code></strong></label>
        <input required id="telha"class="form-control{{ $errors->has('telha') ? ' is-invalid' : '' }}" name="telha" autocomplete="off" type="text"
               value="{{ old('telha', $telha) }}"/>
        @include('shared.error_feedback', ['name' => 'telha'])
    </div>
</div>