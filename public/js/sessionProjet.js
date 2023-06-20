/* Armazena os dados LocalStorage */

/* Tipo Raiamento */
var tipo_raiamento = $("#tipo_raiamento")
tipo_raiamento.on('change',function(){
    
    localStorage.setItem('tipo_raiamento',tipo_raiamento.val());
})
tipo_raiamento.val(localStorage.getItem('tipo_raiamento'))
tipo_raiamento.trigger('change')

/* Tipo */
var tipo_projetil = $("#tipo_projetil")
tipo_projetil.on('change',function(){
    
    localStorage.setItem('tipo_projetil',tipo_projetil.val());
})
tipo_projetil.val(localStorage.getItem('tipo_projetil'))
tipo_projetil.trigger('change')
/* massa */
var massa = $("#massa")
massa.on('input',function(){
    localStorage.setItem('massa',massa.val());
})
massa.val(localStorage.getItem('massa'))
/* real calibre */
var calibre_real_medio = $("#calibre_real_medio")
calibre_real_medio.on('input',function(){
    localStorage.setItem('calibre_real_medio',calibre_real_medio.val());
})
calibre_real_medio.val(localStorage.getItem('calibre_real_medio'))
/* provavel calibre */
var provavel_calibre = $("#provavel_calibre")
provavel_calibre.on('input',function(){
    localStorage.setItem('provavel_calibre',provavel_calibre.val());
})
provavel_calibre.val(localStorage.getItem('provavel_calibre'))
/* altura maxima */
var altura_projetil = $("#altura_projetil")
altura_projetil.on('input',function(){
    localStorage.setItem('altura_projetil',altura_projetil.val());
})
altura_projetil.val(localStorage.getItem('altura_projetil'))
/* Constituicao e Formato */
var constituicao_formato = $("#constituicao_formato")
constituicao_formato.on('change',function(){
    
    localStorage.setItem('constituicao_formato',constituicao_formato.val());
   
})
constituicao_formato.val(localStorage.getItem('constituicao_formato'))
constituicao_formato.trigger('change') 
/* sentidos das raias */

var sentido_raias = $("#sentido_raias")
sentido_raias.on('change',function(){
    
    localStorage.setItem('sentido_raias',sentido_raias.val());
   
})
sentido_raias.val(localStorage.getItem('sentido_raias'))
sentido_raias.trigger('change') 

/* Quantidade de Raias */
var quantidade_raias = $("#quantidade_raias")
quantidade_raias.on('input',function(){
    localStorage.setItem('quantidade_raias',quantidade_raias.val());
})
quantidade_raias.val(localStorage.getItem('quantidade_raias'))
/* Quantidade  */
var quantidade_projetil = $("#quantidade_projetil")
quantidade_projetil.on('input',function(){
    localStorage.setItem('quantidade_projetil',quantidade_projetil.val());
})
quantidade_projetil.val(localStorage.getItem('quantidade_projetil'))
/* cavados  */
var cavados = $("#cavados")
cavados.on('input',function(){
    localStorage.setItem('cavados',cavados.val());
})
cavados.val(localStorage.getItem('cavados'))
/* Ressaltos */
var ressaltos = $("#ressaltos")
ressaltos.on('input',function(){
    localStorage.setItem('ressaltos',ressaltos.val());
})
ressaltos.val(localStorage.getItem('ressaltos'))

/* Observação */
var observacao = $("#observacao")
observacao.on('input',function(){
    localStorage.setItem('observacao',observacao.val());
})
observacao.val(localStorage.getItem('observacao'))
/* Lacre de Entrada*/
var lacrecartucho = $("#lacrecartucho")
lacrecartucho.on('input',function(){
    localStorage.setItem('lacrecartucho',lacrecartucho.val());
})
lacrecartucho.val(localStorage.getItem('lacrecartucho'))
/* Lacre de Saida*/
var lacreSaida = $("#lacreSaida")
lacreSaida.on('input',function(){
    localStorage.setItem('lacreSaida',lacreSaida.val());
})
lacreSaida.val(localStorage.getItem('lacreSaida'))
/* Origem */
var origem_coletaPerito = $("#origem_coletaPerito")
origem_coletaPerito.on('input',function(){
    localStorage.setItem('origem_coletaPerito',origem_coletaPerito.val());
})
origem_coletaPerito.val(localStorage.getItem('origem_coletaPerito'))
/* N° de Coleta */
var rep_materialColetado = $("#rep_materialColetado")
rep_materialColetado.on('input',function(){
    localStorage.setItem('rep_materialColetado',rep_materialColetado.val());
})
rep_materialColetado.val(localStorage.getItem('rep_materialColetado'))
/* Detalhar Localidade */
var detalharLocalizacao = $("#detalharLocalizacao")
detalharLocalizacao.on('input',function(){
    localStorage.setItem('detalharLocalizacao',detalharLocalizacao.val());
})
detalharLocalizacao.val(localStorage.getItem('detalharLocalizacao'))