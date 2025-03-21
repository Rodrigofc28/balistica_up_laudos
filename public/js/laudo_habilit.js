// adiciona os nomes da tabela envolvidos
$(document).ready(function(){
    let envolvidos = JSON.parse(localStorage.getItem('envolvidos')) || [];
  
    function atualizarTabela() {
        $("#tabelaEnvolvidos").empty();
        envolvidos.forEach((item, index) => {
            $("#tabelaEnvolvidos").append(`<tr><td>${item.nome}</td><td>${item.perfil}</td></tr>`);
        });
  
        atualizarInputEscondido();
    }
  
    function atualizarInputEscondido() {
        $('#nomeIncluir').val(JSON.stringify(envolvidos)); // Transforma a lista em JSON e armazena no input
    }
  
    atualizarTabela();
  
    function adicionarEnvolvido() {
        var nome = $('#nome_vitima').val().trim();
        var perfil = $('#perfil_envolvido').val().trim();
  
        if (nome === '') {
            swal("Preencha o campo Nome do Envolvido");
            return;
        }
        if (perfil === '') {
            return;
        }
  
        envolvidos.push({ nome, perfil });
        localStorage.setItem('envolvidos', JSON.stringify(envolvidos));
  
        atualizarTabela();
  
        $('#nome_vitima').val('');
        $('#perfil_envolvido').val('');
    }
  
    $('#incluir').on('click', adicionarEnvolvido);
  
    $('#perfil_envolvido').on('change', adicionarEnvolvido);
  
    $('#limpar').on('click', function(){
        swal({
            title: "Tem certeza?",
            text: "Isso apagará todos os envolvidos!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((confirmado) => {
            if (confirmado) {
                localStorage.removeItem('envolvidos');
                envolvidos = [];
                atualizarTabela();
                swal("Lista apagada!", { icon: "success" });
            }
        });
    });
  });
  
  
  
  //limpa o cache da tabela envolvidos
  $('#salvaContinua').on('click',function(){
    localStorage.removeItem('envolvidos');
  })


