<div class="col-lg-3"><!-- Lacre de Entrada Munição -->
    <div class="form-group">
        
        <label ><strong> @if($label=="N° lacre de saida"){{$label}} @else {{$label}}<code>*</code>@endif </strong></label>
        <input  class="form-control{{ $errors->has('lacrecartucho') ? ' is-invalid' : '' }}"
            name="{{$name}}"@if($label!="N° lacre de saida")required @endif   id="{{$name}}" autocomplete="off" type="text" value="{{old('lacre',$lacre)}}"
                />
        @include('shared.error_feedback', ['name' => 'lacre'])
    </div>
</div>