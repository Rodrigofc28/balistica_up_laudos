<div class="col-lg-3">
	<div class="form-group">
		<label><strong>Sistema de inflamação <code>*</code></strong></label>
		<select required id="sistema_inflamacao"class="js-single form-control{{ $errors->has('sistema_inflamacao') ? ' is-invalid' : '' }}" name="sistema_inflamacao">
		<option value=""></option>
			@foreach (['Intrínseca', 'Extrínseca', 'Fecho de pederneira','Fecho de roda','Pavio'] as $sistema_inflamacao)
				<option value="{{ mb_strtolower($sistema_inflamacao)}}" {{ (mb_strtolower($sistema_inflamacao) == mb_strtolower($sistema_inflamacao2)) ? 'selected=selected' : '' }}>
					{{mb_strtoupper($sistema_inflamacao)}}
				</option>
			@endforeach
		</select>
		@include('shared.error_feedback', ['name' => 'sistema_inflamacao'])
	</div>
</div>