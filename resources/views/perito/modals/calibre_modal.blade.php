@component('layout.modal')
@slot('modal_id')
calibre-modal
@endslot
@slot('modal_title')
Cadastrar Calibre
@endslot
@slot('modal_size')
md
@endslot
<hr>
<style>
    

    .text_lab{
        text-decoration: underline
    }
    
    .conteiner_calibres_armas{
        border-radius: 5px;
        border: 1px solid black;
        justify-items: center;
        padding: 5px;
        background-color: rgb(216, 219, 221)
    }
    
</style>

<div class="form-group">
    <div class="col-lg-12">
        <label><strong>Calibre: <code>*</code></strong></label>
        <input class="form-control mb-2" type="text" id="nome_calibre" name="calibre" autocomplete="off" />

       @php
       
           $tipo_arma="fghfg";
         
       @endphp
                <h2>Utilizado em:</h2>
                <div class="conteiner_calibres_armas">
                    <div class="d-flex flex-row mb-3">
                     
                       
                        <span class="calibre_armas p-2">
                            <input type="checkbox" name="calibres_armas[]" value="Pistola" id="Pistola">
                            <label class="text_lab" for="Pistola">Pistola</label>
                        </span>
                        
                        <!-- Botão 2 -->
                        <span class="calibre_armas p-2">
                            <input type="checkbox" name="calibres_armas[]" value="Revólver" id="Revólver">
                            <label class="text_lab" for="Revólver">Revólver</label>
                        </span>
                        
                        <!-- Botão 3 -->
                        <span  class="calibre_armas p-2">
                            <input type="checkbox" name="calibres_armas[]" value="Garrucha" id="Garrucha">
                            <label class="text_lab" for="Garrucha">Garrucha</label>
                        </span>
                        <span class="calibre_armas p-2">
                            <input type="checkbox" name="calibres_armas[]" value="Fuzil" id="Fuzil">
                            <label class="text_lab" for="Fuzil">Fuzil</label>
                        </span>

                    </div> 
                    <div class="d-flex flex-row mb-3">
                        <!-- Botão 4 -->
                        <span class="calibre_armas p-2">
                            <input type="checkbox" name="calibres_armas[]" value="Metralhadora" id="Metralhadora">
                            <label class="text_lab" for="Metralhadora">Metralhadora</label>
                        </span>
                        
                        <!-- Botão 5 -->
                        <span class="calibre_armas p-2">
                            <input type="checkbox" name="calibres_armas[]" value="Carabina" id="Carabina">
                            <label class="text_lab" for="Carabina">Carabina</label>
                        </span>
                     
                        <!-- Botão 6 -->
                        <span class="calibre_armas p-2">
                            <input type="checkbox" name="calibres_armas[]" value="Submetralhadora" id="Submetralhadora">
                            <label class="text_lab" for="Submetralhadora">Submetralhadora</label>
                        </span>
                    </div>   
                    <div class="d-flex flex-row mb-3">
                        <!-- Botão 4 -->
                        <span class="calibre_armas p-2">
                            <input type="checkbox" name="calibres_armas[]" value="Espingarda" id="Espingarda">
                            <label class="text_lab" for="Espingarda">Espingarda</label>
                        </span>
                        
                        <!-- Botão 5 -->
                        <span class="calibre_armas p-2">
                            <input type="checkbox" name="calibres_armas[]" value="Espingarda mista" id="Espingarda mista">
                            <label class="text_lab" for="Espingarda mista">Espingarda mista</label>
                        </span>
                     
                        <span class="calibre_armas p-2">
                            <input type="checkbox" name="calibres_armas[]" value="Pistolete" id="Pistolete">
                            <label class="text_lab" for="Pistolete">Pistolete</label>
                        </span>
                    </div>  
                        <!-- Botão 7 -->
                       
                  </div>
                </div>
                  
                  
                        
                    
                
            
        
        <div class="row justify-content-between">
            <div class="col-lg-6 mb-2">
                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">
                    <i class="fas fa-times"></i> Fechar</button>
            </div>
            <div class="col-lg-6 mb-2">
                <button type="button" class="btn btn-success btn-block" id="cadastroCalibre">
                    <i class="fas fa-plus" aria-hidden="true"></i> Cadastrar</button>

            </div>
       
        
        </div>
    </div>
</div>
@endcomponent