$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
           
                $(".show-alert").on('click',async function () {
                const usuarioData = this.dataset.usuario;
                const usuario = JSON.parse(usuarioData);
                //Pega a secoes e percorre armazena em um option
                const secaoData = this.dataset.secao;
                const secoes = JSON.parse(secaoData);
                if (!Array.isArray(secoes) || secoes.length === 0) {
                    console.error("Erro: 'secoes' não contém dados válidos.");
                    return;
                }
                const options = secoes.map(secao => `<option value="${secao.id}">${secao.nome}</option>`).join("");
                //verifica se a secao.id do usuario e a mesma que a da secao e pega o nome
                const secaoUsuario = secoes.find(secao => secao.id == usuario.secao_id);
                const nomeSecao = secaoUsuario ? secaoUsuario.nome : ''



                const url_with_id = $(this).val(); // Recupera a URL definida no botão
                console.log(url_with_id);

                // Mostra o SweetAlert com os campos preenchidos
                const { value: formValues } = await Swal.fire({
                    title: "",
                    html: `<div class="conteinerModelCadastroUser">
                    <input id="swal-input3" hidden name="id" value="${usuario.id}">
                    <label for="swal-input1">E-mail</label><br>
                        <input id="swal-input1" name="email" value="${usuario.email}" ><br>
                    
                    <label for="swal-input2">Nome</label><br>
                        <input id="swal-input2" name="nome" value="${usuario.nome}" ><br>
                    <label for="swal-input4">Username GDL</label><br>
                        <input id="swal-input4" name="userGDL" value="${usuario.userGDL}" ><br>
                    <label for="swal-input5"> Senha GDL </label><br>
                        <input id="swal-input5" type="password" name="senhaGDL" value="${usuario.senhaGDL}" ><br>
                    <label for="swal-input6">  Função   </label>  <br>
                    <select name="cargo_id" id="swal-input6"><br>
                            <option value="1">Perito</option><br>
                            <option value="2">Administrador</option><br>
                        </select><br>
                    <label for="swal-input7">   Unidade</label><br>
                        <select name="secao_id" id="swal-input7">
                            
                            <option value="${usuario.secao_id}">${nomeSecao}</option>
                            ${options}
                            
                        </select>
                        
                
                    </div>
                    `,
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: "Enviar",
                    cancelButtonText: "Cancelar",
                    preConfirm: () => {
                    return {
                        email: document.getElementById("swal-input1").value,
                        nome: document.getElementById("swal-input2").value,
                        id: document.getElementById("swal-input3").value,
                        userGDL: document.getElementById("swal-input4").value,
                        senhaGDL: document.getElementById("swal-input5").value,
                        cargo_id: document.getElementById("swal-input6").value,
                        secao_id: document.getElementById("swal-input7").value,
                    };
                    },
});

// Envia os dados se o SweetAlert for confirmado
if (formValues) {
    // Envia os dados usando AJAX do jQuery
    $.ajax({
    url: url_with_id, // URL dinâmica com o ID do usuário
    type: "POST", // Método da requisição
    data: {
    // Token CSRF
        email: formValues.email,
        nome: formValues.nome,
        id: formValues.id,
        userGDL: formValues.userGDL,
        senhaGDL: formValues.senhaGDL,
        cargo_id: formValues.cargo_id,
        secao_id: formValues.secao_id,
    },
    success: function (response) {
        Swal.fire("Sucesso", "Usuário atualizado com sucesso!", "success")
        .then(() => {
                location.reload(); // Recarrega a página
            });
        
    },
    error: function (xhr) {
        Swal.fire("Erro", "Não foi possível atualizar o usuário.", "error");
        console.error(xhr.responseText); // Debug do erro
    },
    });
}
});