<div class="col-lg-3">
    <div class="form-group" >
        <label><strong>Sentido das Raias <code>*</code></strong></label>
        <select id="sentido_raias"class="js-single form-control{{ $errors->has('sentido_raias') ? ' is-invalid' : '' }}" name="sentido_raias">
            <option></option>
            @foreach (['Dextrógiro', 'Sinistrógiro', 'Prejudicado'] as $sentido_raias)
                <option value="{{ mb_strtolower($sentido_raias)}}" {{ (mb_strtolower($sentido_raias) == mb_strtolower($sentido_raias2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($sentido_raias)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'sentido_raias'])
    </div>
</div>
