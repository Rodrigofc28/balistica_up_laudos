<div class="col-lg-3" >
    <div class="form-group">
        <label><strong>Deformações acidentais<code>*</code><strong></label><br>
        
        <select    
            name="deformacaoAcidental[]"  multiple="multiple"  class="js-example-basic-multiple"  >
            
            @foreach(['Grandes na ponta','Grandes na lateral',
            'Grandes na base','Grandes por toda extensão',
            'Médias na ponta','Médias na lateral','Médias na base',
            'Médias por toda extensão','Leves na ponta','Leves na lateral'
            ,'Leves na base','Leves por toda extensão','Com perda de massa'] as $deformacoes)
            <option value="{{$deformacoes}}"    > {{mb_strtoupper($deformacoes)}}</option>
            @endforeach
        </select>
        
    @include('shared.error_feedback', ['name' => 'origem_projetil'])
    </div>
</div>


