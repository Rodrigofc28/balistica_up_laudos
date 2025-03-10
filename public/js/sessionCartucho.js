

$(function () {
    $('#qtdEf').hide(1000)
    $('#qtdIne').hide(1000) 
    //se for percurtido e nao deflagado ele mostra preservado
    $("#condicaoCartucho").change(function () {
        if ($(this).val() === "percutido e não deflagrado") {
            $("#funcionamentoCartucho").val("preservado").change(); // Define o valor como "preservado"
            $("#lacre_saida").attr("required", true);// Define o lacre de saida como campo obrigatorio
        } else {
            
            $("#lacre_saida").removeAttr("required");
        }
    });
    //adiciona quantidade caso seja parcialmente
    $('#funcionamentoCartucho').on('change',function(){
       
        if($('#funcionamentoCartucho').val()=="parcialmente"){
            
            $('#qtdEf').show(1000)
            $('#qtdIne').show(1000)
        }
        if($('#funcionamentoCartucho').val()!="parcialmente"){
            $('#qtdEf').hide(1000)
            $('#qtdIne').hide(1000) 
        }
    })
});
 

