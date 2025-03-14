/* Armazena os dados LocalStorage */
/* Session */
var marca=$("#marca")
marca.on('change',function(){
    localStorage.setItem('marca',marca.val());
})
marca.val(localStorage.getItem('marca'))
marca.trigger('change');
$('#pais').val(localStorage.getItem('marca'));
$('#pais').trigger('change');
/*Modelo*/
var modelo = $("#modelo")
modelo.on('input',function(){
    localStorage.setItem('modelo',modelo.val());
})
modelo.val(localStorage.getItem('modelo'))
/* Status Serie 
var statusSerie = $("#tipo_serie")
statusSerie.on('change',function(){
    
    localStorage.setItem('statusSerie',statusSerie.val());
})
statusSerie.val(localStorage.getItem('statusSerie'))
statusSerie.trigger('change')

var numSerie = $("#num_serie")
numSerie.on('input',function(){
    localStorage.setItem('numSerie',numSerie.val());
})*/
numSerie.val(localStorage.getItem('numSerie'))
/* Num Patrimonio */
var numPatrimonio = $("#numPatrimonio")
numPatrimonio.on('input',function(){
    localStorage.setItem('numPatrimonio',numPatrimonio.val());
})
numPatrimonio.val(localStorage.getItem('numPatrimonio'))
/* Num Canos */
var num_canos = $("#num_canos")
num_canos.on('change',function(){
    
    localStorage.setItem('num_canos',num_canos.val());
})
num_canos.val(localStorage.getItem('num_canos'))
num_canos.trigger('change')
/* Sistema de Carregamento */
var calibre = $("#calibre")
calibre.on('change',function(){
    
    localStorage.setItem('calibre',calibre.val());
})
calibre.val(localStorage.getItem('calibre'))
calibre.trigger('change')
/* Regime de Tiro */
var sistema_funcionamento = $("#sistema_funcionamento")
sistema_funcionamento.on('change',function(){
    
    localStorage.setItem('sistema_funcionamento',sistema_funcionamento.val());
})
sistema_funcionamento.val(localStorage.getItem('sistema_funcionamento'))
sistema_funcionamento.trigger('change')

/* Tipo Carregador */
var tipo_carregador = $("#tipo_carregador")
tipo_carregador.on('change',function(){
    
    localStorage.setItem('tipo_carregador',tipo_carregador.val());
})
tipo_carregador.val(localStorage.getItem('tipo_carregador'))
tipo_carregador.trigger('change')
/* Capacidade */
var capacidade_carregador = $("#capacidade_carregador")
capacidade_carregador.on('input',function(){
    localStorage.setItem('capacidade_carregador',capacidade_carregador.val());
})
capacidade_carregador.val(localStorage.getItem('capacidade_carregador'))

/* Sistema de Percussão */
var sistema_percussao = $("#sistema_percussao")
sistema_percussao.on('change',function(){
    
    localStorage.setItem('sistema_percussao',sistema_percussao.val());
})
sistema_percussao.val(localStorage.getItem('sistema_percussao'))
sistema_percussao.trigger('change')
/* Sistema de Funcionamento */
var sistema_disparo = $("#sistema_disparo")
sistema_disparo.on('change',function(){
    
    localStorage.setItem('sistema_disparo',sistema_disparo.val());
})
sistema_disparo.val(localStorage.getItem('sistema_disparo'))
sistema_disparo.trigger('change')
/* Acabamento */
var tipo_acabamento = $("#tipo_acabamento")
tipo_acabamento.on('change',function(){
    
    localStorage.setItem('tipo_acabamento',tipo_acabamento.val());
})
tipo_acabamento.val(localStorage.getItem('tipo_acabamento'))
tipo_acabamento.trigger('change')
/* Acabamento Outra Opção */
if(tipo_acabamento.val()=="outros"){
    var acabamento_outra_opcao = $("#acabamento_outra_opcao")
    acabamento_outra_opcao.on('input',function(){
        localStorage.setItem('acabamento_outra_opcao',acabamento_outra_opcao.val());
    })
    acabamento_outra_opcao.attr('disabled',false)
    acabamento_outra_opcao.val(localStorage.getItem('acabamento_outra_opcao'))
}

/* Cabo*/
var cabo = $("#cabo")
cabo.on('change',function(){
    
    localStorage.setItem('cabo',cabo.val());
})
cabo.val(localStorage.getItem('cabo'))
cabo.trigger('change')

/* Cabo Outra Opção */
if(cabo.val()=="outros"){
    var cabo_outra_opcao = $("#cabo_outra_opcao")
    cabo_outra_opcao.on('input',function(){
        localStorage.setItem('cabo_outra_opcao',cabo_outra_opcao.val());
    })
    cabo_outra_opcao.attr('disabled',false)
    cabo_outra_opcao.val(localStorage.getItem('cabo_outra_opcao'))
}

