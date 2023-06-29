/* Armazena os dados LocalStorage */

/* Tipo Raiamento */
var tipo_raiamento = $("#tipo_raiamento")
tipo_raiamento.on('change',function(){
    
    sessionStorage.setItem('tipo_raiamento',tipo_raiamento.val());
})
tipo_raiamento.val(sessionStorage.getItem('tipo_raiamento'))
tipo_raiamento.trigger('change')

/* Tipo */
var tipo_projetil = $("#tipo_projetil")
tipo_projetil.on('change',function(){
    
    sessionStorage.setItem('tipo_projetil',tipo_projetil.val());
})
tipo_projetil.val(sessionStorage.getItem('tipo_projetil'))
tipo_projetil.trigger('change')
/* massa */
var massa = $("#massa")
massa.on('input',function(){
    sessionStorage.setItem('massa',massa.val());
})
massa.val(sessionStorage.getItem('massa'))
/* real calibre */
var calibre_real_medio = $("#calibre_real_medio")
calibre_real_medio.on('input',function(){
    sessionStorage.setItem('calibre_real_medio',calibre_real_medio.val());
})
calibre_real_medio.val(sessionStorage.getItem('calibre_real_medio'))
/* provavel calibre */
var provavel_calibre = $("#provavel_calibre")
provavel_calibre.on('input',function(){
    sessionStorage.setItem('provavel_calibre',provavel_calibre.val());
})
provavel_calibre.val(sessionStorage.getItem('provavel_calibre'))
/* altura maxima */
var altura_projetil = $("#altura_projetil")
altura_projetil.on('input',function(){
    sessionStorage.setItem('altura_projetil',altura_projetil.val());
})
altura_projetil.val(sessionStorage.getItem('altura_projetil'))
/* Constituicao e Formato */
var constituicao_formato = $("#constituicao_formato")
constituicao_formato.on('change',function(){
    
    sessionStorage.setItem('constituicao_formato',constituicao_formato.val());
   
})
constituicao_formato.val(sessionStorage.getItem('constituicao_formato'))
constituicao_formato.trigger('change') 
/* sentidos das raias */

var sentido_raias = $("#sentido_raias")
sentido_raias.on('change',function(){
    
    sessionStorage.setItem('sentido_raias',sentido_raias.val());
   
})
sentido_raias.val(sessionStorage.getItem('sentido_raias'))
sentido_raias.trigger('change') 

/* Quantidade de Raias */
var quantidade_raias = $("#quantidade_raias")
quantidade_raias.on('input',function(){
    sessionStorage.setItem('quantidade_raias',quantidade_raias.val());
})
quantidade_raias.val(sessionStorage.getItem('quantidade_raias'))
/* Quantidade  */
var quantidade_projetil = $("#quantidade_projetil")
quantidade_projetil.on('input',function(){
    sessionStorage.setItem('quantidade_projetil',quantidade_projetil.val());
})
quantidade_projetil.val(sessionStorage.getItem('quantidade_projetil'))
/* cavados  */
var cavados = $("#cavados")
cavados.on('input',function(){
    sessionStorage.setItem('cavados',cavados.val());
})
cavados.val(sessionStorage.getItem('cavados'))
/* Ressaltos */
var ressaltos = $("#ressaltos")
ressaltos.on('input',function(){
    sessionStorage.setItem('ressaltos',ressaltos.val());
})
ressaltos.val(sessionStorage.getItem('ressaltos'))

/* Observação */
var observacao = $("#observacao")
observacao.on('input',function(){
    sessionStorage.setItem('observacao',observacao.val());
})
observacao.val(sessionStorage.getItem('observacao'))
/* Lacre de Entrada*/
var lacrecartucho = $("#lacrecartucho")
lacrecartucho.on('input',function(){
    sessionStorage.setItem('lacrecartucho',lacrecartucho.val());
})
lacrecartucho.val(sessionStorage.getItem('lacrecartucho'))
/* Lacre de Saida*/
var lacreSaida = $("#lacreSaida")
lacreSaida.on('input',function(){
    sessionStorage.setItem('lacreSaida',lacreSaida.val());
})
lacreSaida.val(sessionStorage.getItem('lacreSaida'))
/* Origem */
var origem_coletaPerito = $("#origem_coletaPerito")
origem_coletaPerito.on('input',function(){
    sessionStorage.setItem('origem_coletaPerito',origem_coletaPerito.val());
})
origem_coletaPerito.val(sessionStorage.getItem('origem_coletaPerito'))
/* N° de Coleta */
var rep_materialColetado = $("#rep_materialColetado")
rep_materialColetado.on('input',function(){
    sessionStorage.setItem('rep_materialColetado',rep_materialColetado.val());
})
rep_materialColetado.val(sessionStorage.getItem('rep_materialColetado'))
/* Detalhar Localidade */
var detalharLocalizacao = $("#detalharLocalizacao")
detalharLocalizacao.on('input',function(){
    sessionStorage.setItem('detalharLocalizacao',detalharLocalizacao.val());
})
detalharLocalizacao.val(sessionStorage.getItem('detalharLocalizacao'))