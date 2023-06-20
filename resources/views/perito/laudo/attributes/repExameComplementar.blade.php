<div class="col-lg-{{ $size ?? "3" }} ">
    <label for="rep"><strong>Requisição de Exame Complementar</strong></label>
    <input class="form-control {{ $errors->has('rep') ? ' is-invalid' : '' }}"
           name="repExameComplementar"  autocomplete="off" type="text"
           value="{{ old('rep', $rep) }}"   placeholder="******/ano"/>
    @include('shared.error_feedback', ['name' => 'rep'])
</div>