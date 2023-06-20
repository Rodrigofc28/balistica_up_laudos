







<div class="col-lg-3"  >
    <div class="form-group">
        <label><strong>Origem</strong> <code>*</code></label>
        
        <select class="form-control "
            name="origem_projetil" id="pais">
            <option value=""></option>
            @foreach(["Exame de Local","Necrópsia"] as $origem)
            <option value="{{$origem}}"> {{$origem}}</option>
           
            @endforeach
                
            
            
        </select>
        
    @include('shared.error_feedback', ['name' => 'origem_projetil'])
    </div>

