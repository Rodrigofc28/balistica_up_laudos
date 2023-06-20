<div class="col-lg-3 mt-2" >
    <label for=""><strong>Tipo de laudo<code>*</code></strong></label><br>
    
    <input type="radio" name="laudoEfetConst" id="constatacao" value="constatacao"> Constatação<br>
    
    <hr>
    <input type="radio" name="laudoEfetConst" id="eficiencia" value="efetivacao"> Eficiência<br>

    

    @include('shared.error_feedback', ['name' => 'laudoEfetConst'])
</div>