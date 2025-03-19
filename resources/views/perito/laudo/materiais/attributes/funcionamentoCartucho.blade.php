<div class="col-lg-3">
    <div class="form-group" >
        <label><strong>Funcionamento<code>*</code></strong></label>
        <select class="js-single-select form-control"
                name="funcionamentoCartucho" id="funcionamentoCartucho">
            <option > </option>
            <option > </option>
            @if($laudo->laudoEfetConst=="B601"){{--Para exame B601--}}
                @foreach (['Ineficiente','Preservado'] as $funcionamento)
                    <option @if($funcionamento=="Ineficiente") selected @endif value="{{ mb_strtolower($funcionamento)}}" {{ (mb_strtolower($funcionamento) == mb_strtolower($funcionamentoCartucho)) ? 'selected=selected' : '' }}
                            >
                        {{mb_strtoupper($funcionamento)}}
                    </option>
                @endforeach
            @else{{--Para exame B602--}}
                @foreach (['Eficiente', 'Ineficiente','Parcialmente','Preservado'] as $funcionamento)
                    <option value="{{ mb_strtolower($funcionamento)}}" {{ (mb_strtolower($funcionamento) == mb_strtolower($funcionamentoCartucho)) ? 'selected=selected' : '' }}
                            >
                        {{mb_strtoupper($funcionamento)}}
                    </option>
                @endforeach
            @endif
        </select>
        @include('shared.error_feedback', ['name' => 'funcionamento'])
    </div>
</div>
<div class="col-lg-3"id="qtdEf">
    <div class="form-group">
        <label for="" ><strong>Quantidade Eficiente</strong></label>
        <input type="number"  class="form-control" name="qtEficiente">
        
    </div>
</div>
<div class="col-lg-3"id="qtdIne">
    <div class="form-group">
        
        <label for="" ><strong>Quantidade Ineficiente</strong></label>
        <input type="number"  class="form-control" name="qtIneficiente">
    </div>
</div>
