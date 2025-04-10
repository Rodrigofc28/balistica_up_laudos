
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    $('#cadastrar_solicitante').on('click', function () {
        $("#solicitante-modal").modal();
        $('.js-cidade-modal').val($('#cidade').val()); // Select the option with a value of '1'
        $('.js-cidade-modal').trigger('change');
    });

    $('#cadastro_solicitante').on('click', function () {
        var nome2 = $('#nome_solicitante').val();
        var cidade_id2 = $("#cidade2").val();
        let baseUrl = $('meta[name="base-url"]').attr('content'); // Obtém a base do site
        let url = baseUrl + "/solicitantes"; // Concatena a URL correta
        if (nome2.length < 8) {
            swal.fire({
                type: 'error',
                title: 'Erro!',
                text: 'O nome do órgão solicitante deve ter ao menos 8 caracteres!'
            });
        } else {
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    "nome": nome2,
                    "cidade_id": cidade_id2,
                },
                success: function (data) {
                    $('#solicitante-modal').modal('hide');
                    $('#nome_solicitante').val('');
                    $('#solicitante_id').append($('<option>', {
                        value: data.id,
                        text: data.nome
                    }));
                    $("#solicitante_id").val(data.id);
                },
                error: function () {
                    swal.fire('Existem erros no formulário!')
                }
            });
        }
    });
    // /*---------------------------------------------------------*/
    var marca = $('#marca');
    var paisOrigem=$('#pais');
    
    $('#marca').on('change',function(){
   
    
    var marca_origem=$('#marca').val();
    
    $('#pais').val(marca_origem);
    $('#pais').trigger('change');
});
    $('#cadastrar_marca').on('click', function () {
        $("#marca-modal").modal();
       
    
    });

    $('#cadastroMarca').on('click', function () {
        let baseUrl = $('meta[name="base-url"]').attr('content'); // Obtém a base do site
        let url = baseUrl + "/marcas"; // Concatena a URL correta
        var nome_marca = $('#nome').val();
        var categoria = $("#categoria").val();
        var nome_pais = $('#nome_pais').val();
        var fabricacao = $("#fabricacao").val();
        $.ajax({
            url: url,
            type: "GET",
            data: { 'nome': nome_marca, 'categoria': categoria, 'pais_origem':nome_pais,'fabricacao':fabricacao },
            success: function (data) {
                $('#marca-modal').modal('hide');
                marca.append($('<option>', {
                    value: data.id,
                    text: data.nome
                }));
                paisOrigem.append($('<option>', {
                    value: data.id,
                    text: data.pais_origem
                }));
                marca.val(data.id);
                paisOrigem.val(data.id);
            }
        });
    });

    /*------Cadastro de calibre---------------*/
    var calibre = $('#calibre');
    
    $('#cadastrar_calibre').on('click', function () {
        
        $("#calibre-modal").modal();
       

    });

    $('#cadastroCalibre').on('click', function () {
        let baseUrl = $('meta[name="base-url"]').attr('content'); // Obtém a base do site
        let url = baseUrl + "/calibres"; // Concatena a URL correta
       
        var nome_calibre = $('#nome_calibre').val();
        
        var tipo = $("input[name='calibres_armas[]']:checked") 
        .map(function () {
            return $(this).val(); 
        })
        .get();

    
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    "nome": nome_calibre,
                    "tipo_arma": tipo, 
                },
                success: function (data) {
                    console.log("Sucesso:", data);
                    $('#calibre-modal').modal('hide');
                    calibre.append($('<option>', {
                        value: data.id,
                        text: data.nome
                    }));
                    calibre.val(data.id);
                },
                error: function (xhr) {
                    console.error("Erro:", xhr.responseJSON);
                    $.ajax({
                        url: "../../../calibres/", 
                        type: "GET", 
                        data: {
                            "nome": nome_calibre,
                            "tipo_arma": tipo,
                        },
                        success: function(data) {
                            console.log("Sucesso com a URL 2:", data);
                            $('#calibre-modal').modal('hide');
                            calibre.append($('<option>', {
                                value: data.id,
                                text: data.nome
                            }));
                            calibre.val(data.id);
                        },
                        error: function(xhr, status, error) {
                            console.error("Erro com a URL 2:", error);
                        }
                    });
                }
            });
    });
    
    /*-------------------------habilitando buscar modelos-----------------------------------*/
    
$('#salva_cadastro').on('change',function(){
    $('#salva_cadastro').val(1);
    
})  

$('#sistema_carregamento').on('change',function(){
    
    if($('#sistema_carregamento').val()=='antecarga'){
        $('#calibre').attr('disabled',true)
        $('#calibre').val('')
        $('#calibre').trigger('change');
        $('#diametro_cano').attr('disabled',false)
        
    }
    if($('#sistema_carregamento').val()=='retrocarga'){
        $('#calibre').attr('disabled',false)
        $('#diametro_cano').attr('disabled',true)
       
    }
})
$(document).ready(function() {
   
    $('#sistema_carregamento').val("retrocarga")
    $('#sistema_carregamento').trigger('change');
    $('#calibre').attr('disabled',false)
    
    $('#diametro_cano').attr('disabled',true)
    })

