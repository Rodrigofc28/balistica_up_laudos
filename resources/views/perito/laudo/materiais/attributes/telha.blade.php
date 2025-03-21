<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Telha <code>*</code></strong></label>
        

               <select required id="telha"class="js-single form-control{{ $errors->has('telha') ? ' is-invalid' : '' }}" name="telha">
                <option value=""></option>
                    @foreach (['Madeira', 'Material Sintético', 'Desprovido'] as $telha)
                        <option value="{{ mb_strtolower($telha)}}" {{ (mb_strtolower($telha) == mb_strtolower($telha2)) ? 'selected=selected' : '' }}>
                            {{mb_strtoupper($telha)}}
                        </option>
                    @endforeach
                </select>



        @include('shared.error_feedback', ['name' => 'telha'])
    </div>
</div>