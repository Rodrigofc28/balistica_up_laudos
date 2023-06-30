/* Armazena os dados LocalStorage */
/* Session */

var marca=$("#marca")
console.log('Marca: '+marca.val())
/* captura os dados gdl *****************************************************/
console.log('Marca: ',$('#marca_gdl').attr('marca'))
var valorCorrespondente;
if($('#marca_gdl').attr('marca')!=''){
    if($('#marca_gdl').attr('marca')==undefined){
        marca.on('change',function(){
    
            /* pegando o value e comparado */
            sessionStorage.setItem('marca_pistola',marca.val());
          })   
            /*Tem que ta fora da função change*/
        marca.val(sessionStorage.getItem('marca_pistola'))
        
        marca.trigger('change'); 
        $('#pais').val(sessionStorage.getItem('marca_pistola'));
        $('#pais').trigger('change');
            
    }else{
            sessionStorage.setItem('marca_pistola',$('#marca_gdl').attr('marca'));
            var marcaSelecionada = sessionStorage.getItem('marca_pistola');
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
    sessionStorage.setItem('marca_pistola',marca.val());
    
})
    marca.val(sessionStorage.getItem('marca_pistola'))
    marca.trigger('change');
$('#pais').val(sessionStorage.getItem('marca_pistola'));
}

$('#pais').trigger('change');

/*Modelo*********************************************************************/
var modelo = $("#modelo")
console.log('Modelo: '+$('#modelo_gdl').attr('modelo'))
if($('#modelo_gdl').attr('modelo')!=''){
    if($('#modelo_gdl').attr('modelo')==undefined){
        modelo.on('input',function(){
            sessionStorage.setItem('modelo_pistola',modelo.val());
        })
    }else{
    sessionStorage.setItem('modelo_pistola',$('#modelo_gdl').attr('modelo'));
    }
}else{
modelo.on('input',function(){
    sessionStorage.setItem('modelo_pistola',modelo.val());
})
}
modelo.val(sessionStorage.getItem('modelo_pistola'))
/* Status Serie */
var statusSerie = $("#tipo_serie")
console.log('Status Serie: '+$('#estado_serie_gdl').attr('status_serie'))
if($('#estado_serie_gdl').attr('status_serie')!=''){
    if($('#estado_serie_gdl').attr('status_serie')==undefined){
        statusSerie.on('change',function(){
    
            sessionStorage.setItem('statusSerie_pistola',statusSerie.val());
        })
    }else{
    sessionStorage.setItem('statusSerie_pistola',$('#estado_serie_gdl').attr('status_serie'));
    }
}
else{
statusSerie.on('change',function(){
    
    sessionStorage.setItem('statusSerie_pistola',statusSerie.val());
})}
statusSerie.val(sessionStorage.getItem('statusSerie_pistola'))
statusSerie.trigger('change')
/* Num Serie *************************************************************/
var numSerie = $("#num_serie")
console.log('Numero de Serie: '+$('#num_serie_gdl').attr('num_serie'))
if($('#num_serie_gdl').attr('num_serie')!=''){
    if($('#num_serie_gdl').attr('num_serie')==undefined){
        numSerie.on('input',function(){
            sessionStorage.setItem('numSerie_pistola',numSerie.val());
        })
    }else{
    sessionStorage.setItem('numSerie_pistola',$('#num_serie_gdl').attr('num_serie'));
    }
}
else{
numSerie.on('input',function(){
    sessionStorage.setItem('numSerie_pistola',numSerie.val());
})
}
numSerie.val(sessionStorage.getItem('numSerie_pistola'))
/* Num Patrimonio **********************************************************************/
var numPatrimonio = $("#numPatrimonio")
console.log('Patrimonio: '+$('#patrimonio_gdl').attr('patrimonio'))
if($('#patrimonio_gdl').attr('patrimonio')){
    sessionStorage.setItem('numPatrimonio_pistola',$('#patrimonio_gdl').attr('patrimonio'));
}else{
numPatrimonio.on('input',function(){
    sessionStorage.setItem('numPatrimonio_pistola',numPatrimonio.val());
})}
numPatrimonio.val(sessionStorage.getItem('numPatrimonio_pistola'))
/* Num Canos */
var num_canos = $("#num_canos")
num_canos.on('change',function(){
    
    sessionStorage.setItem('num_canos_pistola',num_canos.val());
})
num_canos.val(sessionStorage.getItem('num_canos_pistola'))
num_canos.trigger('change')
/* Sistema de Carregamento */
var calibre = $("#calibre")
console.log('Calibre: '+$('#calibre_gdl').attr('calibreNominal'))
if($('#calibre_gdl').attr('calibreNominal')!=null){
    sessionStorage.setItem('calibre_pistola',$('#calibre_gdl').attr('calibreNominal'));
}else{
calibre.on('change',function(){
    
    sessionStorage.setItem('calibre_pistola',calibre.val());
})}

