/* Armazena os dados LocalStorage */
/* Tambor  */


/* Marca e Pais */
/* Armazena os dados sessionStorage */
/* Session */

var marca=$("#marca")
console.log('Marca: '+marca.val())
/* captura os dados gdl *****************************************************/
console.log('Marca: ',$('#marca_gdl').attr('marca'))
var valorCorrespondente;
if($('#marca_gdl').attr('marca')!=''){
    if($('#marca_gdl').attr('marca')===undefined){
        marca.on('change',function(){
    
            /* pegando o value e comparado */
            sessionStorage.setItem('marca_cartucho',marca.val());
            
        })
            marca.val(sessionStorage.getItem('marca_cartucho'))
            marca.trigger('change');
        $('#pais').val(sessionStorage.getItem('marca_cartucho'));
    }else{
    sessionStorage.setItem('marca_espingarda',$('#marca_gdl').attr('marca'));
    var marcaSelecionada = sessionStorage.getItem('marca_espingarda');
    //percorre todo o option
    $('#marca option').each(function() {
        
        var textoOpcao = $(this).text();
        var tirraS=textoOpcao.replace(/\s/g,"")//tirar os espaços
        
        if (tirraS == marcaSelecionada) {
        
            $('#marca').val($(this).val()).trigger('change');
            $('#pais').val($(this).val()).trigger('change');
          return false; // Interrompe o loop quando a opção correspondente é encontrada
        }
      });
    /* pegando o text do elemento e comparando */
    

}
}
else{
    marca.on('change',function(){
    
    /* pegando o value e comparado */
    sessionStorage.setItem('marca_cartucho',marca.val());
    
})
    marca.val(sessionStorage.getItem('marca_cartucho'))
    marca.trigger('change');
$('#pais').val(sessionStorage.getItem('marca_cartucho'));
}

$('#pais').trigger('change');

/* Calibre */
var calibre = $("#calibre")
calibre.on('change',function(){
    
    sessionStorage.setItem('calibre',calibre.val());
})
calibre.val(sessionStorage.getItem('calibre'))
calibre.trigger('change')

/* Quantidade */
var quantidade = $("#quantidade")

if($('#quantidade_gdl').attr('quantidade')!=''){
    if($('#quantidade_gdl').attr('quantidade')===undefined){
        quantidade.on('input',function(){
            sessionStorage.setItem('quantidade_cartucho',quantidade.val());
        })   
         }
         else{
            sessionStorage.setItem('quantidade_cartucho',$('#quantidade_gdl').attr('quantidade'));
         }
}else{
quantidade.on('input',function(){
    sessionStorage.setItem('quantidade_cartucho',quantidade.val());
})    
    
}

quantidade.val(sessionStorage.getItem('quantidade_cartucho'))


/* Estojo */
var estojo = $("#estojo")
estojo.on('change',function(){
    
    sessionStorage.setItem('estojo',estojo.val());
})
estojo.val(sessionStorage.getItem('estojo'))
estojo.trigger('change')
/* Projetil */
var projetil = $("#projetil")
projetil.on('change',function(){
    
    sessionStorage.setItem('projetil',projetil.val());
})
projetil.val(sessionStorage.getItem('projetil'))
projetil.trigger('change')
/* Espoleta */
var tipo_projetil = $("#tipo_projetil")
tipo_projetil.on('change',function(){
    
    sessionStorage.setItem('tipo_projetil',tipo_projetil.val());
})
tipo_projetil.val(sessionStorage.getItem('tipo_projetil'))
tipo_projetil.trigger('change')

/* Observação */
var observacao = $("#observacao")
observacao.on('input',function(){
    sessionStorage.setItem('observacao',observacao.val());
})
observacao.val(sessionStorage.getItem('observacao'))
/* Funcionamento */
 var funcionamentoCartucho = $("#funcionamentoCartucho")
funcionamentoCartucho.on('change',function(){
    if($('#funcionamentoCartucho').val()!="parcialmente eficiente"){
    sessionStorage.setItem('funcionamentoCartucho',funcionamentoCartucho.val());
    }
})
funcionamentoCartucho.val(sessionStorage.getItem('funcionamentoCartucho'))
funcionamentoCartucho.trigger('change')  
/* N de Coleta */
var rep_materialColetado = $("#rep_materialColetado")
rep_materialColetado.on('input',function(){
    sessionStorage.setItem('rep_materialColetado',rep_materialColetado.val());
})
rep_materialColetado.val(localStorage.getItem('rep_materialColetado'))

/* lote */

var lote = $("#lote")

if($('#lote_gdl').attr('lote')!=''){
    if($('#lote_gdl').attr('lote')===undefined){
        lote.on('input',function(){
            sessionStorage.setItem('lote',lote.val());
        })
    }
    else{
        sessionStorage.setItem('lote',$('#lote_gdl').attr('lote'));
    }
    
}else{
lote.on('input',function(){
    sessionStorage.setItem('lote',lote.val());
})}
lote.val(sessionStorage.getItem('lote'))



/* lacre de entrada */
var lacrecartucho = $("#lacrecartucho")


console.log('Lacre de Entrada: '+$('#lacre_entrada_gdl').attr('lacre'))
if($('#lacre_entrada_gdl').attr('lacre')!=''){
    if($('#lacre_entrada_gdl').attr('lacre')===undefined){
        lacrecartucho.on('input',function(){
            sessionStorage.setItem('numLacreEntrada_cartucho',lacrecartucho.val());
        })   
         }
         else{
            sessionStorage.setItem('numLacreEntrada_cartucho',$('#lacre_entrada_gdl').attr('lacre'));
         }
}else{
lacrecartucho.on('input',function(){
    sessionStorage.setItem('numLacreEntrada_cartucho',lacrecartucho.val());
})    
    
}

lacrecartucho.val(sessionStorage.getItem('numLacreEntrada_cartucho'))




/* lacre de saida */


var lacre_saida = $("#lacre_saida")
console.log('Lacre de Saida'+$('#lacre_saida_gdl').attr('lacre_saida'))
if($('#lacre_saida_gdl').attr('lacre_saida')!=''){
    if($('#lacre_saida_gdl').attr('lacre_saida')===undefined){
        lacre_saida.on('input',function(){
            sessionStorage.setItem('lacreSaida_cartucho',lacre_saida.val());
        })
    }
    else{
        sessionStorage.setItem('lacreSaida_cartucho',$('#lacre_saida_gdl').attr('lacre_saida'));
    }
    
}else{
lacre_saida.on('input',function(){
    sessionStorage.setItem('lacreSaida_cartucho',lacre_saida.val());
})}
lacre_saida.val(sessionStorage.getItem('lacreSaida_cartucho'))
/*condição do cartucho*/

var condicaoCartucho = $("#condicaoCartucho")
condicaoCartucho.on('change',function(){
    
    sessionStorage.setItem('condicaoCartucho',condicaoCartucho.val());
})
condicaoCartucho.val(sessionStorage.getItem('condicaoCartucho'))
condicaoCartucho.trigger('change')
    

 

