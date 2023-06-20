
$(function () {
    
    var tipo_municao = $('#tipo_municao');
    var nao_deflagrado = $('#nao_deflagrado');
    var projetil = $("#projetil");
    var tipo_projetil = $("#tipo_projetil");
    var estojo = $("#estojo");
    var funcionamento = $("#funcionamento");
    var div_nao_deflagrado = $("#div_nao_deflagrado");
    
    if (tipo_municao.val() === 'estojo') {
        if_estojo();
    }
    if (tipo_municao.val() === 'cartucho') {
        if_cartucho();
    }
    if ($(nao_deflagrado).is(':checked')) {
        $(this).val('true');
    } else {
        $(this).val('false');
    }

    tipo_municao.on('change', function () {
        if ($(this).val() === "cartucho") {
            if_cartucho();
        }
        if ($(this).val() === "estojo") {
            if_estojo();
            
        }
        if ($(this).val() === "projétil") {
            if_projetil();
        }
    });

    nao_deflagrado.on('change', function () {
        if ($(this).is(':checked')) {
            $(this).val("true");
            funcionamento.val("ineficiente");
            funcionamento.trigger('change');
        } else {
            $(this).val("false");
        }
    });
    
    function if_cartucho() {
        projetil.attr('disabled', false);
        tipo_projetil.attr('disabled', false);
        estojo.attr('disabled', false);
        funcionamento.attr('disabled', false);
        div_nao_deflagrado.show();
        $('#institutoArma').attr('disabled',false);
        $('#coleta').attr('disabled',false);
        $('#funcionamentoCartucho').attr('disabled',false) 

        $('#condicaoCartucho').attr('disabled',false)
        $('#condicaoEstojo').attr('disabled',true)
        $('#condicao_estojo').hide(1000)
        $('#condicao_cartucho').show(1000)
        $('#projetil_cartucho').show(1000)
        $('#cartucho_checkbox').show(1000)
        $('#condicaoCartucho').on('change',function(){
        if($('#condicaoCartucho').val()=="percutido e não deflagrado"){
            $('#funcionamentoCartucho').attr('disabled',true)
            $('#funcionamentoCartucho').val("")
            $('#institutoArma').val('');
            $('#coleta').val('');
            $('#institutoArma').attr('disabled',true);
            $('#coleta').attr('disabled',true);
            
        }else{
            $('#funcionamentoCartucho').attr('disabled',false)
            $('#institutoArma').attr('disabled',false);
            $('#coleta').attr('disabled',false);
        }
    })
    }
    
    
    function if_estojo() {
        
        estojo.attr('disabled', false);
        projetil.attr('disabled', true);
        tipo_projetil.attr('disabled', false);
       div_nao_deflagrado.hide();
       $('#condicaoCartucho').attr('disabled',true)
       
       $('#condicaoEstojo').attr('disabled',false)
       $('#condicao_cartucho').hide(10)
       $('#condicao_estojo').show(1000)
       $('#projetil_cartucho').hide(10)
       $('#cartucho_checkbox').hide(10)
       $('#condicaoEstojo').on('change',function(){
             
        if($('#condicaoEstojo').val()=="percutido e deflagrado"){
            $('#funcionamentoCartucho').attr('disabled',true)
          
        }else{
            $('#funcionamentoCartucho').attr('disabled',false)
        }
    })
        
        
       
        $('#institutoArma').val('');
        $('#coleta').val('');
        $('#institutoArma').attr('disabled',true);
        $('#coleta').attr('disabled',true);
        
    }
    
    $('#qtdEf').hide()
    $('#qtdIne').hide()
    $('#funcionamentoCartucho').on('change',function(){
       
        if($('#funcionamentoCartucho').val()=="parcialmente eficiente"){
            
            $('#qtdEf').show(1000)
            $('#qtdIne').show(1000)
        }
        if($('#funcionamentoCartucho').val()!="parcialmente eficiente"){
            $('#qtdEf').hide(1000)
            $('#qtdIne').hide(1000) 
        }
    })
});
