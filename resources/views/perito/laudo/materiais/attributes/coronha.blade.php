<div class="col-lg-3">
	<div class="form-group">
		<label><strong>Coronha <code>*</code></strong></label>
		<select required id="coronha"class="js-single form-control{{ $errors->has('coronha_fuste') ? ' is-invalid' : '' }}" name="coronha_fuste">
		<option value=""></option>
			@foreach (['Madeira', 'Material Sintético', 'Desprovido'] as $coronha_fuste)
				<option value="{{ mb_strtolower($coronha_fuste)}}" {{ (mb_strtolower($coronha_fuste) == mb_strtolower($coronha_fuste2)) ? 'selected=selected' : '' }}>
					{{mb_strtoupper($coronha_fuste)}}
				</option>
			@endforeach
		</select>
		@include('shared.error_feedback', ['name' => 'coronha_fuste'])
	</div>
</div>