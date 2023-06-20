/* Armazena os dados LocalStorage */
/* Session */
var marca=$("#marca")
/* captura os dados gdl *****************************************************/
if($('#marca_gdl').attr('marca')!=null){
    sessionStorage.setItem('marca_submetralhadora',$('#marca_gdl').attr('marca'));
    /* pegando o text do elemento e comparando */
    $('#marca option:selected').text(sessionStorage.getItem('marca_submetralhadora'))
}
else{
marca.on('change',function(){
    
    /* pegando o value e comparado */
    sessionStorage.setItem('marca_submetralhadora',marca.val());
})
marca.val(sessionStorage.getItem('marca_submetralhadora'))

}
marca.trigger('change');
/* Fabricacao ***************************************************************/

$('#pais').val(sessionStorage.getItem('marca_submetralhadora'));
$('#pais').trigger('change');

/*Modelo*********************************************************************/
var modelo = $("#modelo")
modelo.on('input',function(){
    sessionStorage.setItem('modelo_submetralhadora',modelo.val());
})
modelo.val(sessionStorage.getItem('modelo_submetralhadora'))
/* Status Serie */
var statusSerie = $("#tipo_serie")
if($('#estado_serie_gdl').attr('status_serie')!=null){
    sessionStorage.setItem('statusSerie_submetralhadora',$('#estado_serie_gdl').attr('status_serie'));
}
else{
statusSerie.on('change',function(){
    console.log($("#tipo_serie").val())
    sessionStorage.setItem('statusSerie_submetralhadora',statusSerie.val());
})}
statusSerie.val(sessionStorage.getItem('statusSerie_submetralhadora'))
statusSerie.trigger('change')
/* Num Serie *************************************************************/
var numSerie = $("#num_serie")

if($('#num_serie_gdl').attr('num_serie')!=null){
    sessionStorage.setItem('numSerie_submetralhadora',$('#num_serie_gdl').attr('num_serie'));
}
else{
numSerie.on('input',function(){
    sessionStorage.setItem('numSerie_submetralhadora',numSerie.val());
})
}
numSerie.val(sessionStorage.getItem('numSerie_submetralhadora'))
/* Num Patrimonio **********************************************************************/
var numPatrimonio = $("#numPatrimonio")
if($('#patrimonio_gdl').attr('patrimonio')){
    sessionStorage.setItem('numPatrimonio_submetralhadora',$('#patrimonio_gdl').attr('patrimonio'));
}else{
numPatrimonio.on('input',function(){
    sessionStorage.setItem('numPatrimonio_submetralhadora',numPatrimonio.val());
})}
numPatrimonio.val(sessionStorage.getItem('numPatrimonio_submetralhadora'))
/* Num Canos */
var num_canos = $("#num_canos")
num_canos.on('change',function(){
    
    sessionStorage.setItem('num_canos_submetralhadora',num_canos.val());
})
num_canos.val(sessionStorage.getItem('num_canos_submetralhadora'))
num_canos.trigger('change')
/* Sistema de Carregamento */
var calibre = $("#calibre")

calibre.on('change',function(){
    
    sessionStorage.setItem('calibre_submetralhadora',calibre.val());
})
calibre.val(sessionStorage.getItem('calibre_submetralhadora'))
calibre.trigger('change')
/* Regime de Tiro */
var sistema_funcionamento = $("#sistema_funcionamento")
sistema_funcionamento.on('change',function(){
    
    sessionStorage.setItem('sistema_funcionamento_submetralhadora',sistema_funcionamento.val());
})
sistema_funcionamento.val(sessionStorage.getItem('sistema_funcionamento_submetralhadora'))
sistema_funcionamento.trigger('change')

/* Tipo Carregador */
var tipo_carregador = $("#tipo_carregador")
tipo_carregador.on('change',function(){
    
    sessionStorage.setItem('tipo_carregador_submetralhadora',tipo_carregador.val());
})
tipo_carregador.val(sessionStorage.getItem('tipo_carregador_submetralhadora'))
tipo_carregador.trigger('change')
/* Capacidade*************************************************************** */
var capacidade_carregador = $("#capacidade_carregador")

if($('#capacidade_gdl').attr('capacidade')!=null){
    sessionStorage.setItem('capacidade_carregador_submetralhadora',$('#capacidade_gdl').attr('capacidade'));
}else{
capacidade_carregador.on('input',function(){
    sessionStorage.setItem('capacidade_carregador_submetralhadora',capacidade_carregador.val());
})}
capacidade_carregador.val(sessionStorage.getItem('capacidade_carregador_submetralhadora'))

