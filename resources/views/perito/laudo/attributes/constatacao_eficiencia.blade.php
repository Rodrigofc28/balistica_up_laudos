<div class="col-lg-3 mt-2 " >
    <style>
        .text-left{
            text-align: left,
            
        }
    </style>
    <label for=""><strong>Tipo de laudo<code>*</code></strong></label><br>
    @if($errors->has('laudoEfetConst')) 
        <span class="radio-red"><STRONG>* O CAMPO TIPO DE LAUDO DEVE SER MARCADO</STRONG> </span><br>
    @endif
    <!--Exame de Balística-->
    @if($tipo_exame=='balistica')
        
        <select class="form-control" name="laudoEfetConst" id="">
            <option value="B602">B602 - Exame de eficiência e prestabilidade</option>
            <option value="B601">B601 -  Exame de constatação</option>
            {{-- <option value="B603">Coleta de Padrão</option>
                <option value="B612">B612 - Exame de confronto balístico</option>--}}
        </select>
        {{--
        <label class="btn btn-dark btn-md btn-block mb-3 text-left"  for="constatacao">
           B603 - Coleta de Padrão &nbsp;&nbsp;
            
          <!--<input type="radio" name="laudoEfetConst"  id="constatacao" value="constatacao"> -->
        </label>
        <label class="btn btn-dark btn-md btn-block mb-3 text-left"  for="constatacao">
            B612 - Exame de confronto balístico &nbsp;&nbsp;
            
          <!--<input type="radio" name="laudoEfetConst"  id="constatacao" value="constatacao"> -->
        </label>--}}
    @endif
    <!--Exame de Chassi-->
    @if($tipo_exame=='chassi')
        <label class="btn btn-dark btn-md btn-block mb-3 text-left" for="eficiencia">
            I801 - Numerações Identificadoras &nbsp;&nbsp;
            <input type="radio" name="laudoEfetConst" id="#" value="I801"> 
        </label>
        <label class="btn btn-dark btn-md btn-block mb-3 text-left" for="eficiencia">
            I802 - Compartimentos &nbsp;&nbsp;
            <input type="radio" name="laudoEfetConst" id="#" value="I802"> 
        </label>
        <label class="btn btn-dark btn-md btn-block mb-3 text-left" for="eficiencia">
            I806 - Constatação &nbsp;&nbsp;
            <input type="radio" name="laudoEfetConst" id="#" value="I806"> 
        </label>
        <label class="btn btn-dark btn-md btn-block mb-3 text-left" for="eficiencia">
            I812 - Numerações Identificadoras + compartimentos &nbsp;&nbsp;
            <input type="radio" name="laudoEfetConst" id="#" value="I812"> 
        </label>
       
    @endif

    @include('shared.error_feedback', ['name' => 'laudoEfetConst'])
    
</div>