$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(".model-arma").on('click',async function () {
  
    const armaData = this.dataset.arma;
    const arma = JSON.parse(armaData);
    
    const url_with_id = $(this).val();
    arma.comprimento_total = arma.comprimento_total.replace(',', '.');
    arma.comprimento_cano = arma.comprimento_cano.replace(',', '.');
    arma.altura= arma.altura.replace(',', '.');
    arma.num_canos= arma.num_canos.replace('um', 1);
    const { value: formValues } = await Swal.fire({
      title: '',
      html: `
        <img src="${arma.imagemCantoSuperior}">
        <div class="form-floating">
          
          <input id="swal-input0" class="form-control" value="${arma.tipo_arma || ''}">
          <input id="swal-input1" class="form-control" value="${arma.modelo || ''}">
            
          <input id="swal-input2" class="form-control" value="${arma.tambor_rebate !== null ? arma.tambor_rebate : ''}">
          <input id="swal-input3" class="form-control" value="${arma.capacidade_tambor !== null ? arma.capacidade_tambor : ''}">
          <input id="swal-input4" class="form-control" value="${arma.sistema_percussao || ''}">
          <input id="swal-input5" class="form-control" value="${arma.comprimento_total || ''}">
          <input id="swal-input6" class="form-control" value="${arma.comprimento_cano || ''}">
          <input id="swal-input7" class="form-control" value="${arma.altura || ''}">
          <input id="swal-input8" class="form-control" value="${arma.quantidade_raias || ''}">
          <input id="swal-input9" class="form-control" value="${arma.sentido_raias || ''}">
          <input id="swal-input10" class="form-control" value="${arma.cabo || ''}">
          <input id="swal-input11" class="form-control" value="${arma.sistema_funcionamento || ''}">
          <input id="swal-input12" class="form-control" value="${arma.num_canos || ''}">
          <input id="swal-input13" class="form-control" value="${arma.disposicao_canos || ''}">
          <input id="swal-input14" class="form-control" value="${arma.teclas_gatilho || ''}">
          <input id="swal-input15" class="form-control" value="${arma.sistema_carregamento || ''}">
          <input id="swal-input16" class="form-control" value="${arma.sistema_engatilhamento || ''}">
          <input id="swal-input17" class="form-control" value="${arma.coronha_fuste || ''}">
          <input id="swal-input18" class="form-control" value="${arma.chave_abertura || ''}">
          <input id="swal-input19" class="form-control" value="${arma.tipo_carregador || ''}">
          <input id="swal-input20" class="form-control" value="${arma.calibre_real || ''}">
          <input id="swal-input21" class="form-control" value="${arma.bandoleira || ''}">
          <input id="swal-input22" class="form-control" value="${arma.placas_laterais || ''}">
          <input id="swal-input23" class="form-control" value="${arma.cao || ''}">
          <input id="swal-input24" class="form-control" value="${arma.carregador || ''}">
          <input id="swal-input25" class="form-control" value="${arma.capacidade_carregador || ''}">
          <input id="swal-input26" class="form-control" value="${arma.trava_ferrolho || ''}">
          <input id="swal-input27" class="form-control" value="${arma.trava_gatilho || ''}">
          <input id="swal-input28" class="form-control" value="${arma.trava_seguranca || ''}">
          <input id="swal-input29" class="form-control" value="${arma.retem_carregador || ''}">
          <input id="swal-input30" class="form-control" value="${arma.carregamento || ''}">
          <input id="swal-input31" class="form-control" value="${arma.numeracao_montagem || ''}">
          <input id="swal-input32" class="form-control" value="${arma.corocha || ''}">
          <input id="swal-input33" class="form-control" value="${arma.diametro_cano || ''}">
          <input id="swal-input34" class="form-control" value="${arma.telha || ''}">
          <input id="swal-input35" class="form-control" value="${arma.tipo_tambor || ''}">
          <input id="swal-input36" class="form-control" value="${arma.sistema_disparo || ''}">
         
         
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
          corocha: document.getElementById("swal-input32").value || null,
          diametro_cano: document.getElementById("swal-input33").value || null,
          telha: document.getElementById("swal-input34").value || null,
          tipo_tambor: document.getElementById("swal-input35").value || null,
          sistema_disparo: document.getElementById("swal-input36").value || null,
          imagemCantoSuperior: arma.imagemCantoSuperior,
          
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