/* Sistema de Percussão */
var sistema_percussao = $("#sistema_percussao")
sistema_percussao.on('change',function(){
    
    sessionStorage.setItem('sistema_percussao_submetralhadora',sistema_percussao.val());
})
sistema_percussao.val(sessionStorage.getItem('sistema_percussao_submetralhadora'))
sistema_percussao.trigger('change')
/* Sistema de Funcionamento */
var sistema_disparo = $("#sistema_disparo")
sistema_disparo.on('change',function(){
    
    sessionStorage.setItem('sistema_disparo_submetralhadora',sistema_disparo.val());
})
sistema_disparo.val(sessionStorage.getItem('sistema_disparo_submetralhadora'))
sistema_disparo.trigger('change')
/* Acabamento **************************************************************************/
var tipo_acabamento = $("#tipo_acabamento")
if($('#acabamento_gdl').attr('acabamento')!=null){
    sessionStorage.setItem('tipo_acabamento_submetralhadora',$('#acabamento_gdl').attr('acabamento'));
}else{
tipo_acabamento.on('change',function(){
    
    sessionStorage.setItem('tipo_acabamento_submetralhadora',tipo_acabamento.val());
})}
tipo_acabamento.val(sessionStorage.getItem('tipo_acabamento_submetralhadora'))
tipo_acabamento.trigger('change')
/* Acabamento Outra Opção */
if(tipo_acabamento.val()=="outros"){
    var acabamento_outra_opcao = $("#acabamento_outra_opcao")
    acabamento_outra_opcao.on('input',function(){
        sessionStorage.setItem('acabamento_outra_opcao_submetralhadora',acabamento_outra_opcao.val());
    })
    acabamento_outra_opcao.attr('disabled',false)
    acabamento_outra_opcao.val(sessionStorage.getItem('acabamento_outra_opcao_submetralhadora'))
}

/* Cabo*/
var cabo = $("#cabo")
cabo.on('change',function(){
    
    sessionStorage.setItem('cabo_submetralhadora',cabo.val());
})
cabo.val(sessionStorage.getItem('cabo_submetralhadora'))
cabo.trigger('change')

/* Cabo Outra Opção */
if(cabo.val()=="outros"){
    var cabo_outra_opcao = $("#cabo_outra_opcao")
    cabo_outra_opcao.on('input',function(){
        sessionStorage.setItem('cabo_outra_opcao_submetralhadora',cabo_outra_opcao.val());
    })
    cabo_outra_opcao.attr('disabled',false)
    cabo_outra_opcao.val(sessionStorage.getItem('cabo_outra_opcao_submetralhadora'))
}

/* Comprimento Total */
var comprimento_total = $("#comprimento_total")
comprimento_total.on('input',function(){
    sessionStorage.setItem('comprimento_total_submetralhadora',comprimento_total.val());
})
comprimento_total.val(sessionStorage.getItem('comprimento_total_submetralhadora'))

/* Altura */
var altura = $("#altura")
altura.on('input',function(){
    sessionStorage.setItem('altura_submetralhadora',altura.val());
})
altura.val(sessionStorage.getItem('altura_submetralhadora'))

/* Comprimento do Cano */
var comprimento_cano = $("#comprimento_cano")
comprimento_cano.on('input',function(){
    sessionStorage.setItem('comprimento_cano_submetralhadora',comprimento_cano.val());
})
comprimento_cano.val(sessionStorage.getItem('comprimento_cano_submetralhadora'))
/* Quantidade de Raias */
var quantidade_raias = $("#quantidade_raias")
quantidade_raias.on('input',function(){
    sessionStorage.setItem('quantidade_raias_submetralhadora',quantidade_raias.val());
})
quantidade_raias.val(sessionStorage.getItem('quantidade_raias_submetralhadora'))

/* Sentido das Raias */
var sentido_raias = $("#sentido_raias")
sentido_raias.on('change',function(){
    
    sessionStorage.setItem('sentido_raias_submetralhadora',sentido_raias.val());
})
sentido_raias.val(sessionStorage.getItem('sentido_raias_submetralhadora'))
sentido_raias.trigger('change')

/* Estado Geral ******************************************************************/
var estado_geral = $("#estado_geral")
console.log($('#estado_geral_gdl').attr('estado_geral'))
/* Dados vindo gdl se for diferente de null o dado e capturado*/
if($('#estado_geral_gdl').attr('estado_geral')!=null){
    sessionStorage.setItem('estado_geral_submetralhadora',$('#estado_geral_gdl').attr('estado_geral'));
}else{
    estado_geral.on('change',function(){
    
    sessionStorage.setItem('estado_geral_submetralhadora',estado_geral.val());
}) }
estado_geral.val(sessionStorage.getItem('estado_geral_submetralhadora'))
estado_geral.trigger('change')