calibre.val(sessionStorage.getItem('calibre_pistola'))
calibre.trigger('change')
/* Regime de Tiro */
var sistema_funcionamento = $("#sistema_funcionamento")
sistema_funcionamento.on('change',function(){
    
    sessionStorage.setItem('sistema_funcionamento_pistola',sistema_funcionamento.val());
})
sistema_funcionamento.val(sessionStorage.getItem('sistema_funcionamento_pistola'))
sistema_funcionamento.trigger('change')

/* Tipo Carregador */
var tipo_carregador = $("#tipo_carregador")
tipo_carregador.on('change',function(){
    
    sessionStorage.setItem('tipo_carregador_pistola',tipo_carregador.val());
})
tipo_carregador.val(sessionStorage.getItem('tipo_carregador_pistola'))
tipo_carregador.trigger('change')
/* Capacidade*************************************************************** */
var capacidade_carregador = $("#capacidade_carregador")

console.log('Capacidade: '+$('#capacidade_gdl').attr('capacidade'))
if($('#capacidade_gdl').attr('capacidade')!=''){
    if($('#capacidade_gdl').attr('capacidade')==undefined){
        capacidade_carregador.on('input',function(){
            sessionStorage.setItem('capacidade_carregador_pistola',capacidade_carregador.val());
        })
    }else{
    sessionStorage.setItem('capacidade_carregador_pistola',$('#capacidade_gdl').attr('capacidade'));
    }
}else{
capacidade_carregador.on('input',function(){
    sessionStorage.setItem('capacidade_carregador_pistola',capacidade_carregador.val());
})}
capacidade_carregador.val(sessionStorage.getItem('capacidade_carregador_pistola'))

/* Sistema de Percussão */
var sistema_percussao = $("#sistema_percussao")
sistema_percussao.on('change',function(){
    
    sessionStorage.setItem('sistema_percussao_pistola',sistema_percussao.val());
})
sistema_percussao.val(sessionStorage.getItem('sistema_percussao_pistola'))
sistema_percussao.trigger('change')
/* Sistema de Funcionamento */
var sistema_disparo = $("#sistema_disparo")
sistema_disparo.on('change',function(){
    
    sessionStorage.setItem('sistema_disparo_pistola',sistema_disparo.val());
})
sistema_disparo.val(sessionStorage.getItem('sistema_disparo_pistola'))
sistema_disparo.trigger('change')
/* Acabamento **************************************************************************/
var tipo_acabamento = $("#tipo_acabamento")
console.log('Acabamento: '+$('#acabamento_gdl').attr('acabamento'))
if($('#acabamento_gdl').attr('acabamento')!=''){
    if($('#acabamento_gdl').attr('acabamento')==undefined){
        tipo_acabamento.on('change',function(){
    
            sessionStorage.setItem('tipo_acabamento_pistola',tipo_acabamento.val());
        })
    }else{
    sessionStorage.setItem('tipo_acabamento_pistola',$('#acabamento_gdl').attr('acabamento'));
    }
}else{
tipo_acabamento.on('change',function(){
    
    sessionStorage.setItem('tipo_acabamento_pistola',tipo_acabamento.val());
})}
tipo_acabamento.val(sessionStorage.getItem('tipo_acabamento_pistola'))
tipo_acabamento.trigger('change')
/* Acabamento Outra Opção */
if(tipo_acabamento.val()=="outros"){
    var acabamento_outra_opcao = $("#acabamento_outra_opcao")
    acabamento_outra_opcao.on('input',function(){
        sessionStorage.setItem('acabamento_outra_opcao_pistola',acabamento_outra_opcao.val());
    })
    acabamento_outra_opcao.attr('disabled',false)
    acabamento_outra_opcao.val(sessionStorage.getItem('acabamento_outra_opcao_pistola'))
}

