<div class="col-lg-{{ $size ?? "3" }} mt-2">
    <label for="rep"><strong>Rep (xxxxxx/ano)<code> *</code></strong></label>
    <input class="form-control {{ $errors->has('rep') ? ' is-invalid' : '' }}"
         id="rep"  name="rep"  autocomplete="off" type="text"
           value="{{ old('rep', $rep) }}"  required placeholder="******/ano"/>
    @include('shared.error_feedback', ['name' => 'rep'])
</div>