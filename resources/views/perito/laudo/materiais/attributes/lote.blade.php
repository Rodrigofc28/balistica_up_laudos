<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Lote</strong></label>
        <input class="form-control{{ $errors->has('lote') ? ' is-invalid' : '' }}"
               name="lote" autocomplete="off" maxlength="12" id="lote" value="{{ old('lote', $lote) }}" type="text"
                />
        @include('shared.error_feedback', ['name' => 'lote'])
    </div>
</div>