/* Cabo*/
var cabo = $("#cabo")
cabo.on('change',function(){
    
    sessionStorage.setItem('cabo_pistola',cabo.val());
})
cabo.val(sessionStorage.getItem('cabo_pistola'))
cabo.trigger('change')

/* Cabo Outra Opção */
if(cabo.val()=="outros"){
    var cabo_outra_opcao = $("#cabo_outra_opcao")
    cabo_outra_opcao.on('input',function(){
        sessionStorage.setItem('cabo_outra_opcao_pistola',cabo_outra_opcao.val());
    })
    cabo_outra_opcao.attr('disabled',false)
    cabo_outra_opcao.val(sessionStorage.getItem('cabo_outra_opcao_pistola'))
}

/* Comprimento Total */
var comprimento_total = $("#comprimento_total")
comprimento_total.on('input',function(){
    sessionStorage.setItem('comprimento_total_pistola',comprimento_total.val());
})
comprimento_total.val(sessionStorage.getItem('comprimento_total_pistola'))

/* Altura */
var altura = $("#altura")
altura.on('input',function(){
    sessionStorage.setItem('altura_pistola',altura.val());
})
altura.val(sessionStorage.getItem('altura_pistola'))

/* Comprimento do Cano */
var comprimento_cano = $("#comprimento_cano")
comprimento_cano.on('input',function(){
    sessionStorage.setItem('comprimento_cano_pistola',comprimento_cano.val());
})
comprimento_cano.val(sessionStorage.getItem('comprimento_cano_pistola'))
/* Quantidade de Raias */
var quantidade_raias = $("#quantidade_raias")
quantidade_raias.on('input',function(){
    sessionStorage.setItem('quantidade_raias_pistola',quantidade_raias.val());
})
quantidade_raias.val(sessionStorage.getItem('quantidade_raias_pistola'))

/* Sentido das Raias */
var sentido_raias = $("#sentido_raias")
sentido_raias.on('change',function(){
    
    sessionStorage.setItem('sentido_raias_pistola',sentido_raias.val());
})
sentido_raias.val(sessionStorage.getItem('sentido_raias_pistola'))
sentido_raias.trigger('change')

/* Estado Geral ******************************************************************/
var estado_geral = $("#estado_geral")
console.log('Estado Geral: '+$('#estado_geral_gdl').attr('estado_geral'))
/* Dados vindo gdl se for diferente de null o dado e capturado*/
if($('#estado_geral_gdl').attr('estado_geral')!=''){
    if($('#estado_geral_gdl').attr('estado_geral')==undefined){
        estado_geral.on('change',function(){
    
            sessionStorage.setItem('estado_geral_pistola',estado_geral.val());
        })
    }else{
    sessionStorage.setItem('estado_geral_pistola',$('#estado_geral_gdl').attr('estado_geral'));
    }
}else{
    estado_geral.on('change',function(){
    
    sessionStorage.setItem('estado_geral_pistola',estado_geral.val());
}) }
estado_geral.val(sessionStorage.getItem('estado_geral_pistola'))
estado_geral.trigger('change')

/* Funcionamento */
var funcionamento = $("#funcionamento")
console.log('Funcionamento: '+$('#funcionamento_gdl').attr('funcionamento'))
if($('#funcionamento_gdl').val()!=''){
    if($('#funcionamento_gdl').val()==undefined){
        funcionamento.on('change',function(){
    
            sessionStorage.setItem('funcionamento_pistola',$('#funcionamento').val());
        })
    }else{
    sessionStorage.setItem('funcionamento_pistola',$('#funcionamento_gdl').attr('funcionamento'));
    }
}else{
funcionamento.on('change',function(){
    
    sessionStorage.setItem('funcionamento_pistola',$('#funcionamento').val());
})
}
funcionamento.val(sessionStorage.getItem('funcionamento_pistola'))

funcionamento.trigger('change')

