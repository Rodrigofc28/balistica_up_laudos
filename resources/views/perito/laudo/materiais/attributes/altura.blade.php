<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Altura <code>*</code></strong></label>
        <input required class="form-control  {{ $errors->has('altura') ? ' is-invalid' : '' }}" name="altura"
            placeholder="0 (cm)" id="altura" autocomplete="off" value="{{ old('altura', $altura) }}" required />
        @include('shared.error_feedback', ['name' => 'altura'])
    </div>
</div>