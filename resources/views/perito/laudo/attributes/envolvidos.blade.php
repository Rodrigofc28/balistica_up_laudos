<style>
    .envolvido_btn{
        
       width: 100%;
        border-radius: 4px;
    }
    .label_envolvido{
        padding-left: 10%;
        color: #646161;
    }
    .limpar {
        display: flex;
        justify-content: center;
    
    }
</style>
<div class="col-lg-3 mt-2" >
    
    <label for="nome_vitima"  ><strong>Nome do envolvido </strong></label><br>
    
    <input   class="form-control" type="text"  name="nome_vitima" id="nome_vitima">
    
    
    <div id="nomesIDs">

    </div>
    
</div>

<div class="col-lg-3 mt-2" >
    <label for="perfil_envolvido"><strong>Perfil</strong></label><br>
   
    <select  class="form-control" name="perfil_envolvido"  id="perfil_envolvido">
        <option ></option>
        <option value="Vitima">Vitima</option>
        <option value="Em poder de"> Portador (caso arma)</option>
        <option value="Envolvido">Envolvido (vitima ou portador)</option>
    </select>
</div>


  
    

