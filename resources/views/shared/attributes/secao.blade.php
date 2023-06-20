<div class="col-lg-{{ $size ?? "3" }} ">
    <label for="secao_id"><strong>Unidade <code> *</code></strong></label>
    <select class="js-single-secoes form-control {{ $errors->has('secao_id') ? ' is-invalid' : '' }}"
            name="secao_id" id="secao_id">
        @foreach($secoes as $secao)
            @if(Auth::user()->secao->id === $secao->id && $secao2=='' )
                <option value="{{$secao->id}}" selected>{{$secao->nome}}</option>
            @else
                <option value="{{ $secao->id }}" {{ $secao->id == $secao2 ? 'selected=selected' : '' }}>
                    {{$secao->nome}}
                </option>
            @endif
        @endforeach
    </select>
    @include('shared.error_feedback', ['name' => 'secao_id'])
</div>