/* Funcionamento */
var funcionamento = $("#funcionamento")
funcionamento.on('change',function(){
    
    sessionStorage.setItem('funcionamento_submetralhadora',funcionamento.val());
})
funcionamento.val(sessionStorage.getItem('funcionamento_submetralhadora'))
funcionamento.trigger('change')

/* N° Exame de Coleta */
var rep_materialColetado = $("#rep_materialColetado")
rep_materialColetado.on('input',function(){
    sessionStorage.setItem('rep_materialColetado_submetralhadora',rep_materialColetado.val());
})
rep_materialColetado.val(sessionStorage.getItem('rep_materialColetado_submetralhadora'))
/* N° Lacre de Entrada *****************************************************************/
var numLacreEntrada = $("#numLacreEntrada")

/* lacre vindo do gdl */
/* Se for diferente de null a rep captura a rep vindo gdl e armazena na sessão */
console.log($('#lacre_entrada_gdl').attr('lacre'))
if($('#lacre_entrada_gdl').attr('lacre')!=null){
sessionStorage.setItem('numLacreEntrada_submetralhadora',$('#lacre_entrada_gdl').attr('lacre')); 
}else{
numLacreEntrada.on('input',function(){
    sessionStorage.setItem('numLacreEntrada_submetralhadora',numLacreEntrada.val());
})    
    
}

numLacreEntrada.val(sessionStorage.getItem('numLacreEntrada_submetralhadora'))

/* N° Lacre de Saida **********************************************************************/
var lacreSaida = $("#lacreSaida")
if($('#lacre_saida_gdl').attr('lacre_saida')!=null){
    sessionStorage.setItem('lacreSaida_submetralhadora',$('#lacre_saida_gdl').attr('lacre_saida'));
}else{
lacreSaida.on('input',function(){
    sessionStorage.setItem('lacreSaida_submetralhadora',lacreSaida.val());
})}
lacreSaida.val(sessionStorage.getItem('lacreSaida_submetralhadora'))

/* N° Montagem */
var numeracao_montagem = $("#numeracao_montagem")
numeracao_montagem.on('input',function(){
    sessionStorage.setItem('numeracao_montagem_submetralhadora',numeracao_montagem.val());
})
numeracao_montagem.val(sessionStorage.getItem('numeracao_montagem_submetralhadora'))

/*Telha*/
var telha = $("#telha")
telha.on('input',function(){
    sessionStorage.setItem('telha_submetralhadora',telha.val());
})
telha.val(sessionStorage.getItem('telha_submetralhadora'))

/* Coronha e Fuste */
var coronha_fuste = $("#coronha_fuste")
coronha_fuste.on('change',function(){
    
    sessionStorage.setItem('coronha_fuste_submetralhadora',coronha_fuste.val());
})
coronha_fuste.val(sessionStorage.getItem('coronha_fuste_submetralhadora'))
coronha_fuste.trigger('change')

/* Coronha  */
var coronha = $("#coronha")
coronha.on('change',function(){
    
    sessionStorage.setItem('coronha_submetralhadora',coronha.val());
})
coronha.val(sessionStorage.getItem('coronha_submetralhadora'))
coronha.trigger('change')

/* Tambor  */
var tambor_rebate = $("#tambor_rebate")
tambor_rebate.on('change',function(){
    
    sessionStorage.setItem('tambor_rebate_submetralhadora',tambor_rebate.val());
})
tambor_rebate.val(sessionStorage.getItem('tambor_rebate_submetralhadora'))
tambor_rebate.trigger('change')

/* Tipo Tambor  */
var tipo_tambor = $("#tipo_tambor")
tipo_tambor.on('change',function(){
    
    sessionStorage.setItem('tipo_tambor_submetralhadora',tipo_tambor.val());
})
tipo_tambor.val(sessionStorage.getItem('tipo_tambor_submetralhadora'))
tipo_tambor.trigger('change')
/* Dito oficio */
var dito_oficio = $("#dito_oficio")
dito_oficio.on('input',function(){
    sessionStorage.setItem('dito_oficio_submetralhadora',dito_oficio.val());
})
dito_oficio.val(sessionStorage.getItem('dito_oficio_submetralhadora'))
/* end local */