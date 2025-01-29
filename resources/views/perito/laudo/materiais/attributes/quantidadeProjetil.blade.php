<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Quantidade <code>*</code></strong></label>
        <input required class="form-control "
               name="quantidade_frascos" autocomplete="off" type="number"
                min="0" id="quantidade_projetil" required value="{{old('quantidadeProjetil',$quantidadeProjetil)}}"/>
        @include('shared.error_feedback', ['name' => 'quantidade'])
    </div>
</div>