$('#busca_cadastro').on('change',function(){
   
var buscaCadastro=$('#busca_cadastro').val();
buscaCadastro = JSON.parse(buscaCadastro);
 
var objetoBuscaCadastro=buscaCadastro;
console.log(objetoBuscaCadastro)
$('#marca').val(objetoBuscaCadastro.marca_id);
$('#marca').trigger('change');
$('#tipo_arma').val(objetoBuscaCadastro.tipo_arma);
$('#tipo_arma').trigger('change');
$('#calibre').val(objetoBuscaCadastro.calibre_id);
$('#calibre').trigger('change');
$('#origem_id').val(objetoBuscaCadastro.origem_id);
$('#origem_id').trigger('change');
$('#altura').val(objetoBuscaCadastro.altura);
$('#altura').trigger('change');
$('#bandoleira').val(objetoBuscaCadastro.bandoleira);
$('#bandoleira').trigger('change');
$('#cabo').val(objetoBuscaCadastro.cabo);
$('#cabo').trigger('change');
$('#calibre_real_help').val(objetoBuscaCadastro.calibre_real);
$('#calibre_real_help').trigger('change');
$('#cao').val(objetoBuscaCadastro.cao);
$('#cao').trigger('change');
$('#capacidade_carregador').val(objetoBuscaCadastro.capacidade_carregador);
$('#capacidade_carregador').trigger('change');
$('#capacidade_tambor').val(objetoBuscaCadastro.campacidade_tambor);
$('#capacidade_tambor').trigger('change');
$('#carregador').val(objetoBuscaCadastro.carregador);
$('#carregador').trigger('change');
$('#carregamento').val(objetoBuscaCadastro.carregamento);
$('#carregamento').trigger('change');
$('#chave_abertura').val(objetoBuscaCadastro.chave_abertura);
$('#chave_abertura').trigger('change');
$('#comprimento_cano').val(objetoBuscaCadastro.comprimento_cano);
$('#comprimento_cano').trigger('change');
$('#comprimento_total').val(objetoBuscaCadastro.comprimento_total);
$('#comprimento_total').trigger('change');
$('#coronha').val(objetoBuscaCadastro.coronha);
$('#coronha').trigger('change');
$('#coronha_fuste').val(objetoBuscaCadastro.coronha_fuste);
$('#coronha_fuste').trigger('change');
$('#diametro_cano').val(objetoBuscaCadastro.diametro_cano);
$('#diametro_cano').trigger('change');
$('#disposicao_canos').val(objetoBuscaCadastro.disposicao_canos);
$('#disposicao_canos').trigger('change');
$('#modelo').val(objetoBuscaCadastro.modelo);
$('#modelo').trigger('change');
$('#num_canos').val(objetoBuscaCadastro.num_canos);
$('#num_canos').trigger('change');
$('#placas_laterais').val(objetoBuscaCadastro.placas_laterais);
$('#placas_laterais').trigger('change');
$('#quantidade_raias').val(objetoBuscaCadastro.quantidade_raias);
$('#quantidade_raias').trigger('change');
$('#retem_carregador').val(objetoBuscaCadastro.retem_carregador);
$('#retem_carregador').trigger('change');
$('#sentido_raias').val(objetoBuscaCadastro.sentido_raias);

$('#sentido_raias').trigger('change');
$('#sistema_carregamento').val(objetoBuscaCadastro.sistema_carregamento);
$('#sistema_carregamento').trigger('change');
$('#sistema_engatilhamento').val(objetoBuscaCadastro.sistema_engatilhamento);
$('#sistema_engatilhamento').trigger('change');

$('#sistema_funcionamento').val(objetoBuscaCadastro.sistema_funcionamento);
$('#sistema_funcionamento').trigger('change');
$('#sistema_inflamacao').val(objetoBuscaCadastro.sistema_inflamacao);
$('#sistema_inflamacao').trigger('change');
$('#sistema_percussao').val(objetoBuscaCadastro.sistema_percussao);
$('#sistema_percussao').trigger('change');
$('#tambor_rebate').val(objetoBuscaCadastro.tambor_rebate);
$('#tambor_rebate').trigger('change');
$('#tipo_tambor').val(objetoBuscaCadastro.tipo_tambor);
$('#tipo_tambor').trigger('change');
$('#teclas_gatilho').val(objetoBuscaCadastro.teclas_gatilho);
$('#teclas_gatilho').trigger('change');
$('#telha').val(objetoBuscaCadastro.telha);
$('#telha').trigger('change');
$('#trava_ferrolho').val(objetoBuscaCadastro.trava_ferrolho);
$('#trava_ferrolho').trigger('change');
$('#trava_gatilho').val(objetoBuscaCadastro.trava_gatilho);
$('#trava_gatilho').trigger('change');
$('#trava_seguranca').val(objetoBuscaCadastro.trava_seguranca);
$('#trava_seguranca').trigger('change');

$('#sistema_disparo').val(objetoBuscaCadastro.sistema_disparo);
$('#sistema_disparo').trigger('change');
$('#tipo_carregador').val(objetoBuscaCadastro.tipo_carregador);
$('#tipo_carregador').trigger('change');
$('#imagemModeloCantoDireito').attr('src', objetoBuscaCadastro.imagemCantoInferior);
$('#imagemModeloCantoEsquerdo').attr('src', objetoBuscaCadastro.imagemCantoSuperior);
});


});
