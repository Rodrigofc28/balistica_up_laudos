// adiciona os nomes da tabela envolvidos
$(document).ready(function(){
    let doc = JSON.parse(localStorage.getItem('docs')) || [];
  
    function atualizarTabela() {
        $("#tabelaDocumentos").empty();
        doc.forEach((item, index) => {
            $("#tabelaDocumentos").append(`<tr><td>${item.inqueritoDC}</td><td>${item.numeroInq}</td></tr>`);
        });
  
        atualizarInputEscondido();
    }
  
    function atualizarInputEscondido() {
        $('#docs').val(JSON.stringify(doc)); // Transforma a lista em JSON e armazena no input
    }
  
    atualizarTabela();
  
    function adicionarEnvolvido() {
        var numeroInq = $('#inquerito').val().trim();
        var inqueritoDC = $('#tipo_inquerito').val().trim();
  
        if (numeroInq === '') {

            
            return;
        }
        if (inqueritoDC === '') {
            
            return;
        }
        
  
        doc.push({ inqueritoDC, numeroInq });
        localStorage.setItem('docs', JSON.stringify(doc));
  
        atualizarTabela();
  
        $('#inquerito').val('');
        $('#tipo_inquerito').val('');
    }
  
    $('#inquerito').on('click', adicionarEnvolvido);
  
    $('#tipo_inquerito').on('change', adicionarEnvolvido);
  
    $('#limparDocs').on('click', function(){
        swal({
            title: "Tem certeza?",
            text: "Isso apagará todos os documentos!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((confirmado) => {
            if (confirmado) {
                localStorage.removeItem('docs');
                doc = [];
                atualizarTabela();
                swal("Lista apagada!", { icon: "success" });
            }
        });
    });
  });
  
  
  
  //limpa o cache da tabela envolvidos
  $('#salvaContinua').on('click',function(){
    localStorage.removeItem('docs');
  })