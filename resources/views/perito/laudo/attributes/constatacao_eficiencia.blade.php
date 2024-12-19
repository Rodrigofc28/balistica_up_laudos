<div class="col-lg-3 mt-2" >
    <label for=""><strong>Tipo de laudo<code>*</code></strong></label><br>
    @if($errors->has('laudoEfetConst')) 
        <span class="radio-red"><STRONG>* O CAMPO TIPO DE LAUDO DEVE SER MARCADO</STRONG> </span><br>
    @endif
    <label class="btn btn-dark btn-md btn-block mb-3" for="eficiencia">
        Eficiência &nbsp;&nbsp;
        <input type="radio" name="laudoEfetConst" id="eficiencia" value="efetivacao"> 
    </label>
    <label class="btn btn-dark btn-md btn-block mb-3"  for="constatacao">
        Constatação &nbsp;&nbsp;
        <span style="color:red" > (Em desenvolvimento) </span>
       <input type="radio" name="laudoEfetConst"  id="constatacao" value="constatacao"> 
    </label>
    <label class="btn btn-dark btn-md btn-block mb-3"  for="constatacao">
        Coleta de Padrões &nbsp;&nbsp;
        <span style="color:red" > (Em desenvolvimento) </span>
       <input type="radio" name="laudoEfetConst"  id="constatacao" value="constatacao"> 
    </label>
    <label class="btn btn-dark btn-md btn-block mb-3"  for="constatacao">
        Confronto &nbsp;&nbsp;
        <span style="color:red" > (Em desenvolvimento) </span>
       <input type="radio" name="laudoEfetConst"  id="constatacao" value="constatacao"> 
    </label>

    

    @include('shared.error_feedback', ['name' => 'laudoEfetConst'])
    
</div>