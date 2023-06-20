/* Armazena os dados LocalStorage */
/* Tambor  */
var tipo_municao = $("#tipo_municao")
tipo_municao.on('change',function(){
    
    localStorage.setItem('tipo_municao',tipo_municao.val());
})
tipo_municao.val(localStorage.getItem('tipo_municao'))
tipo_municao.trigger('change')

/* Marca e Pais */
var marca=$("#marca")
marca.on('change',function(){
    localStorage.setItem('marca',marca.val());
})
marca.val(localStorage.getItem('marca'))
marca.trigger('change');
$('#pais').val(localStorage.getItem('marca'));
$('#pais').trigger('change');
/* Calibre */
var calibre = $("#calibre")
calibre.on('change',function(){
    
    localStorage.setItem('calibre',calibre.val());
})
calibre.val(localStorage.getItem('calibre'))
calibre.trigger('change')

/* Quantidade */
var quantidade = $("#quantidade")
quantidade.on('input',function(){
    localStorage.setItem('quantidade',quantidade.val());
})
quantidade.val(localStorage.getItem('quantidade'))
/* Estojo */
var estojo = $("#estojo")
estojo.on('change',function(){
    
    localStorage.setItem('estojo',estojo.val());
})
estojo.val(localStorage.getItem('estojo'))
estojo.trigger('change')
/* Projetil */
var projetil = $("#projetil")
projetil.on('change',function(){
    
    localStorage.setItem('projetil',projetil.val());
})
projetil.val(localStorage.getItem('projetil'))
projetil.trigger('change')
/* Espoleta */
var tipo_projetil = $("#tipo_projetil")
tipo_projetil.on('change',function(){
    
    localStorage.setItem('tipo_projetil',tipo_projetil.val());
})
tipo_projetil.val(localStorage.getItem('tipo_projetil'))
tipo_projetil.trigger('change')
/* Condição Cartucho */
var condicaoCartucho = $("#condicaoCartucho")
condicaoCartucho.on('change',function(){
    
    localStorage.setItem('condicaoCartucho',condicaoCartucho.val());
})
condicaoCartucho.val(localStorage.getItem('condicaoCartucho'))
condicaoCartucho.trigger('change')
/* Condição Estojo */
var condicaoEstojo = $("#condicaoEstojo")
condicaoEstojo.on('change',function(){
    
    localStorage.setItem('condicaoEstojo',condicaoEstojo.val());
})
condicaoEstojo.val(localStorage.getItem('condicaoEstojo'))
condicaoEstojo.trigger('change')
/* Condição cartucho/Estojo */
if(tipo_municao.val()=="cartucho"){
    condicaoEstojo.val("")
}else if(tipo_municao.val()=="estojo"){
    condicaoCartucho.val("")
}
/* Observação */
var observacao = $("#observacao")
observacao.on('input',function(){
    localStorage.setItem('observacao',observacao.val());
})
observacao.val(localStorage.getItem('observacao'))
/* Funcionamento */
 var funcionamentoCartucho = $("#funcionamentoCartucho")
funcionamentoCartucho.on('change',function(){
    if($('#funcionamentoCartucho').val()!="parcialmente eficiente"){
    localStorage.setItem('funcionamentoCartucho',funcionamentoCartucho.val());
    }
})
funcionamentoCartucho.val(localStorage.getItem('funcionamentoCartucho'))
funcionamentoCartucho.trigger('change')  
/* N de Coleta */
var rep_materialColetado = $("#rep_materialColetado")
rep_materialColetado.on('input',function(){
    localStorage.setItem('rep_materialColetado',rep_materialColetado.val());
})
rep_materialColetado.val(localStorage.getItem('rep_materialColetado'))

/* lote */
var lote = $("#lote")
lote.on('input',function(){
    localStorage.setItem('lote',lote.val());
})
lote.val(localStorage.getItem('lote'))
/* lacre de entrada */
var lacrecartucho = $("#lacrecartucho")
lacrecartucho.on('input',function(){
    localStorage.setItem('lacrecartucho',lacrecartucho.val());
})
lacrecartucho.val(localStorage.getItem('lacrecartucho'))
/* lacre de saida */
var lacre_saida = $("#lacre_saida")
lacre_saida.on('input',function(){
    localStorage.setItem('lacre_saida',lacre_saida.val());
})
lacre_saida.val(localStorage.getItem('lacre_saida'))


    
    

