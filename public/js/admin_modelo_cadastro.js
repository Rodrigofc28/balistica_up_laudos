$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(".model-arma").on('click',async function () {
  
    const armaData = this.dataset.arma;
    const arma = JSON.parse(armaData);
    
    const url_with_id = $(this).val();
    arma.comprimento_total = (arma.comprimento_total || '').replace(',', '.');
    arma.comprimento_cano = (arma.comprimento_cano || '').replace(',', '.');
    
    arma.altura = (arma.altura || '').replace(',', '.');
    
    arma.num_canos= arma.num_canos.replace('um', 1);
    const { value: formValues } = await Swal.fire({
      title: '',
      html: `
        <img src="${arma.imagemCantoSuperior}">
        
        <div class="input-container">
          <input id="swal-input0" class="form-control" value="${arma.tipo_arma || ''}">
          <label for="swal-input0">Arma</label>
        </div>
        <div class="input-container">  
          <input id="swal-input1" class="form-control"   value="${arma.modelo || ''}">
          <label for="swal-input1">Modelo</label>
        </div>  
        <div class="input-container" ${arma.tambor_rebate !== null ? '' : "hidden"}>  
          <input id="swal-input2" class="form-control"   value="${arma.tambor_rebate !== null ? arma.tambor_rebate : ''}">
          <label for="swal-input2">Tambor Rebate</label>
        </div> 
        <div class="input-container" ${arma.capacidade_tambor !== null ? '' : "hidden"}> 
          <input id="swal-input3" class="form-control"  value="${arma.capacidade_tambor !== null ? arma.capacidade_tambor : ''}">
          <label for="swal-input3"></label>
        </div>
        <div class="input-container" ${arma.sistema_percussao !== null ? '' : "hidden"}>  
          <input id="swal-input4" class="form-control"   value="${arma.sistema_percussao || ''}">
        <label for="swal-input4">Sistema de percussão</label>
        </div>
        <div class="input-container" ${arma.comprimento_total !== null ? '' : "hidden"} > 
          <input id="swal-input5" class="form-control"  value="${arma.comprimento_total || ''}">
        <label for="swal-input5">Comprimento total </label>
        </div>
        <div class="input-container" ${arma.comprimento_cano !== null ? '' : "hidden"}> 
          <input id="swal-input6" class="form-control"   value="${arma.comprimento_cano || ''}">
        <label for="swal-input6">Comprimento cano</label>
        </div>
        <div class="input-container" ${arma.altura !== null ? '' : "hidden"}> 
          <input id="swal-input7" class="form-control"   value="${arma.altura || ''}">
        <label for="swal-input7">Altura</label>
        </div>
        <div class="input-container" ${arma.quantidade_raias !== null ? '' : "hidden"}> 
          <input id="swal-input8" class="form-control"   value="${arma.quantidade_raias || ''}">
          <label for="swal-input8">Quantidade raias</label>
        </div>
        <div class="input-container" ${arma.sentido_raias !== null ? '' : "hidden"} > 
          
          <span>Sentido das Raias</span>
          <select id="swal-input9" class="form-control">
            <option value="dextrógiro" ${arma.sentido_raias == 'dextrógiro' ? 'selected' : ''}>Dextrógiro</option>
            <option value="sinistrógiro" ${arma.sentido_raias == 'sinistrógiro' ? 'selected' : ''}>Sinistrógiro</option>
            <option value="prejudicado" ${arma.sentido_raias == 'prejudicado' ? 'selected' : ''}>Prejudicado</option>
            
          </select>
        </div>
        <div class="input-container" ${arma.cabo !== null ? '' : "hidden"}> 
          
          <span>Cabo</span>
          <select id="swal-input10" class="form-control">
            <option value="chifre" ${arma.cabo == 'chifre' ? 'selected' : ''}>Chifre</option>
            <option value="madrepérola" ${arma.cabo == 'madrepérola' ? 'selected' : ''}>Madrepérola</option>
            <option value="madeira" ${arma.cabo == 'madeira' ? 'selected' : ''}>Madeira</option>
            <option value="material sintético" ${arma.cabo == 'material sintético' ? 'selected' : ''}>Material Sintético</option>
            
          </select>
        </div>
        <div class="input-container" ${arma.sistema_funcionamento !== null ? '' : "hidden"} > 
          <input id="swal-input11" class="form-control"  value="${arma.sistema_funcionamento || ''}">
        <label for="swal-input11">Sistema de funcionamento</label>
        </div>
        <div class="input-container" ${arma.num_canos !== null ? '' : "hidden"}> 
          <input id="swal-input12" class="form-control"   value="${arma.num_canos || ''}">
        <label for="swal-input12"> Numero de canos</label>
        </div>
        <div class="input-container" ${arma.disposicao_canos !== null ? '' : "hidden"} > 
          <input id="swal-input13" class="form-control"  value="${arma.disposicao_canos || ''}">
        <label for="swal-input13">Disposição dos canos</label>
        </div>
        <div class="input-container" ${arma.teclas_gatilho !== null ? '' : "hidden"}> 
          <input id="swal-input14" class="form-control"   value="${arma.teclas_gatilho || ''}">
        <label for="swal-input14">Teclas gatilho</label>
        </div>
        <div class="input-container" ${arma.sistema_carregamento !== null ? '' : "hidden"}> 
          <input id="swal-input15" class="form-control"   value="${arma.sistema_carregamento || ''}">
        <label for="swal-input15">Sistema de carrregamento</label>
        </div>
        <div class="input-container" ${arma.sistema_engatilhamento  !== null ? '' : "hidden"}> 
          <input id="swal-input16" class="form-control"   value="${arma.sistema_engatilhamento || ''}">
        <label for="swal-input16">Sistema de engatilhamento</label>
        </div>
        <div class="input-container" ${arma.coronha_fuste !== null ? '' : "hidden"}> 
          <input id="swal-input17" class="form-control"   value="${arma.coronha_fuste || ''}">
        <label for="swal-input17">Coronha fuste</label>
        </div>
        <div class="input-container" ${arma.chave_abertura !== null ? '' : "hidden"}> 
          <input id="swal-input18" class="form-control"   value="${arma.chave_abertura || ''}">
        <label for="swal-input18">chave de abertura</label>
        </div>
        <div class="input-container" ${arma.tipo_carregador !== null ? '' : "hidden"}> 
          <input id="swal-input19" class="form-control"   value="${arma.tipo_carregador || ''}">
        <label for="swal-input19">Tipo de carregador</label>
        </div>
        <div class="input-container" ${arma.calibre_real !== null ? '' : "hidden"}> 
          <input id="swal-input20" class="form-control"   value="${arma.calibre_real || ''}">
        <label for="swal-input20">Calibre real</label>
        </div>
        <div class="input-container" ${arma.bandoleira !== null ? '' : "hidden"}> 
          <input id="swal-input21" class="form-control"   value="${arma.bandoleira || ''}">
        <label for="swal-input21">Bandoleira</label>
        </div>
        <div class="input-container" ${arma.placas_laterais !== null ? '' : "hidden"} > 
          <input id="swal-input22" class="form-control"  value="${arma.placas_laterais || ''}">
        <label for="swal-input22">Placas laterais</label>
        </div>
        <div class="input-container" ${arma.cao !== null ? '' : "hidden"}> 
          <input id="swal-input23" class="form-control"   value="${arma.cao || ''}">
        <label for="swal-input23">Cão</label>
        </div>
        <div class="input-container" ${arma.carregador  !== null ? '' : "hidden"}> 
          <input id="swal-input24" class="form-control"   value="${arma.carregador || ''}">
        <label for="swal-input24">Carregador</label>
        </div>
        <div class="input-container" ${arma.capacidade_carregador !== null ? '' : "hidden"}> 
          <input id="swal-input25" class="form-control"   value="${arma.capacidade_carregador || ''}">
        <label for="swal-input25">Capacidade do carregador</label>
        </div>
        <div class="input-container"  ${arma.trava_ferrolho !== null ? '' : "hidden"}> 
          <input id="swal-input26" class="form-control"  value="${arma.trava_ferrolho || ''}">
        <label for="swal-input26">Trava do ferrolho</label>
        </div>
        <div class="input-container" ${arma.trava_gatilho !== null ? '' : "hidden"}> 
          <input id="swal-input27" class="form-control"   value="${arma.trava_gatilho || ''}">
        <label for="swal-input27">Trava de gatilho</label>
        </div>
        <div class="input-container" ${arma.trava_seguranca !== null ? '' : "hidden"} > 
          <input id="swal-input28" class="form-control"  value="${arma.trava_seguranca || ''}">
        <label for="swal-input28">Trava de segurança</label>
        </div>
        <div class="input-container" ${arma.retem_carregador !== null ? '' : "hidden"}> 
          <input id="swal-input29" class="form-control"   value="${arma.retem_carregador || ''}">
        <label for="swal-input29">retem do carregador</label>
        </div>
        <div class="input-container" ${arma.carregamento !== null ? '' : "hidden"}> 
          <input id="swal-input30" class="form-control"   value="${arma.carregamento || ''}">
        <label for="swal-input30">Carregamento</label>
        </div>
        <div class="input-container" ${arma.numeracao_montagem !== null ? '' : "hidden"}> 
          <input id="swal-input31" class="form-control"   value="${arma.numeracao_montagem || ''}">
        <label for="swal-input31">Numeração de montagem</label>
        </div>
        <div class="input-container" ${arma.coronha  !== null ? '' : "hidden"}> 
          <input id="swal-input32" class="form-control"   value="${arma.coronha || ''}">
        <label for="swal-input32">Coronha</label>
        </div>
        <div class="input-container" ${arma.diametro_cano !== null ? '' : "hidden"} > 
          <input id="swal-input33" class="form-control"  value="${arma.diametro_cano || ''}">
        <label for="swal-input33">Diametro do cano</label>
        </div>
        <div class="input-container"  ${arma.telha !== null ? '' : "hidden"}> 
          <input id="swal-input34" class="form-control"  value="${arma.telha || ''}">
        <label for="swal-input34">Telha</label>
        </div>
        <div class="input-container" ${arma.tipo_tambor!== null ? '' : "hidden"} > 
          <input id="swal-input35" class="form-control"  value="${arma.tipo_tambor || ''}">
        <label for="swal-input35">Tipo de tambor</label>
        </div>
        <div class="input-container" ${arma.sistema_disparo !== null ? '' : "hidden"}>
          <span>Sistema de Funcionamento</span>
          <select id="swal-input36" class="form-control">
            <option value="ação simples" ${arma.sistema_disparo == 'ação simples' ? 'selected' : ''}>Ação simples</option>
            <option value="dupla ação" ${arma.sistema_disparo == 'dupla ação' ? 'selected' : ''}>Dupla ação</option>
            <option value="movimento duplo ( ação simples + dupla )" ${arma.sistema_disparo == 'movimento duplo ( ação simples + dupla )' ? 'selected' : ''}>Movimento duplo (ação simples + dupla)</option>
            <option value="ação híbrida (dupla ação com semiengatilhamento)" ${arma.sistema_disparo == 'ação híbrida (dupla ação com semiengatilhamento)' ? 'selected' : ''}>Ação híbrida (dupla ação com semiengatilhamento)</option>
          </select>

        </div>   
           
       
      `,
      focusConfirm: false,
      showCancelButton: true,
      confirmButtonText: "Cadastrar",
      cancelButtonText: "Cancelar",
      preConfirm: () => {
        return {
          arma_id:arma.id,
          tipo_arma: document.getElementById("swal-input0").value,
          modelo: document.getElementById("swal-input1").value,
          tambor_rebate: document.getElementById("swal-input2").value || null,
          capacidade_tambor: document.getElementById("swal-input3").value || null,
          sistema_percussao: document.getElementById("swal-input4").value || null,
          comprimento_total: document.getElementById("swal-input5").value || null,
          comprimento_cano: document.getElementById("swal-input6").value || null,
          altura: document.getElementById("swal-input7").value || null,
          quantidade_raias: document.getElementById("swal-input8").value || null,
          sentido_raias: document.getElementById("swal-input9").value || null,
          cabo: document.getElementById("swal-input10").value || null,
          sistema_funcionamento: document.getElementById("swal-input11").value || null,
          num_canos: document.getElementById("swal-input12").value || null,
          disposicao_canos: document.getElementById("swal-input13").value || null,
          teclas_gatilho: document.getElementById("swal-input14").value || null,
          sistema_carregamento: document.getElementById("swal-input15").value || null,
          sistema_engatilhamento: document.getElementById("swal-input16").value || null,
          coronha_fuste: document.getElementById("swal-input17").value || null,
          chave_abertura: document.getElementById("swal-input18").value || null,
          tipo_carregador: document.getElementById("swal-input19").value || null,
          calibre_real: document.getElementById("swal-input20").value || null,
          bandoleira: document.getElementById("swal-input21").value || null,
          placas_laterais: document.getElementById("swal-input22").value || null,
          cao: document.getElementById("swal-input23").value || null,
          carregador: document.getElementById("swal-input24").value || null,
          capacidade_carregador: document.getElementById("swal-input25").value || null,
          trava_ferrolho: document.getElementById("swal-input26").value || null,
          trava_gatilho: document.getElementById("swal-input27").value || null,
          trava_seguranca: document.getElementById("swal-input28").value || null,
          retem_carregador: document.getElementById("swal-input29").value || null,
          carregamento: document.getElementById("swal-input30").value || null,
          numeracao_montagem: document.getElementById("swal-input31").value || null,
          coronha: document.getElementById("swal-input32").value || null,
          diametro_cano: document.getElementById("swal-input33").value || null,
          telha: document.getElementById("swal-input34").value || null,
          tipo_tambor: document.getElementById("swal-input35").value || null,
          sistema_disparo: document.getElementById("swal-input36").value || null,
          imagemCantoSuperior: arma.imagemCantoSuperior,
          status: "1",
         
        };
      }
  });
      if (formValues) {
        $.ajax({
          url: url_with_id, // URL dinâmica com o ID do usuário
          type: "POST", // Método da requisição
          data: formValues ,
          success: function (response) {
              Swal.fire("Sucesso", "Arma cadastrada com sucesso!", "success")
              .then(() => {
                      location.reload(); // Recarrega a página
                  });
              
          },
          error: function (xhr) {
              Swal.fire("Erro", "Não foi possível cadastrar a arma.", "error");
              console.error(xhr.responseText); // Debug do erro
          },
          });
      }

})
