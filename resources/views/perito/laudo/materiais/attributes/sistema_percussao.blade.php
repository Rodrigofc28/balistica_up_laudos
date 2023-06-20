<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Sistema de Percussão <code>*</code></strong></label>
        <select required id="sistema_percussao"class="js-single form-control{{ $errors->has('sistema_percussao') ? ' is-invalid' : '' }}"
                name="sistema_percussao">
                <option value=""></option>
            @foreach (['Indireta com cão exposto','Indireta com cão oculto','Direta com cão exposto','direta com percutor lançado','Direta com percutor fixo ao ferrolho','mecanismos embutidos'] as $sistema_percussao)
                <option value="{{ mb_strtolower($sistema_percussao)}}" {{ (mb_strtolower($sistema_percussao) == mb_strtolower($sistema_percussao2)) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($sistema_percussao)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'sistema_percussao'])
    </div>
</div>
