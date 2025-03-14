

var array=[];


$('#tipo_inquerito').on('change',function(){
    
    if($('#tipo_inquerito').val()=="IP ONLINE"){
        var ipApfd=$('#inqueritosPoliciais1').attr('ip')
        var orgao=$('#inqueritosPoliciais1').attr('orgao')
        var cidade=$('#inqueritosPoliciais1').attr('cidade')
        $('#cidadeSpan').text(cidade)
        $('#cidadeIn').val(cidade) 
        $('#inquerito').val(ipApfd)
        $('#orgaoSpan').text(orgao)
        $('#orgaoIn').val(orgao) 
        
    }
    if($('#tipo_inquerito').val()=="BO"){
        var ipApfd=$('#inqueritosPoliciais4').attr('ip')
        var orgao=$('#inqueritosPoliciais4').attr('orgao')
        var cidade=$('#inqueritosPoliciais4').attr('cidade')
        $('#cidadeSpan').text(cidade)
        $('#cidadeIn').val(cidade) 
        $('#inquerito').val(ipApfd)
        $('#orgaoSpan').text(orgao)
        $('#orgaoIn').val(orgao) 
      }
    if($('#tipo_inquerito').val()=="IP/APFD"){
        var ipApfd=$('#inqueritosPoliciais').attr('ip')
        var orgao=$('#inqueritosPoliciais').attr('orgao')
        var cidade=$('#inqueritosPoliciais').attr('cidade')
        $('#cidadeSpan').text(cidade)
        $('#cidadeIn').val(cidade) 
        $('#inquerito').val(ipApfd)
        $('#orgaoSpan').text(orgao)
        $('#orgaoIn').val(orgao) 
        
         
      }
    if($('#tipo_inquerito').val()=="BOC"){
        var ipApfd=$('#inqueritosPoliciais3').attr('ip')
        var orgao=$('#inqueritosPoliciais3').attr('orgao')
        var cidade=$('#inqueritosPoliciais3').attr('cidade')
        $('#cidadeSpan').text(cidade)
        $('#cidadeIn').val(cidade) 
        $('#inquerito').val(ipApfd)
        $('#orgaoSpan').text(orgao)
        $('#orgaoIn').val(orgao)  
      }
    if($('#tipo_inquerito').val()=="IP/PM"){
      
        var ipApfd=$('#inqueritosPoliciais2').attr('ip')
        
        var orgao=$('#inqueritosPoliciais2').attr('orgao')
        var cidade=$('#inqueritosPoliciais2').attr('cidade')
        $('#cidadeSpan').text(cidade)
        $('#cidadeIn').val(cidade) 
        $('#inquerito').val(ipApfd)
        $('#orgaoSpan').text(orgao)
        $('#orgaoIn').val(orgao) 
      }
      if($('#tipo_inquerito').val()=="AI"){
        var ipApfd=$('#inqueritosPoliciais5').attr('ip')
        var orgao=$('#inqueritosPoliciais5').attr('orgao')
        var cidade=$('#inqueritosPoliciais5').attr('cidade')
        $('#cidadeSpan').text(cidade)
        $('#cidadeIn').val(cidade) 
        $('#inquerito').val(ipApfd)
        $('#orgaoSpan').text(orgao)
        $('#orgaoIn').val(orgao) 
      }
})
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
$(document).ready(function() {
    $('#tabela').on('click',function(){
    console.log('ok deu certo')
})
    
  });


  if($('#laudoGDL').val() != ''){
     $('#eficiencia').prop('checked',true)
   }
 

$('#aumentar').on('click',function(e){
  e.preventDefault()
  $('#laudo_campo').show(1000)/*slideDown(1000); aparece de cima pra baixo  */
  console.log('aumentar')

})
$('#diminuir').on('click',function(e){
  e.preventDefault()
  $('#laudo_campo').slideUp(1000) /* slideUp(1000) desaparece de baixo pra cima */
  console.log('diminuir')
})

$(document).ready(function() {
  $('input[type="radio"]').click(function() {
    if ($(this).is(':checked')) {
      $(this).css('transform', 'scale(1.7)');
    } else {
      $(this).css('transform', 'scale(0.1)');
    }
  });
});





