<div class="col-lg-{{ $size ?? "8" }}">
    @if(!empty($label))
    @if($label != "Data da ocorrência")
        <label for="{{ $name }}" class="col-form-label"><strong>{{ $label }}<code>*</code> </strong></label>
    @else
    <label for="{{ $name }}" class="col-form-label"><strong>{{ $label }} </strong></label>
    @endif
    @endif
    @if(!empty($label2))
        <label for="{{ $name }}" class="col-form-label">{{ $label2 ?? ''}}</label>
    @endif
    <input class="form-control calendario {{ $errors->has($name) ? ' is-invalid' : '' }}"
           type="text" id="{{ $id ?? $name }}" name="{{ $name }}"
           autocomplete="off" value="{{old($name) ?? $value}}"  placeholder="__/__/____"/>
    @include('shared.error_feedback', ['name' => $name])
</div>