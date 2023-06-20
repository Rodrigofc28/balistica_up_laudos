<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Cão <code>*</code></strong></label>
        <select class="js-single-select form-control{{ $errors->has('cao') ? ' is-invalid' : '' }}" name="cao" id="cao">
            <option value=""></option>
            @foreach (['Exposto', 'Mecanismo Embutido'] as $cao)
                <option value="{{ mb_strtolower($cao)}}" {{ (mb_strtolower($cao) == mb_strtolower($cao2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($cao)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'cao'])
    </div>
</div>