/* Comprimento Total */
var comprimento_total = $("#comprimento_total")
comprimento_total.on('input',function(){
    localStorage.setItem('comprimento_total',comprimento_total.val());
})
comprimento_total.val(localStorage.getItem('comprimento_total'))

/* Altura */
var altura = $("#altura")
altura.on('input',function(){
    localStorage.setItem('altura',altura.val());
})
altura.val(localStorage.getItem('altura'))

/* Comprimento do Cano */
var comprimento_cano = $("#comprimento_cano")
comprimento_cano.on('input',function(){
    localStorage.setItem('comprimento_cano',comprimento_cano.val());
})
comprimento_cano.val(localStorage.getItem('comprimento_cano'))
/* Quantidade de Raias */
var quantidade_raias = $("#quantidade_raias")
quantidade_raias.on('input',function(){
    localStorage.setItem('quantidade_raias',quantidade_raias.val());
})
quantidade_raias.val(localStorage.getItem('quantidade_raias'))

/* Sentido das Raias */
var sentido_raias = $("#sentido_raias")
sentido_raias.on('change',function(){
    
    localStorage.setItem('sentido_raias',sentido_raias.val());
})
sentido_raias.val(localStorage.getItem('sentido_raias'))
sentido_raias.trigger('change')

/* Estado Geral */
var estado_geral = $("#estado_geral")
estado_geral.on('change',function(){
    
    localStorage.setItem('estado_geral',estado_geral.val());
})
estado_geral.val(localStorage.getItem('estado_geral'))
estado_geral.trigger('change')

/* Funcionamento */
var funcionamento = $("#funcionamento")
funcionamento.on('change',function(){
    
    localStorage.setItem('funcionamento',funcionamento.val());
})
funcionamento.val(localStorage.getItem('funcionamento'))
funcionamento.trigger('change')

/* N° Exame de Coleta */
var rep_materialColetado = $("#rep_materialColetado")
rep_materialColetado.on('input',function(){
    localStorage.setItem('rep_materialColetado',rep_materialColetado.val());
})
rep_materialColetado.val(localStorage.getItem('rep_materialColetado'))
/* N° Lacre de Entrada */
var numLacreEntrada = $("#numLacreEntrada")
numLacreEntrada.on('input',function(){
    localStorage.setItem('numLacreEntrada',numLacreEntrada.val());
})
numLacreEntrada.val(localStorage.getItem('numLacreEntrada'))

/* N° Lacre de Saida */
var lacreSaida = $("#lacreSaida")
lacreSaida.on('input',function(){
    localStorage.setItem('lacreSaida',lacreSaida.val());
})
lacreSaida.val(localStorage.getItem('lacreSaida'))

/* N° Montagem */
var numeracao_montagem = $("#numeracao_montagem")
numeracao_montagem.on('input',function(){
    localStorage.setItem('numeracao_montagem',numeracao_montagem.val());
})
numeracao_montagem.val(localStorage.getItem('numeracao_montagem'))

/*Telha*/
var telha = $("#telha")
telha.on('input',function(){
    localStorage.setItem('telha',telha.val());
})
telha.val(localStorage.getItem('telha'))

/* Coronha e Fuste */
var coronha_fuste = $("#coronha_fuste")
coronha_fuste.on('change',function(){
    
    localStorage.setItem('coronha_fuste',coronha_fuste.val());
})
coronha_fuste.val(localStorage.getItem('coronha_fuste'))
coronha_fuste.trigger('change')

/* Coronha  */
var coronha = $("#coronha")
coronha.on('change',function(){
    
    localStorage.setItem('coronha',coronha.val());
})
coronha.val(localStorage.getItem('coronha'))
coronha.trigger('change')

/* Tambor  */
var tambor_rebate = $("#tambor_rebate")
tambor_rebate.on('change',function(){
    
    localStorage.setItem('tambor_rebate',tambor_rebate.val());
})
tambor_rebate.val(localStorage.getItem('tambor_rebate'))
tambor_rebate.trigger('change')

/* Tipo Tambor  */
var tipo_tambor = $("#tipo_tambor")
tipo_tambor.on('change',function(){
    
    localStorage.setItem('tipo_tambor',tipo_tambor.val());
})
tipo_tambor.val(localStorage.getItem('tipo_tambor'))
tipo_tambor.trigger('change')
/* Dito oficio */
var dito_oficio = $("#dito_oficio")
dito_oficio.on('input',function(){
    localStorage.setItem('dito_oficio',dito_oficio.val());
})
dito_oficio.val(localStorage.getItem('dito_oficio'))
/* end local */


var tipo_tambor = $("#imagemCantoSuperior")
