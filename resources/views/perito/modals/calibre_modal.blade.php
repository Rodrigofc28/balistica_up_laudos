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

<div class="form-group">
    <div class="col-lg-12">
        <label><strong>Calibre: <code>*</code></strong></label>
        <input class="form-control mb-2" type="text" id="nome_calibre" name="calibre" autocomplete="off" />

        @if (isset($tipo_arma))
        <input type="hidden" value="{{ $tipo_arma }}" name="tipo_arma" id="tipo_arma">
        <p class="obrigatorio mt-2"><strong><code>*</code> Obrigatório</strong></p>
        <div class="row justify-content-between">
            <div class="col-lg-6 mb-2">
                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">
                    <i class="fas fa-times"></i> Fechar</button>
            </div>
            <div class="col-lg-6 mb-2">
                <button type="button" class="btn btn-success btn-block" id="cadastroCalibre">
                    <i class="fas fa-plus" aria-hidden="true"></i> Cadastrar</button>

            </div>
        @else
        
        <label><strong>Cano:<code>*</code> </strong></label>&nbsp;
        <label for="lisa">Alma lisa</label>
        <input type="radio" name="tipo_arma" value="Espingarda,Pistolete"  id="tipo_arma" >&nbsp;&nbsp;&nbsp;
        <label for="raiada">Alma raiada</label>
        <input type="radio" name="tipo_arma" id="tipo_arma"  value="Revólver,Fuzil,Pistola,Garrucha,Mettralhadora,Carabina,Submetralhadora"><br>
        <span style="font-size:11px" >( Alma lisa: Espingarda, Pistolete.</span><br>
        <span style="font-size:11px">Alma raiada: Revólver, Fuzil, Pistola, Garrucha, Metralhadra, Carabina, Submetralhadora.)</span>
        <p class="obrigatorio mt-2"><strong><code>*</code> Obrigatório</strong></p>
        <div class="row justify-content-between">
            <div class="col-lg-6 mb-2">
                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">
                    <i class="fas fa-times"></i> Fechar</button>
            </div>
            <div class="col-lg-6 mb-2">
                <button type="button" class="btn btn-success btn-block" id="cadastroCalibreMunicao">
                    <i class="fas fa-plus" aria-hidden="true"></i> Cadastrar</button>

            </div>
 
        @endif
        
        </div>
    </div>
</div>
@endcomponent