/* N° Exame de Coleta */
var rep_materialColetado = $("#rep_materialColetado")
rep_materialColetado.on('input',function(){
    sessionStorage.setItem('rep_materialColetado_pistola',rep_materialColetado.val());
})
rep_materialColetado.val(sessionStorage.getItem('rep_materialColetado_pistola'))
/* N° Lacre de Entrada *****************************************************************/
var numLacreEntrada = $("#numLacreEntrada")

/* lacre vindo do gdl */
/* Se for diferente de null a rep captura a rep vindo gdl e armazena na sessão */
console.log('Lacre de Entrada: '+$('#lacre_entrada_gdl').attr('lacre'))
if($('#lacre_entrada_gdl').attr('lacre')!=''){
    
    if($('#lacre_entrada_gdl').attr('lacre')===undefined){
        numLacreEntrada.on('input',function(){
            sessionStorage.setItem('numLacreEntrada_pistola',numLacreEntrada.val());
        })
         }
         else{
            sessionStorage.setItem('numLacreEntrada_pistola',$('#lacre_entrada_gdl').attr('lacre'));
         }
}else{
numLacreEntrada.on('input',function(){
    sessionStorage.setItem('numLacreEntrada_pistola',numLacreEntrada.val());
})    
    
}

numLacreEntrada.val(sessionStorage.getItem('numLacreEntrada_pistola'))

/* N° Lacre de Saida **********************************************************************/
var lacreSaida = $("#lacreSaida")
console.log('Lacre de Saida'+$('#lacre_saida_gdl').attr('lacre_saida'))
if($('#lacre_saida_gdl').attr('lacre_saida')!=''){
    if($('#lacre_saida_gdl').attr('lacre_saida')==undefined){
        lacreSaida.on('input',function(){
            sessionStorage.setItem('lacreSaida_pistola',lacreSaida.val());
        })
    }else{
    sessionStorage.setItem('lacreSaida_pistola',$('#lacre_saida_gdl').attr('lacre_saida'));
    }
}else{
lacreSaida.on('input',function(){
    sessionStorage.setItem('lacreSaida_pistola',lacreSaida.val());
})}
lacreSaida.val(sessionStorage.getItem('lacreSaida_pistola'))

/* N° Montagem */
var numeracao_montagem = $("#numeracao_montagem")
numeracao_montagem.on('input',function(){
    sessionStorage.setItem('numeracao_montagem_pistola',numeracao_montagem.val());
})
numeracao_montagem.val(sessionStorage.getItem('numeracao_montagem_pistola'))

/*Telha*/
var telha = $("#telha")
telha.on('input',function(){
    sessionStorage.setItem('telha_pistola',telha.val());
})
telha.val(sessionStorage.getItem('telha_pistola'))

/* Coronha e Fuste */
var coronha_fuste = $("#coronha_fuste")
coronha_fuste.on('change',function(){
    
    sessionStorage.setItem('coronha_fuste_pistola',coronha_fuste.val());
})
coronha_fuste.val(sessionStorage.getItem('coronha_fuste_pistola'))
coronha_fuste.trigger('change')

/* Coronha  */
var coronha = $("#coronha")
coronha.on('change',function(){
    
    sessionStorage.setItem('coronha_pistola',coronha.val());
})
coronha.val(sessionStorage.getItem('coronha_pistola'))
coronha.trigger('change')

/* Tambor  */
var tambor_rebate = $("#tambor_rebate")
tambor_rebate.on('change',function(){
    
    sessionStorage.setItem('tambor_rebate_pistola',tambor_rebate.val());
})
tambor_rebate.val(sessionStorage.getItem('tambor_rebate_pistola'))
tambor_rebate.trigger('change')

/* Tipo Tambor  */
var tipo_tambor = $("#tipo_tambor")
tipo_tambor.on('change',function(){
    
    sessionStorage.setItem('tipo_tambor_pistola',tipo_tambor.val());
})
tipo_tambor.val(sessionStorage.getItem('tipo_tambor_pistola'))
tipo_tambor.trigger('change')
/* Dito oficio */
var dito_oficio = $("#dito_oficio")
dito_oficio.on('input',function(){
    sessionStorage.setItem('dito_oficio_pistola',dito_oficio.val());
})
dito_oficio.val(sessionStorage.getItem('dito_oficio_pistola'))
/* end local */