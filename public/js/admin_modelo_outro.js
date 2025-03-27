$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(".model-outro").on('click',async function () {
  
    const outroData = this.dataset.outro;
    const outro = JSON.parse(outroData);
    
    const url_with_id = $(this).val();
    
    const { value: formValues } = await Swal.fire({
      title: '',
      html: `
        <img width="80%" src="${outro.up_image}">
        
        <div class="input-container">
          <input id="swal-input0" class="form-control" value="${outro.nome || ''}">
          <label for="swal-input0">Nome</label>
        </div>
        <div class="input-container">  
          <input id="swal-input1" class="form-control"   value="${outro.marca || ''}">
          <label for="swal-input1">Marca</label>
        </div>
       <div class="input-container" ${outro.descricao_item !== null ? '' : "hidden"}> 
            <span>Descrição do Item</span>
            <textarea id="swal-input2" class="form-control">${outro.descricao_item || ''}</textarea>
            
        </div>

        <div class="input-container" ${outro.modeloSalvo !== null ? '' : "hidden"}> 
          <input id="swal-input3" class="form-control"   value="${outro.modeloSalvo || ''}">
          <label for="swal-input3">Nome a ser salvo</label>
        </div>  
           
       
      `,
      focusConfirm: false,
      showCancelButton: true,
      confirmButtonText: "Cadastrar",
      cancelButtonText: "Cancelar",
      preConfirm: () => {
        return {
          id:outro.id,
          nome: document.getElementById("swal-input0").value,
          marca: document.getElementById("swal-input1").value,
          descricao_item: document.getElementById("swal-input2").value || null,
          modeloSalvo: document.getElementById("swal-input3").value || null,
          
         
         
        };
      }
  });
      if (formValues) {
        $.ajax({
          url: url_with_id, // URL dinâmica com o ID do usuário
          type: "POST", // Método da requisição
          data: formValues ,
          success: function (response) {
              Swal.fire("Sucesso", "Outro material cadastrado com sucesso!", "success")
              .then(() => {
                      location.reload(); // Recarrega a página
                  });
              
          },
          error: function (xhr) {
              Swal.fire("Erro", "Não foi possível cadastrar a esse material.", "error");
              console.error(xhr.responseText); // Debug do erro
          },
          });
      }

})
