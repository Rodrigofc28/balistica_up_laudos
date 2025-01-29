<div class="col-lg-3">
	<div class="form-group">
		<label><strong>Regime de tiro <code>*</code></strong></label>
		<select required class="js-single form-control{{ $errors->has('sistema_funcionamento') ? ' is-invalid' : '' }}"
				name="sistema_funcionamento" id="sistema_funcionamento">
				<option value=""></option>
			@foreach (['Unitário', 'Repetição', 'Semi-automático', 'Automático','Repetição + semiautomático','Semiautomático + automático'] as $sistema_funcionamento)
				<option value="{{ mb_strtolower($sistema_funcionamento)}}" {{ (mb_strtolower($sistema_funcionamento) == mb_strtolower($sistema_funcionamento2)) ? 'selected=selected' : '' }}>
					{{mb_strtoupper($sistema_funcionamento)}}
				</option>
			@endforeach
		</select>
		@include('shared.error_feedback', ['name' => 'sistema_funcionamento'])
	</div>
</div>

