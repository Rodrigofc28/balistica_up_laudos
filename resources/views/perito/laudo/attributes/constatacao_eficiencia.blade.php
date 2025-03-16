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
            <option selected value="B602">B602 - Exame de eficiência e prestabilidade</option>
            <option value="B601">B601 -  Exame de constatação</option>
            {{-- <option value="B603">Coleta de Padrão</option>
                <option value="B612">B612 - Exame de confronto balístico</option>--}}
        </select>
        
    @endif
    <!--Exame de Chassi-->
    @if($tipo_exame=='chassi')
        <select class="form-control" name="laudoEfetConst" id="">
            <option selected value="I801">I801 - Numerações Identificadoras </option>
            <option value="I802">I802 - Compartimentos</option>
            <option value="I806">I806 - Constatação</option>
            <option value="I812">I812 - Numerações Identificadoras + compartimentos </option>
           
        </select>
        
       
    @endif

    @include('shared.error_feedback', ['name' => 'laudoEfetConst'])
    
</div>