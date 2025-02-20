$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".model-arma").on('click', async function () {
    const veiculoData = this.dataset.veiculo; // Alterado para veiculoData
    const veiculo = JSON.parse(veiculoData); // Alterado para veiculo

    const url_with_id = $(this).val();

    const { value: formValues } = await Swal.fire({
        title: '',
        html: `
            <div class="input-container">
                <input id="swal-input0" class="form-control" value="${veiculo.marca_fabricacao || ''}">
                <label for="swal-input0">Marca de Fabricação</label>
            </div>
            <div class="input-container">
                <input id="swal-input1" class="form-control" value="${veiculo.modelo || ''}">
                <label for="swal-input1">Modelo</label>
            </div>
            <div class="input-container">
                <input id="swal-input2" class="form-control" value="${veiculo.ano || ''}">
                <label for="swal-input2">Ano</label>
            </div>
            <div class="input-container">
                <input id="swal-input3" class="form-control" value="${veiculo.placa || ''}">
                <label for="swal-input3">Placa</label>
            </div>
            <div class="input-container">
                <input id="swal-input4" class="form-control" value="${veiculo.estado_conservacao || ''}">
                <label for="swal-input4">Estado de Conservação</label>
            </div>
            <div class="input-container">
                <input id="swal-input5" class="form-control" value="${veiculo.cor || ''}">
                <label for="swal-input5">Cor</label>
            </div>
            <div class="input-container">
                <input id="swal-input6" class="form-control" value="${veiculo.image1 || ''}">
                <label for="swal-input6">Imagem 1</label>
            </div>
            <div class="input-container">
                <input id="swal-input7" class="form-control" value="${veiculo.image2 || ''}">
                <label for="swal-input7">Imagem 2</label>
            </div>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: "Cadastrar",
        cancelButtonText: "Cancelar",
        preConfirm: () => {
            return {
                veiculo_id: veiculo.veiculo_id, // Adicionado veiculo_id
                marca_fabricacao: document.getElementById("swal-input0").value,
                modelo: document.getElementById("swal-input1").value,
                ano: document.getElementById("swal-input2").value,
                placa: document.getElementById("swal-input3").value,
                estado_conservacao: document.getElementById("swal-input4").value,
                cor: document.getElementById("swal-input5").value,
                image1: document.getElementById("swal-input6").value,
                image2: document.getElementById("swal-input7").value,
                status: "1", // Mantido o status, se necessário
            };
        }
    });

    if (formValues) {
        $.ajax({
            url: url_with_id, // URL dinâmica com o ID do veículo
            type: "POST", // Método da requisição
            data: formValues,
            success: function (response) {
                Swal.fire("Sucesso", "Veículo cadastrado com sucesso!", "success")
                    .then(() => {
                        location.reload(); // Recarrega a página
                    });
            },
            error: function (xhr) {
                Swal.fire("Erro", "Não foi possível cadastrar o veículo.", "error");
                console.error(xhr.responseText); // Debug do erro
            },
        });
    }
});