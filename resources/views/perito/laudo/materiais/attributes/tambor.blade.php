<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Giro do tambor <code>*</code></strong></label>
        <select required id="tambor_rebate"class="js-single form-control{{ $errors->has('tambor_rebate') ? ' is-invalid' : '' }}"
                name="tambor_rebate">
            @foreach (['Sentido Horário', 'Sentido anti-horário'] as $tambor_rebate)
                <option value="{{ mb_strtolower($tambor_rebate)}}" {{ (mb_strtolower($tambor_rebate) == mb_strtolower($tambor_rebate2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($tambor_rebate)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'tambor_rebate'])
    </div>
</div>
