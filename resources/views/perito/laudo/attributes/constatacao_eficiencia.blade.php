<div class="col-lg-3 mt-2" >
    <label for=""><strong>Tipo de laudo<code>*</code></strong></label><br>
    @if($errors->has('laudoEfetConst')) 
        <span class="radio-red"><STRONG>* O CAMPO TIPO DE LAUDO DEVE SER MARCADO</STRONG> </span><br>
    @endif
    
    <input type="radio" name="laudoEfetConst"  id="constatacao" value="constatacao"> <span  >Constatação</span> <br>
    
    <hr>
    <input type="radio" name="laudoEfetConst" id="eficiencia" value="efetivacao"> Eficiência<br>

    

    @include('shared.error_feedback', ['name' => 'laudoEfetConst'])
    
</div>