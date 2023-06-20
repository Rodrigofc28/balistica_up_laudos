

export function session_armas(nome){
        /* Armazena os dados LocalStorage */
    /* Session */
    var marca=$("#marca")
    /* captura os dados gdl *****************************************************/
    if($('#marca_gdl').attr('marca')!=null){
        sessionStorage.setItem(`marca${nome}`,$('#marca_gdl').attr('marca'));
        /* pegando o text do elemento e comparando */
        $('#marca option:selected').text(sessionStorage.getItem(`marca${nome}`))
    }
    else{
    marca.on('change',function(){
        
        /* pegando o value e comparado */
        sessionStorage.setItem(`marca${nome}`,marca.val());
    })
    marca.val(sessionStorage.getItem(`marca${nome}`))

    }
    marca.trigger('change');
    /* Fabricacao ***************************************************************/

    $('#pais').val(sessionStorage.getItem(`marca${nome}`));
    $('#pais').trigger('change');

    /*Modelo*********************************************************************/
    var modelo = $("#modelo")
    modelo.on('input',function(){
        sessionStorage.setItem(`modelo${nome}`,modelo.val());
    })
    modelo.val(sessionStorage.getItem(`modelo${nome}`))
    /* Status Serie */
    var statusSerie = $("#tipo_serie")
    if($('#estado_serie_gdl').attr('status_serie')!=null){
        sessionStorage.setItem(`statusSerie${nome}`,$('#estado_serie_gdl').attr('status_serie'));
    }
    else{
    statusSerie.on('change',function(){
        console.log($("#tipo_serie").val())
        sessionStorage.setItem(`statusSerie${nome}`,statusSerie.val());
    })}
    statusSerie.val(sessionStorage.getItem(`statusSerie${nome}`))
    statusSerie.trigger('change')
    /* Num Serie *************************************************************/
    var numSerie = $("#num_serie")

    if($('#num_serie_gdl').attr('num_serie')!=null){
        sessionStorage.setItem(`numSerie${nome}`,$('#num_serie_gdl').attr('num_serie'));
    }
    else{
    numSerie.on('input',function(){
        sessionStorage.setItem(`numSerie${nome}`,numSerie.val());
    })
    }
    numSerie.val(sessionStorage.getItem(`numSerie${nome}`))
    /* Num Patrimonio **********************************************************************/
    var numPatrimonio = $("#numPatrimonio")
    if($('#patrimonio_gdl').attr('patrimonio')){
        sessionStorage.setItem(`numPatrimonio${nome}`,$('#patrimonio_gdl').attr('patrimonio'));
    }else{
    numPatrimonio.on('input',function(){
        sessionStorage.setItem(`numPatrimonio${nome}`,numPatrimonio.val());
    })}
    numPatrimonio.val(sessionStorage.getItem(`numPatrimonio${nome}`))
    /* Num Canos */
    var num_canos = $("#num_canos")
    num_canos.on('change',function(){
        
        sessionStorage.setItem(`num_canos${nome}`,num_canos.val());
    })
    num_canos.val(sessionStorage.getItem(`num_canos${nome}`))
    num_canos.trigger('change')
    /* Sistema de Carregamento */
    var calibre = $("#calibre")

    calibre.on('change',function(){
        
        sessionStorage.setItem(`calibre${nome}`,calibre.val());
    })
    calibre.val(sessionStorage.getItem(`calibre${nome}`))
    calibre.trigger('change')
    /* Regime de Tiro */
    var sistema_funcionamento = $("#sistema_funcionamento")
    sistema_funcionamento.on('change',function(){
        
        sessionStorage.setItem(`sistema_funcionamento${nome}`,sistema_funcionamento.val());
    })
    sistema_funcionamento.val(sessionStorage.getItem(`sistema_funcionamento${nome}`))
    sistema_funcionamento.trigger('change')

    /* Tipo Carregador */
    var tipo_carregador = $("#tipo_carregador")
    tipo_carregador.on('change',function(){
        
        sessionStorage.setItem(`tipo_carregador${nome}`,tipo_carregador.val());
    })
    tipo_carregador.val(sessionStorage.getItem(`tipo_carregador${nome}`))
    tipo_carregador.trigger('change')
    /* Capacidade*************************************************************** */
    var capacidade_carregador = $("#capacidade_carregador")

    if($('#capacidade_gdl').attr('capacidade')!=null){
        sessionStorage.setItem(`capacidade_carregador${nome}`,$('#capacidade_gdl').attr('capacidade'));
    }else{
    capacidade_carregador.on('input',function(){
        sessionStorage.setItem(`capacidade_carregador${nome}`,capacidade_carregador.val());
    })}
    capacidade_carregador.val(sessionStorage.getItem(`capacidade_carregador${nome}`))

    /* Sistema de Percussão */
    var sistema_percussao = $("#sistema_percussao")
    sistema_percussao.on('change',function(){
        
        sessionStorage.setItem(`sistema_percussao${nome}`,sistema_percussao.val());
    })
    sistema_percussao.val(sessionStorage.getItem(`sistema_percussao${nome}`))
    sistema_percussao.trigger('change')
    /* Sistema de Funcionamento */
    var sistema_disparo = $("#sistema_disparo")
    sistema_disparo.on('change',function(){
        
        sessionStorage.setItem(`sistema_disparo${nome}`,sistema_disparo.val());
    })
    sistema_disparo.val(sessionStorage.getItem(`sistema_disparo${nome}`))
    sistema_disparo.trigger('change')
    /* Acabamento **************************************************************************/
    var tipo_acabamento = $("#tipo_acabamento")
    if($('#acabamento_gdl').attr('acabamento')!=null){
        sessionStorage.setItem(`tipo_acabamento${nome}`,$('#acabamento_gdl').attr('acabamento'));
    }else{
    tipo_acabamento.on('change',function(){
        
        sessionStorage.setItem(`tipo_acabamento${nome}`,tipo_acabamento.val());
    })}
    tipo_acabamento.val(sessionStorage.getItem(`tipo_acabamento${nome}`))
    tipo_acabamento.trigger('change')
    /* Acabamento Outra Opção */
    if(tipo_acabamento.val()=="outros"){
        var acabamento_outra_opcao = $("#acabamento_outra_opcao")
        acabamento_outra_opcao.on('input',function(){
            sessionStorage.setItem(`acabamento_outra_opcao${nome}`,acabamento_outra_opcao.val());
        })
        acabamento_outra_opcao.attr('disabled',false)
        acabamento_outra_opcao.val(sessionStorage.getItem(`acabamento_outra_opcao${nome}`))
    }

    /* Cabo*/
    var cabo = $("#cabo")
    cabo.on('change',function(){
        
        sessionStorage.setItem(`cabo${nome}`,cabo.val());
    })
    cabo.val(sessionStorage.getItem(`cabo${nome}`))
    cabo.trigger('change')

    /* Cabo Outra Opção */
    if(cabo.val()=="outros"){
        var cabo_outra_opcao = $("#cabo_outra_opcao")
        cabo_outra_opcao.on('input',function(){
            sessionStorage.setItem(`cabo_outra_opcao${nome}`,cabo_outra_opcao.val());
        })
        cabo_outra_opcao.attr('disabled',false)
        cabo_outra_opcao.val(sessionStorage.getItem('cabo_outra_opcao${nome}'))
    }

    /* Comprimento Total */
    var comprimento_total = $("#comprimento_total")
    comprimento_total.on('input',function(){
        sessionStorage.setItem(`comprimento_total${nome}`,comprimento_total.val());
    })
    comprimento_total.val(sessionStorage.getItem('comprimento_total${nome}'))

    /* Altura */
    var altura = $("#altura")
    altura.on('input',function(){
        sessionStorage.setItem(`altura${nome}`,altura.val());
    })
    altura.val(sessionStorage.getItem(`altura${nome}`))

    /* Comprimento do Cano */
    var comprimento_cano = $("#comprimento_cano")
    comprimento_cano.on('input',function(){
        sessionStorage.setItem(`comprimento_cano${nome}`,comprimento_cano.val());
    })
    comprimento_cano.val(sessionStorage.getItem(`comprimento_cano${nome}`))
    /* Quantidade de Raias */
    var quantidade_raias = $("#quantidade_raias")
    quantidade_raias.on('input',function(){
        sessionStorage.setItem(`quantidade_raias${nome}`,quantidade_raias.val());
    })
    quantidade_raias.val(sessionStorage.getItem(`quantidade_raias${nome}`))

    /* Sentido das Raias */
    var sentido_raias = $("#sentido_raias")
    sentido_raias.on('change',function(){
        
        sessionStorage.setItem(`sentido_raias${nome}`,sentido_raias.val());
    })
    sentido_raias.val(sessionStorage.getItem(`sentido_raias${nome}`))
    sentido_raias.trigger('change')

    /* Estado Geral ******************************************************************/
    var estado_geral = $("#estado_geral")
    console.log($('#estado_geral_gdl').attr('estado_geral'))
    /* Dados vindo gdl se for diferente de null o dado e capturado*/
    if($('#estado_geral_gdl').attr('estado_geral')!=null){
        sessionStorage.setItem(`estado_geral${nome}`,$('#estado_geral_gdl').attr('estado_geral'));
    }else{
        estado_geral.on('change',function(){
        
        sessionStorage.setItem('estado_geral${nome}',estado_geral.val());
    }) }
    estado_geral.val(sessionStorage.getItem(`estado_geral${nome}`))
    estado_geral.trigger('change')

    /* Funcionamento */
    var funcionamento = $("#funcionamento")
    funcionamento.on('change',function(){
        
        sessionStorage.setItem(`funcionamento${nome}`,funcionamento.val());
    })
    funcionamento.val(sessionStorage.getItem('funcionamento${nome}'))
    funcionamento.trigger('change')

    /* N° Exame de Coleta */
    var rep_materialColetado = $("#rep_materialColetado")
    rep_materialColetado.on('input',function(){
        sessionStorage.setItem(`rep_materialColetado${nome}`,rep_materialColetado.val());
    })
    rep_materialColetado.val(sessionStorage.getItem(`rep_materialColetado${nome}`))
    /* N° Lacre de Entrada *****************************************************************/
    var numLacreEntrada = $("#numLacreEntrada")

    /* lacre vindo do gdl */
    /* Se for diferente de null a rep captura a rep vindo gdl e armazena na sessão */
    console.log($('#lacre_entrada_gdl').attr('lacre'))
    if($('#lacre_entrada_gdl').attr('lacre')!=null){
    sessionStorage.setItem(`numLacreEntrada${nome}`,$('#lacre_entrada_gdl').attr('lacre')); 
    }else{
    numLacreEntrada.on('input',function(){
        sessionStorage.setItem(`numLacreEntrada${nome}`,numLacreEntrada.val());
    })    
        
    }

    numLacreEntrada.val(sessionStorage.getItem(`numLacreEntrada${nome}`))

    /* N° Lacre de Saida **********************************************************************/
    var lacreSaida = $("#lacreSaida")
    if($('#lacre_saida_gdl').attr('lacre_saida')!=null){
        sessionStorage.setItem('lacreSaida${nome}',$('#lacre_saida_gdl').attr('lacre_saida'));
    }else{
    lacreSaida.on('input',function(){
        sessionStorage.setItem(`lacreSaida${nome}`,lacreSaida.val());
    })}
    lacreSaida.val(sessionStorage.getItem(`lacreSaida${nome}`))

    /* N° Montagem */
    var numeracao_montagem = $("#numeracao_montagem")
    numeracao_montagem.on('input',function(){
        sessionStorage.setItem(`numeracao_montagem${nome}`,numeracao_montagem.val());
    })
    numeracao_montagem.val(sessionStorage.getItem(`numeracao_montagem${nome}`))

    /*Telha*/
    var telha = $("#telha")
    telha.on('input',function(){
        sessionStorage.setItem(`telha${nome}`,telha.val());
    })
    telha.val(sessionStorage.getItem(`telha${nome}`))

    /* Coronha e Fuste */
    var coronha_fuste = $("#coronha_fuste")
    coronha_fuste.on('change',function(){
        
        sessionStorage.setItem(`coronha_fuste${nome}`,coronha_fuste.val());
    })
    coronha_fuste.val(sessionStorage.getItem(`coronha_fuste${nome}`))
    coronha_fuste.trigger('change')

    /* Coronha  */
    var coronha = $("#coronha")
    coronha.on('change',function(){
        
        sessionStorage.setItem(`coronha${nome}`,coronha.val());
    })
    coronha.val(sessionStorage.getItem(`coronha${nome}`))
    coronha.trigger('change')

    /* Tambor  */
    var tambor_rebate = $("#tambor_rebate")
    tambor_rebate.on('change',function(){
        
        sessionStorage.setItem(`tambor_rebate${nome}`,tambor_rebate.val());
    })
    tambor_rebate.val(sessionStorage.getItem(`tambor_rebate${nome}`))
    tambor_rebate.trigger('change')

    /* Tipo Tambor  */
    var tipo_tambor = $("#tipo_tambor")
    tipo_tambor.on('change',function(){
        
        sessionStorage.setItem('tipo_tambor${nome}',tipo_tambor.val());
    })
    tipo_tambor.val(sessionStorage.getItem(`tipo_tambor${nome}`))
    tipo_tambor.trigger('change')
    /* Dito oficio */
    var dito_oficio = $("#dito_oficio")
    dito_oficio.on('input',function(){
        sessionStorage.setItem(`dito_oficio${nome}`,dito_oficio.val());
    })
    dito_oficio.val(sessionStorage.getItem(`dito_oficio${nome}`))
    /* end local */
}