$('#editarInformacoes').hide()
$('#btn-edit').on('click',function(){
    $('#editarInformacoes').fadeIn(1000)
    $('#showLaudo').hide()
    $('#btn-edit').hide()
    
})


function acaoBtnAumentar(element) {/*slideDown(1000); aparece de cima pra baixo  */
    
    var cont=element
    var divId = 'group_pecas_gdl' + cont;
    $('#' + divId).show(1000);
    
}
function acaoBtnDiminuir(element){
   var cont = element
    var divId = 'group_pecas_gdl' + cont;
    $('#' + divId).hide(1000);
    
 }   

 function acaoDiminuirDiv() {
    var cont = 0;
    var divId = 'group_pecas_gdl' + cont;
  
    while ($('#' + divId).length > 0) {
      $('#' + divId).hide(1000);
      cont++;
      divId = 'group_pecas_gdl' + cont;
      
    }
  } 
acaoDiminuirDiv()
$('#btnAumentarImg').on('click',function(){
  
  $('#imageHideShow').show(1000)
}) 
$('#btnDiminuirImg').on('click',function(){
  
  $('#imageHideShow').hide(1000)
}) 


